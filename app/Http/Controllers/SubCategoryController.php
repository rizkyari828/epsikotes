<?php

namespace App\Http\Controllers;

use App\PsiQuestion;
use App\PsiSubCategory;
use App\PsiSubCategoryVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\SubCategoryResource as subCatResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Model\SubCategory;
use App\Model\Questions;
use App\Model\Narrations;
use Session;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    function index(){
        Session::forget('result');
        Session::forget('msg');
        return view('pages.SubCategoryInquiry');
    }

    function getSubCategory(Request $request){
        $paramFilters = \Request::input('paramFilters');
        $name = $paramFilters['name'];
        $question = $paramFilters['question'];
        $random = $paramFilters['random'];
        // $name = 'INDUCTIVE';
        $version = $this->findCurrentVersion($name);
        $dateNow = date('Y-m-d');

        $datas = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID');
        // ->where('que_sub_category_versions.DATE_FROM','<=',$dateNow)
        // ->where('que_sub_category_versions.DATE_TO','>=',$dateNow);

        if($name != ""){
            $datas->where('sub_category_name', 'like', '%' . $name . '%');
        }
        if($random != ""){
            $datas->where('que_sub_category_versions.RANDOM_QUESTION', $random);
        }
        if($question != ""){
            $datas->join('que_questions','que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID');
            $datas->where('que_questions.QUESTION_TEXT', 'like', '%' . $question . '%');
        }
        // $data->group_by("sub_category_id");


        $datas->orderBy('creation_date','DESC');
        $datas = $datas->get(['que_sub_categories.*', 'que_sub_category_versions.RANDOM_QUESTION','que_sub_category_versions.LAST_UPDATE_DATE']);
        $result = array();
        $result['data'] = array();  
        foreach ($datas as $key=>$value){
            $new_version = $this->findCurrentVersion($value['SUB_CATEGORY_ID']);
            $duration = 0;
            //GET DURATION DATA
            $countDurra = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', $new_version)
            ->where('que_questions.IS_ACTIVED', '=',1)
            ->where('que_questions.EXAMPLE', '=',0)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_questions.duration_per_que'
            ]);
            //SUM DURRATIONs
            foreach ($countDurra as $dKey=>$dValue){
                $duration = $duration + $dValue['duration_per_que'];
             }

             //GET ACTIVE DATA
             $countActive= SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', $new_version)
            ->where('que_questions.IS_ACTIVED', '=',1)
            ->where('que_questions.EXAMPLE', '=',0)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_sub_categories.SUB_CATEGORY_ID',
                'que_sub_categories.sub_category_name',
            ]);
            // get example data
            $countexample = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', $new_version)
            ->where('que_questions.EXAMPLE', '=',1)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_sub_categories.SUB_CATEGORY_ID',
                'que_sub_categories.sub_category_name',
            ]);

            $result['data'][] =[
                'sub_category_id' => $value['SUB_CATEGORY_ID'],
                'sub_category_name' => $value['SUB_CATEGORY_NAME'],
                'total_example'=>$countexample->count(),
                'total_que_active'=>$countActive->count(),
                'total_duration'=>$duration,
                'is_random_que'=> $value['RANDOM_QUESTION'],
                'created_by' => $value['CREATED_BY'],
                'creation_date' => $value['CREATION_DATE'],
                'last_updated_by' => $value['LAST_UPDATED_BY'],
                'last_update_date' => $value['LAST_UPDATE_DATE']
            ];
            $vv = '';
        }  
        $final_result = $result['data'];
        $newArray = array(); 
        $final_array['data'] = array(); 
        foreach ($final_result as $value) { 
            if( !isset( $value[ $value["sub_category_id"] ] ) ) {
                $final_array['data'] [ $value["sub_category_id"] ] = $value;
                continue;
            } else {
                $time_1 = strtotime($final_array['data'] [$value["sub_category_id"]]["last_update_date"]);
                $time_2 = strtotime($value["last_update_date"] );
                if($time_1 < $time_2) {
                    $final_array['data'] [$value["sub_category_id"] ]["last_update_date"] = $value["last_update_date"];
                }
            }
        }   
 
        $test['data'] = array();
        foreach ($final_array['data'] as $key=>$value) {  
            $test['data'][] = [
                'sub_category_id' => $value['sub_category_id'],
                'sub_category_name' => $value['sub_category_name'],
                'total_example'=>$value['total_example'],
                'total_que_active'=>$value['total_que_active'],
                'total_duration'=>$value['total_duration'],
                'is_random_que'=>$value['is_random_que'],
                'created_by' => $value['created_by'],
                'creation_date' => $value['creation_date'],
                'last_updated_by' => $value['last_updated_by'],
                'last_update_date' => $value['last_update_date']
            ];
        }
        // print_r($result);
        // print_r($final_array);
        // die();
        return $test;
    }

    function save(Request $request){
        if($request->input('version') == 'NEW'){

        }
    }

    function validateData(Request $request){

        $validation = Validator::make(
            array(
                'subCategoryName' => strtoupper($request->input( 'subCategoryName' )),
                'description' => $request->input( 'desc' ),
                'instruction' => $request->input( 'instruction'),
                'isRandom' => $request->input( 'isRandom' ),
                'effectiveStartDt' => $request->input( 'effectiveStartDt' ),
                'effectiveEndDt' => $request->input( 'effectiveEndDt' ),
                'questionList' => $request->input( 'questionList' ),
            ),
            array(
                'subCategoryName' => array( 'required', 'alpha_dash' ),
                'description' => array( 'required', 'email' ),
                'effectiveStartDt'=>'required|date|date_format:Y-m-d|before:effectiveEndDt',
                'effectiveEndDt' =>'required|date|date_format:Y-m-d|after:effectiveStartDt'
            )
        );
        $datas = $request->input('questionList');
        foreach ($datas as $sku=>$aa){
            echo $sku . ':' . $aa['subCategoryTypeName'] . '<br>';
        }

        if ( $validation->fails() ) {
            $errors = $validation->messages();
        }


        //display errors
        if ( ! empty( $errors ) ) {
            foreach ( $errors->all() as $error ) {
                echo '<div class="error">' . $error . '</div>';
            }
        }
    }

    function update(){

    }

    function lookupfindByName(Request $request){
        $name = $request->input('q');
        // $name = 'INDUCTIVE';
        $result = [];
        // find Category by name
        $datas = SubCategory::where('sub_category_name', 'like', '%' . $name . '%')
        ->orderBy('creation_date','desc')
        ->get();
        foreach($datas as $ke=>$value){
            $result ['data'][] = [
                'name'=>$value->sub_category_name
            ];
        }
        // $res['subCategoryName'][] = $name;
        return $result;
    }

    function findCurrentVersion($id){
        $version = SubCategory::join('que_sub_category_versions','que_sub_category_versions.sub_category_id', '=', 'que_sub_categories.sub_category_id')
        ->where('que_sub_categories.sub_category_id', '=', $id) 
        ->max('que_sub_category_versions.version_number');

        return $version;
    }

    function uploadImage(Request $request){
        $current = Carbon::now();
        $current = new Carbon();
        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $news = $current->year.
        ''.$current->month.''.$current->day.''
        .$current->hour.''.$current->minute.''.$current->second;
        $imageName = $news.'_'.request()->image->getClientOriginalName();

        request()->image->move(public_path('images/question_url/'.$request->input('subCategoryName'). '/'), $imageName);

        return $imageName;
    }

    // function uploadImage(Request $request){
    //     // IMAGE PATH FORMAT :
    //     // << lookup CMS_ROOT_URL >><< lookup QUESTION_URL >> /<<nama sub category>>/QUE /
    //     //<<originalfile_yyyymmddhhmmss.ext>>
    //     $path = 'images';
    //     $size = 'images';

    //     request()->validate([

    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif',

    //     ]);

    //     if (!File::isDirectory($this->path . '/' . $row)) {
    //         //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
    //         File::makeDirectory($this->path . '/' . $row);
    //     }


    // }
    public function subCategories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $SubCategories = new SubCategory();
        $records = array();

        foreach ($SubCategories->getSubCategoryByName($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data_rows'][] = array('categoryName'=>$rowCategory->sub_category_name,'categoryId' => $rowCategory->sub_category_id  );


        }

        echo json_encode($records);
    }

    public function viewSubCategory($id){
        $SubCategories = new SubCategory();
        $getSubCat = $SubCategories->getSubcategoryById($id);
        $Questions = new Questions();
        $getQuestions = $Questions->getQuestionByVersionId2($getSubCat->VERSION_ID);
        return view('pages.SubCategoryView')
            ->with('getSubCat', $getSubCat)
            ->with('getQuestions', $getQuestions);
    }

    public function viewQuestion($id){
        $SubCategories = new SubCategory();
        $getSubCat = $SubCategories->getSubcategoryById($id);
        $Questions = new Questions();
        $getQuestions = $Questions->getQuestionByVersionId2($getSubCat->VERSION_ID);


        return view('pages.SubCategoryQuestionListView')
            ->with('subCat', $getSubCat)
            ->with('getQuestions', $getQuestions);
    }
    public function getViewQuestion($id){
        $kategori_id = $id;

        $version = SubCategory::join('que_sub_category_versions','que_sub_category_versions.sub_category_id', '=', 'que_sub_categories.sub_category_id')
        ->where('que_sub_categories.sub_category_id', '=', $id) 
        ->max('que_sub_category_versions.version_number');


        $datas = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID') ;
        $datas->join('que_questions','que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID');
        $datas->where('que_sub_categories.SUB_CATEGORY_ID', '=', $kategori_id);
        $datas->where('que_sub_category_versions.version_number', '=', $version);
        $datas->orderBy('creation_date','DESC');
        $datas = $datas->get(['que_sub_categories.*', 'que_sub_category_versions.RANDOM_QUESTION','que_sub_category_versions.VERSION_ID as versionIdSubCategory','que_questions.*']); 

        $result = [];
        foreach ($datas as $key=>$value){
            $duration = 0;
            //GET DURATION DATA
            $countDurra = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', 1)
            ->where('que_questions.IS_ACTIVED', '=',1)
            ->where('que_questions.EXAMPLE', '=',0)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_questions.duration_per_que'
            ]);
            //SUM DURRATIONs
            foreach ($countDurra as $dKey=>$dValue){
                $duration = $duration + $dValue['duration_per_que'];
             }

             //GET ACTIVE DATA
             $countActive= SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', 1)
            ->where('que_questions.IS_ACTIVED', '=',1)
            ->where('que_questions.EXAMPLE', '=',0)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_sub_categories.SUB_CATEGORY_ID',
                'que_sub_categories.sub_category_name',
            ]);
            // get example data
            $countexample = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
            ->join('que_questions', 'que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID')
            ->where('que_sub_categories.SUB_CATEGORY_ID', '=', $value['SUB_CATEGORY_ID'])
            ->where('que_sub_category_versions.VERSION_NUMBER', '=', 1)
            ->where('que_questions.EXAMPLE', '=',1)
            ->orderBy('que_sub_categories.CREATION_DATE')
            ->get([
                'que_sub_categories.SUB_CATEGORY_ID',
                'que_sub_categories.sub_category_name',
            ]);
            if(!empty($value['QUESTION_IMG'])){

                $img ="<img width='80px' src='".'uploads/question_url/'.$value['QUESTION_IMG']."'>";
            }else{
                $img =""; 
            }
            $result['data'][] =[
                'sub_category_id' => $value['SUB_CATEGORY_ID'],
                'question_id' => $value['QUESTION_ID'],
                'sub_category_name' => $value['SUB_CATEGORY_NAME'],
                'question_text' => $value['QUESTION_TEXT'],
                'question_image' => $img,
                'question_digit' => $value['QUESTION_SEQUENCE'],
                'total_duration'=>$value['DURATION_PER_QUE'],
                'is_example'=> $value['EXAMPLE'],
                'is_actived'=> $value['IS_ACTIVED'],
                'type_answer'=> $value['TYPE_ANSWER'],
                'is_random_que'=> $value['RANDOM_ANSWER']
            ];
            $vv = '';
        }
        return $result;
    }
    public function viewAnswer($id){
       $datas = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID') ;
        $datas->join('que_questions','que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID');
        $datas->where('que_questions.QUESTION_ID', '=', $id);
        $datas->orderBy('creation_date','DESC');
        $datas = $datas->get(['que_sub_categories.*', 'que_sub_category_versions.RANDOM_QUESTION','que_sub_category_versions.VERSION_ID as versionIdSubCategory','que_questions.*'])->toArray();


        return view('pages.SubCategoryAnswerListView')
            ->with('subCat', $datas[0]);
            // ->with('getQuestions', $getQuestions);
    }
    public function getViewAnswer($id,$type_answer){
        $question_id = $id;
        $type_answer = $type_answer;
        $result = [];
        if($type_answer == "MULTIPLE_CHOICE"){
            $datas = DB::table('que_ans_choices')->where('QUESTION_ID', '=', $question_id)->get();

            foreach ($datas as $key=>$value){
                $image = "";
                if(!empty($value->CHOICE_IMG)){
                    $image =  "<img width='80px' src='".'uploads/answer_url/'. $value->CHOICE_IMG."'>";
                } 
                $result['data'][] =[
                    'CHOICE_TEXT' => $value->CHOICE_TEXT,
                    'CHOICE_IMG' =>$image,
                    'CORRECT_ANSWER' => $value->CORRECT_ANSWER
                ];
            }
        }elseif($type_answer == "TEXT_SERIES"){
            $datas = DB::table('que_ans_text_series')->where('QUESTION_ID', '=', $question_id)->get();

            foreach ($datas as $key=>$value){
                $result['data'][] =[
                    'CORRECT_TEXT' => $value->CORRECT_TEXT
                ];
            }
        }elseif($type_answer == "MULTIPLE_GROUP"){
            $datas = DB::table('que_ans_group')->where('QUESTION_ID', '=', $question_id)->get();

            foreach ($datas as $key=>$value){
                $result['data'][] =[
                    'IMG_SEQUENCE' => $value->IMG_SEQUENCE,
                    'GROUP_IMG' => $value->GROUP_IMG
                ];
            }
        }

        return $result;
    }

    public function editSubCategory($id){
        $SubCategories = new SubCategory();
        $getSubCat = $SubCategories->getSubcategoryById($id);
        $getLastVersion = $SubCategories->getVersionNumberLast($id);  
        $getVersionNumber = $SubCategories->getVersionNumber($id);  
        $Questions = new Questions();
        $getQuestions = $Questions->getQuestionOnSubCategory($getLastVersion->VERSION_ID);
        
        foreach ($getQuestions as $key => $value) {
            $value->answers = array();
            if($value->TYPE_ANSWER === 'MULTIPLE_CHOICE'){
                $value->answers = $Questions->getAnsChoicesByQuestionId($value->QUESTION_ID);
                // array_push($getAnsChoices, $getAns);
            }elseif($value->TYPE_ANSWER === 'MULTIPLE_GROUP'){
                $value->answers = $Questions->getAnsGroupByQuestionId($value->QUESTION_ID);
 
            }elseif($value->TYPE_ANSWER === 'TEXT_SERIES'){
                $value->answers = $Questions->getAnsTextSeriesByQuestionId($value->QUESTION_ID); 
            }
        } 
 
        $subCat =  DB::table('que_sub_categories')
        ->join('que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id') 
        ->get();
        
        $temp_array = array(); 
        $key_array = array(); 
        foreach($subCat as $key=> $val) { 
            if (!in_array($val->SUB_CATEGORY_ID,$key_array)) {
                $key_array[$key] = $val->SUB_CATEGORY_ID;
                $temp_array[$key] = $val;
            } 
        }  

        $Narrations = new Narrations();
        $getNar = $Narrations->getAllNarations();
        return view('pages.subcategory.edit')
            ->with('getSubCat', $getSubCat)
            ->with('getVersionNumber', $getVersionNumber)
            ->with('getLastVersion', $getLastVersion)
            ->with('getQuestions', $getQuestions) 
            ->with('subCat', $temp_array)
            ->with('narations', $getNar);
    }

    public function checkNameSubCategory(Request $request){
        $response = array();
        $response['status'] = false;
        $response['msg'] = "";
        $response['data'] = array();
        $subCateName = $request->subCateName;
        $data = DB::table('que_sub_categories')->where("SUB_CATEGORY_NAME",$subCateName)->get();  
        if(count($data) >= 1){
            $response['msg'] = "Sub Category Name is Exist";
        }else{
            $response['status']  = true;

            $response['msg'] = "Success Create SubCategory";
        }


        echo json_encode($response);
    }

    public function addSubCategory() { 
        $catFrom = Carbon::tomorrow()->format('Y-m-d');
        $catTo = '4712-12-31';
        $arrDate = array('from' => $catFrom, 'to' => $catTo);
        $subCat =  DB::table('que_sub_categories')
        ->join('que_sub_category_versions','que_sub_categories.sub_category_id','=','que_sub_category_versions.sub_category_id')
        // ->whereRaw('date(sysdate()) between que_sub_category_versions.date_from and que_sub_category_versions.date_to')
        ->get();
        // echo "<pre>"; 

        $temp_array = array(); 
        $key_array = array();

        foreach($subCat as $key=> $val) {
            if (!in_array($val->SUB_CATEGORY_ID,$key_array)) {
                $key_array[$key] = $val->SUB_CATEGORY_ID;
                $temp_array[$key] = $val;
            } 
        } 
        // print_r($subCat);
        // print_r($temp_array);
        // die();
        $Narrations = new Narrations();
        $getNar = $Narrations->getAllNarations();
        return view('pages.subcategory.add')
            ->with('subCat', $temp_array)
            ->with('narations', $getNar)
            ->with('arrDate', $arrDate);
    }

    public function saveAddSubCategory(Request $request){  
        $Questions = new Questions();
        $username = Session::get('user.username');
        $current = Carbon::now();
        $current = new Carbon();
        $result = true;
        $paramInsertSubCategory = array();
        $paramInsertSubCategoryVersion = array();

        $paramInsertSubCategory['sub_category_name'] = $request->subCateName;
        $paramInsertSubCategory['CREATED_BY'] = $username;
        $paramInsertSubCategory['LAST_UPDATED_BY'] = $username;
        $paramInsertSubCategory['LAST_UPDATE_DATE'] = date('Y-m-d H:i:s');
        DB::table('psi.que_sub_categories')->insert($paramInsertSubCategory);
        $idSubCategory = DB::getPdo()->lastInsertId(); 
        if(!$idSubCategory){
            $result = false;
        }  

         if($request->subCateRandom == "on"){
            $request->subCateRandom = 1;
        }else{
            $request->subCateRandom = 0;
        }

        $defaultTo = '4712-12-31';
        // INSERT SUB CATEGORY VERSIONS
        $paramInsertSubCategoryVersion['sub_category_id'] = $idSubCategory;
        $paramInsertSubCategoryVersion['version_number'] = 1;
        $paramInsertSubCategoryVersion['date_from'] = $request->subDateFrom;
        $paramInsertSubCategoryVersion['date_to'] = (!empty($request->subDateTo)?$request->subDateTo:$defaultTo);
        $paramInsertSubCategoryVersion['description'] = $request->subCateDesc;
        $paramInsertSubCategoryVersion['work_instruction'] = $request->workInst;
        $paramInsertSubCategoryVersion['random_question'] = $request->subCateRandom;
        $paramInsertSubCategoryVersion['created_by'] = $username;
        $paramInsertSubCategoryVersion['last_updated_by'] = $username; 
        $paramInsertSubCategoryVersion['LAST_UPDATE_DATE'] = date('Y-m-d H:i:s');
        if($idSubCategory){
            DB::table('psi.que_sub_category_versions')->insert($paramInsertSubCategoryVersion);

            $versionIdSubCategory = DB::getPdo()->lastInsertId();
            if($versionIdSubCategory){ 
                $result = true;
            }else{
                $result = false;
            }
        } 
        $questions = $request->listSubCat; 
        $queSequence = 1; 
        for ($i = 0; $i < count($questions) ; $i++) {
            $paramInsertQuestion = array(); 
            $isActive = (!empty($request->isActive[$i]))?$request->isActive[$i]:0;
            if($isActive == "on"){
                $isActive = 1;
            }
            $duration = (!empty($request->duration[$i]))?$request->duration[$i]:0;
            $isExample = (!empty($request->isExample[$i]))?$request->isExample[$i]:0;
 
            if($isExample === "on"){
                $isExample = 1;
            } 
            $txtareaHint = (!empty($request->txtareaHint[$i]))?$request->txtareaHint[$i]:"";
            $imgHint = (!empty($request->imgHint[$i]))?$request->imgHint[$i]:"";
            if(!empty($imgHint)){  
                $curDate = $current->year.
                ''.$current->month.''.$current->day.''
                .$current->hour.''.$current->minute.''.$current->second;
                $file = $request->file('imgHint')[$i];
               
                $imageName = $curDate.'_hint'.'_'.$file->getClientOriginalName();
                $imgHint = $imageName;
                $file->move(public_path('uploads/question_url/'), $imageName);
            } 
            $txtAreaQue = (!empty($request->txtAreaQue[$i]))?$request->txtAreaQue[$i]:""; 
            $imgQue = (!empty($request->imgQue[$i]))?$request->imgQue[$i]:""; 
            if(!empty($imgQue)){  
                $curDate = $current->year.
                ''.$current->month.''.$current->day.''
                .$current->hour.''.$current->minute.''.$current->second;
                $file = $request->file('imgQue')[$i];
               
                $imageName = $curDate.'_img'.'_'.$file->getClientOriginalName();
                $imgQue = $imageName;
                $file->move(public_path('uploads/question_url/'), $imageName);
            } 

            $queCharacter = (!empty($request->queCharacter[$i]))?$request->queCharacter[$i]:"";  

            $listTypeOfAnswer = (!empty($request->listTypeOfAnswer[$i]))?$request->listTypeOfAnswer[$i]:""; 
           
            $randomCha = 0;
            $randomAnswer = 0;
            if(!empty($request->randomCha[$i])){ 
                if($request->randomCha[$i] == "on"){
                    $randomCha = 1;
                } 
            }  
            if(!empty($request->randomAnswer[$i])){ 
                if($request->randomAnswer[$i] == "on"){
                    $randomAnswer = 1;
                } 
            }

            if(!empty($request->naration_id[$i])){ 
                $narrations = new Narrations(); 
                $data_naration = $narrations->getNarrationsId($request->naration_id[$i]); 
                $narraId = $data_naration[0];
            }else{
                $narraId = 0;
            }
            $paramInsertQuestion['version_id'] = $versionIdSubCategory;
            $paramInsertQuestion['question_sequence'] = $queSequence;
            $paramInsertQuestion['type_sub_category'] = $questions[$i];
            $paramInsertQuestion['is_actived'] = $isActive;
            $paramInsertQuestion['duration_per_que'] = $duration;
            $paramInsertQuestion['example'] = $isExample;
            $paramInsertQuestion['hint_text'] = $txtareaHint;
            $paramInsertQuestion['hint_img'] = $imgHint;
            $paramInsertQuestion['narration_id'] = $narraId;
            $paramInsertQuestion['question_text'] = $txtAreaQue;
            $paramInsertQuestion['question_img'] = $imgQue;
            $paramInsertQuestion['random_character'] = $randomCha;
            $paramInsertQuestion['question_character'] = $queCharacter; 
            $paramInsertQuestion['type_answer'] = $listTypeOfAnswer;
            $paramInsertQuestion['random_answer'] = $randomAnswer;  

            if($idSubCategory){
                $QuestionId = $Questions->insertQuestions($paramInsertQuestion);
                if(!$QuestionId){
                    $result = false;
                }
            }

            if($request->listTypeOfAnswer[$i] == "MULTIPLE_CHOICE"){
                $data_answer_text = $request->multChoiceTxt[$i];
                $data_answer_img = !empty($request->multChoiceImg[$i])?$request->multChoiceImg[$i]:array();
                $data_answer_correct = !empty($request->multChoiceCorrect[$i])?$request->multChoiceCorrect[$i]:array();  

                $ansSeq = 1;
                for ($j = 0; $j < count($data_answer_text); $j++) {
                    $paramInsertMultChoice = [];
                    $paramInsertMultChoice['question_id'] = $QuestionId;
                    if(!empty($data_answer_img)){ 
                        $curDate = $current->year.
                        ''.$current->month.''.$current->day.''
                        .$current->hour.''.$current->minute.''.$current->second;
                        if(!empty($data_answer_img[$j])){ 
                            $file = $request->file('multChoiceImg')[$i][$j];
                            $imageName = $curDate.$ansSeq.'_'.$file->getClientOriginalName(); 
                            $file->move(public_path('uploads/answer_url/'), $imageName);
                            $paramInsertMultChoice['choice_img'] = $imageName;
                        }
                       
                        
                    } 
                    if(!empty($data_answer_correct[$j])){ 
                        if($data_answer_correct[$j] == "on"){
                            $correct = 1;
                        }else{
                            $correct = 0;
                        }
                    }else{
                         $correct = 0;
                    }
                    
                    $paramInsertMultChoice['ans_sequence'] = $ansSeq;
                    $paramInsertMultChoice['choice_text'] = $data_answer_text[$j]; 
                    $paramInsertMultChoice['correct_answer'] = $correct; 

                    if($idSubCategory){
                        $ansChoiceId = $Questions->insertAnsMultChoice($paramInsertMultChoice);
                    }
                    $ansSeq++;
                }
            }
            if($request->listTypeOfAnswer[$i] == "TEXT_SERIES"){
                if(!empty($request->txtSeriesChoices[$i])){
                    $ansSeq = 1;

                    $data_answer_text = $request->txtSeriesChoices[$i];
                    for ($j = 0; $j < count($data_answer_text); $j++) {
                        $paramInsertTxtSeries['question_id'] = $QuestionId;
                        $paramInsertTxtSeries['correct_text'] = $data_answer_text[$j];
                        $paramInsertTxtSeries['ans_sequence'] = $ansSeq;

                        if($idSubCategory){ 
                            $ansChoiceId = $Questions->insertAnsTxtSeries($paramInsertTxtSeries);
                        }
                        $ansSeq++;
                    } 
                }
            } 
            if($request->listTypeOfAnswer[$i] === 'MULTIPLE_GROUP'){
                if(!empty($request->ansMultGroupImgSeq[$i])){
                    $data_answer_seq = $request->ansMultGroupImgSeq[$i];
                    $dataGroupImage = $request->ansMultGroupImg[$i];
                    for ($j = 0; $j < count($data_answer_seq); $j++) { 

                        $paramInsertMultGroup['question_id'] = $QuestionId;
                        $paramInsertMultGroup['img_sequence'] = $data_answer_seq[$j];
                        $paramInsertMultGroup['group_img'] = $dataGroupImage[$j];
                        if($idSubCategory){
                            $ansChoiceId = $Questions->insertAnsMultGroup($paramInsertMultGroup); 
                        }
                    }
                }
            }
            $queSequence++; 
        }   
        $msg ="";  
        if($result){
            $msg = 'Sub category has been successfully added!';
        }else{
            $msg =  'Failed to create a new sub category!';
        }

         


        Session::put('result', $result);
        Session::put('msg', $msg);
        return redirect('/workspace#subcategory');
    }

    public function saveEditSubCategory(Request $request){
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        // ini_set("max_input_vars",1000000);
        // ini_set("max_file_uploads",50);
        // echo "<pre>";
        // echo "post_max_size :".ini_get("post_max_size");
        // echo "<br>";
        // echo "upload_max_filesize :".ini_get("upload_max_filesize");
        // echo "<br>";
        // echo "max_input_vars :".ini_get("max_input_vars");
        // echo "<br>";
        // echo "max_file_uploads :".ini_get("max_file_uploads");

        // dd($request->all());  
        $SubCategories = new SubCategory();
        $idSubCategory = $request->subCateId;
        
        $getVersionNumber = $SubCategories->getVersionNumberLast($idSubCategory);
        $choose_version = $request->version;
        $versionID =  $request->versionID;

        $Questions = new Questions();
        $username = Session::get('user.username');
        $current = Carbon::now();
        $current = new Carbon();
        $result = true;
        $paramInsertSubCategory = array();
        $paramInsertSubCategoryVersion = array();

        $paramInsertSubCategory['sub_category_name'] = $request->subCateName; 
        $paramInsertSubCategory['LAST_UPDATED_BY'] = $username;
        DB::table('psi.que_sub_categories')
              ->where('sub_category_id', $idSubCategory)
              ->update($paramInsertSubCategory); 
        if($request->subCateRandom == "on"){
            $request->subCateRandom = 1;
        }else{
            $request->subCateRandom = 0;
        }
        // INSERT SUB CATEGORY VERSIONS

        $defaultTo = '4712-12-31';
        // INSERT SUB CATEGORY VERSIONS 
        $paramInsertSubCategoryVersion['sub_category_id'] = $idSubCategory;
        $paramInsertSubCategoryVersion['version_number'] = 1;
        $paramInsertSubCategoryVersion['date_from'] = $request->subDateFrom;
        $paramInsertSubCategoryVersion['date_to'] = (!empty($request->subDateTo)?$request->subDateTo:$defaultTo);
        $paramInsertSubCategoryVersion['description'] = $request->subCateDesc;
        $paramInsertSubCategoryVersion['work_instruction'] = $request->workInst;
        $paramInsertSubCategoryVersion['random_question'] = $request->subCateRandom;
        $paramInsertSubCategoryVersion['created_by'] = $username;
        $paramInsertSubCategoryVersion['last_updated_by'] = $username;
        if($idSubCategory){
            if($choose_version == "New"){
                $new_version = $this->findCurrentVersion($idSubCategory);

                $paramInsertSubCategoryVersion['version_number'] = $new_version+1;

                DB::table('psi.que_sub_category_versions')
                ->insert($paramInsertSubCategoryVersion);

                $versionID = DB::getPdo()->lastInsertId();
                if($versionID){ 
                    $result = true;
                }else{
                    $result = false;
                }
            }else{
                DB::table('psi.que_sub_category_versions')
                ->where('VERSION_ID', $versionID)
                ->update($paramInsertSubCategoryVersion) ;
 
                if($versionID){ 
                    $result = true;
                }else{
                    $result = false;
                } 
            }
           
        } 
        $questions = $request->listSubCat; 
        // print_r($questions);
        $queSequence = 1; 
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('que_questions')->where('VERSION_ID', $versionID)->delete();
        for ($i = 0; $i < count($questions) ; $i++) {
            $paramInsertQuestion = array(); 
            $isActive = (!empty($request->isActive[$i]))?$request->isActive[$i]:0;
            if($isActive === "on"){
                $isActive = 1;
            }
            $duration = (!empty($request->duration[$i]))?$request->duration[$i]:0;
            $isExample = (!empty($request->isExample[$i]))?$request->isExample[$i]:0;

            if($isExample === "on"){
                $isExample = 1;
            }
            $txtareaHint = (!empty($request->txtareaHint[$i]))?$request->txtareaHint[$i]:"";
            $imgHint = (!empty($request->imgHint[$i]))?$request->imgHint[$i]:"";
            if(!empty($imgHint)){  
                $curDate = $current->year.
                ''.$current->month.''.$current->day.''
                .$current->hour.''.$current->minute.''.$current->second;
                $file = $request->file('imgHint')[$i];
               
                $imageName = $curDate.'_hint'.'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/question_url/'), $imageName);
                $imgHint = $imageName;
            }else{
                if($choose_version != "New"){
                    $imgHint = $request->imgHintText[$i];
                }
            } 
            $txtAreaQue = (!empty($request->txtAreaQue[$i]))?$request->txtAreaQue[$i]:""; 
            $imgQue = (!empty($request->imgQue[$i]))?$request->imgQue[$i]:""; 
           
            if(!empty($imgQue)){  
                $curDate = $current->year.
                ''.$current->month.''.$current->day.''
                .$current->hour.''.$current->minute.''.$current->second;
                $file = $request->file('imgQue')[$i];
               
                $imageName = $curDate.'_img'.'_'.$file->getClientOriginalName();
                $imgQue = $imageName;
                $file->move(public_path('uploads/question_url/'), $imageName);
            }else{
                if($choose_version != "New"){
                  
                    $imgQue = $request->imgQueText[$i];
                }
            } 

            $queCharacter = (!empty($request->queCharacter[$i]))?$request->queCharacter[$i]:"";  

            $listTypeOfAnswer = (!empty($request->listTypeOfAnswer[$i]))?$request->listTypeOfAnswer[$i]:""; 
           
            $randomCha = 0;
            $randomAnswer = 0;
            if(!empty($request->randomCha[$i])){ 
                if($request->randomCha[$i] == "on"){
                    $randomCha = 1;
                } 
            }  
            if(!empty($request->randomAnswer[$i])){ 
                if($request->randomAnswer[$i] == "on"){
                    $randomAnswer = 1;
                } 
            }

            if(!empty($request->naration_id[$i])){ 
                $narrations = new Narrations(); 
                $data_naration = $narrations->getNarrationsId($request->naration_id[$i]); 
                $narraId = $data_naration[0];
            }else{
                $narraId = 0;
            }
            $paramInsertQuestion['version_id'] = $versionID;
            $paramInsertQuestion['question_sequence'] = $queSequence;
            $paramInsertQuestion['type_sub_category'] = $questions[$i];
            $paramInsertQuestion['is_actived'] = $isActive;
            $paramInsertQuestion['duration_per_que'] = $duration;
            $paramInsertQuestion['example'] = $isExample;
            $paramInsertQuestion['hint_text'] = $txtareaHint;
            $paramInsertQuestion['hint_img'] = $imgHint;
            $paramInsertQuestion['narration_id'] = $narraId;
            $paramInsertQuestion['question_text'] = $txtAreaQue;
            $paramInsertQuestion['question_img'] = $imgQue;
            $paramInsertQuestion['random_character'] = $randomCha;
            $paramInsertQuestion['question_character'] = $queCharacter; 
            $paramInsertQuestion['type_answer'] = $listTypeOfAnswer;
            $paramInsertQuestion['random_answer'] = $randomAnswer;  

            if($idSubCategory){ 
                $QuestionId = $Questions->insertQuestions($paramInsertQuestion);
                if(!$QuestionId){
                    $result = false;
                }
            }

            if($request->listTypeOfAnswer[$i] == "MULTIPLE_CHOICE"){
                if(isset($request->multChoiceTxt[$i])){ 
                $data_answer_text = $request->multChoiceTxt[$i];
                $data_answer_img = !empty($request->multChoiceImg[$i])?$request->multChoiceImg[$i]:array();
                $data_answer_correct = !empty($request->multChoiceCorrect[$i])?$request->multChoiceCorrect[$i]:array();  

                $ansSeq = 1;
                if($choose_version != "New"){
                    $old_question_id = $request->question_id[$i];
                }else{
                    $old_question_id = $QuestionId;
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                DB::table('que_ans_choices')->where('QUESTION_ID', $old_question_id)->delete();
                for ($j = 0; $j < count($data_answer_text); $j++) {
                    $paramInsertMultChoice = [];
                    $paramInsertMultChoice['question_id'] = $QuestionId;
                    if(!empty($data_answer_img[$j])){ 
                        $curDate = $current->year.
                        ''.$current->month.''.$current->day.''
                        .$current->hour.''.$current->minute.''.$current->second;
                        $file = $request->file('multChoiceImg')[$i][$j];
                       
                        $imageName = $curDate.'_'.$file->getClientOriginalName(); 
                        $file->move(public_path('uploads/answer_url/'), $imageName);
                        $paramInsertMultChoice['choice_img'] = $imageName;
                    }else{
                        if($choose_version != "New"){
                            $imageName = $request->multChoiceImgText[$i][$j]; 
                            $paramInsertMultChoice['choice_img'] = $imageName;
                        }
                    } 
                    if(!empty($data_answer_correct[$j])){ 
                        if($data_answer_correct[$j] == "on"){
                            $correct = 1;
                        }else{
                            $correct = 0;
                        }
                    }else{
                         $correct = 0;
                    }
                    
                    $paramInsertMultChoice['ans_sequence'] = $ansSeq;
                    $paramInsertMultChoice['choice_text'] = $data_answer_text[$j]; 
                    $paramInsertMultChoice['correct_answer'] = $correct; 
                    if($idSubCategory){ 
                        $ansChoiceId = $Questions->insertAnsMultChoice($paramInsertMultChoice);
                    }
                    $ansSeq++;
                } 
                }
            }
            if($request->listTypeOfAnswer[$i] == "TEXT_SERIES"){
                if(!empty($request->txtSeriesChoices[$i])){
                    if($choose_version != "New"){
                        $old_question_id = $request->question_id[$i];
                    }else{
                        $old_question_id = $QuestionId;
                    }
                    $ansSeq = 1;
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    DB::table('que_ans_text_series')->where('QUESTION_ID', $old_question_id)->delete();
                    $data_answer_text = $request->txtSeriesChoices[$i];
                    for ($j = 0; $j < count($data_answer_text); $j++) {
                        $paramInsertTxtSeries['question_id'] = $QuestionId;
                        $paramInsertTxtSeries['correct_text'] = $data_answer_text[$j];
                        $paramInsertTxtSeries['ans_sequence'] = $ansSeq;

                        if($idSubCategory){ 
                            
                            $ansChoiceId = $Questions->insertAnsTxtSeries($paramInsertTxtSeries);
                        }
                        $ansSeq++;
                    } 
                }
            } 
            if($request->listTypeOfAnswer[$i] === 'MULTIPLE_GROUP'){
                if(!empty($request->ansMultGroupImgSeq[$i])){
                    $data_answer_seq = $request->ansMultGroupImgSeq[$i];
                    $dataGroupImage = $request->ansMultGroupImg[$i];
                    if($choose_version != "New"){
                        $old_question_id = $request->question_id[$i];
                    }else{
                        $old_question_id = $QuestionId;
                    }
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    DB::table('que_ans_group')->where('QUESTION_ID', $old_question_id)->delete();
                    for ($j = 0; $j < count($data_answer_seq); $j++) { 

                        $paramInsertMultGroup['question_id'] = $QuestionId;
                        $paramInsertMultGroup['img_sequence'] = $data_answer_seq[$j];
                        $paramInsertMultGroup['group_img'] = $dataGroupImage[$j];
                        if($idSubCategory){
                           
                            $ansChoiceId = $Questions->insertAnsMultGroup($paramInsertMultGroup); 
                        }
                    }
                }
            }
            $queSequence++; 
        }   
        $msg ="";  
        if($result){
            $msg = 'Sub category has been successfully added!';
        }else{
            $msg =  'Failed to create a new sub category!';
        } 

        // die();
        Session::put('result', $result);
        Session::put('msg', $msg);
        return redirect('/workspace#subcategory');
    }
}
