<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        $id_provinsi = DB::table('provinsi')->insertGetId(['nama'=>'Jawa Tengah']);
        $id_kota = DB::table('kota')->insertGetId(['nama'=>'Semarang','id_provinsi'=>$id_provinsi]);

        $id_wilayah = DB::table('wilayah')->insertGetId(['nama'=>'WILAYAH A']);
        $id_area = DB::table('area')->insertGetId(['nama'=>'AREA A','id_wilayah'=>$id_wilayah]);
        $id_subarea = DB::table('subarea')->insertGetId(['nama'=>'SUBAREA A','id_area'=>$id_area]);

        $id_devisi = DB::table('devisi')->insertGetId(['nama'=>'DEVISI BOD']);

    	$id_karyawan = DB::table('karyawan')->insertGetId([
            'kode'=>'SPA',
    		'nama_lengkap'=>'Super Admin',
    		'no_telp'=>'123456',
    		'alamat'=>'Duta Bukit Mas No 22',
            'id_kota'=>$id_kota,
            'id_provinsi'=>$id_provinsi
    		]);

        $id = DB::table('user')->insertGetId([
        	'id_karyawan'=>$id_karyawan,
            'id_devisi'=>$id_devisi,
            'id_provinsi'=>$id_provinsi,
            'id_kota'=>$id_kota,
            'id_area'=>$id_area,
            'id_subarea'=>$id_subarea,
            'id_wilayah'=>$id_wilayah,
        	'username'=>'superadmin',
        	'password'=>Hash::make('123456'),
        	'status'=>'enable'
        	]);
    }
}