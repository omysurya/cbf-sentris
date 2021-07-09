<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminBeritaController extends Controller
{  
    public function getIndex() {

    	$this->pageTitle('Berita');

    	$result = DB::table('berita');
        $result->join('berita_kategori','berita_kategori.id','=','id_berita_kategori');                   
        $result->join('user','user.id','=','id_user');
        $result->join('karyawan','karyawan.id','=','id_karyawan');
        $result->select('berita.*','berita_kategori.nama as berita_kategori_nama','karyawan.nama_lengkap as karyawan_nama');       

        if(g('search') && array_filter(g('search'))) {
            foreach(array_filter(g('search')) as $key=>$val) {
                $result->where($key,'like','%'.$val.'%');    
            }
            
        }
        if(g('where') && array_filter(g('where'))) {
            foreach(array_filter(g('where')) as $key=>$val) {
                $result->where($key,$val);
            }            
        }

        $result->whereNull('berita.deleted_at');
    	$result->orderby('berita.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.berita.index',$data);
    } 

    public function postUploadImage(Request $request) {
        $name = 'userfile';
        if ($request->hasFile($name))
        {
            $file = $request->file($name);
            $ext  = $file->getClientOriginalExtension();

            //Create Directory Monthly
            $dir = 'uploads/'.date('Y-m-d');
            @mkdir(public_path($dir));

            //Move file to storage
            $filename = md5(str_random(5)).'.'.$ext;
            if($file->move(public_path($dir),$filename)) {
                echo asset($dir.'/'.$filename);
            }
        }
    }

    public function getAdd() { 
    	$this->pageTitle('Tambah Berita');        
    	return view('admin.berita.add');
    } 

    public function postAdd() {
        validation([                            
            'judul'=>'required|string|unique:berita,judul,NULL,id,deleted_at,NULL',
            'isi'=>'required|string',            
            'status'=>'required',
            'distribution'=>'required',
            // 'id_devisi'=>'integer',           
            'id_berita_kategori'=>'required'              
            ]);
        $id = DB::table('berita')->insertGetId([
            'judul'=>p('judul'), 
            'isi'=>p('isi'),            
            'status'=>p('status'),
            'distribution'=>p('distribution'),
            // 'id_devisi'=>p('id_devisi'),
            'id_berita_kategori'=>p('id_berita_kategori'),
            'id_user'=>getUserId(),
            'created_at'=>now()
            ]);

        //Send Notifikasi
        $rows = DB::table('berita');        
        $rows->join('berita_kategori','berita_kategori.id','=','berita.id_berita_kategori');
        $rows->leftjoin('devisi','devisi.id','=','berita.id_devisi');
        $rows->select('berita.id','berita.judul',
            'berita.created_at',
            'berita.isi',
            'berita_kategori.nama as berita_kategori_nama'
            ,'berita.status','berita.distribution',
            DB::raw('IFNULL(devisi.nama,"Semua Divisi") as devisi_nama'));
        $rows->where('berita.id',$id);
        $item = $rows->first();
        $item->isi_raw = strip_tags($item->isi); 

        $regids = DB::table('user')
        ->join('karyawan','karyawan.id','=','id_karyawan')
        ->join('role','role.id','=','user.id_role')
        ->whereNull('user.deleted_at')
        ->whereNotNull('karyawan.regid')
        ->where('user.status','enable');

        switch (p('distribution')) {
            case 'SM':
                $regids->where('role.nama','SM');
                break;
            case 'AM':
                $regids->where('role.nama','AM');
                break;
            case 'MR':
                $regids->where('role.nama','MR');
                break;
            case 'PM':
                $regids->where('role.nama','PM');
                break;
        }
        
        $regids = $regids->pluck('karyawan.regid')->toArray();        
        
        sendFCM($regids,['title'=>'Sentris','content'=>'Berita: '.$item->judul,'command'=>'berita','item'=>$item]); 

        goAction('AdminBeritaController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Berita');
        $data['row'] = first('berita',$id);
        return view('admin.berita.edit',$data);
    } 

    public function postEdit($id) {
        validation([                            
            'judul'=>'required|string|unique:berita,judul,'.$id.',id,deleted_at,NULL',
            'isi'=>'required|string',
            'distribution'=>'required',
            'status'=>'required',
            // 'id_devisi'=>'required', 
            'id_berita_kategori'=>'required' 
            ]);

        DB::table('berita')->where('id',$id)
        ->update([
            'judul'=>p('judul'), 
            'isi'=>p('isi'),
            'distribution'=>p('distribution'),
            'status'=>p('status'),
            // 'id_devisi'=>p('id_devisi'),     
            'id_berita_kategori'=>p('id_berita_kategori'),     
            'updated_at'=>now() 
            ]);

        goAction('AdminBeritaController@getIndex','Berhasil ubah data!',true);
    }  
 
    public function getDelete($id) {  
    	DB::table('berita')->where('id',$id)->update(['deleted_at'=>now()]);
    	goBack('Berhasil menghapus data!');
    }
}
