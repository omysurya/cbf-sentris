<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminUserController extends Controller
{

    public function getProfile() {
        
        $this->pageTitle('Profile');

        return view('admin.profile');
    }

    public function postProfile(Request $request) {
        validation([
            'nama_lengkap'=>'required|string|max:25',
            'no_telp'=>'required|numeric',
            'alamat'=>'required|string|max:150',
            'email'=>'required|email',
            'foto'=>'image',          
            'username'=>'required'          
            ]);

        $user = getUser();

        if(DB::table('user')->where('username',p('username'))->whereNull('deleted_at')->where('status','enable')->where('user.id','!=',$user->id)->count() != 0) {
            goBack('Maaf username yang anda masukkan sudah ada yang menggunakan');
        }


        if(DB::table('karyawan')->where('email',p('email'))->whereNull('deleted_at')->where('karyawan.id','!=',$user->id_karyawan)->count() != 0) {
            goBack('Maaf email yang anda masukkan sudah ada yang menggunakan');
        }

        $a = [];
        $a['username'] = p('username');
        if(p('password')) {
            $a['password'] = \Hash::make(p('password'));
        }
        try{
            DB::table('user')->where('id',$user->id)->update($a);            
        }catch(\Exception $e) {
            goBack('Aduh, ada sesuatu yang tidak beres, baiklah ini sangat memalukan, kami akan segera memperbaiki secepatnya!');
            \Log::warning($e);
        }


        $a = [];
        $a['nama_lengkap'] = p('nama_lengkap');
        $a['no_telp'] = p('no_telp');
        $a['alamat'] = p('alamat');
        $a['email'] = p('email');     

        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension();
            $filename = md5(str_random(5)).'.'.$ext;
            $dest = 'uploads/'.date('Y-m');
            @mkdir(public_path($dest));
            $file->move(public_path($dest),$filename);
            $a['foto'] = $dest.'/'.$filename;
        } 
        
        try{
            DB::table('karyawan')->where('id',$user->id_karyawan)->update($a);
            goBack('Data profile anda berhasil disimpan !','success');
        }catch(\Exception $e) {
            goBack('Aduh, ada sesuatu yang tidak beres, baiklah ini sangat memalukan, kami akan segera memperbaiki secepatnya!');
            \Log::warning($e);
        }
    }

    public function getIndex() {

        $this->pageTitle('User');

        $result = DB::table('user');
        $result->leftjoin('karyawan','karyawan.id','=','id_karyawan');
        $result->leftjoin('role','role.id','=','user.id_role');     
        $result->select('user.*',
            'karyawan.kode as karyawan_kode',
            'karyawan.regid',
            'karyawan.nama_lengkap as karyawan_nama',
            'role.nama as role_nama');
        $result->whereNull('user.deleted_at');  
        if(g('search_type')) $result->where('role.nama',g('search_type'));

        $result->orderby('karyawan.kode','asc');
        $result->orderby('user.created_at','asc');
        $result->where('user.username','!=','admin');
        if(g('search_text')) {
            $result->where(function($w) {
                $w->where('karyawan.nama_lengkap','like','%'.g('search_text').'%')
                ->orWhere('role.nama','like','%'.g('search_text').'%')
                ->orWhere('user.kode_sales','like','%'.g('search_text').'%')
                ->orWhere('user.username','like','%'.g('search_text').'%');
            });
        }

        $data['result'] = $result->paginate(20);
        return view('admin.user.index',$data);        
    } 

    public function getLogout($id_user) {
        $user = first('user',$id_user);
        $k = first('karyawan',$user->id_karyawan);

        DB::table('karyawan')->where('id',$user->id_karyawan)->update(['regid'=>NULL]);
        DB::table('user')->where('id_karyawan',$user->id_karyawan)->update(['is_online'=>0]);
        sendFCM([$k->regid],['title'=>'Account Logout','content'=>'Maaf akun login pada device lain','command'=>'logout']);

        goBack('Berhasil melogout user','success');
    }

    public function getAdd($id=NULL) {
        $this->pageTitle('Tambah User');
        
        $user = DB::table('user')->where('id_karyawan',$id)->orderby('user.id','desc')->whereNull('deleted_at')->first();
        $data['user'] = $user;

        $data['karyawan'] = $k = first('karyawan',$id);
        // exit($k->kode);
        $kodeSales = substr_replace($k->kode, '.', 2, 0);
        $alpha = range('A','Z');
        $lastAlpha = substr($user->kode_sales, -1, 1);
        if($lastAlpha) {            
            $newAlphaIndex = array_search($lastAlpha, $alpha);
        }else{
            $newAlphaIndex = -1;                   
        }
        $newAlpha = $alpha[$newAlphaIndex+1]; 
        $lastCount = $newAlphaIndex+2;
        // $lastCount = DB::table('user')->whereNull('deleted_at')->where('id_karyawan',$id)->count();
        $kodeSales = $kodeSales.$newAlpha;
        $data['kode_sales'] = $kodeSales;
        $data['username'] = $k->kode.$lastCount;
        return view('admin.user.add',$data);
    } 

    public function postAdd($id) {
        validation([
            'id_role'=>'required|integer',            
            'password'=>'required|string|max:32',
            'ulangi_password'=>'required|string|max:32',                        
            'username'=>'required|string|max:30|unique:user,username,NULL,id,deleted_at,NULL'
            ]);

        if(p('password')) {
            if(p('ulangi_password')=='') {
                return redirect()->back()->with(['message'=>'Anda harus mengkonfirmasikan password!','message_type'=>'warning'])->withInput();
            }else{
                if(p('password') != p('ulangi_password')) {
                    return redirect()->back()->with(['message'=>'Password ulang anda tidak cocok!','message_type'=>'warning'])->withInput();
                }
            }
        }

        $karyawan = first('karyawan',$id);
        $a                = [];
        $a['created_at']  = now();        
        $a['id_karyawan'] = $id;                
        $a['id_role']     = p('id_role');
        $a['username']    = p('username');  
        $a['kode_sales']  = p('kode_sales');
        $a['status']      = 'enable';

        if(p('password')) {
            $a['password'] = \Hash::make(p('password'));
        }
        DB::table('user')->insert($a);

        goAction('AdminUserController@getIndex','Berhasil menambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit User');
        $data['row'] = first('user',$id);
        $data['user_role'] = first('role',$data['row']->id_role);
        $data['karyawan'] = first('karyawan',$data['row']->id_karyawan);
        return view('admin.user.edit',$data);
    }

    public function postEdit($id) {
        validation([
            'id_role'=>'required|integer',                                                       
            'username'=>'required|string|max:30|unique:user,username,'.$id.',id,deleted_at,NULL',
            'kode_sales'=>'required|unique:user,kode_sales,'.$id.',id,deleted_at,NULL'
            ]);
        
        $a                = [];
        $a['updated_at']  = now();                             
        $a['id_role']     = p('id_role');
        $a['username']    = p('username');  
        $a['kode_sales']  = p('kode_sales');
        $a['status']      = 'enable';              
        if(p('password')) {
            $a['password'] = \Hash::make(p('password'));
        }
        DB::table('user')->where('id',$id)->update($a);

        goAction('AdminUserController@getIndex','Berhasil mengubah data!');
    }

    public function getDetail($id_karyawan) {
        $this->pageTitle('Detail User');
        $row = DB::table('karyawan')->where('id',$id_karyawan)->first();
        $data['row'] = $row;
        $data['user'] = first('user',['id_karyawan'=>$id_karyawan,'status'=>'enable']);
        return view('admin.user.detail',$data);
    }

    public function getChooseKaryawan() {
        $res = [];
        $res['draw'] = g('draw');
        $res['recordsTotal'] = 0;
        $res['recordsFiltered'] = 0;
        $res['data'] = [];

        $result = DB::table('karyawan');
        $result->whereNull('karyawan.deleted_at');

        if(g('search')) {
            $result->where('nama_lengkap','like','%'.g('search')['value'].'%');
        }

        $recordsTotal = clone $result;
        $recordsFiltered = clone $result;
        $recordsTotal = $recordsTotal->count();
        $recordsFiltered = $recordsFiltered->count();

        $result->select('karyawan.*',
            DB::raw("(select username from user where user.id_karyawan = karyawan.id and user.deleted_at IS NULL and user.status = 'enable' order by user.id desc limit 1) as user_terakhir"));
        $result->orderby('karyawan.nama_lengkap','asc');   
        $result->whereNull('karyawan.deleted_at');
        $result->where('status','=','1');
        $result->take(g('length'));
        $result->skip(g('start'));
        $data = $result->get();     
        $res['recordsTotal'] = $recordsTotal;   
        $res['recordsFiltered'] = $recordsFiltered;           
        foreach($data as $r) {
            $res['data'][] = [                
                $r->nama_lengkap,
                $r->user_terakhir,
                str_limit($r->alamat,50),
                "<a href='javascript:;' onclick='pilihKaryawan($r->id)' class='btn btn-primary'>Pilih</a>"
            ];
        }

        return response()->json($res);
    }

    public function getActive($id) {
        $row = first('user',$id);
        // DB::table('user')->where('id_karyawan',$row->id_karyawan)->update(['status'=>'disable']);

        DB::table('user')->where('id',$id)->update(['status'=>'enable']);
        goBack('Berhasil mengubah status!','success');
    }
    public function getUnactive($id) {
        $row = first('user',$id);
        // DB::table('user')->where('id_karyawan',$row->id_karyawan)->update(['status'=>'disable']);
        
        DB::table('user')->where('id',$id)->update(['status'=>'disable']);
		//Disable dari jabatan
		//DB::table('user_jabatan')->where('id_user',$id)->update(['is_active'=>0]);

        goBack('Berhasil mengubah status!');   
    }

    public function getDelete($id) {
        if($id!='1606'){ // Jika buka id admin
            DB::table('user')->where('id',$id)->update(['deleted_at'=>now()]);  
			//Disable dari jabatan
			//DB::table('user_jabatan')->where('id_user',$id)->update(['is_active'=>0]);
            goBack('Berhasil menghapus data!');
        }else{
            goBack('Superadmin tidak bisa dihapus.');
        }
    }
}

