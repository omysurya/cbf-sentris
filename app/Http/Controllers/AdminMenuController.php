<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminMenuController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Menu');
    	
        $data['result'] = getMenu();

    	return view('admin.menu.index',$data);
    } 

    public function getAdd() {
    	$this->pageTitle('Tambah Menu');        
    	return view('admin.menu.add');
    } 

    public function postAdd() {
        validation([
            'nama'=>'required',
            'module_path'=>'required|unique:menu,module_path,NULL,id,deleted_at,NULL',
            'icon'=>'required',
            'parent_menu_id'=>'required'            
            ]);

        $sorting = DB::table('menu')->where('parent_menu_id',p('parent_menu_id'))->max('sorting') + 1;

        DB::table('menu')->insert([
            'nama'=>p('nama'),
            'module_path'=>p('module_path'),
            'icon'=>p('icon'),
            'parent_menu_id'=>p('parent_menu_id'),
            'sorting'=>$sorting,
            'created_at'=>now()
            ]);
        goAction('AdminMenuController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Menu');
        $data['row'] = first('menu',$id);
        return view('admin.menu.edit',$data);
    } 

    public function postEdit($id) {
        validation([
            'nama'=>'required',
            'module_path'=>'required|unique:menu,module_path,'.$id.',id,deleted_at,NULL',
            'icon'=>'required',
            'parent_menu_id'=>'required'
            ]);
        DB::table('menu')->where('id',$id)
        ->update([
            'nama'=>p('nama'),
            'module_path'=>p('module_path'),
            'icon'=>p('icon'),
            'parent_menu_id'=>p('parent_menu_id'),
            'updated_at'=>now()
            ]);
        goAction('AdminMenuController@getIndex','Berhasil ubah data!',true);
    }

    public function getDelete($id) {
    	DB::table('menu')->where('id',$id)->update(['deleted_at'=>now()]);
    	goBack('Berhasil menghapus data!');
    }

    public function getUp($id,$parent_menu_id) {
        DB::table('menu')->where('id',$id)->decrement('sorting');

        $rows = DB::table('menu')->where('parent_menu_id',$parent_menu_id)->orderby('sorting','asc')->get();
        foreach($rows as $i=>$r) {
            DB::table('menu')->where('id',$r->id)->update(['sorting'=>$i]);
        }

        goBack('Berhasil update sorting','success');
    }
    public function getDown($id,$parent_menu_id) {
        DB::table('menu')->where('id',$id)->increment('sorting');

        $rows = DB::table('menu')->where('parent_menu_id',$parent_menu_id)->orderby('sorting','asc')->get();
        foreach($rows as $i=>$r) {
            DB::table('menu')->where('id',$r->id)->update(['sorting'=>$i]);
        }

        goBack('Berhasil update sorting','success');
    }
}
