<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;

class ApiKaryawanController extends Controller
{       
    private $userID;
    private $userData;  
    private $userKaryawan;  
    private $userRole;
    public function __construct() {
        @$this->userID = Cache::get('appsLogin'.p('sessionID'));
        if(p('id_user')) {
            $this->userID = p('id_user');
        }
        @$this->userData = first('user',['id'=>$this->userID]);
        @$this->userArea = first('area',['id'=>$this->userData->id_area]);
        @$this->userKaryawan = first('karyawan',['id'=>$this->userData->id_karyawan]);
        @$this->userRole = first('role',['id'=>$this->userData->id_role]);
    }

    public function getListKaryawan() {
        $result = DB::table('user')
        ->join('role','role.id','=','id_role')
        ->join('karyawan','karyawan.id','=','id_karyawan')
        ->whereNull('user.deleted_at')
        ->where('role.nama','!=','SUPERADMIN')
        ->where('user.status','enable')
        ->select('user.id','role.nama as role_nama','karyawan.nama_lengkap as karyawan_nama');

        if(g('search')) {
            $result->where(function($w) {
                $w->where('karyawan.nama_lengkap','like','%'.g('search').'%')
                ->orWhere('user.username',g('search'));
            });
            
        }

        if(g('role')) {
            $result->where('role.nama',g('role'));
        }

        if(g('offset')) {
            $result->skip(g('offset'));
        }

        if(g('limit')) {
            $result->take(g('limit'));
        }
        
        $result->orderby('karyawan.nama_lengkap','asc');

        return response()->json(['api_status'=>1,'api_message'=>'success','items'=>$result->get()]);
    }

    public function getListJoinVisit() {
        if($this->userRole->nama == 'MR') {
            $result = [];

            $u = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','AM')
            ->whereNull('user.deleted_at')
            ->where('user.id_area',$this->userData->id_area)
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama')
            ->first();
            $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>'AM'];

            $u = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','SM')
            ->whereNull('user.deleted_at')
            ->where('user.id_region',$this->userArea->id_region)
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama')
            ->first();
            $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>'SM'];

            $bod = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->whereIn('role.nama',['NSM','DIRUT','MM','GPM'])
            ->whereNull('user.deleted_at')            
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama','role.nama as role_nama')
            ->orderByRaw("FIELD(role.nama,'NSM','DIRUT','MM','GPM')")
            ->get();
            foreach($bod as $u) {                
                $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>$u->role_nama];
            }      


            // $curGroupProduk = DB::table('sales_plan_produk')
            // ->join('sales_plan','sales_plan.id','=','id_sales_plan')
            // ->where('sales_plan.bulan_ke',date('n'))
            // ->where('sales_plan.tahun_bulan',date('Y'))
            // ->whereNUll('sales_plan_produk.deleted_at')
            // ->whereNull('sales_plan.deleted_at')
            // ->pluck('id_produk_group')
            // ->toArray();

            $pms = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','PM')
            ->whereNull('user.deleted_at')
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama')
            ->get();
            foreach($pms as $pm) {
                $result[] = ['id'=>$pm->id,'nama'=>$pm->karyawan_nama,'role'=>'PM'];  
            }
            
               

        }elseif ($this->userRole->nama == 'AM') {

            $mrs = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('area','area.id','=','user.id_area')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','MR')
            ->whereNull('user.deleted_at')            
            ->where('user.status','enable')
            ->where('area.id',$this->userData->id_area)
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama','role.nama as role_nama')            
            ->get();
            foreach($mrs as $u) {
                $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>$u->role_nama];
            }

            $u = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','SM')
            ->whereNull('user.deleted_at')
            ->where('user.id_region',$this->userArea->id_region)
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama')
            ->first();
            $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>'SM'];

            $bod = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->whereIn('role.nama',['NSM','DIRUT','MM','GPM','PM'])
            ->whereNull('user.deleted_at')            
            ->where('user.status','enable')
            ->select('user.*','karyawan.nama_lengkap as karyawan_nama','role.nama as role_nama')
            ->orderByRaw("FIELD(role.nama,'NSM','DIRUT','MM','GPM','PM')")
            ->get();
            foreach($bod as $u) {                
                $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>$u->role_nama];
            }            
        }

        // $bod = DB::table('user')
        // ->join('role','role.id','=','id_role')
        // ->join('karyawan','karyawan.id','=','id_karyawan')
        // ->whereIn('role.nama',['AM','PM','NSM','SM','DIRUT','MM','GPM','AM'])
        // ->whereNull('user.deleted_at')            
        // ->where('user.status','enable')
        // ->select('user.*','karyawan.nama_lengkap as karyawan_nama','role.nama as role_nama')
        // ->orderByRaw("FIELD(role.nama,'DIRUT','MM','NSM','GPM','PM','SM','AM')")
        // ->get();
        // foreach($bod as $u) {                
        //     $result[] = ['id'=>$u->id,'nama'=>$u->karyawan_nama,'role'=>$u->role_nama];
        // }

        return response()->json(['api_status'=>1,'api_message'=>'success','items'=>$result]);
    }

    public function getListAmMr() {        

        $result = [];
        $ams = DB::table('user')
        ->join('role','role.id','=','id_role')
        ->join('karyawan','karyawan.id','=','id_karyawan')
        ->where('role.nama','AM')
        ->whereNull('user.deleted_at')        
        ->where('user.status','enable')
        ->select('user.id','user.id_area','role.nama as role_nama','karyawan.nama_lengkap as karyawan_nama');

        $noAM = 0;
        foreach($ams->get() as $am) {            
            $result[] = ['id'=>$am->id,'role'=>$am->role_nama,'nama'=>(++$noAM)." ".$am->karyawan_nama];
            $mrs = DB::table('user')
            ->join('role','role.id','=','id_role')
            ->join('karyawan','karyawan.id','=','id_karyawan')
            ->where('role.nama','MR')
            ->whereNull('user.deleted_at')        
            ->where('user.status','enable')
            ->where('user.id_area',$am->id_area)
            ->select('user.id','user.id_area','role.nama as role_nama','karyawan.nama_lengkap as karyawan_nama');

            $noMR = 0;
            foreach($mrs->get() as $mr) {
                $result[] = ['id'=>$mr->id,'role'=>$mr->role_nama,'nama'=>$noAM.".".(++$noMR)." ".$mr->karyawan_nama];
            }
        }


        foreach($result as $i=>$row) {
            if(g('q')) {
                if(!stripos($row['nama'], g('q'))!==FALSE) {
                    unset($result[$i]);
                }
            }
        }

        $limit = g('limit')?:20;
        $offset = g('offset')?:0;        
        $result = array_values($result);         

        $result = array_slice($result, $offset, $limit);

        return response()->json(['api_status'=>1,'api_message'=>'success','items'=>$result]);
    }
}
