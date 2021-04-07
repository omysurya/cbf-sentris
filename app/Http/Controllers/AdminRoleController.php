<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminRoleController extends Controller
{  
    
    public function __construct() {
        
    }

    public function getIndex() {

    	$this->pageTitle('Jabatan (Role)');

    	$result = DB::table('role');            
        $result->select('role.*');       

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

        $result->whereNull('role.deleted_at');
    	$result->orderby('role.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.role.index',$data);
    } 

    public function getAdd() { 
    	$this->pageTitle('Tambah Jabatan (Role)');        
    	return view('admin.role.add');
    } 

    public function postAdd() {
        validation([                            
            'nama'=>'required|string|unique:role,nama,NULL,id,deleted_at,NULL'                        
            ]);
        DB::table('role')->insert([
            'nama'=>p('nama'),    
            'config'=>serialize(p('permission')),          
            'created_at'=>now()
            ]);
        goAction('AdminRoleController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Jabatan (Role)');
        $data['row'] = first('role',$id);

        $data['modules'] = DB::table('menu')->get();

        return view('admin.role.edit',$data);
    } 

    public function postEdit($id) {
        validation([                            
            'nama'=>'required|string|unique:role,nama,'.$id.',id,deleted_at,NULL',
            'permission'=>'required'            
            ]);

        DB::table('role')->where('id',$id)
        ->update([
            'nama'=>p('nama'), 
            'config'=>serialize(p('permission')),       
            'updated_at'=>now() 
            ]);

        goAction('AdminRoleController@getIndex','Berhasil ubah data!',true);
    } 
 
    public function getDelete($id) {  
    	DB::table('role')->where('id',$id)->update(['deleted_at'=>now()]);
    	goBack('Berhasil menghapus data!');
    }
}
