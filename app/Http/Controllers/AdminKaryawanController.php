<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminKaryawanController extends Controller
{  

    public function getIndex() {

    	$this->pageTitle('Karyawan');

    	$result = DB::table('karyawan');           
        $result->select('karyawan.*',DB::raw("(select role.nama from user join role on role.id = user.id_role where user.id_karyawan = karyawan.id and user.deleted_at is null order by user.id desc limit 1) as role_nama") );       

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

        $result->whereNull('karyawan.deleted_at');
    	$result->orderby('karyawan.id','desc');
    	$result->orderby('karyawan.foto','asc');
    	$data['result'] = $result->paginate(10); 

    	return view('admin.karyawan.index',$data);
    } 

    public function getClearRegid($id) {
        $k = first('karyawan',$id);
        DB::table('karyawan')->where('id',$id)->update(['regid'=>NULL]);
        DB::table('user')->where('id_karyawan',$id)->update(['is_online'=>0]);
        sendFCM([$k->regid],['title'=>'Account Logout','content'=>'Maaf akun login pada device lain','command'=>'logout']);
        goBack('Berhasil melogout karyawan','success');
    }

    public function getAdd() { 
    	$this->pageTitle('Tambah Karyawan');        

        //Ambil nik terakhir
        $last = DB::table('karyawan AS aa')
            ->select(DB::raw('MAX(aa.kode) AS nik'))
            ->where('aa.kode','LIKE', "'%".date('Y')."'")
            ->first();
        $data['nik'] = $last->nik+1; 
    	return view('admin.karyawan.add',$data);
    } 

    public function postAdd(Request $request) {
        validation([                            
            'kode'=>'required|unique:karyawan,kode,NULL,id,deleted_at,NULL',                    
            'nama_lengkap'=>'required|string|max:100',
            'foto'=>'image',
            'no_telp'=>'required|numeric',
            'jenis_kelamin'=>'required',
            'email'=>'required|email|unique:karyawan,email,NULL,id,deleted_at,NULL',
            'alamat'=>'required|string|max:150',
            'id_provinsi'=>'required|exists:provinsi,id',            
            'id_kota_reguler'=>'required|exists:kota_reguler,id',
            'id_devisi'=>'required|exists:devisi,id',
            'keterangan'=>'string'                    
            ]);

        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension();
            $filename = md5(str_random(5)).'.'.$ext;
            $dest = 'uploads/'.date('Y-m');
            @mkdir(public_path($dest));
            $file->move(public_path($dest),$filename);
            $foto = $dest.'/'.$filename;
        }else{
            $foto = NULL;
        }

        DB::table('karyawan')->insert([                    
            'kode'=>p('kode'),
            'foto'=>$foto,
            'nama_lengkap'=>strtoupper(p('nama_lengkap')),
            'jenis_kelamin'=>p('jenis_kelamin'),
            'tempat_lahir'=>p('tempat_lahir'),
            'tanggal_lahir'=>p('tanggal_lahir'),
            'no_telp'=>p('no_telp'),
            'email'=>p('email'),
            'alamat'=>p('alamat'),
            'id_provinsi'=>p('id_provinsi'),            
            'id_kota_reguler'=>p('id_kota_reguler'),   
            'id_devisi'=>p('id_devisi'),   
            'keterangan'=>p('keterangan'),
            'status'=>1,         
            'created_at'=>now()
            ]);
        goAction('AdminKaryawanController@getIndex','Berhasil tambah data!');
    }

    public function getEdit($id) {
        $this->pageTitle('Edit Karyawan');
        $data['row'] = first('karyawan',$id);
        return view('admin.karyawan.edit',$data);
    } 

    public function postEdit(Request $request,$id) {
        validation([                            
            'kode'=>'required|unique:karyawan,kode,'.$id.',id,deleted_at,NULL',                    
            'nama_lengkap'=>'required|string|max:100',
            'foto'=>'image',
            'no_telp'=>'required|numeric',
            'jenis_kelamin'=>'required',
            'email'=>'required|email|unique:karyawan,email,'.$id.',id,deleted_at,NULL',
            'alamat'=>'required|string|max:150',
            'id_provinsi'=>'required|exists:provinsi,id',            
            'id_kota_reguler'=>'required|exists:kota_reguler,id',
            'id_devisi'=>'required|exists:devisi,id',
            'keterangan'=>'string'                    
            ]);

        

        $data = [
            'kode'=>p('kode'),            
            'nama_lengkap'=>p('nama_lengkap'),
            'jenis_kelamin'=>p('jenis_kelamin'),
            'tempat_lahir'=>p('tempat_lahir'),
            'tanggal_lahir'=>p('tanggal_lahir'),
            'no_telp'=>p('no_telp'),
            'email'=>p('email'),
            'alamat'=>p('alamat'),
            'id_provinsi'=>p('id_provinsi'),            
            'id_kota_reguler'=>p('id_kota_reguler'),  
            'id_devisi'=>p('id_devisi'),   
            'keterangan'=>p('keterangan'),         
            'updated_at'=>now()
            ];
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension();
            $filename = md5(str_random(5)).'.'.$ext;
            $dest = 'uploads/'.date('Y-m');
            @mkdir(public_path($dest));
            $file->move(public_path($dest),$filename);
            $foto = $dest.'/'.$filename;
            $data['foto'] = $foto;
        }

        DB::table('karyawan')->where('id',$id)
        ->update($data);
        goAction('AdminKaryawanController@getIndex','Berhasil ubah data!',true);
    } 

    public function getDelete($id) {
        //Softdelete data karyawan
    	DB::table('karyawan')->where('id',$id)->update(['deleted_at'=>now()]);
        //Softdelete data users
        DB::table('user')->where('id_karyawan',$id)->update(['deleted_at'=>now(),'status'=>'disable']);
        //Disable userjabatan
        //DB::table('user_jabatan')->where('id_karyawan',$id)->update(['is_active'=>0]);
    	goBack('Berhasil menghapus data!');
    }

    public function getCariKota($id_provinsi=NULL) {
        $rows = getData('kota',"id_provinsi = '$id_provinsi'","nama asc");
        return response()->json($rows);
    }

    public function getCariKotaReguler($id_provinsi=NULL) {
        $rows = getData('kota_reguler',"id_provinsi = '$id_provinsi'","nama asc");
        return response()->json($rows);
    }
}
