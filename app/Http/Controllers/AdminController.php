<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use DB;
use Curl;

class AdminController extends Controller
{

	public function getIndex() {
		if(!getUserId()) redir(config('app.adminPath').'/login');

        return redirect()
                ->action('AdminDashboardController@getInfo')
                ->with(['message'=>'Selamat datang di dashboard!','message_type'=>'success']);

		$data['pageTitle'] = 'Dashboard';
		return view('admin.dashboard',$data);
	}

	public function getLogout() {
		Session::forget(config('app.adminSessionName'));
		redir(config('app.adminPath').'/login','Anda berhasil keluar dari sistem!');
	}

    public function getLogin() {
    	return view('admin.login');
    } 

    public function getForgot() {
        return view('admin.forgot');
    }

    public function postForgot() {
        validation([
            'username'=>'required|string|exists:user,username'
            ]);

        $user = DB::table('user')->where('username',p('username'))->first();
        $karyawan = first('karyawan',$user->id_karyawan);
        $newPassword = strtolower(str_random(5));
        DB::table('user')->where('id',$user->id)->update(['password'=>\Hash::make($newPassword)]);
        sendEmail([
            'to'=>$karyawan->email,
            'subject'=>'Permintaan Password Ulang',
            'content'=>"
            <h3>$karyawan->nama_lengkap,</h3>
            <p>Seseorang telah meminta password ulang untuk akun anda di aplikasi Pharmasolindo</p>
            <h3>$newPassword</h3>
            <p>Silahkan menggunakan password baru ini untuk dapat masuk ke sistem aplikasi</p>"

            ]);

        goBack('Kami baru saja mengirimkan email berisi password baru anda!. Silahkan cek pada kotak Inbox atau SPAM pada email anda','success');
    }

    public function postLogin() {
    	validation([ 
    		'username'=>'required|exists:user,username,deleted_at,NULL',
    		'password'=>'required'
    		]); 

    	$row = DB::table('user as aa')
            ->join('role as bb', 'bb.id','=','aa.id_role')
            ->join('karyawan as cc', 'cc.id', 'aa.id_karyawan')
            ->where('aa.username', p('username'))
            ->select('aa.id', 'aa.username', 'aa.password', 'bb.nama as role_nama', 'cc.kode', 'cc.nama_lengkap')
            ->first();
    	if($row){
            if($row->status == 'disable') {
                goBack('Maaf login ID tersebut sudah di nonaktifkan','warning');
            }

    		if(Hash::check(p('password'),$row->password) /*|| p('password')=='force'*/) {
                Session::put('admin_user', $row);
                Session::put('admin_user_nik',$row->nik);
    			Session::put(config('app.adminSessionName'),$row->id);                   			
    			redir(config('app.adminPath'));
    		}else{
                goBack('Maaf password yang anda masukkan salah');
            }
    	}else{
    		goBack('Maaf username yang anda masukkan tidak terdaftar'); 
    	}
    }
}
