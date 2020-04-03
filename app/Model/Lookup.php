<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Lookup extends Model
{

    public function getLookup($lookupName){

        $lookup = DB::table('psi.mst_lookup_hdr')
        ->join('psi.mst_lookup_dtl','mst_lookup_hdr.lookup_id','=','mst_lookup_dtl.lookup_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('upper(mst_lookup_hdr.name) like upper(\'%'.$lookupName.'%\')')
        ->orderBy('seq_number', 'asc')
        ->select('mst_lookup_dtl.detail_code','mst_lookup_dtl.meaning')
        ->get();

        return $lookup;

    }

    public function getLookupDtl($lookupName,$lookupNameDtl){

        $lookup = DB::table('psi.mst_lookup_hdr')
        ->join('psi.mst_lookup_dtl','mst_lookup_hdr.lookup_id','=','mst_lookup_dtl.lookup_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('upper(mst_lookup_hdr.name) like upper(\'%'.$lookupName.'%\')')
        ->whereRaw('upper(mst_lookup_dtl.meaning) like upper(\'%'.$lookupNameDtl.'%\')')
        ->orderBy('seq_number', 'asc')
        ->select('mst_lookup_dtl.detail_code','mst_lookup_dtl.meaning')
        ->get();

        return $lookup;

    }

}
