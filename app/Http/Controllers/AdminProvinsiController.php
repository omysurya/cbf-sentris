<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminProvinsiController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Provinsi');

    	$result = DB::table('provinsi'); 
        
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

        $result->whereNull('provinsi.deleted_at');
    	$result->orderby('provinsi.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.provinsi.index',$data);
    } 

    public function getAdd() {
    	$this->pageTitle('Tambah Provinsi');
    	return view('admin.provinsi.add');
    } 

    public function postAdd() {
        validation([
            'nama'=>'required|unique:provinsi,nama,NULL,id,deleted_at,NULL'
            ]);
        DB::table('provinsi')->insert(['nama'=>p('nama'),'created_at'=>now()]);
        return redirect()->action('AdminProvinsiController@getIndex')->with(['message'=>'Berhasil tambah data!','message_type'=>'success']);
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Provinsi');
        $data['row'] = first('provinsi',$id);
        return view('admin.provinsi.edit',$data);
    } 

    public function postEdit($id) {
        validation([
            'nama'=>'required|unique:provinsi,nama,'.$id.',id,deleted_at,NULL'
            ]);
        DB::table('provinsi')->where('id',$id)
        ->update([
            'nama'=>p('nama'),
            'updated_at'=>now()
            ]);
        goAction('AdminProvinsiController@getIndex','Berhasil ubah data!',true);
    }

    public function getDelete($id) {
    	DB::table('provinsi')->where('id',$id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
    	goBack('Berhasil menghapus data!');
    }
}
