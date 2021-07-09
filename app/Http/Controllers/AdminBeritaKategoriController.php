<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminBeritaKategoriController extends Controller
{  
    public function getIndex() {

    	$this->pageTitle('Kategori Berita');

    	$result = DB::table('berita_kategori');                    
        $result->select('berita_kategori.*');       

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

        $result->whereNull('berita_kategori.deleted_at');
    	$result->orderby('berita_kategori.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.berita_kategori.index',$data);
    } 

    public function getAdd() { 
    	$this->pageTitle('Tambah Kategori Berita');        
    	return view('admin.berita_kategori.add');
    } 

    public function postAdd() {
        validation([                            
            'nama'=>'required|string|unique:berita_kategori,nama,NULL,id,deleted_at,NULL'              
            ]);
        DB::table('berita_kategori')->insert([
            'nama'=>p('nama'),                   
            'created_at'=>now()
            ]);
        goAction('AdminBeritaKategoriController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Kategori Berita');
        $data['row'] = first('berita_kategori',$id);
        return view('admin.berita_kategori.edit',$data);
    } 

    public function postEdit($id) {
        validation([                            
            'nama'=>'required|string|unique:berita_kategori,nama,'.$id.',id,deleted_at,NULL'              
            ]);

        DB::table('berita_kategori')->where('id',$id)
        ->update([
            'nama'=>p('nama'),       
            'updated_at'=>now() 
            ]);

        goAction('AdminBeritaKategoriController@getIndex','Berhasil ubah data!',true);
    } 
 
    public function getDelete($id) {  
    	DB::table('berita_kategori')->where('id',$id)->update(['deleted_at'=>now()]);
    	goBack('Berhasil menghapus data!');
    }
}
