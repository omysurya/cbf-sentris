<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminKotaRegulerController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Kota Reguler');

    	$result = DB::table('kota_reguler'); 
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
        $result->whereNull('kota_reguler.deleted_at');
        $result->leftjoin('provinsi','provinsi.id','=','id_provinsi');
        $result->select('kota_reguler.*','provinsi.nama as provinsi_nama');
        $result->whereNull('kota_reguler.deleted_at');
    	$result->orderby('kota_reguler.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.kota_reguler.index',$data);
    } 

    public function getAdd() {
    	$this->pageTitle('Tambah Kota Reguler');        
    	return view('admin.kota_reguler.add');
    } 

    public function postAdd() {
        validation([
            'nama'=>'required|unique:kota,nama,NULL,id,deleted_at,NULL',
            'id_provinsi'=>'required|integer'
            ]);
        DB::table('kota_reguler')->insert(['nama'=>p('nama'),
            'id_provinsi'=>p('id_provinsi'),
            'created_at'=>now()]);
        return redirect()->action('AdminKotaRegulerController@getIndex')->with(['message'=>'Berhasil tambah data!','message_type'=>'success']);
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Kota Reguler');
        $data['row'] = first('kota_reguler',$id);
        return view('admin.kota_reguler.edit',$data);
    } 

    public function postEdit($id) {
        validation([
            'nama'=>'required|unique:kota,nama,'.$id.',id,deleted_at,NULL',
            'id_provinsi'=>'required|integer'
            ]);
        DB::table('kota_reguler')->where('id',$id)
        ->update([
            'nama'=>p('nama'),
            'id_provinsi'=>p('id_provinsi'),
            'updated_at'=>now()
            ]);
        goAction('AdminKotaRegulerController@getIndex','Berhasil ubah data!',true);
    }

    public function getDelete($id) {
    	DB::table('kota_reguler')->where('id',$id)->update(['deleted_at'=>date('Y-m-d H:i:s')]);
    	goBack('Berhasil menghapus data!');
    }
}
