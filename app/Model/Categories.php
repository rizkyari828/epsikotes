<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



/**
 *
 */
class Categories extends Model
{

    public function getCategory($categoryName){

        $categories = /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/
        $categories = DB::table('que_categories')
        ->join('que_category_versions','que_category_versions.category_id','=','que_categories.category_id')
        ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')')
        ->whereRaw('date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to')
        ->select('que_categories.category_name','que_categories.category_id','que_categories.last_updated_by','que_categories.last_update_date')
        ->get();

        return $categories;

    }

    public function getallCategory2($categoryName){
        $categories = DB::table('que_categories')
            ->join('que_category_versions','que_category_versions.category_id','=','que_categories.category_id')
            ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')')
            ->select('que_categories.category_name','que_categories.category_id','que_categories.last_updated_by','que_categories.last_update_date')
            ->get();

        return $categories;

    }

    public function getDetailCategory($paramFilter){
                $dateSysdate = date("Y-m-d");


        if($paramFilter['isCurrent']){
            $paramFilter['versionNumber'] = $paramFilter['versionNumber'];
           // $categories->whereRaw('date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to');
        }else if($paramFilter['isFuture']){
            if($paramFilter['countcategory'] >= 1){
                            $paramFilter['versionNumber'] = $paramFilter['versionNumber']-1;
            }else{
                            $paramFilter['versionNumber'] = $paramFilter['versionNumber'];

            }
           // $categories->where('que_category_versions.date_from','>',$dateSysdate);
        }else{
            if($paramFilter['countcategory'] >= 1){
                            $paramFilter['versionNumber'] = $paramFilter['versionNumber']-1;
            }else{
                            $paramFilter['versionNumber'] = $paramFilter['versionNumber'];

            }           // $categories->where('que_category_versions.date_to','<',$dateSysdate);
        }




         $categories = DB::table('psi.que_categories')
        ->join('psi.que_category_versions','que_category_versions.category_id','=','que_categories.category_id');
     //   ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')'
        if(isset($paramFilter)){
            if(isset($paramFilter['categoryId'])){
                if($paramFilter['categoryId'] != null)
                {
                    $categories->where('que_categories.category_id','=',$paramFilter['categoryId']);
                }
            }
            if(isset($paramFilter['versionNumber'])){
                if($paramFilter['versionNumber'] != null)
                {
                    $categories->where('que_category_versions.version_number','=',$paramFilter['versionNumber']);
                }
            }
        }

        $data = $categories->select('que_categories.CATEGORY_ID','que_categories.CATEGORY_NAME','que_category_versions.VERSION_ID','que_category_versions.VERSION_NUMBER','que_category_versions.DATE_FROM','que_category_versions.DATE_TO','que_category_versions.DESCRIPTION','que_category_versions.RANDOM_SUB_CATEGORY','que_category_versions.GET_ONE_SUB_CATEGORY')
        ->get();
        return $data;
    }

    public function getDetailCategoryByVersion($paramFilter){
        $dateSysdate = date("Y-m-d");

         $categories = DB::table('psi.que_categories')
        ->join('psi.que_category_versions','que_category_versions.category_id','=','que_categories.category_id');
     //   ->whereRaw('upper(que_categories.category_name) like upper(\'%'.$categoryName.'%\')'
        if(isset($paramFilter)){
            if(isset($paramFilter['categoryId'])){
                if($paramFilter['categoryId'] != null)
                {
                    $categories->where('que_categories.category_id','=',$paramFilter['categoryId']);
                }
            }
            if(isset($paramFilter['versionNumber'])){
                if($paramFilter['versionNumber'] != null)
                {
                    $categories->where('que_category_versions.version_number','=',$paramFilter['versionNumber']);
                }
            }
        }

        $data = $categories->select('que_categories.CATEGORY_ID','que_categories.CATEGORY_NAME','que_category_versions.VERSION_ID','que_category_versions.VERSION_NUMBER','que_category_versions.DATE_FROM','que_category_versions.DATE_TO','que_category_versions.DESCRIPTION','que_category_versions.RANDOM_SUB_CATEGORY','que_category_versions.GET_ONE_SUB_CATEGORY')
        ->get();
        return $data;
    }

    public function getAllCategory($paramFilter){

        $categories = /*DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();*/
        $where = 'where que_category_versions.version_id in (select MAX(que_category_versions.version_id) as version_id from que_category_versions group by que_category_versions.category_id) ';

        if(isset($paramFilter)){

            if(($paramFilter['categoryId'] != null) || ($paramFilter['subCategoryId'] != null) || ($paramFilter['isRandomCategory'] != 0) || ($paramFilter['onlySubCategory'] != 0) ){
                    $where .= 'and 1=1 ';
            }

            if(isset($paramFilter['categoryId'])){
                if($paramFilter['categoryId'] != null)
                {
                    $where .= 'and que_categories.category_id = '.$paramFilter['categoryId'];
                }
            }
            if(isset($paramFilter['subCategoryId'])){
                if($paramFilter['subCategoryId'] != null)
                {
                    $where .= 'and que_sub_category_list.sub_category_id = '.$paramFilter['subCategoryId'];

                }
            }
            if(isset($paramFilter['isRandomCategory'])){
                if($paramFilter['isRandomCategory'] != 0)
                {
                        $paramFilter['isRandomCategory'] = $paramFilter['isRandomCategory'] == 2 ? 0 : 1;
                        $where .= 'and que_category_versions.random_sub_category = '.$paramFilter['isRandomCategory'];

                }
            }
            if(isset($paramFilter['onlySubCategory'])){
                if($paramFilter['onlySubCategory'] != 0)
                {
                        $paramFilter['onlySubCategory'] = $paramFilter['onlySubCategory'] == 2 ? 0 : 1;
                        $where .= 'and que_category_versions.get_one_sub_category = '.$paramFilter['onlySubCategory'];
                }
            }
        }

        /*
        $categories = DB::select('select
                            DISTINCT
                            que_categories.category_id,
                            que_categories.category_name,
                            que_category_versions.RANDOM_SUB_CATEGORY,
                            que_category_versions.GET_ONE_SUB_CATEGORY,
                            count(que_sub_category_list.list_id) as total_sub_category,
                            que_category_versions.last_updated_by,
                            que_category_versions.last_update_date
                        from   que_categories
                        left join que_category_versions on que_categories.category_id = que_category_versions.category_id
                        left join que_sub_category_list on que_category_versions.version_id = que_sub_category_list.version_id
                                                     '.$where.'
                        group by
                            que_categories.category_id,
                            que_categories.category_name,
                            que_category_versions.RANDOM_SUB_CATEGORY,
                            que_category_versions.GET_ONE_SUB_CATEGORY,
                            que_sub_category_list.version_id,
                            que_category_versions.last_updated_by,
                            que_category_versions.last_update_date
                        order by  que_category_versions.last_update_date desc

                         ');
                         */
        $categories = DB::select('
                         select
                            que_categories.category_id,
                            que_categories.category_name,
                            que_category_versions.RANDOM_SUB_CATEGORY,
                            que_category_versions.GET_ONE_SUB_CATEGORY,
                            (
                                select count(que_sub_category_list.list_id) from que_sub_category_list
                                where que_sub_category_list.version_id = que_category_versions.version_id
                            ) as total_sub_category,
                            que_category_versions.last_updated_by,
                            que_category_versions.last_update_date
                        from   que_categories
                        left join que_category_versions on que_categories.category_id = que_category_versions.category_id
                        '.$where.'
                        order by  que_category_versions.last_update_date desc
                     ');

                               //     date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to

        return $categories;

    }

      public function getSubCategory($paramFilter){
        $categories = DB::table('psi.que_sub_category_list')
        ->join('psi.que_sub_categories','que_sub_category_list.sub_category_id','=','que_sub_categories.sub_category_id')
        ->where('que_sub_category_list.version_id','=',$paramFilter['versionId'])
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id')
        ->get();

         return $categories;
    }

    public function insertCategories($CategoryList){
       return DB::table('psi.que_categories')->insertGetId($CategoryList);
    }

    public function insertCategoryVersions($CategoryVersion){
        return DB::table('psi.que_category_versions')->insertGetId($CategoryVersion);
    }

    public function insertSubCategoryList($normsScore){
         DB::table('psi.que_sub_category_list')->insert($normsScore);

    }

    public function deleteCategoryScore($versionId){
        DB::table('psi.que_category_score')->where('version_id',$versionId)->delete();
    }

    public function deleteSubCategoryVersion($versionId){
        DB::table('psi.que_sub_category_list')->where('version_id',$versionId)->delete();
    }

    public function getFutureCategory($CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getFutureCategoryForProcess($CategoryId,$versionNumber){
        $dateSysdate = date("Y-m-d");

        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();

        return $isFuture;
    }

    public function getPastCategory($CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getPastCategoryForProcess($CategoryId,$versionNumber){

        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->whereRaw('que_category_versions.date_to < date(sysdate())')
        //->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();

        return $isFuture;

    }



    public function getCurrentCategory($CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->whereRaw('date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to')
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getCurrentCategoryForProcess($CategoryId,$versionNumber){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->whereRaw('date(sysdate()) between que_category_versions.date_from and que_category_versions.date_to')
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getMaxVersion($CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->select(DB::raw('MAX(VERSION_NUMBER) as version_number'))
        ->get();
        return $isFuture;
    }

    public function getFutureVersion($versionNumber,$CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->whereRaw('que_category_versions.date_from > date(sysdate())')
        //->where('date_from','>',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

     public function getPastVersion($versionNumber,$CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->where('date_to','<',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }

    public function getCurrentVersion($versionNumber,$CategoryId){
        $dateSysdate = date("Y-m-d");
        $isFuture = DB::table('psi.que_category_versions')
        ->where('category_id','=',$CategoryId)
        ->where('version_number','=',$versionNumber)
        ->where('que_category_versions.date_from','<=',$dateSysdate)
        ->where('que_category_versions.date_to','>=',$dateSysdate)
        ->select(DB::raw('CASE WHEN category_id is not null THEN 1 ELSE 0 END as IS_FUTURE'))
        ->get();
        return $isFuture;
    }


    public function getVersionNumber($paramFilter){
        $dateSysdate = date("Y-m-d");
        $versionNumbers = DB::table('psi.que_category_versions')
        ->where('category_id','=',$paramFilter['categoryId'])
        ->select(DB::raw('CASE WHEN date_from > "'.$dateSysdate.'" THEN "FUTURE" WHEN date_to < "'.$dateSysdate.'" THEN "PAST" ELSE "CURRENT"  END as STATE,  VERSION_ID, VERSION_NUMBER, category_ID'))
        ->get();

        return $versionNumbers;
    }

    public function getVersionId($paramFilter){
        $dateSysdate = date("Y-m-d");
        $versionNumbers = DB::table('psi.que_category_versions')
        ->where('category_id','=',$paramFilter['categoryId'])
        ->where('version_number','=',$paramFilter['versionNumber'])
        ->select('version_number','version_id','category_id')
        ->first();

        return $versionNumbers;
    }

    public function updateVersionActive($paramFilter){
        DB::table('psi.que_category_versions')
        ->where('category_id','=',$paramFilter['categoryId'])
        ->where('version_number','=',$paramFilter['versionNumber'])
        ->update($paramFilter['value']);

    }

    public function getCategoryIdExists($paramCategory){
        $isExists = DB::table('psi.que_categories')
        ->where('que_categories.category_name', $paramCategory)
        ->select(DB::raw('CASE WHEN que_categories.category_id is not null THEN 1 ELSE 0 END as IS_EXISTS'))
        ->get();
        return $isExists;
    }

}
