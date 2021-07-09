<?php

namespace App\Http\Controllers;
error_reporting(E_ALL ^ E_NOTICE);

use Illuminate\Http\Request;
use Illuminate\Support;
use DB;

class AdminDashboardController extends Controller
{  

    public function getInfo() {
        $this->pageTitle('Info Dari Pusat');
        $data=[];
        
        $data['result'] = DB::table('berita')
        ->join('berita_kategori','berita_kategori.id','=','id_berita_kategori')
        ->join('user','user.id','=','berita.id_user')
        ->join('karyawan','karyawan.id','=','user.id_karyawan')
        ->select('berita.*','berita_kategori.nama as berita_kategori_nama','karyawan.nama_lengkap as karyawan_nama')
        ->where('berita.status','publish')
        ->whereNull('berita.deleted_at')
        ->orderByRaw("DATE(berita.created_at) desc, berita.id desc")        
        ->paginate(10);        

        return view('admin.dashboard.info',$data);
    }

    public function getInfoDetail($id) {
        $this->pageTitle('Info Dari Pusat');

        $data['row'] = DB::table('berita')
        ->join('berita_kategori','berita_kategori.id','=','id_berita_kategori')
        ->join('user','user.id','=','berita.id_user')
        ->join('karyawan','karyawan.id','=','user.id_karyawan')
        ->select('berita.*','berita_kategori.nama as berita_kategori_nama','karyawan.nama_lengkap as karyawan_nama')
        ->where('berita.id',$id)
        ->first();

        return view('admin.dashboard.info_detail',$data);
    }
}
