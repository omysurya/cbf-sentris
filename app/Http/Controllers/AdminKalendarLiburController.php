<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminKalendarLiburController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Kalendar Libur');

    	$result = DB::table('kalendar_libur');            
        $result->select('kalendar_libur.*');       

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

        $result->whereNull('kalendar_libur.deleted_at');
    	$result->orderby('kalendar_libur.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.kalendar_libur.index',$data);
    } 

    public function getAdd() { 
    	$this->pageTitle('Tambah Kelendar Libur');        
    	return view('admin.kalendar_libur.add');
    } 

    public function postAdd() {
        validation([                            
            'tanggal'=>'required|date|unique:kalendar_libur,tanggal,NULL,id,deleted_at,NULL',            
            'keterangan'=>'required|string|max:255'
            ]);
        DB::table('kalendar_libur')->insert([
            'tanggal'=>p('tanggal'),   
            'keterangan'=>p('keterangan'),      
            'tahun'=>date('Y',strtotime(p('tanggal'))),          
            'created_at'=>now()
            ]);

        $bulan = date('n',strtotime(p('tanggal')));
        $tahun = date('Y',strtotime(p('tanggal')));

        updateAllHkeVisitPlan($bulan,$tahun);

        goAction('AdminKalendarLiburController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Kalendar Libur');
        $data['row'] = first('kalendar_libur',$id);
        return view('admin.kalendar_libur.edit',$data);
    } 

    public function postEdit($id) {
        validation([                            
            'tanggal'=>'required|date|unique:kalendar_libur,tanggal,'.$id.',id,deleted_at,NULL',            
            'keterangan'=>'required|string|max:255'
            ]);
        DB::table('kalendar_libur')->where('id',$id)
        ->update([
            'tanggal'=>p('tanggal'),   
            'keterangan'=>p('keterangan'),      
            'tahun'=>date('Y',strtotime(p('tanggal'))),      
            'updated_at'=>now() 
            ]);

        $bulan = date('n',strtotime(p('tanggal')));
        $tahun = date('Y',strtotime(p('tanggal')));
                
        updateAllHkeVisitPlan($bulan,$tahun);

        goAction('AdminKalendarLiburController@getIndex','Berhasil ubah data!',true);
    } 
 
    public function getDelete($id) {  
        $kalendar = DB::table('kalendar_libur')->where('id',$id)->first();

    	DB::table('kalendar_libur')->where('id',$id)->update(['deleted_at'=>now()]);

        $bulan = date('n',strtotime($kalendar->tanggal));
        $tahun = date('Y',strtotime($kalendar->tanggal));
                
        updateAllHkeVisitPlan($bulan,$tahun);

    	goBack('Berhasil menghapus data!');
    }
}
