<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;

class ApiBrosureController extends Controller
{       
    private $userID;
    private $userData;  
    private $userKaryawan;  
    private $userRole;
    public function __construct() {
        @$this->userID = Cache::get('appsLogin'.p('sessionID'));
        @$this->userData = first('user',['id'=>$this->userID]);
        @$this->userKaryawan = first('karyawan',['id'=>$this->userData->id_karyawan]);
        @$this->userRole = first('role',['id'=>$this->userData->id_role]);
    }

       
    public function getIndex() {
        validation([
            'id_produk'=>'integer|exists:produk,id,deleted_at,NULL',
            'offset'=>'integer',
            'limit'=>'integer',
            'q'=>'string'
            ]);

        $limit = g('limit')?:10;
        $offset = g('offset')?:0;
        
        $rows = DB::table('brosure');
        $rows->whereNull('brosure.deleted_at');
        if(g('id_produk')) {
            $rows->where('id_produk',g('id_produk'));
        }
        $rows->leftjoin('produk','produk.id','=','brosure.id_produk');
        $rows->leftjoin('produk_group','produk_group.id','=','produk.id_produk_group');
        $rows->select(
            'brosure.*',            
            'produk.kode as produk_kode',
            'produk.harga as produk_harga',
            'produk_group.nama as produk_group_nama',
            'produk.nama as produk_nama');
        $rows->orderby('brosure.id','desc');
        $rows->take($limit);
        $rows->skip($offset);

        if(!g('id_produk')) {
            if($this->userRole->nama == 'MR') {

                $salesPlanGroup = DB::table('sales_plan_produk')
                ->join('sales_plan','sales_plan.id','=','id_sales_plan')
                ->where('sales_plan.bulan_ke',date('n'))
                ->where('sales_plan.tahun_bulan',date('Y'))
                ->whereNull('sales_plan_produk.deleted_at')
                ->whereNull('sales_plan.deleted_at')
                ->where('sales_plan.id_user',$this->userID)
                ->groupBy('id_produk_group')
                ->pluck('id_produk_group')
                ->toArray();

                if($salesPlanGroup) {
                    $rows->whereIn('produk.id_produk_group',$salesPlanGroup);    
                }
                
            }elseif ($this->userRole->nama == 'AM') {
                $salesPlanGroup = DB::table('sales_plan_produk')
                ->join('sales_plan','sales_plan.id','=','id_sales_plan')
                ->join('user','user.id','=','sales_plan.id_user')
                ->join('area','area.id','=','user.id_area')
                ->where('area.id',$this->userData->id_area)
                ->where('sales_plan.bulan_ke',date('n'))
                ->where('sales_plan.tahun_bulan',date('Y'))
                ->whereNull('sales_plan_produk.deleted_at')
                ->whereNull('sales_plan.deleted_at')
                ->groupBy('id_produk_group')
                ->pluck('id_produk_group')
                ->toArray();
                if($salesPlanGroup) {
                    $rows->whereIn('produk.id_produk_group',$salesPlanGroup);    
                }
                
            }elseif ($this->userRole->nama == 'SM') {
                $salesPlanGroup = DB::table('sales_plan_produk')
                ->join('sales_plan','sales_plan.id','=','id_sales_plan')
                ->join('user','user.id','=','sales_plan.id_user')
                ->join('area','area.id','=','user.id_area')
                ->where('area.id_region',$this->userData->id_region)
                ->where('sales_plan.bulan_ke',date('n'))
                ->where('sales_plan.tahun_bulan',date('Y'))
                ->whereNull('sales_plan_produk.deleted_at')
                ->whereNull('sales_plan.deleted_at')
                ->groupBy('id_produk_group')
                ->pluck('id_produk_group')
                ->toArray();
                if($salesPlanGroup) {
                    $rows->whereIn('produk.id_produk_group',$salesPlanGroup);
                }
                
            }elseif ($this->userRole->nama == 'PM') {
                $gp = DB::table('user_group_produk')
                ->where('id_user',$this->userID)
                ->pluck('id_produk_group')
                ->toArray();
                $rows->whereIn('produk.id_produk_group',$gp);
            }
        }
        



        if(g('q')) {
        	$rows->where('brosure.nama','like','%'.g('q').'%');
        }

        $items = $rows->get();

        foreach($items as &$item) {
            $item->isi_raw = strip_tags($item->isi);
        }
 
        $resp = [];
        $resp['api_status'] = 1;
        $resp['api_message'] = 'success';
        $resp['items'] = $rows->get();
        // $resp['salesPlanGroup'] = $salesPlanGroup;
        return response()->json($resp);
    }

    public function getHit($id_brosure) {
        DB::table('brosure')->where('id',$id_brosure)->increment('hit');
        return response()->json(['api_status'=>1,'api_message'=>'success']);
    }

    public function getDetail($id) {
        $row = DB::table('brosure');
        $row->where('brosure.id',$id);
        $row = $row->first();
        return response()->json(['api_status'=>1,'api_message'=>'success','item'=>$row]);
    }
}
