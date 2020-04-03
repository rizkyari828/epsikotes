<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource as catResource;
use App\Category;
use App\SubCategory;
use App\QueSubCategoryVersion;
use App\QueSubCategoryList;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function lookupfindByName(Request $request){
        $name = $request->input('q');
        $result = [];
        // find Category by name
        $datas = Category::where('CATEGORY_NAME', 'like', '%' . $name . '%')
        ->orderBy('CATEGORY_NAME','DESC')
        ->groupBy(['CATEGORY_NAME'])
        ->get(['CATEGORY_NAME']);
        foreach($datas as $key=>$val){
            $result['data'][] = [
                'name'=>$val->CATEGORY_NAME
            ];
        }
        return $result;
    }

    function index(Request $request){

    }

    function save(Request $request){
        $isFuture = false;
        $check = Category::where('CATEGORY_NAME', '=', strtoupper($request->input('categoryName')))->first();
        $category = $request->isMethod('put') ? Category::find($request->input('categoryId')) : new Category;

        if($check == null || $request->isMethod('put') ){
            if($request->input('categoryId')){
                $category->category_id = $request->input('categoryId');
            }else{
                $category->category_id = null;
            }
            $category->CATEGORY_NAME = strtoupper($request->input('categoryName'));
            // $category->narration_text = $request->input('narrationText');
            if(!$request->isMethod('put') ){
                $category->CREATED_BY= 'SYSTEM'; //$request->input('createBy');
                $category->CREATION_DATE= date('Y-m-d H:i:s');//$request->input('creationDate');
            }

            $category->LAST_UPDATED_BY= 'SYSTEM';//$request->input('lastUpdatedBy');
            $category->LAST_UPDATE_DATE= date('Y-m-d H:i:s');//$request->input('lastUpdatedDate');

            if($category->save()){
                $futureVersion = 1;
                if($request->input('version') != 'NEW'){
                    $currVersion = QueSubCategoryVersion::where('que_category_versions.category_id', $category->CATEGORY_ID)
                    ->where('que_category_versions.version_number', $request->input('version'));
                    // ->max('que_category_versions.version_number');
                    //update version current Active version
                    foreach($currVersion->get() as $cc=>$actV){
                        if($actV->DATE_FROM >= now()){
                            $isFuture = true;
                            // delete Category Version And Sub Category list if future version

                            $listToDelete = QueSubCategoryList::where('VERSION_ID', $actV->VERSION_ID)
                            ->delete();
                            $currVersion->delete();
                        }
                    }
                    $activeVersion = QueSubCategoryVersion::where('QUE_CATEGORY_VERSIONS.CATEGORY_ID',$category->CATEGORY_ID)
                    ->where('QUE_CATEGORY_VERSIONS.date_from', '<=', now())
                    ->where('QUE_CATEGORY_VERSIONS.date_to', '>=', now());


                    foreach($activeVersion->get() as $a=>$act){
                        if($act->VERSION_NUMBER < $request->input('version')){
                            $isFuture = true;
                        }
                        $this->updateVersion($act->VERSION_ID, $request->input('dtFrom'));
                    }
                    if($isFuture){
                        $futureVersion = $request->input('version');
                    }
                }

                $version = new QueSubCategoryVersion;

                $version->version_id = null;
                $version->category_id= $category->category_id;
                $version->version_number = $futureVersion;
                $version->date_from= $request->input('dtFrom');
                $version->date_to= $request->input('dtTo');
                $version->description= $request->input('desc');
                $version->random_sub_category= $request->input('randomSubCat');
                $version->get_one_sub_category= $request->input('getOneSubCat');
                $version->CREATED_BY= 'SYSTEM';
                $version->CREATION_DATE= date('Y-m-d H:i:s');
                $version->LAST_UPDATED_BY= 'SYSTEM';
                $version->LAST_UPDATE_DATE=date('Y-m-d H:i:s');

                $rt = $request->input('listSubCat');
                if($version->save()){
                    //save Sub Categorysub_category_id List
                    foreach($request->input('listSubCat') as $key=>$val){
                        $catId = SubCategory::where('que_sub_categories.SUB_CATEGORY_NAME','=', $val['sub_cat_name'])
                        ->get(['que_sub_categories.sub_category_id'])->first();
                        $rrs = (int)$catId->sub_category_id;
                    $list = new QueSubCategoryList;
                    $list->LIST_ID = null;
                    $list->VERSION_ID = $version->VERSION_ID;
                    $list->SUB_CATEGORY_SEQUENCE = $val['sub_sequence'];
                    $list->SUB_CATEGORY_ID = $rrs;

                    $list->save();
                    }
                    return (new catResource($category))
                    ->response()
                    ->setStatusCode(200);
                }
            }
    }
    return (new catResource($check))
    ->response()
    ->setStatusCode(201);
}

    function getDetail(Request $request){
        $id = $request->id;
        $result= [];
        $curr = date("Y-m-d");
        $subCategoryList = [];

        $category = Category::where('QUE_CATEGORIES.CATEGORY_ID', $id)
        ->get();

        $versions = QueSubCategoryVersion::where('QUE_CATEGORY_VERSIONS.CATEGORY_ID',$id);
        if($request->input('version') == null || $request->input('version') == ''){
            $versions->where('QUE_CATEGORY_VERSIONS.date_from', '<=', $curr);
            $versions->where('QUE_CATEGORY_VERSIONS.date_to', '>=', $curr);
        }else{
            $versions->where('QUE_CATEGORY_VERSIONS.version_number', '=',$request->input('version'));
        }
        $versions = $versions->get();

        foreach($versions as $key=>$value){
            $subCatList = QueSubCategoryList::where('QUE_SUB_CATEGORY_LIST.VERSION_ID', $value->VERSION_ID)
            ->get();
            foreach($subCatList as $keyList=>$valueList){
                $subCats = SubCategory::where('SUB_CATEGORY_ID', $valueList->SUB_CATEGORY_ID)->get();
                    foreach($subCats as $subCatKey=> $subCatVal){
                $ss = [
                    'listId'=>$valueList->LIST_ID,
                    'versionId' => $valueList->VERSION_ID,
                    'subCategorySequence'=>$valueList->SUB_CATEGORY_SEQUENCE,
                    'subCategoryId'=>$valueList->SUB_CATEGORY_ID,
                    'subCategoryName'=>$subCatVal->SUB_CATEGORY_NAME
                ];

            }
                array_push($subCategoryList, $ss);
            }
            foreach($category as $a=>$b){
                $result['data'][] = [
                    'categoryId'=>$b->CATEGORY_ID,
                    'categoryName'=>$b->CATEGORY_NAME,
                    'createdBy'=>$b->CREATED_BY,
                    'creationDate'=>$b->CREATION_DATE,
                    'lastUpdatedBy'=>$b->LAST_UPDATED_BY,
                    'lastUpdateDate'=>$b->LAST_UPDATE_DATE,
                    'randomSubCat'=>$value->RANDOM_SUB_CATEGORY,
                    'getOneSubCat'=>$value->GET_ONE_SUB_CATEGORY,
                    'desc'=>$value->DESCRIPTION,
                    'dtFrom'=>$value->DATE_FROM,
                    'dtTo'=>$value->DATE_TO,
                    'version'=>$value->VERSION_NUMBER,
                    'versioniD'=>$value->VERSION_ID,
                    'listSubCat' =>$subCategoryList,
                ];
         }
    }
        return $result;
    }
    function updateVersion($version_id, $setDateTo){
            $versionToChange = QueSubCategoryVersion::findOrFail($version_id);

            $time = strtotime($setDateTo . '-1 day');
            $newdate = date('Y-m-d',$time);
            $versionToChange->DATE_TO =  $newdate;
            $versionToChange->save();
            // $currVersion->fill('DATE_TO' => $newdate)->save();
    }
    function getInquiry(Request $request){
        $catName = $request->input('categoryName');
        $subCategoryId = SubCategory ::where('sub_category_name', $request->input('subCategoryName'))->get(['SUB_CATEGORY_ID'])->first();
        $isRandom = 0;
        $getOneSubCat =0;
        if($request->input('isRandom') == 'YES'){
            $isRandom = 1;
        }
        if($request->input('getOneSubCat') == 'YES'){
            $getOneSubCat = 1;
        }

        // $constraints = array_only($request::input('categoryName'), 'QUE_CATEGORIES.CATEGORY_NAME');
        $datas = Category::join('que_category_versions', 'que_category_versions.CATEGORY_ID', '=', 'QUE_CATEGORIES.CATEGORY_ID')
        ->join('que_sub_category_list', 'que_sub_category_list.version_id', 'que_category_versions.version_id');
        if($catName){
            $datas = $datas->where('QUE_CATEGORIES.CATEGORY_NAME', $catName);
        }
        if($subCategoryId != null){
            $datas = $datas->where('que_sub_category_list.SUB_CATEGORY_ID', '=', $subCategoryId);
        }
        if($request->input('isRandom') != 'null'){
            $datas = $datas->where('que_category_versions.random_sub_category', '=', $isRandom);
        }
        if($request->input('getOneSubCat') != 'null'){
            $datas = $datas->where('que_category_versions.get_one_sub_category', '=', $getOneSubCat);
        }
        $datas= $datas->where('que_category_versions.date_from', '<=', date('Y-m-d'));
        $datas= $datas->where('que_category_versions.date_to', '>=', date('Y-m-d'));
        // ->orwhere('que_category_versions.date_from', '<=', date('Y-m-d'))->max('version_number');
        // ->where('QUE_CATEGORIES.CATEGORY_NAME',  $catName)
        // ->where('que_sub_category_list.SUB_CATEGORY_ID', '=', $subCategoryId)
        // ->where('que_category_versions.random_sub_category', '=', $isRandom)
        // ->where('que_category_versions.get_one_sub_category', '=', $getOneSubCat)
        $datas = $datas->groupBy(['QUE_CATEGORIES.CATEGORY_NAME',
        'que_category_versions.VERSION_ID',
        'que_category_versions.RANDOM_SUB_CATEGORY',
        'que_category_versions.get_one_sub_category']);

        $datas = $datas->get(['QUE_CATEGORIES.*',
        'que_category_versions.VERSION_ID',
        'que_category_versions.RANDOM_SUB_CATEGORY',
        'que_category_versions.get_one_sub_category']);
        $result = [];
        foreach ($datas as $key=>$value){

            $totalSubCat = Category::join('que_category_versions', 'que_category_versions.CATEGORY_ID', '=', 'QUE_CATEGORIES.CATEGORY_ID')
            ->join('que_sub_category_list', 'que_sub_category_list.version_id', 'que_category_versions.version_id')
            ->where('QUE_SUB_CATEGORY_LIST.version_id', '=', $value['VERSION_ID'])
            ->get(['que_sub_category_list.sub_category_id']);

            $result['data'][] =[
                'CATEGORY_ID' => $value['CATEGORY_ID'],
                'CATEGORY_NAME' => $value['CATEGORY_NAME'],
                'TOTAL_SUB_CATEGORY'=>$totalSubCat->count(),
                'RANDOM_SUB_CATEGORY'=>$value['RANDOM_SUB_CATEGORY'],
                'ONLY_GET_ONE_SUB_CATEGORY'=>$value['ONLY_GET_ONE_SUB_CATEGORY'],
                'CREATED_BY' => $value['CREATED_BY'],
                'CREATION_DATE' => $value['CREATION_DATE'],
                'LAST_UPDATED_BY' => $value['LAST_UPDATED_BY'],
                'LAST_UPDATED_DATE' => $value['LAST_UPDATE_DATE']
            ];
        }

        return $result;
    }

    function getCategoryLookup(Request $request){
        $name = $request->input('categoryName');
        $datas = Category::where('QUE_CATEGORIES.CATEGORY_NAME', 'like', '%' . $name . '%')
        ->orderBy('CREATION_DATE','DESC')
        ->get();

        return catResource::collection($datas);
    }

    function validateData(Request $request){
        $dtFrom = strtotime($request->input( 'effectiveStartDt' ));
        $newformatStartDt = date('Y-m-d :h:m:s',$dtFrom);

        $dtTo = strtotime($request->input( 'effectiveEndDt' ));
        $newformatEndDt = date('Y-m-d :h:m:s',$dtTo);

        date_default_timezone_set("Asia/Bangkok");

        $validation = Validator::make(
            array(
                'categoryName' => strtoupper($request->input( 'categoryName' )),
                'desc' => $request->input( 'desc' ),
                'randomSubCategory' => $request->input( 'isRandom' ),
                'getOneSubCategory' =>  $request->input( 'getOneSubCategory' ),
                'effectiveStartDt' => $newformatStartDt,
                'effectiveEndDt' => $newformatEndDt,
                'version' => $request->input( 'questionList' ),
                'subCategoryList' => $request->input( 'subCategoryList' ),
            ),
            array(
                'categoryName' => array( 'required' ),
                'desc' => array( 'required' ),
                // 'effectiveStartDt'=>'required|date|date_format:Y-m-d|before:effectiveEndDt',
                // 'effectiveEndDt' =>'required|date|date_format:Y-m-d|after:effectiveStartDt',
                'subCategoryList' => 'required'
            )
        );

        if ( $validation->fails() ) {
            $errors = $validation->messages();
        }else{
            $errors = 'OK COUYY';
        }


        //display errors
        // if ( ! empty( $errors ) ) {
        //     foreach ( $errors->all() as $error ) {
        //         echo '<div class="error">' . $error . '</div>';
        //     }
        // }

        return $errors;
    }

    function getCategoryVersions(Request $request){
        $id = $request->input('categoryId');
        $result = [];
        // $currDate = new Datetime();
        // $currDate = $currDate->date_format('Y-m-d');
        $versions = QueSubCategoryVersion::where('category_id', $id)
        ->orderBy('version_number','ASC')
        ->get();

        $status = '';
        $numFuture = 0;
        foreach($versions as $key=>$value){
            $result []= [
                'version_id'=>$value->VERSION_ID,
                'version_number'=>$value->VERSION_NUMBER,
                'version_text'=>$value->VERSION_NUMBER,
                'status_version'=>$status,
                'date_from'=>$value->DATE_FROM,
                'date_to'=> $value->DATE_TO
            ];
            $numFuture = $value->VERSION_NUMBER;
        }
        $lastVal = [
            'version_id'=>null,
            'version_number'=>$numFuture +1,
            'version_text'=>'NEW',
            'status_version'=>null,
            'date_from'=>null,
            'date_to'=> null
        ];
        array_push($result, $lastVal);
        return $result;
    }
    function test($categoryId){
        $categoryId = $request->input('categoryId');
        $dtFrom = $request->input('dtFrom');
        $dtTo = $request->input('dtTo');

        $version = Category::join('QUE_CATEGORIES_VERSIONS', 'QUE_CATEGORIES_VERSIONS.version_id', '=', 'QUE_CATEGORIES.version_id')
        ->where('QUE_CATEGORIES_VERSIONS.CATEGORY_ID',$categoryId)
        ->where('QUE_CATEGORIES_VERSIONS.DATE_FROM', '<=', $dtFrom)
        ->where('QUE_CATEGORIES_VERSIONS.DATE_TO', '<=', $dtTo)
        ->get();
    }
}
