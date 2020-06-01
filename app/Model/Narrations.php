<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Narrations extends Model
{

    public function getNarrations($paramFilter){

        /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/


        $narration = DB::table('psi.que_narrations');
        if(isset($paramFilter)){
            // print_r($paramFilter);
            if($paramFilter != null)
            {
                $narration->whereRaw('upper(que_narrations.narration_name) like upper(\'%'.$paramFilter.'%\')');
            }
            if(isset($paramFilter)){
                if($paramFilter != null)
                {
                    $narration->whereRaw('upper(CONVERT(que_narrations.narration_text USING latin1)) like upper(\'%'.$paramFilter.'%\')');
                }
            }
        }
        
        $data = $narration->select('que_narrations.narration_name','que_narrations.narration_id','que_narrations.narration_text','que_narrations.last_updated_by','que_narrations.last_update_date')
        ->orderBy('que_narrations.last_update_date','DESC')
        ->get();

        return $data;

    }

    public function getNarrationsById($paramFilter){

        /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/
        $narration = DB::table('psi.que_narrations')
        ->where('que_narrations.narration_id','=',$paramFilter['narrationId'])
        ->select('que_narrations.narration_name','que_narrations.narration_id','que_narrations.narration_text','que_narrations.last_updated_by','que_narrations.last_update_date')
        ->get();

        return $narration;

    }
	
	 public function getAllNarations(){
        $narration = DB::table('psi.que_narrations')->get();
        return $narration;
    }

    public function insertNarrations($narrationList){
        DB::table('psi.que_narrations')->insert($narrationList);
    }

    public function updateNarrations($narrationList){

            DB::table('psi.que_narrations')->where('NARRATION_ID',$narrationList['NARRATION_ID'])->update($narrationList);
    }
	
	public function getNarrationsId($paramFilter){
        $narration = DB::table('psi.que_narrations')
        ->where('que_narrations.narration_name','=',$paramFilter)
        ->pluck('que_narrations.narration_id');
        // ->first();

        return $narration;

    }

    public function getNameNarrationExists($paramNameNarrations){
        $isExists = DB::table('psi.que_narrations')
        ->where('que_narrations.narration_name', $paramNameNarrations)
        ->select(DB::raw('CASE WHEN que_narrations.narration_name is not null THEN 1 ELSE 0 END as IS_EXISTS'))
        ->get();
        return $isExists;
    }

}
