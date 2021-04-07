<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;

class ApiUserController extends Controller
{       
    private $userID;
    private $userData;  
    private $userKaryawan;  
    private $userRole;
    public function __construct() {
        @$this->userID = Cache::get('appsLogin'.p('sessionID'));
        @$this->userData = first('user',['id'=>$this->userID]);
        @$this->userKaryawan = first('karyawan',['id'=>$this->userData->id_karyawan]);
        @$this->userRole = first('role',['id'=>$this->userData->id_role]);
    }

    public function postPing() {
        validation(['latitude'=>'required|string','longitude'=>'required|string'],'json');
        try{
            $status = getSetting('visit_dokter_baru')?:0;

            $fields = [
                'last_online_datetime'=>now(),
                'is_online'=>1,
                'last_latitude'=>p('latitude'),
                'last_longitude'=>p('longitude')];
            DB::table('user')->where('id',$this->userID)->update($fields);
            return response()->json(['api_status'=>1,'api_message'=>'success','fields'=>$fields,'status_visit_dokter_baru'=>$status]);
        }catch(\Exception $e) {
            return response()->json(['api_status'=>0,'api_message'=>'Terjadih kesalahan sistem!','error'=>$e]);
        }
    }

       
    public function getProfile() {
        $row = first('user',$this->userID);
        $karyawan = first('karyawan',$row->id_karyawan);

        $item = [];
        $item['nama_lengkap'] = $karyawan->nama_lengkap;
        $item['no_telp'] = $karyawan->no_telp;
        $item['alamat'] = $karyawan->alamat;
        $item['email'] = $karyawan->email;
        $item['username'] = $row->username;
        $item['foto'] = ($karyawan->foto)?asset($karyawan->foto):'';

        return response()->json(['api_status'=>1,'api_message'=>'success','item'=>$item]);
    }

    public function postUpdatePassword(Request $request) {
        validation([            
            'password'=>'required'
            ]);
        DB::table('user')->where('id',$this->userID)->update(['password'=>\Hash::make(p('password'))]);

        return response()->json(['api_status'=>1,'api_message'=>'success']);
    }

    public function postUpdateProfile(Request $request) {        
        validation([
            'nama_lengkap'=>'required|string',
            'no_telp'=>'required|numeric',
            'alamat'=>'required',
            'foto'=>'image',
            'email'=>'required|email|unique:karyawan,email,'.$this->userID.',id,deleted_at,NULL',
            'username'=>'required|unique:user,username,'.$this->userID.',id,deleted_at,NULL',
            'password'=>'string'
            ],'json');
        try{
            $a = [];
            $a['username'] = p('username');
            if(p('password')) {
                $a['password'] = \Hash::make(p('password'));
            }
            DB::table('user')
            ->where('id',$this->userID)
            ->update($a);

            $user = first('user',$this->userID);

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

            DB::table('karyawan')->where('id',$user->id_karyawan)->update($a);

            return response()->json(['api_status'=>1,'api_message'=>'Berhasil menyimpan data profile.']);
        }catch(\Exception $e) {
            return response()->json(['api_status'=>0,'api_message'=>'Oops terjadi kesalahan sistem!']);
            \Log::warning($e);
        }        
    }
}
