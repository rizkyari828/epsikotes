<?php

namespace App\Http\Controllers\Questionmanagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Norma;
use App\Model\Narrations;




class NarrationAddPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request,$narrationId = 0)
    {   
        $narrations = new Narrations();
                $valeInput = array();

        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';
        $page = '';

        if(!$narrationId){
            $valeInput['NARRATION_ID'] = '';
            $valeInput['NARRATION_NAME'] = '';
            $valeInput['NARRATION_TEXT'] = '';
        }else{
            $page = 'View';
            $isReadOnly = 'readonly';
            $isDisable = '';
            $valeInput = $this->getValueNarrations($narrationId);
        }
        $allNarrations =  $narrations->getAllNarations();

        $param = array('valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'page'=>$page,'narrations'=>$allNarrations);

        return view('pages.NarrationAddPage',$param);
    }

    public function processNarration(Request $request){

            $narrations = new Narrations();

            $this->middleware('auth');
            $param = $request->all();
            $paramInsert['NARRATION_NAME'] = $param['NARRATION_NAME'];
            $paramInsert['NARRATION_TEXT'] = $param['NARRATION_TEXT'];
            $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

            if(!isset($param['NARRATION_ID'])){
                $idNorma = $narrations->insertNarrations($paramInsert);
            }else{
                $narrationId = $param['NARRATION_ID'];
                $paramInsert['NARRATION_ID'] = $narrationId;
                $narrations->updateNarrations($paramInsert);
            }


            return redirect('/workspace#narrationsetup');

    }

    public function getValueNarrations($narrationId){
        $paramFilter['narrationId'] = $narrationId;
        $narrations = new Narrations();
        $valeInput = array();
        foreach ($narrations->getNarrationsById($paramFilter) as $indexNarration => $rowNarration ){
            
            $valeInput['NARRATION_ID'] = $rowNarration->narration_id;
            $valeInput['NARRATION_NAME'] = $rowNarration->narration_name;
            $valeInput['NARRATION_TEXT'] = $rowNarration->narration_text;

        }

        return $valeInput;
    }

    public function categories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $Categories = new Categories();
        $records = array();


        foreach ($Categories->getCategory($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data_rows'][] = array('catagoryName'=>$rowCategory->category_name,'categoryId' => $rowCategory->category_id  );


        }

        echo json_encode($records);
    }

    public function allCategories(){

        $this->middleware('auth');

        $subCategoryName = \Request::input('categoryName');
        $Categories = new Norma();
        $records = array();

      //  print_r($Categories->getAllNorma($subCategoryName));
       // exit();


        foreach ($Categories->getAllNormaActive($subCategoryName) as $indexCategory => $rowCategory ){
            $records['data'][] = array('<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','<a href="#normaview/'.$rowCategory->NORMA_ID.'">detail</a>',$rowCategory->CATEGORY_NAME,$rowCategory->last_update_date,$rowCategory->last_updated_by );


        }

        echo json_encode($records);
    }

    public function existsNameNarration(Request $request){
        $nameNaration = \Request::input('NARRATION_NAME');
        $narrations = new Narrations();
        $isExists = $narrations->getNameNarrationExists($nameNaration);
        $paramFilter['isExists'] = $isExists->isEmpty() ?  'true' : 'false';
        return $paramFilter['isExists']; 

    }


}
