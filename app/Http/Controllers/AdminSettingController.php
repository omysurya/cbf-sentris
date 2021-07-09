<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Cache;

class AdminSettingController extends Controller
{  

    public function getIndex() {
    	$this->pageTitle('Setting');    
    	return view('admin.setting.index');
    } 

    public function postSave() {
        $post = Request::all();
        foreach($post as $key=>$val) {

            if(Request::hasFile($key)) {
                $file = Request::file($key);
                $ext = $file->getClientOriginalExtension();
                $filename = md5(str_random(6)).'.'.$ext;
                @mkdir(public_path('uploads/'.date('Y-m')));
                $destPath = 'uploads/'.date('Y-m');
                $file->move($destPath,$filename);
                $val = $destPath.'/'.$filename;
            }

            if(DB::table('setting')->where('nama',$key)->count() == 0) {
                
                DB::table('setting')->insert([
                'created_at'=>now(),
                'nama'=>$key,
                'nilai'=>$val
                ]);

                Cache::forget('setting_'.$key);
                
            }else{                
                Cache::forget('setting_'.$key);
                DB::table('setting')->where('nama',$key)->update(['nilai'=>$val]);
            }
        }
        goBack('Setting berhasil disimpan!','success');
    } 
}
