<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Norma extends Model
{

    public function getAllNorma($paramFilter){

        $dateSysdate = date("Y-m-d");

        $categories = /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/
        $categories = DB::table('psi.psy_norma')
        ->join('psi.psy_norma_versions','psy_norma_versions.norma_id','=','psy_norma.norma_id')
        ->join('psi.que_categories','que_categories.category_id','=','psy_norma.category_id');
     //   ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')')
        if($paramFilter['countNorma'] >= 1){
           if($paramFilter['isCurrent']){
                $categories->where('psy_norma_versions.date_from','<=',$dateSysdate)->where('psy_norma_versions.date_to','>=',$dateSysdate);
            }else if($paramFilter['isFuture']){
                $categories->where('psy_norma_versions.date_from','>',$dateSysdate);
            }else{
                $categories->where('psy_norma_versions.date_to','<',$dateSysdate);

            }
        }
        if(isset($paramFilter)){
            $categories->where('psy_norma.norma_id','=',$paramFilter['normaId']);
        }
        $data = $categories->select('psy_norma_versions.NORMA_ID','que_categories.CATEGORY_NAME','que_categories.CATEGORY_ID','psy_norma_versions.VERSION_ID','psy_norma_versions.VERSION_NUMBER','psy_norma_versions.DESCRIPTION','psy_norma_versions.DATE_FROM','psy_norma_versions.DATE_TO','psy_norma_versions.last_updated_by','psy_norma_versions.last_update_date')
        ->get();

        return $data;

    }

     public function getAllNormaActive($paramFilter){

        $dateSysdate = date("Y-m-d");
        $where = "where psy_norma_versions.version_id in (select MAX(psy_norma_versions.version_id) as version_id from psy_norma_versions group by psy_norma_versions.norma_id) ";

        if(isset($paramFilter)){

            if(($paramFilter['categoryId'] != null)){
                    $where .= 'and 1=1 ';
            }

            if(isset($paramFilter['categoryId'])){
                if($paramFilter['categoryId'] != null)
                {
                    $where .= 'and que_categories.category_id = '.$paramFilter['categoryId'];
                }
            }
        }


         $data = DB::select(' 
                         select 
                            psy_norma.NORMA_ID,
                            que_categories.CATEGORY_NAME,
                            que_categories.CATEGORY_ID,
                            psy_norma.last_updated_by,
                            psy_norma.last_update_date
                        from   psy_norma
                        left join psy_norma_versions on psy_norma_versions.NORMA_ID = psy_norma.NORMA_ID
                        join que_categories on que_categories.CATEGORY_ID = psy_norma.CATEGORY_ID
                        '.$where.'  
                        order by  psy_norma.last_update_date desc
                     ');

        return $data;

    }

    public function getNormaVersion($paramFilter){

        $dateSysdate = date("Y-m-d");

        $categories = DB::table('psi.psy_norma')
        ->join('psi.psy_norma_versions','psy_norma_versions.norma_id','=','psy_norma.norma_id')
        ->join('psi.que_categories','que_categories.category_id','=','psy_norma.category_id');
       
        $categories
        ->where('psy_norma_versions.norma_id','=',$paramFilter['normaId'])
        ->where('psy_norma_versions.VERSION_NUMBER','=',$paramFilter['versionNumber'])
        ;
        
        $data = $categories->select('psy_norma_versions.NORMA_ID','que_categories.CATEGORY_NAME','que_categories.CATEGORY_ID','psy_norma_versions.VERSION_ID','psy_norma_versions.VERSION_NUMBER','psy_norma_versions.DESCRIPTION','psy_norma_versions.DATE_FROM','psy_norma_versions.DATE_TO','psy_norma_versions.last_updated_by','psy_norma_versions.last_update_date')
        ->get();

        return $data;

    }

    public function getNormaScore($paramFilter){
         $normaScore = DB::table('psi.psy_norma_score')
         ->where('psy_norma_score.version_id','=',$paramFilter['versionId'])
         ->get();

         return $normaScore;
    }

    public function getNormaAspect($paramFilter){

         $normaAspect = DB::table('psi.psy_norma_aspect')
         ->where('psy_norma_aspect.version_id','=',$paramFilter['versionId'])
         ->get();

         return $normaAspect;

    }

    public function insertNorma($normaList){
       return DB::table('psi.psy_norma')->insertGetId($normaList);
    }

    public function insertNormaVersions($normaVersion){
        return DB::table('psi.psy_norma_versions')->insertGetId($normaVersion);
    }

    public function insertNormaScore($normsScore){
         DB::table('psi.psy_norma_score')->insert($normsScore);

    }

    public function insertNormaAspect($normaAspect){
         DB::table('psi.psy_norma_aspect')->insert($normaAspect);

    }
    public function deleteNormaScore($versionId){
        DB::table('psi.psy_norma_score')->where('version_id',$versionId)->delete();
    }
    public function deleteNormaAspect($versionId){
        DB::table('psi.psy_norma_aspect')->where('version_id',$versionId)->delete();
    }
    public function getFutureNorma($normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

     public function getPastNorma($normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }


    public function getCurrentNorma($normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('psy_norma_versions.date_from','<=',$dateSysdate)
        ->where('psy_norma_versions.date_to','>=',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getMaxVersion($normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->select(DB::raw('MAX(VERSION_NUMBER) as version_number'))
        ->get();
        return $isFuture;
    }

    public function getFutureVersion($versionNumber,$normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('version_number','=',$versionNumber)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

     public function getPastVersion($versionNumber,$normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('version_number','=',$versionNumber)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getCurrentVersion($versionNumber,$normaId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$normaId)
        ->where('version_number','=',$versionNumber)
        ->where('psy_norma_versions.date_from','<=',$dateSysdate)
        ->where('psy_norma_versions.date_to','>=',$dateSysdate)
        ->select(DB::raw('CASE WHEN norma_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }


    public function getVersionNumber($paramFilter){
        $dateSysdate = date("Y-m-d");
        $versionNumbers = DB::table('psi.psy_norma_versions')
        ->where('norma_id','=',$paramFilter['normaId'])
        ->select(DB::raw('CASE WHEN date_from > "'.$dateSysdate.'" THEN "FUTURE" WHEN date_to < "'.$dateSysdate.'" THEN "PAST" ELSE "CURRENT"  END as STATE,  VERSION_ID, VERSION_NUMBER, NORMA_ID'))
        ->get();

        return $versionNumbers;
    }

    public function updateVersionActive($paramFilter){
        DB::table('psi.psy_norma_versions') 
        ->where('norma_id','=',$paramFilter['normaId'])
        ->where('version_number','=',$paramFilter['versionNumber'])
        ->update($paramFilter['value']);

    }

}
