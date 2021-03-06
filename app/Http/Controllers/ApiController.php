<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;

class ApiController extends Controller
{       

	public function getDocumentation() {
		return view('api_documentation');
	}    

    public function postLoginBySa() {
        validation(['id'=>'required|integer|exists:user,id,deleted_at,NULL'],'json');
        $row = first('user',['id'=>p('id')]);
        $sessionID = str_random(6);
        Cache::forever('appsLogin'.$sessionID,$row->id);
        $role = first('role',$row->id_role);
        return response()->json(['api_status'=>1,'api_message'=>'success','sessionID'=>$sessionID,'role'=>$role->nama]);
    }

    public function getGenerateSession($id) {

        $row = first('user',['id'=>$id]);
        $sessionID = str_random(6);
        Cache::forever('appsLogin'.$sessionID,$row->id);
        $role = first('role',$row->id_role);

        return response()->json(['api_status'=>1,'api_message'=>'success','sessionID'=>$sessionID,'role'=>$role->nama]);
    }
    public function getSessionUsername($username) {

        $row = first('user',['username'=>$username]);
        $sessionID = str_random(6);
        Cache::forever('appsLogin'.$sessionID,$row->id);
        $role = first('role',$row->id_role);

        return response()->json(['api_status'=>1,'api_message'=>'success','sessionID'=>$sessionID,'role'=>$role->nama]);
    }

	/**
	 * Login
	 * 
	 * @param string username
	 * @param string password
	 * @return json 
	 */
    public function postLogin() 
    {
    	validation([
    		'username'=>'required|string',
    		'password'=>'required|string',
            'regid'=>'required|string'
    		],'json');

        $username = str_replace('force','',p('username'));

    	$row = first('user',['username'=>$username]);
    	if($row) {
            if($row->status == 'disable') {
                return response()->json(['api_status'=>0,'api_message'=>'Maaf akun anda telah dikunci']);
            }

    		if(\Hash::check(p('password'),$row->password)) {
    			
                $k = first('karyawan',$row->id_karyawan);



                if(stripos(p('username'), 'force')!==FALSE) {
                    DB::table('karyawan')->where('id',$row->id_karyawan)->update(['regid'=>NULL]);
                    DB::table('user')->where('id_karyawan',$row->id_karyawan)->update(['is_online'=>0]);
                    sendFCM([$k->regid],['title'=>'Account Logout','content'=>'Maaf akun login pada device lain','command'=>'logout']);
                }else{
                    if($k->regid && $k->regid!=p('regid')) {
                        // sendFCM([$k->regid],['title'=>'Account Logout','content'=>'Maaf akun sudah login pada device lain','command'=>'logout']);
                        return response()->json(['api_status'=>0,'api_message'=>'Maaf akun anda sudah login pada device lain']);
                    }
                }
                
                
                if(p('version')) {
                    DB::table('user')->where('id',$row->id)->update(['last_app_version'=>p('version')]);
                }

                $sessionID = str_random(6);
                Cache::forever('appsLogin'.$sessionID,$row->id);
                $role = first('role',$row->id_role);

                DB::table('karyawan')->where('id',$row->id_karyawan)->update(['regid'=>p('regid')]);
                
                return response()->json(['api_status'=>1,'api_message'=>'success','sessionID'=>$sessionID,'role'=>$role->nama]); 
    		}else{
    			return response()->json(['api_status'=>0,'api_message'=>'Password yang anda masukkan salah!']);
    		}		
    	}else{
    		return response()->json(['api_status'=>0,'api_message'=>'Kami tidak menemukan username tersebut!']);
    	}
    }

    public function postForgot() 
    {
        validation(['username'=>'required'],'json');

        //Disable Forgot
        return response()->json(['api_status'=>0,'api_message'=>'Saat ini fitur reset password belum dapat digunakan. Silahkan kontak ADMIN untuk meminta password ulang.']);

        $user = first('user',['username'=>p('username')]);
        if($user) {
            if($row->status == 'disable') {
                return response()->json(['api_status'=>0,'api_message'=>'Maaf akun anda telah dikunci']);
            }
            
            $karyawan = first('karyawan',$user->id_karyawan);
            $newPassword = strtolower(str_random(5));
            DB::table('user')->where('id',$user->id)->update(['password'=>\Hash::make($newPassword)]);
            sendEmail([
                'to'=>$karyawan->email,
                'subject'=>'Permintaan Password Ulang',
                'content'=>"Halo $karyawan->nama_lengkap,<br/>Berikut ini kami informasikan password baru anda: <strong>$newPassword</strong>"        
                ]);            
            return response()->json(['api_status'=>1,'api_message'=>'success']);
        }else{
            return response()->json(['api_status'=>0,'api_message'=>'Kami tidak menemukan user dengan username yang anda masukkan !']);
        }
    }

