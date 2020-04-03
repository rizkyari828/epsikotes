<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Location extends Model
{

    public function getLocation($networkId,$city){

         $networks = DB::table('psi.mst_city')
        ->whereRaw('upper(mst_city.city) like upper(\'%'.$city.'%\')')
        ->where('network_id',$networkId)
        ->where('is_active',1)
        ->select('mst_city.city','mst_city.city_id','mst_city.id_city_gawe')
        ->get();

        return $networks;

    }


    public function getLocationByGaweId($gaweCityId){

         $networks = DB::table('psi.mst_city')
        ->where('id_city_gawe',$gaweCityId)
        ->where('is_active',1)
        ->select('mst_city.city','mst_city.city_id','mst_city.id_city_gawe')
        ->first();

        return $networks;

    }

}
