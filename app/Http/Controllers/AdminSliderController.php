<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminSliderController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Slider');

    	$result = DB::table('slider');           
        $result->select('slider.*');       

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
        
    	$result->orderby('slider.id','desc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.slider.index',$data);
    } 

    public function getAdd() {
    	$this->pageTitle('Tambah Slider');        
    	return view('admin.slider.add');
    } 

    public function postAdd() {
        validation([
            'nama'=>'required',
            'image'=>'required|image'                  
            ]);


        $file = Request::file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = md5(str_random(5)).'.'.$ext;
        @mkdir(public_path('uploads/'.date('Y-m')));
        $dest = public_path('uploads/'.date('Y-m'));
        $file->move($dest,$filename);
        $image = $dest.'/'.$filename;

        DB::table('slider')->insert([
            'nama'=>p('nama'),            
            'image'=>$image,
            'created_at'=>now()
            ]);
        goAction('AdminSliderController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit slider');
        $data['row'] = first('slider',$id);
        return view('admin.slider.edit',$data);
    } 

    public function postEdit($id) {
        validation([
            'nama'=>'required',
            'image'=>'image'                  
            ]);
        $a = [];

        if(Request::hasFile('image')) {
            $file = Request::file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = md5(str_random(5)).'.'.$ext;
            @mkdir(public_path('uploads/'.date('Y-m')));
            $dest = public_path('uploads/'.date('Y-m'));
            $file->move($dest,$filename);
            $image = $dest.'/'.$filename;
            $a['image'] = $image;
        }
        $a['updated_at'] = now();
        $a['nama'] = p('nama');

        DB::table('devisi')
        ->where('id',$id)
        ->update($a);

        goAction('AdminSliderController@getIndex','Berhasil ubah data!',true);
    }

    public function getDelete($id) {
    	DB::table('devisi')->where('id',$id)->update(['deleted_at'=>now()]);
    	goBack('Berhasil menghapus data!');
    }
}