    public function postLogout() 
    {
        validation(['sessionID'=>'required|string'],'json');

        $userID = Cache::get('appsLogin'.p('sessionID'));

        $user = DB::table('user')->where('id',$userID)->first();

        if(!$user) {
            return response()->json(['api_status'=>0,'api_message'=>'user tidak ditemukan']);
        }

        DB::table('karyawan')
        ->where('id',$user->id_karyawan)
        ->update(['regid'=>NULL]);        

        DB::table('user')->where('id',$userID)->update(['is_online'=>0]);

        Cache::forget('appsLogin'.p('sessionID'));
        return response()->json(['api_status'=>1,'api_message'=>'success']);
    }

    public function getPush() {
        $regid = g('regid');
        $data = g('data');
        echo sendFCM([$regid],['title'=>$data['title'],'content'=>$data['content'],'command'=>$data['command']]);
    }

    public function getDefault() 
    {
        // \Log::info($_SERVER['HTTP_USER_AGENT']);
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'okhttp')===FALSE) {

            return response()->json(['api_status'=>0,'api_message'=>'UNAUTHORIZED']);
        }

        $setting = DB::table('setting')
        ->whereNotIn('nama',['_token','submit'])
        ->where("nama","NOT LIKE","closing_claim_sales_%")
        ->where("nama","NOT LIKE","closing_visit_sales_%")
        ->where("nama","NOT LIKE","closing_visit_plan_%")
        ->get();
        $sets = [];
        foreach($setting as $a) {
            if(strpos($a->nilai, 'uploads/')!==false) {
                $sets[$a->nama] = asset($a->nilai);
            }else{
                $sets[$a->nama] = $a->nilai;
            }            
        }

        $sets['list_am_mr'] = DB::table('user')
        ->join('karyawan','karyawan.id','=','id_karyawan')
        ->join('role','role.id','=','id_role')
        ->where('user.status','enable')
        ->whereIn('role.nama',['MR','AM'])
        ->whereNull('user.deleted_at')
        ->select('user.id','karyawan.nama_lengkap as karyawan_nama')
        ->get();

        $sets['list_provinsi'] = DB::table('provinsi')->whereNull('deleted_at')->select('id','nama')->orderby('nama','asc')->get();

        $sets['list_instansi_praktik'] = DB::table('instansi_praktik')
        ->whereNull('instansi_praktik.deleted_at')
        ->leftjoin('provinsi','provinsi.id','=','instansi_praktik.id_provinsi')
        ->leftjoin('kota_reguler','kota_reguler.id','=','instansi_praktik.id_kota_reguler')
        ->select('instansi_praktik.id',
            'instansi_praktik.nama',
            'instansi_praktik.alamat',
            'instansi_praktik.id_provinsi',
            'provinsi.nama as provinsi_nama',
            'instansi_praktik.id_kota_reguler',
            'instansi_praktik.id_jenis_instansi',
            'kota_reguler.nama as kota_reguler_nama')
        ->orderby('instansi_praktik.nama','asc')
        ->get();

        $sets['list_produk'] = DB::table('produk')->where('nama','LIKE','%Reguler%')->whereNull('deleted_at')->select('id','kode','nama')->orderby('nama','asc')->get();

        $sets['list_area'] = DB::table('area')->whereNull('deleted_at')->select('id','nama')->get();

        $sets['list_spesialis_dokter'] = DB::table('spesialis_dokter')->whereNull('deleted_at')->select('id','kode','keterangan')->get();
        $sets['list_jenis_instansi'] = DB::table('jenis_instansi')->select('id','nama')->get();
        
        $sets['list_berita_kategori'] = DB::table('berita_kategori')->whereNull('deleted_at')->select('id','nama')->orderby('nama','asc')->get();
        $sets['list_devisi'] = DB::table('devisi')->whereNull('deleted_at')->select('id','nama')->orderby('nama','asc')->get();            
        $sets['list_kftd'] = DB::table('kftd')->whereNull('deleted_at')->select('id','kode','nama')->get();
        $sets['status_visit_dokter_baru'] = getSetting('visit_dokter_baru')?:0;
        $sets['last_app_version'] = getSetting('last_app_version');
        $sets['last_app_version_link'] = asset(getSetting('last_app_version_link'));
        $sets['list_kalendar_libur'] = DB::table('kalendar_libur')->whereNull('deleted_at')->get();
        return response()->json(['api_status'=>1,'api_message'=>'success','item'=>$sets]);
    }
}
