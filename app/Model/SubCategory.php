<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    protected $table = 'que_sub_categories';
    protected $primaryKey = 'SUB_CATEGORY_ID';
    // protected $fillable = [
    //     'NARRATION_NAME',
    //     'NARRATION_TEXT',
    //     'CREATED_BY',
    //     'CREATION_DATE',
    //     'LAST_UPDATED_BY',
    //     'LAST_UPDATE_DATE'];
    public $timestamps = false;

    public function getSubCategory($subCategoryName){

        $categories = DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
       // ->whereBetween(date("Y-m-d"), ['que_sub_category_versions.date_from','que_sub_category_versions.date_to'])
        ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$subCategoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();

        return $categories;

    }

    public function getSubcategoryById($id){
        $dateNow = date('Y-m-d');
        $data = DB::table('psi.que_sub_category_versions')
        ->join('psi.que_sub_categories', 'psi.que_sub_categories.SUB_CATEGORY_ID', '=', 'psi.que_sub_category_versions.SUB_CATEGORY_ID')
        ->where('psi.que_sub_categories.SUB_CATEGORY_ID',$id)
        ->where('psi.que_sub_category_versions.DATE_FROM','<=',$dateNow)
        ->where('psi.que_sub_category_versions.DATE_TO','>=',$dateNow)
        ->first();

        return $data;
    }
     public function getSubCategoryByName($categoryName){

        $categories = DB::table('psi.que_sub_categories')
        ->join('psi.que_sub_category_versions','que_sub_category_versions.sub_category_id','=','que_sub_categories.sub_category_id')
        ->whereRaw('upper(que_sub_categories.sub_category_name) like upper(\'%'.$categoryName.'%\')')
        ->select('que_sub_categories.sub_category_name','que_sub_categories.sub_category_id','que_sub_categories.last_updated_by','que_sub_categories.last_update_date')
        ->get();

        return $categories;

    }

    public function getVersionNumber($id){
        $verNumber = DB::table('psi.que_sub_category_versions')
            ->where('psi.que_sub_category_versions.sub_category_id', $id)
            ->get();

        return $verNumber;
    }

    public function getVersionNumberLast($id){
        $verNumber = DB::table('psi.que_sub_category_versions')
            ->where('psi.que_sub_category_versions.sub_category_id', $id)
            ->orderBy('psi.que_sub_category_versions.version_number', 'desc')
            ->first();

        return $verNumber;
    }

    public function insertSubCategory($subCatList){
       return DB::table('psi.que_sub_categories')->insertGetId($subCatList);
    }

    public function insertSubCategoryVersion($subCatList){
       return DB::table('psi.que_sub_category_versions')->insertGetId($subCatList);
    }

    public function insertSubCategoryList($subCatList){
       return DB::table('psi.que_sub_category_list')->insertGetId($subCatList);
    }

    public function updateSubCategoryVersion($subCatList){
            DB::table('psi.que_sub_category_versions')->where('VERSION_ID',$subCatList['VERSION_ID'])->update($subCatList);
    }
}
