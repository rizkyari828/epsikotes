<?php

namespace App\Http\Controllers\Questionmanagement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Lookup;

class CategoryAddPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request,$categoryId = 0,$message= '')
    {
        $lookup = $this->lookupPsychogramAspect();
        $valeInput = array();
        $category = new Categories();

        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';

        $page = '';
        $error = '';

        $isDisableHeader = '';
        $isDisableBody = '';
        $isDisableDateTo = '';
        $isDisableButtonSubmit = '';

        if(!$categoryId){
            $valeInput['CATEGORY_NAME'] = '';
            $valeInput['CATEGORY_ID'] = '';
            $valeInput['VERSION_NUMBER'] = '<option value=New>New</option>';
            $valeInput['DESCRIPTION'] = '';
            $valeInput['DATE_FROM'] = '';
            $valeInput['DATE_TO'] = '';
            $valeInput['SUB_CATEGORY'] = '';

            $valeInput['RANDOM_SUB_CATEGORY'] = '';
            $valeInput['GET_ONE_SUB_CATEGORY'] = '';
            $page = 'NEW';
        }else{
            $maxVersionNumber = $category->getMaxVersion($categoryId);
            if($maxVersionNumber[0]->version_number>1){
                $versionNumber = $maxVersionNumber[0]->version_number-1;

            }else{
                $versionNumber = $maxVersionNumber[0]->version_number;
            }

            $isFuture = $category->getFutureCategoryForProcess($categoryId,$versionNumber);
            $isPast = $category->getPastCategoryForProcess($categoryId,$versionNumber);
            $isCurrent = $category->getCurrentCategoryForProcess($categoryId,$versionNumber);

            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
         
            $categorysetup = $this->getcategorySetup($categoryId);
            $subcategoryList = $this->getSubCategoryList($categorysetup['VERSION_ID'],$categoryId);

            $valeInput = $categorysetup;

            //print_r($valeInput);

             //array_push($valeInput,$categorysetup);
            $valeInput += $subcategoryList;

             //echo $paramFilter['isCurrent'];

            if($paramFilter['isCurrent']){
               
                $isDisableHeader = 'disabled';
                $isDisableBody = 'disabled';
                $isDisableDateTo = '';
                $isDisableButtonSubmit = '';
            }else if($paramFilter['isPast']){
               $isDisableHeader = 'disabled';
                $isDisableBody = 'disabled';
                $isDisableDateTo = 'disabled';
                $isDisableButtonSubmit = 'disabled';
            }else if($paramFilter['isFuture']){
                $isDisableHeader = 'disabled';
                $isDisableBody = '';
                $isDisableDateTo = '';
                $isDisableButtonSubmit = '';
            }


        }

        $err = $request->session()->get('err.status');
        $param = array('valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'isDisableCurrent'=>$isDisableCurrent,'isDisablePast'=>$isDisablePast,'isDisableHeader'=>$isDisableHeader,'isDisableBody' => $isDisableBody,
         'isDisableDateTo'=>$isDisableDateTo,'isDisableButtonSubmit'=>$isDisableButtonSubmit,'error'=>$err[0]);

        return view('pages.CategoryPageAdd',$param);
    }

    public function getCategoryByVersion(){

            $categoryId = \Request::input('categoryId');
            $versionNumber = \Request::input('versionNumber');
            $category = new Categories();


            $isFuture = $category->getFutureVersion($versionNumber,$categoryId);
            $isPast = $category->getPastVersion($versionNumber,$categoryId);
            $isCurrent = $category->getCurrentVersion($versionNumber,$categoryId);
            $maxVersionNumber = $category->getMaxVersion($categoryId);
            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
            $paramFilter['categoryId'] = $categoryId;
            $paramFilter['versionNumber'] = $versionNumber;

            $idcategoryVersion =  $category->getVersionId($paramFilter);

           
            $categorysetup = $this->getcategoryVersionSetup($paramFilter);
            $subcategoryList = $this->getSubCategoryVersionList($idcategoryVersion->version_id,$categoryId);

            $valeInput = $categorysetup;
             //array_push($valeInput,$categorysetup);
            $valeInput += $subcategoryList;

            if($paramFilter['isCurrent']){
                $isDisableCurrent = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isPast']){
                $isDisablePast = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isFuture']){
                $isDisable = 'readonly';
            }


            $valeInput['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $valeInput['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $valeInput['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

            echo json_encode($valeInput);

    }

    public function lookupPsychogramAspect(){

        $this->middleware('auth');

        $lookup = new Lookup();
        $records = array();

        foreach ($lookup->getLookup('PSY_ASPECT') as $indexLookup => $rowLookup ){
            $records[] = $rowLookup->detail_code;

        }

        return $records;
    }

    public function getExistsCategoryName(Request $request){
        $categoryName = \Request::input('category_name');
        $category = new Categories();
        $isExists = $category->getCategoryIdExists($categoryName);
        $paramFilter['isExists'] = $isExists->isEmpty() ?  'true' : 'false';
        return $paramFilter['isExists']; 

    }

    public function processCategory(Request $request){

        $category = new Categories();

        $this->middleware('auth');
        $param = $request->all();

        

        /*insert psy_category*/
        if(($param['version_number'] == 'New') && ($param['CATEGORY_ID'] == null) ){
          
            $request->session()->forget('err.status');
            $paramInsert['CATEGORY_NAME'] = $param['category_name'];
            $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

            $idCategory = $category->insertCategories($paramInsert);



            $paramInsertcategoryVersion['CATEGORY_ID'] = $idCategory;
            $paramInsertcategoryVersion['VERSION_NUMBER'] = 1;
            $paramInsertcategoryVersion['RANDOM_SUB_CATEGORY'] = isset($param['RANDOM_SUB_CATEGORY']) ? 1 : 0;
            $paramInsertcategoryVersion['GET_ONE_SUB_CATEGORY'] = isset($param['GET_ONE_SUB_CATEGORY']) ? 1 : 0;
            $paramInsertcategoryVersion['DATE_FROM'] = date( "Y-m-d", strtotime( $param['date_from'] ) );
            $paramInsertcategoryVersion['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
            $paramInsertcategoryVersion['DESCRIPTION'] = $param['description'];
            $paramInsertcategoryVersion['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsertcategoryVersion['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsertcategoryVersion['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsertcategoryVersion['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


            $idcategoryVersion = $category->insertCategoryVersions($paramInsertcategoryVersion);

            foreach ($param['sub_category_name'] as $key => $value) {
                $paramInsertcategoryRawScore['VERSION_ID'] = $idcategoryVersion;
                $paramInsertcategoryRawScore['SUB_CATEGORY_ID'] = $param['sub_category_id'][$key];
                $paramInsertcategoryRawScore['SUB_CATEGORY_SEQUENCE'] = ++$key;

                $category->insertSubCategoryList($paramInsertcategoryRawScore);
            }

        }else{

            $isFuture = $category->getFutureCategoryForProcess($param['CATEGORY_ID'],$param['version_number']);
            $isPast = $category->getPastCategoryForProcess($param['CATEGORY_ID'],$param['version_number']);
            $isCurrent = $category->getCurrentCategoryForProcess($param['CATEGORY_ID'],$param['version_number']);
            $maxVersionNumber = $category->getMaxVersion($param['CATEGORY_ID']);
            $paramFilter['isFuture'] =  $isFuture->isEmpty() ? 0 : 1;  //$isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

            if($param['version_number'] == 'New'){

                $paramFilter['categoryId'] = $param['CATEGORY_ID'];
                $paramFilter['versionNumber'] = $maxVersionNumber[0]->version_number;
                $paramFilter['value']['DATE_TO'] =  date("Y-m-d") ;
                $paramFilter['value']['LAST_UPDATED_BY'] =  $request->session()->get('user.username');
                $paramFilter['value']['LAST_UPDATE_DATE'] =  date("Y-m-d h:i:s");

                $category->updateVersionActive($paramFilter);


                $paramInsertcategoryVersion['CATEGORY_ID'] = $param['CATEGORY_ID'];
                $paramInsertcategoryVersion['VERSION_NUMBER'] = $maxVersionNumber[0]->version_number+1;
                $paramInsertcategoryVersion['RANDOM_SUB_CATEGORY'] = isset($param['RANDOM_SUB_CATEGORY']) ? 1 : 0;
                $paramInsertcategoryVersion['GET_ONE_SUB_CATEGORY'] = isset($param['GET_ONE_SUB_CATEGORY']) ? 1 : 0;
                $paramInsertcategoryVersion['DATE_FROM'] = date( "Y-m-d", strtotime( $param['date_from'] ) );
                $paramInsertcategoryVersion['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
                $paramInsertcategoryVersion['DESCRIPTION'] = $param['description'];
                $paramInsertcategoryVersion['CREATED_BY'] = $request->session()->get('user.username');
                $paramInsertcategoryVersion['CREATION_DATE'] = date("Y-m-d h:i:s");
                $paramInsertcategoryVersion['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                $paramInsertcategoryVersion['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


                $idcategoryVersion = $category->insertCategoryVersions($paramInsertcategoryVersion);

                foreach ($param['sub_category_name'] as $key => $value) {
                    $paramInsertcategoryRawScore['VERSION_ID'] = $idcategoryVersion;
                    $paramInsertcategoryRawScore['SUB_CATEGORY_ID'] = $param['sub_category_id'][$key];
                    $paramInsertcategoryRawScore['SUB_CATEGORY_SEQUENCE'] = ++$key;

                    $category->insertSubCategoryList($paramInsertcategoryRawScore);
                }
                
            }else if($paramFilter['isCurrent']){


                $paramFilter['categoryId'] = $param['CATEGORY_ID'];
                $paramFilter['versionNumber'] = $maxVersionNumber[0]->version_number;
                $paramFilter['value']['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
                $paramFilter['value']['LAST_UPDATED_BY'] =  $request->session()->get('user.username');
                $paramFilter['value']['LAST_UPDATE_DATE'] =  date("Y-m-d h:i:s");

                $category->updateVersionActive($paramFilter);
                
            }else if($paramFilter['isFuture']){

                $paramInsertcategoryVersion['categoryId'] = $param['CATEGORY_ID'];
                $paramInsertcategoryVersion['versionNumber'] = $param['version_number'];
                $paramInsertcategoryVersion['value']['DATE_FROM'] = date( "Y-m-d", strtotime( $param['date_from'] ) );
                $paramInsertcategoryVersion['value']['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
                $paramInsertcategoryVersion['value']['RANDOM_SUB_CATEGORY'] = isset($param['RANDOM_SUB_CATEGORY']) ? 1 : 0;
                $paramInsertcategoryVersion['value']['GET_ONE_SUB_CATEGORY'] = isset($param['GET_ONE_SUB_CATEGORY']) ? 1 : 0;
                $paramInsertcategoryVersion['value']['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                $paramInsertcategoryVersion['value']['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


                $category->updateVersionActive($paramInsertcategoryVersion);

                $paramFilter['categoryId'] = $param['CATEGORY_ID'];
                $paramFilter['versionNumber'] = $param['version_number'];

                $idcategoryVersion =  $category->getVersionId($paramFilter);


                $category->deleteSubCategoryVersion($idcategoryVersion->version_id);

                foreach ($param['sub_category_name'] as $key => $value) {
                    $paramInsertcategoryRawScore['VERSION_ID'] = $idcategoryVersion->version_id;
                    $paramInsertcategoryRawScore['SUB_CATEGORY_ID'] = $param['sub_category_id'][$key];
                    $paramInsertcategoryRawScore['SUB_CATEGORY_SEQUENCE'] = ++$key;

                    $category->insertSubCategoryList($paramInsertcategoryRawScore);
                }

            }

        }
            return redirect('/workspace#categorysetup');
        
    }

    public function getcategorySetup($categoryId){

        $category = new Categories();
        $paramFilter['categoryId'] = $categoryId;
        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
        $paramFilter['countcategory'] = $category->getVersionNumber($paramFilter)->count();
        $paramFilter['versionNumber'] = $maxVersionNumber[0]->version_number;

     
        $valeInput = array();
        foreach ($category->getDetailCategory($paramFilter) as $indexcategory => $rowcategory ){
            $valeInput['CATEGORY_NAME'] = $rowcategory->CATEGORY_NAME;
            $valeInput['CATEGORY_ID'] = $rowcategory->CATEGORY_ID;
            $valeInput['VERSION_ID'] = $rowcategory->VERSION_ID;
            $valeInput['DESCRIPTION'] = $rowcategory->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowcategory->DATE_FROM;
            $valeInput['DATE_TO'] = $rowcategory->DATE_TO;
            $valeInput['RANDOM_SUB_CATEGORY'] = $rowcategory->RANDOM_SUB_CATEGORY;
            $valeInput['GET_ONE_SUB_CATEGORY'] = $rowcategory->GET_ONE_SUB_CATEGORY;
        }



        $versionNumberList = array();
        $versionNumber = '';

        $selectedVersions = 0;
        
        foreach ($category->getVersionNumber($paramFilter) as $indexcategory => $rowcategory ){
            if($paramFilter['countcategory'] == 1 ){
                $versionNumber .= '<option value="'.$rowcategory->VERSION_NUMBER.'" selected>'.$rowcategory->VERSION_NUMBER.'</option>';
                if($paramFilter['isCurrent'] || $paramFilter['isPast']  ){
                    $versionNumber .= '<option value=New>New</option>';
                }
            }else{
               
                if($paramFilter['isFuture']){
                    $selectedVersions = $maxVersionNumber[0]->version_number-1;
                }else if($paramFilter['isCurrent'] && ($maxVersionNumber[0]->version_number == $rowcategory->VERSION_NUMBER)){
                    $selectedVersions = $rowcategory->VERSION_NUMBER;
                }else if($paramFilter['isPast'] && ($maxVersionNumber[0]->version_number == $rowcategory->VERSION_NUMBER)){
                    $selectedVersions = $rowcategory->VERSION_NUMBER;
                }


                if( $selectedVersions == $rowcategory->VERSION_NUMBER){
                    $versionNumber .= '<option value="'.$rowcategory->VERSION_NUMBER.'" selected>'.$rowcategory->VERSION_NUMBER.'</option>';
                }else{
                    $versionNumber .= '<option value="'.$rowcategory->VERSION_NUMBER.'">'.$rowcategory->VERSION_NUMBER.'</option>';
                }


                if($paramFilter['isCurrent'] && ($maxVersionNumber[0]->version_number == $rowcategory->VERSION_NUMBER)){
                    $versionNumber .= '<option value=New>New</option>';
                }else if($paramFilter['isPast'] && ($maxVersionNumber[0]->version_number == $rowcategory->VERSION_NUMBER)){
                    $versionNumber .= '<option value=New>New</option>';
                }

                /*else{
                    $versionNumber .= '<option value="'.$rowcategory->VERSION_NUMBER.'">'.$rowcategory->VERSION_NUMBER.'</option>';
                }*/

            }
            $versionNumberList['VERSION_ID'][] = $rowcategory->VERSION_ID;
            $versionNumberList['STATE'][] = $rowcategory->STATE;

        }

        //print_r($arrayS);
        //exit();
        $valeInput['VERSION_NUMBER'] = $versionNumber;
        $valeInput['VERSION_NUMBER_LIST']= $versionNumberList;
       
        return $valeInput;
    }

    public function getcategoryVersionSetup($paramFilter){

        $category = new Categories();
        $paramFilter['categoryId'] = $paramFilter['categoryId'];
        $paramFilter['versionNumber'] = $paramFilter['versionNumber'];
      

        $paramFilter['countcategory'] = $category->getVersionNumber($paramFilter)->count();
     
        $valeInput = array();
        foreach ($category->getDetailCategoryByVersion($paramFilter) as $indexcategory => $rowcategory ){
            //x$valeInput['category_ID'] = $rowcategory->category_id;
            $valeInput['CATEGORY_NAME'] = $rowcategory->CATEGORY_NAME;
            $valeInput['CATEGORY_ID'] = $rowcategory->CATEGORY_ID;
            $valeInput['VERSION_ID'] = $rowcategory->VERSION_ID;
            $valeInput['VERSION_NUMBER'] = $rowcategory->VERSION_NUMBER;
            $valeInput['DESCRIPTION'] = $rowcategory->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowcategory->DATE_FROM;
            $valeInput['DATE_TO'] = $rowcategory->DATE_TO;

        }

        $versionNumberList = array();
        $versionNumber = '';
       
        return $valeInput;
    }

    public function getSubCategoryList($versionId,$categoryId){
        $category = new Categories();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';

        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';

        foreach ($category->getSubCategory($paramFilter) as $indexcategory => $rowcategory ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label></td>';    
            $rowTable .='<td><label class="input"><input type="input" id="sub_category_name" class="sub_category_name" name="sub_category_name[]" value="'.$rowcategory->sub_category_name.'" placeholder="Sub Category Name" '.$isDisable.'><input type="hidden" name="sub_category_id[]" class="sub_category_id" value="'.$rowcategory->sub_category_id.'" id="sub_category_id"><i class="icon-append fa fa-search"></i></label></td>';
            $rowTable .='<td><a href="">view</a></td>';
            $rowTable .= '</tr>';
        }

        $valeInput['SUB_CATEGORY'] = $rowTable ;
        return $valeInput;
    }

    public function getSubCategoryVersionList($versionId,$categoryId){
        $category = new Categories();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';


        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';
        $index = 0;

        foreach ($category->getSubCategory($paramFilter) as $indexcategory => $rowcategory ){

                $valeInput['SUB_CATEGORY_LIST'][$index]['SUB_CATEGORY_NAME'] = $rowcategory->sub_category_name;
                $valeInput['SUB_CATEGORY_LIST'][$index]['SUB_CATEGORY_ID'] = $rowcategory->sub_category_id;


                $index++;

        }

        return $valeInput;

    }

    public function getcategoryVersionScoreList($versionId,$categoryId){
        $category = new category();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';

        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        

        $index = 1;

        foreach ($category->getcategoryScore($paramFilter) as $indexcategory => $rowcategory ){
             $rowTable = '';
             $valeInput['RAW_SCORE'][$index]['RAW_SCORES'] = $rowcategory->RAW_SCORE;
             $valeInput['RAW_SCORE'][$index]['STANDARD_SCORE'] = $rowcategory->STANDARD_SCORE;
             $rowTable .= '<label class="select"><select name="PSYCHOGRAM_ASPECT_RAW[]">';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowcategory->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
             $rowTable .= '</select><i></i></label>';
             $valeInput['RAW_SCORE'][$index]['PSYCHOGRAM_ASPECT'] = $rowTable;
            $index++;

        }
        return $valeInput;
    }

    public function getcategoryAspecList($versionId,$categoryId){

         $category = new category();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();

        $isDisable = '';

        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';

        foreach ($category->getcategoryAspect($paramFilter) as $indexcategory => $rowcategory ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label></td>';    
             $rowTable .= '<td><label class="select"><select name="PSYCHOGRAM_ASPECT[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowcategory->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label></td>';
            $rowTable .= '<td><label class="textarea"><textarea rows="5" name="DEFINITION[]" placeholder="Definition" '.$isDisable.'>'.$rowcategory->DEFINITION.'</textarea></label></td>';


            $rowTable .= '</tr>';

        }

        $valeInput['PSYCHOGRAM_ASPECT'] = $rowTable ;


        return $valeInput;

    }

    public function getcategoryAspecVersionList($versionId,$categoryId){

         $category = new category();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $rowData = array();
        $lookup = $this->lookupPsychogramAspect();

        $isDisable = '';

        $isFuture = $category->getFuturecategory($categoryId);
        $isPast = $category->getPastcategory($categoryId);
        $isCurrent = $category->getCurrentcategory($categoryId);
        $maxVersionNumber = $category->getMaxVersion($categoryId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';
        $index=1;

        foreach ($category->getcategoryAspect($paramFilter) as $indexcategory => $rowcategory ){

                $rowTable = '';

                $rowTable .= '<label class="select"><select name="PSYCHOGRAM_ASPECT[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowcategory->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label>';

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['PSYCHOGRAM_ASPECT'] = $rowTable;

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['DEFINITION'] = $rowcategory->DEFINITION;

                $index++;

        }

        return $valeInput;

    }

}
