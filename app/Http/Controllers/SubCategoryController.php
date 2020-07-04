<?php

namespace App\Http\Controllers;

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

class SubCategoryController extends Controller
{
    function index(){
        return view('pages.SubCategoryInquiry');
    }

    function getSubCategory(Request $request){
        $name = $request->input('name');
        $question = $request->input('question');
        $random = $request->input('random');
        // $name = 'INDUCTIVE';
        $version = $this->findCurrentVersion($name);
        $dateNow = date('Y-m-d');

        $datas = SubCategory::join('que_sub_category_versions','que_sub_category_versions.SUB_CATEGORY_ID', '=', 'que_sub_categories.SUB_CATEGORY_ID')
        ->where('sub_category_name', 'like', '%' . $name . '%')
        ->where('psi.que_sub_category_versions.DATE_FROM','<=',$dateNow)
        ->where('psi.que_sub_category_versions.DATE_TO','>=',$dateNow);
        if($random != ""){
            $datas->where('que_sub_category_versions.RANDOM_QUESTION', $random);
        }
        if($question != ""){
            $datas->join('que_questions','que_questions.VERSION_ID', '=', 'que_sub_category_versions.VERSION_ID');
            $datas->where('que_questions.QUESTION_TEXT', 'like', '%' . $question . '%');
        }
        $datas->orderBy('creation_date','DESC');
        $datas = $datas->get(['que_sub_categories.*', 'que_sub_category_versions.RANDOM_QUESTION']);
        
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
        return $result;
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
        ->where('que_sub_category_versions.date_from', '<=', now())
        ->where('que_sub_category_versions.date_to', '>=', now())
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

     public function editSubCategory($id){
        $SubCategories = new SubCategory();
        $getSubCat = $SubCategories->getSubcategoryById($id);
        $getVersionNumber = $SubCategories->getVersionNumber($id);
        $Questions = new Questions();
        $getQuestions = $Questions->getQuestionByVersionId2($getSubCat->VERSION_ID);
        $getAnsChoices = array();
        $getAnsGroup = array();
        $getAnsTextSeries = array();
        foreach ($getQuestions as $key => $value) {
            if($value->TYPE_ANSWER === 'MULTIPLE_CHOICE'){
                $getAns = $Questions->getAnsChoicesByQuestionId($value->QUESTION_ID);
                array_push($getAnsChoices, $getAns);
            }elseif($value->TYPE_ANSWER === 'MULTIPLE_GROUP'){
                $getAns = $Questions->getAnsGroupByQuestionId($value->QUESTION_ID);
                array_push($getAnsGroup, $getAns);
            }elseif($value->TYPE_ANSWER === 'TEXT_SERIES'){
                $getAns = $Questions->getAnsTextSeriesByQuestionId($value->QUESTION_ID);
                array_push($getAnsTextSeries, $getAns);
            }
        }
        // $ansMultipleChoice2 = array();
        // foreach ($getQuestions as $key => $value) {
        //     if($value->type_answer === 'MULTIPLE_CHOICE'){
        //         for ($i=0; $i < count($getAnsChoices); $i++) { 
        //             foreach ($getAnsChoices[$i] as $keys => $values) {
        //                 if($values->question_id == $value->question_id){
        //                     $arrAns = [$key,$values->choice_text,$values->choice_img,$values->correct_answer,$value->question_id];
        //                     array_push($ansMultipleChoice2, $arrAns);
        //                 }
        //             }
        //         }
        //     }
        // }
        // print_r($getQuestions);
        // exit();

        $subCat = SubCategory::all();
        $Narrations = new Narrations();
        $getNar = $Narrations->getAllNarations();
        return view('pages.SubCategoryEdit')
            ->with('getSubCat', $getSubCat)
            ->with('getVersionNumber', $getVersionNumber)
            ->with('getQuestions', $getQuestions)
            ->with('getAnsChoices', $getAnsChoices)
            ->with('getAnsGroup', $getAnsGroup)
            ->with('getAnsTextSeries', $getAnsTextSeries)
            ->with('subCat', $subCat)
            ->with('narations', $getNar);
    }

    public function addSubCategory(){
        $catFrom = Carbon::tomorrow()->format('d-m-Y');
        $catTo = '31-12-4712';
        $arrDate = array('from' => $catFrom, 'to' => $catTo);
        $subCat = SubCategory::all();
        $Narrations = new Narrations();
        $getNar = $Narrations->getAllNarations();
        return view('pages.SubCategoryForm')
            ->with('subCat', $subCat)
            ->with('narations', $getNar)
            ->with('arrDate', $arrDate);
    }

    public function saveAddSubCategory(Request $request){
        $SubCategories = new SubCategory();
        $Questions = new Questions();
        $username = Session::get('user.username');;
        $catName = strtoupper($request->subCateName);

        $prevSubCategory = SubCategory::query()
            ->where('SUB_CATEGORY_NAME', $catName)
            ->count();

        if ($prevSubCategory > 0) {
            return "Sub category name already exists!";
        }

        $catDesc = $request->subCateDesc;
        $catInst = $request->subCateInst;
        $catRand = $request->subCateRandom;
        $SubcatFrom = date('Y-m-d', strtotime($request->subDateFrom));
        $SubcatTo = date('Y-m-d', strtotime($request->subDateTo));
        $result = true;

        if($catRand)
            $catRand = 1;
        else
            $catRand = 0;
        $catFrom = date('Y-m-d');
        $catTo = '4712-12-31';


        $quesLists = json_decode($request->queLists, true);
        //dd($quesLists);

     
        // var_dump($quesLists);
        $ansMultChoices = json_decode($request->ansMultipleChoice, true);
        $ansTextSeries = json_decode($request->ansTextSeries, true);
        $ansMultGroups = json_decode($request->ansMultipleGroup, true);
        // var_dump($quesLists);

        // INSERT SUB CATEGORY
        $paramInsertSubCategory['sub_category_name'] = $catName;
        $paramInsertSubCategory['created_by'] = $username;
        $paramInsertSubCategory['last_updated_by'] = $username;
        $idSubCategory = $SubCategories->insertSubCategory($paramInsertSubCategory);
        
        if(!$idSubCategory)
            $result = false;

        // INSERT SUB CATEGORY VERSIONS
        $paramInsertSubCategoryVersion['sub_category_id'] = $idSubCategory;
        $paramInsertSubCategoryVersion['version_number'] = 1;
        $paramInsertSubCategoryVersion['date_from'] = $SubcatFrom;
        $paramInsertSubCategoryVersion['date_to'] = $catTo;
        $paramInsertSubCategoryVersion['description'] = $catDesc;
        $paramInsertSubCategoryVersion['work_instruction'] = $catInst;
        $paramInsertSubCategoryVersion['random_question'] = $catRand;
        $paramInsertSubCategoryVersion['created_by'] = $username;
        $paramInsertSubCategoryVersion['last_updated_by'] = $username;
        if($idSubCategory){
            $versionIdSubCategory = $SubCategories->insertSubCategoryVersion($paramInsertSubCategoryVersion);
            if($versionIdSubCategory){
                // $paramInsertSubCategoryList['version_id'] = $versionIdSubCategory;
                // $paramInsertSubCategoryList['SUB_CATEGORY_SEQUENCE'] = 1;
                // $paramInsertSubCategoryList['sub_category_id'] = $idSubCategory;
                // $subCategoryList = $SubCategories->insertSubCategoryList($paramInsertSubCategoryList);
                // if(!$subCategoryList){
                //     $result = false;
                // }
                $result = true;
            }else{
                $result = false;
            }
        }


        
        //INSERT QUESTIONS
        $queSequence = 0;
        for ($i=0; $i < count($quesLists) ; $i++) { 
            $queSequence++;
            if($quesLists[$i][6] === ""){
                $narraId = 0;
            }
            else{
                $Narrations = new Narrations();
                $narId = $Narrations->getNarrationsId($quesLists[$i][6]);
                $narraId = $narId[0];
            }

            if($quesLists[$i][11] === ""){
                $queChar = 0;
            }else{
                $queChar = $quesLists[$i][11];
            }
            
            $paramInsertQuestion['version_id'] = $versionIdSubCategory;
            $paramInsertQuestion['question_sequence'] = $queSequence;
            $paramInsertQuestion['type_sub_category'] = $quesLists[$i][0];
            $paramInsertQuestion['is_actived'] = $quesLists[$i][1];
            $paramInsertQuestion['duration_per_que'] = $quesLists[$i][2];
            $paramInsertQuestion['example'] = $quesLists[$i][3];
            $paramInsertQuestion['hint_text'] = $quesLists[$i][4];
            $paramInsertQuestion['hint_img'] = $quesLists[$i][5];
            $paramInsertQuestion['narration_id'] = $narraId;
            $paramInsertQuestion['question_text'] = $quesLists[$i][7];
            $paramInsertQuestion['question_img'] = $quesLists[$i][8];
            $paramInsertQuestion['random_character'] = $quesLists[$i][12];
            // $paramInsertQuestion['question_character'] = $queChar;
            $paramInsertQuestion['question_character'] = 0;
            $paramInsertQuestion['type_answer'] = $quesLists[$i][9];
            $paramInsertQuestion['random_answer'] = $quesLists[$i][10];
            // print_r($quesLists[$i][11]);
            // exit();
            if($idSubCategory){
                $QuestionId = $Questions->insertQuestions($paramInsertQuestion);
                if(!$QuestionId){
                    $result = false;
                }
            }
            // INSERT ANSWER
            if($quesLists[$i][9] === 'MULTIPLE_CHOICE'){
                $indexChoices = array();
                for ($j=0; $j < count($ansMultChoices); $j++) { 
                    if($ansMultChoices[$j][0] == $i){
                        $indexChoices[] = $j;
                    }
                }
                $ansSeq = 0;
                for ($k=0; $k < count($indexChoices); $k++) { 
                    $indx = $indexChoices[$k];
                    $ansSeq++;
                    $paramInsertMultChoice['question_id'] = $QuestionId;
                    $paramInsertMultChoice['ans_sequence'] = $ansSeq;
                    $paramInsertMultChoice['choice_text'] = $ansMultChoices[$indx][1];
                    $paramInsertMultChoice['choice_img'] = $ansMultChoices[$indx][2];
                    if($ansMultChoices[$indx][3] === true)
                        $correct = 1;
                    else
                        $correct = 0;
                    $paramInsertMultChoice['correct_answer'] = $correct;

                    if($idSubCategory){
                        $ansChoiceId = $Questions->insertAnsMultChoice($paramInsertMultChoice);
                        if(!$ansChoiceId){
                            $result = false;
                        }
                    }
                }
            }else if($quesLists[$i][9] === 'TEXT_SERIES'){
                $ansSeq=0;
                for ($j=0; $j < count($ansTextSeries); $j++) { 
                    if($ansTextSeries[$j][0] == $i){
                        $ansSeq++;
                        $paramInsertTxtSeries['question_id'] = $QuestionId;
                        $paramInsertTxtSeries['correct_text'] = $ansTextSeries[$j][1];
                        $paramInsertTxtSeries['ans_sequence'] = $ansSeq;

                        if($idSubCategory){
                            $ansChoiceId = $Questions->insertAnsTxtSeries($paramInsertTxtSeries);
                            if(!$ansChoiceId){
                                $result = false;
                            }
                        }
                    }
                }
            }else if($quesLists[$i][9] === 'MULTIPLE_GROUP'){
                $indexChoices = array();
                for ($j=0; $j < count($ansMultGroups); $j++) { 
                    if($ansMultGroups[$j][0] == $i)
                        $indexChoices[] = $j;
                }
                for ($k=0; $k < count($indexChoices); $k++) { 
                    $indx = $indexChoices[$k];
                    $paramInsertMultGroup['question_id'] = $QuestionId;
                    $paramInsertMultGroup['img_sequence'] = $ansMultGroups[$indx][1];
                    $paramInsertMultGroup['group_img'] = $ansMultGroups[$indx][2];
                    if($idSubCategory){
                        $ansChoiceId = $Questions->insertAnsMultGroup($paramInsertMultGroup);
                        if(!$ansChoiceId){
                            $result = false;
                        }
                    }
                }
            }
        }

        if($result)
            return 'Sub category has been successfully added!';
        else
            return 'Failed to create a new sub category!';

        // return $result;
    }

    public function saveEditSubCategory(Request $request){
        $SubCategories = new SubCategory();
        $Questions = new Questions();
        $username = Session::get('user.username');;
        $catName = strtoupper($request->subCateName);
        $catDesc = $request->subCateDesc;
        $catInst = $request->subCateInst;
        $catRand = $request->subCateRandom;
        $catVersionId = $request->subVersionId;
        $SubcatFrom = date('Y-m-d', strtotime($request->subDateFrom));
        $SubcatTo = date('Y-m-d', strtotime($request->subDateTo));

        $idSubCategory = $request->subCateId;
        $getVersionNumber = $SubCategories->getVersionNumberLast($idSubCategory);
        $futureVersion = $getVersionNumber->version_number + 1;

        $result = true;
        
        if($catRand)
            $catRand = 1;
        else
            $catRand = 0;
        $catFrom = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('-1 day', strtotime($SubcatFrom)));
        $catTo = '4712-12-31';


        $quesLists = json_decode($request->queLists, true);
        //dd($quesLists);

     
        var_dump($quesLists);
        $ansMultChoices = json_decode($request->ansMultipleChoice, true);
        $ansTextSeries = json_decode($request->ansTextSeries, true);
        $ansMultGroups = json_decode($request->ansMultipleGroup, true);
        // var_dump($quesLists);

        // UPDATE SUB CATEGORY VERSIONS
        $paramUpdateSubCategoryVersion['version_id'] = $getVersionNumber->version_id;
        $paramUpdateSubCategoryVersion['date_to'] = $endDate;
        $paramUpdateSubCategoryVersion['last_update_by'] = $username;
        $paramUpdateSubCategoryVersion['last_update_date'] = $catFrom;
    
        $versionIdSubCategory = $SubCategories->updateSubCategoryVersion($paramUpdateSubCategoryVersion);
        if(!$versionIdSubCategory){
            $paramInsertSubCategoryVersion['sub_category_id'] = $idSubCategory;
            $paramInsertSubCategoryVersion['version_number'] = $futureVersion;
            $paramInsertSubCategoryVersion['date_from'] = $SubcatFrom;
            $paramInsertSubCategoryVersion['date_to'] = $catTo;
            $paramInsertSubCategoryVersion['description'] = $catDesc;
            $paramInsertSubCategoryVersion['work_instruction'] = $catInst;
            $paramInsertSubCategoryVersion['random_question'] = $catRand;
            $paramInsertSubCategoryVersion['created_by'] = $username;
            $paramInsertSubCategoryVersion['creation_date'] = $catFrom;
            $paramInsertSubCategoryVersion['last_update_by'] = $username;
            $paramInsertSubCategoryVersion['last_update_date'] = $catFrom;
            $InsertNewVersion = $SubCategories->insertSubCategoryVersion($paramInsertSubCategoryVersion);
            if($InsertNewVersion){
                // $paramInsertSubCategoryList['version_id'] = $InsertNewVersion;
                // $paramInsertSubCategoryList['SUB_CATEGORY_SEQUENCE'] = 1;
                // $paramInsertSubCategoryList['sub_category_id'] = $idSubCategory;
                // $subCategoryList = $SubCategories->insertSubCategoryList($paramInsertSubCategoryList);
                // if(!$subCategoryList){
                //     $result = false;
                // }
                $result = true;
            }else{
                $result = false;
            }
        }
        
        //UPDATE QUESTIONS
        $queSequence = 0;
        for ($i=0; $i < count($quesLists) ; $i++) { 
            $queSequence++;
            if($quesLists[$i][6] === ""){
                $narraId = 0;
            }
            else{
                $Narrations = new Narrations();
                $narId = $Narrations->getNarrationsId($quesLists[$i][6]);
                $narraId = $narId[0];
            }
            if($quesLists[$i][11] === ""){
                $queChar = null;
            }else{
                $queChar = $quesLists[$i][11];
            }

            // $paramInsertQuestion['question_id'] = $quesLists[$i][13];
            $paramInsertQuestion['version_id'] = $InsertNewVersion;
            $paramInsertQuestion['question_sequence'] = $queSequence;
            $paramInsertQuestion['type_sub_category'] = $quesLists[$i][0];
            $paramInsertQuestion['is_actived'] = $quesLists[$i][1];
            $paramInsertQuestion['duration_per_que'] = $quesLists[$i][2];
            $paramInsertQuestion['example'] = $quesLists[$i][3];
            $paramInsertQuestion['hint_text'] = $quesLists[$i][4];
            $paramInsertQuestion['hint_img'] = $quesLists[$i][5];
            $paramInsertQuestion['narration_id'] = $narraId;
            $paramInsertQuestion['question_text'] = $quesLists[$i][7];
            $paramInsertQuestion['question_img'] = $quesLists[$i][8];
            $paramInsertQuestion['random_character'] = $quesLists[$i][12];
            $paramInsertQuestion['question_character'] = $queChar;
            $paramInsertQuestion['type_answer'] = $quesLists[$i][9];
            $paramInsertQuestion['random_answer'] = $quesLists[$i][10];

            if($idSubCategory){
                $QuestionId = $Questions->insertQuestions($paramInsertQuestion);
                if(!$QuestionId)
                    $result = false;
            }
            // UPDATE ANSWER
            if($quesLists[$i][9] === 'MULTIPLE_CHOICE'){
                $indexChoices = array();
                for ($j=0; $j < count($ansMultChoices); $j++) { 
                    if($ansMultChoices[$j][0] == $i){
                        $indexChoices[] = $j;
                    }
                }
                $ansSeq = 0;
                for ($k=0; $k < count($indexChoices); $k++) { 
                    $indx = $indexChoices[$k];
                    $ansSeq++;
                    $paramInsertMultChoice['question_id'] = $QuestionId;
                    $paramInsertMultChoice['ans_sequence'] = $ansSeq;
                    $paramInsertMultChoice['choice_text'] = $ansMultChoices[$indx][1];
                    $paramInsertMultChoice['choice_img'] = $ansMultChoices[$indx][2];
                    if($ansMultChoices[$indx][3] === true)
                        $correct = 1;
                    else
                        $correct = 0;
                    $paramInsertMultChoice['correct_answer'] = $correct;

                    if($idSubCategory){
                        $ansChoiceId = $Questions->insertAnsMultChoice($paramInsertMultChoice);
                        if(!$ansChoiceId){
                            $result = false;
                        }
                    }
                }
            }else if($quesLists[$i][9] === 'TEXT_SERIES'){
                $ansSeq=0;
                for ($j=0; $j < count($ansTextSeries); $j++) { 
                    if($ansTextSeries[$j][0] == $i){
                        $ansSeq++;
                        $paramInsertTxtSeries['question_id'] = $QuestionId;
                        $paramInsertTxtSeries['correct_text'] = $ansTextSeries[$j][1];
                        $paramInsertTxtSeries['ans_sequence'] = $ansSeq;

                        if($idSubCategory){
                            $ansChoiceId = $Questions->insertAnsTxtSeries($paramInsertTxtSeries);
                            if(!$ansChoiceId){
                                $result = false;
                            }
                        }
                    }
                }
            }else if($quesLists[$i][9] === 'MULTIPLE_GROUP'){
                $indexChoices = array();
                for ($j=0; $j < count($ansMultGroups); $j++) { 
                    if($ansMultGroups[$j][0] == $i)
                        $indexChoices[] = $j;
                }
                for ($k=0; $k < count($indexChoices); $k++) { 
                    $indx = $indexChoices[$k];
                    $paramInsertMultGroup['question_id'] = $QuestionId;
                    $paramInsertMultGroup['img_sequence'] = $ansMultGroups[$indx][1];
                    $paramInsertMultGroup['group_img'] = $ansMultGroups[$indx][2];
                    if($idSubCategory){
                        $ansChoiceId = $Questions->insertAnsMultGroup($paramInsertMultGroup);
                        if(!$ansChoiceId)
                            $result = false;
                    }
                }
            }
        }

        if($result)
            return 'Sub category has been successfully edited!';
        else
            return 'Failed to edit sub category!';

        // return $result;
    }
}
