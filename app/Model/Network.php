<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Network extends Model
{

    public function getNetwork($networkName){

        /*
        $lookup = DB::table('psi.mst_lookup_hdr')
        ->join('psi.mst_lookup_dtl','mst_lookup_hdr.lookup_id','=','mst_lookup_dtl.lookup_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('upper(mst_lookup_hdr.name) like upper(\'%'.$lookupName.'%\')')
        ->orderBy('seq_number', 'asc')
        ->select('mst_lookup_dtl.detail_code')
        ->get();
        */

        $networks = DB::table('psi.mst_networks')
        ->whereRaw('upper(mst_networks.network) like upper(\'%'.$networkName.'%\')')
        ->where('is_active',1)
        ->select('mst_networks.network','mst_networks.network_id','mst_networks.cabang_id')
        ->get();

        return $networks;

    }

    public function getAllNetwork($paramFilter){

        /*
        $lookup = DB::table('psi.mst_lookup_hdr')
        ->join('psi.mst_lookup_dtl','mst_lookup_hdr.lookup_id','=','mst_lookup_dtl.lookup_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('upper(mst_lookup_hdr.name) like upper(\'%'.$lookupName.'%\')')
        ->orderBy('seq_number', 'asc')
        ->select('mst_lookup_dtl.detail_code')
        ->get();
        */

        $networks = DB::table('psi.mst_networks');
        if(isset($paramFilter)){
          if(isset($paramFilter['cabangId'])){
            if($paramFilter['cabangId'] != null)
            {
                $networks->where('mst_networks.CABANG_ID','=',$paramFilter['cabangId']);
            }
          }
        }
        $data = $networks->where('is_active',1)
        ->select('mst_networks.network','mst_networks.network_id','mst_networks.cabang_id')
        ->get();

        return $data;

    }

}
