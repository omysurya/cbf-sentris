<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Cache;

class ApiBeritaController extends Controller
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

       
    public function getIndex() {
        validation([            
            'offset'=>'integer',
            'limit'=>'integer'
            ]);

        $limit  = g('limit')?:10;
        $offset = (g('offset'))?g('offset'):0;
        
        $rows = DB::table('berita');        
        $rows->join('berita_kategori','berita_kategori.id','=','berita.id_berita_kategori');
        $rows->leftjoin('devisi','devisi.id','=','berita.id_devisi');
        $rows->select('berita.id','berita.judul',
            'berita.created_at',
            'berita.isi',
            'berita_kategori.nama as berita_kategori_nama'
            ,'berita.status',
            DB::raw('IFNULL(devisi.nama,"Semua Divisi") as devisi_nama'));
        $rows->orderby('berita.created_at','desc');
        $rows->whereNull('berita.deleted_at');
        $rows->where('berita.status','Publish');
        $rows->take($limit);
        $rows->skip($offset);

        $items = $rows->get();

        foreach($items as &$item) {
            $item->isi_raw = strip_tags($item->isi);
        }
 
        $resp = [];
        $resp['api_status'] = 1;
        $resp['api_message'] = 'success';
        $resp['items'] = $items;
        return response()->json($resp);
    }

    public function postCreate() {
        validation([
            'id_devisi'=>'required',
            'judul'=>'required',
            'isi'=>'required',
            'id_berita_kategori'=>'required',
            'status'=>'required|in:publish,pending'
            ],'json');
        $a = [];
        $a['created_at'] = now();
        $a['id_devisi'] = p('id_devisi');
        $a['judul'] = p('judul');
        $a['isi'] = p('isi');
        $a['id_berita_kategori'] = p('id_berita_kategori');        
        $a['status'] = p('status');
        $a['id_user'] = $this->userID;
        $id = DB::table('berita')->insertGetId($a);

        //Send Notifikasi
        $rows = DB::table('berita');        
        $rows->join('berita_kategori','berita_kategori.id','=','berita.id_berita_kategori');
        $rows->leftjoin('devisi','devisi.id','=','berita.id_devisi');
        $rows->select('berita.id','berita.judul',
            'berita.created_at',
            'berita.isi',
            'berita_kategori.nama as berita_kategori_nama'
            ,'berita.status',
            DB::raw('IFNULL(devisi.nama,"Semua Divisi") as devisi_nama'));
        $rows->where('berita.id',$id);
        $item = $rows->first();
        $item->isi_raw = strip_tags($item->isi);     

        $regids = DB::table('karyawan');
        $regids->whereNull('deleted_at');
        $regids->whereNotNull('regid');
        if(p('id_devisi')!=0) $regids->where('id_devisi',Request::get('id_devisi'));
        $regids = $regids->pluck('regid')->toArray();        
        sendFCM($regids,['title'=>'Pharmasolindo App','content'=>'Berita: '.p('judul').' baru saja dipublikasikan','command'=>'berita','item'=>$item]); 

        return response()->json(['api_status'=>1,'api_message'=>'Berhasil menambahkan berita','id_berita'=>$id]);
    }

    public function postUpdate() {
        validation([
            'id'=>'required',
            'id_devisi'=>'required',
            'judul'=>'required',
            'isi'=>'required',
            'id_berita_kategori'=>'required',
            'status'=>'required|in:publish,pending'
            ],'json');
        $a = [];
        $a['id_devisi'] = p('id_devisi');
        $a['judul'] = p('judul');
        $a['isi'] = p('isi');
        $a['id_berita_kategori'] = p('id_berita_kategori');
        $a['distribution'] = p('distribution');
        $a['status'] = p('status');
        $a['id_user'] = $this->userID;
        DB::table('berita')->where('id',p('id'))->update($a);
        return response()->json(['api_status'=>1,'api_message'=>'Berhasil memperbarui berita','id_berita'=>p('id')]);
    }

    public function postDelete() {
        validation([
            'id'=>'required'
            ],'json');
        DB::table('berita')->where('id',p('id'))->update(['deleted_at'=>now()]);
        return response()->json(['api_status'=>1,'api_message'=>'Berhasil menghapus berita','id_berita'=>p('id')]);
    }

}
