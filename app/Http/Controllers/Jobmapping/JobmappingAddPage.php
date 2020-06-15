<?php

namespace App\Http\Controllers\Jobmapping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Narrations;
use App\Model\Job;
use App\Model\Jobmapping;
use App\Model\Categories;

use Session;

class JobmappingAddPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request,$jobMappingId = 0)
    {
        $Jobmapping = new Jobmapping();
        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';
        $page = '';

       

        if(!$jobMappingId){
            $valeInput['JOB_MAPPING_ID'] = '';
            $valeInput['NAME'] = '';
            $valeInput['CATEGORY_NAME'] = '';
            $valeInput['GENERAL_INSTRUCTION_NAME'] = '';
            $valeInput['GENERAL_INSTRUCTION_ID'] = '';
            $valeInput['FINAL_GREATING'] = '';
            $valeInput['FINAL_GREATING_ID'] = '';
            $valeInput['VERSION_NUMBER'] = '<option value=New>New</option>';
            $valeInput['DESCRIPTION'] = '';
            $valeInput['DATE_FROM'] = '';
            $valeInput['DATE_TO'] = '';
            $valeInput['CATEGORY_LIST'] = '';
            $valeInput['JOB_PROFILE'] = '';
            $page = 'NEW';
            $paramFilter['jobMappingId'] = "";
        }else{
            $isFuture = $Jobmapping->getFutureJobMapping($jobMappingId);
            $isPast = $Jobmapping->getPastJobMapping($jobMappingId);
            $isCurrent = $Jobmapping->getCurrentJobMapping($jobMappingId);
            $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
            $jobmappingsetup = $this->getJobMappingSetup($jobMappingId); 
            
            if($paramFilter['isCurrent']){
                $isDisableCurrent = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isPast']){
                $isDisablePast = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isFuture']){
                // $isDisable = 'readonly';
            }

            $jobmappingcategory = $this->getCategoryList($jobmappingsetup['VERSION_ID'],$jobMappingId,$isDisablePast, $isDisableCurrent,$isDisable);
            $jobprofile = $this->getJobProfileScore($jobmappingsetup['VERSION_ID'],$jobMappingId,$isDisablePast, $isDisableCurrent,$isDisable);

            $valeInput = $jobmappingsetup;
            $valeInput += $jobmappingcategory;
            $valeInput += $jobprofile;
        }

         $categoryProfile = $this->buildCategoryProfileScore($isDisablePast, $isDisableCurrent,$isDisable);



        $param = array('INDUCTIVEREASONING'=>$categoryProfile['INDUCTIVEREASONING'],'DEDUCTIVEREASONING'=>$categoryProfile['DEDUCTIVEREASONING'],'READINGCOMPREHENSION'=>$categoryProfile['READINGCOMPREHENSION'],'ARITHMETICABILITY'=>$categoryProfile['ARITHMETICABILITY'],'SPATIALABILITY'=>$categoryProfile['SPATIALABILITY'],'MEMORY'=>$categoryProfile['MEMORY'],'valeInput'=>$valeInput,'isDisableCurrent'=>$isDisableCurrent,'isDisable'=>$isDisable,'isDisablePast'=>$isDisablePast,'jobMappingId'=>$jobMappingId);



        return view('pages.JobmappingPageAdd',$param);
    }

    public function narrations(){

        $this->middleware('auth');

        $narrationName = \Request::input('narrationName');
        $narrations = new Narrations();
        $records = array();


        foreach ($narrations->getNarrations($narrationName) as $indexNarration => $rowNarration ){
            $records['data_rows'][] = array('narrationId'=>$rowNarration->narration_id,'narrationName'=>$rowNarration->narration_name );


        }

        echo json_encode($records);
    }

    public function buildCategoryProfileScore($isDisablePast = '',$isDisableCurrent='',$isDisable=''){

         $Categories = new Categories();
        $records = array();

        $jobMappingCategoryScoreList = array();


        foreach ($Categories->getCategory('') as $indexCategory => $rowCategory ){
            $categoryName =  str_replace(' ', '', $rowCategory->category_name);

              $jobMappingCategoryScoreList[$categoryName] = '<label class="input"><input type="number" name="pass_score['.$rowCategory->category_id.'][]" placeholder="Raw Score" class="pass_score" ></label><label class="checkbox"><input type="checkbox" name="mandatory['.$rowCategory->category_id.'][]" id="mandatory"> <i></i><br/> Is Mandatory</label>';
        }


      return $jobMappingCategoryScoreList;


    }

    public function processJobMapping(Request $request){

        $Jobmapping = new Jobmapping();

        $this->middleware('auth');
        $param = $request->all();
        $jobMappingId = $param['jobMappingId'];
        if($jobMappingId == 0 ){
             /* start insert job mapping */
            $paramInsert['NAME'] = $param['name'];
            $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");
            $idJobMapping = $Jobmapping->insertJobMapping($paramInsert);
        }else{
            $idJobMapping = $jobMappingId;
        }
        /* end insert */

        /* start insert job mapping versions */
        $paramInsertJobMappingVersions['JOB_MAPPING_ID'] = $idJobMapping;
        $paramInsertJobMappingVersions['VERSION_NUMBER'] = 1;
        $paramInsertJobMappingVersions['date_from'] = isset($param['date_from']) ? date( "Y-m-d", strtotime( $param['date_from'] ) ) : date( "Y-m-d");
        $paramInsertJobMappingVersions['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime("+1 day")) ;
        $paramInsertJobMappingVersions['DESCRIPTION'] = $param['description'];
        $paramInsertJobMappingVersions['GENERAL_INSTRUCTION'] = $param['general_instruction'];
        $paramInsertJobMappingVersions['FINAL_GREATING'] = $param['final_greating_id'];
        $paramInsertJobMappingVersions['RANDOM_CATEGORY'] = 1;
        $paramInsertJobMappingVersions['CREATED_BY'] = $request->session()->get('user.username');
        $paramInsertJobMappingVersions['CREATION_DATE'] = date("Y-m-d h:i:s");
        $paramInsertJobMappingVersions['LAST_UPDATED_BY'] = $request->session()->get('user.username');
        $paramInsertJobMappingVersions['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");
        $idJobMappingVersions = $Jobmapping->insertJobMappingVersions($paramInsertJobMappingVersions);
        /* end insert */

        /* start insert category list */
        $catSeq = 1;
        foreach ($param['category_id'] as $key => $value) {
            $paramInsertJobCategoryList['VERSION_ID'] = $idJobMappingVersions;
            $paramInsertJobCategoryList['CATEGORY_SEQ'] = $catSeq;
            $paramInsertJobCategoryList['CATEGORY_ID'] = $value;
            $Jobmapping->insertJobCategoryList($paramInsertJobCategoryList);
            $catSeq++;
        }
        /* end insert */

        /* start insert job profile */
        foreach ($param['job_id'] as $key => $value) {
            $paramInsertJobProfiles['VERSION_ID'] = $idJobMappingVersions;
            $paramInsertJobProfiles['JOB_ID'] = $value;
            $paramInsertJobProfiles['TOTAL_PASS_SCORE'] = $param['total_pass_score'][$key];
            $idJobProfile = $Jobmapping->insertJobProfile($paramInsertJobProfiles);
            /* start insert job profile score */
            foreach ($param['pass_score'] as $key_pass_score => $value_pass_score) {
                    $paramInsertJobProfileScore['JOB_PROFILE_ID'] = $idJobProfile;
                    $paramInsertJobProfileScore['CATEGORY_ID'] = $key_pass_score;
                    $paramInsertJobProfileScore['PASS_SCORE'] = $value_pass_score[$key];
                    $paramInsertJobProfileScore['MANDATORY']     = isset($param['mandatory'][$key_pass_score][$key]) ? 1 : 0 ;
                    $Jobmapping->insertJobProfileScore($paramInsertJobProfileScore);

            }
            /* end insert */

        }
        /* end insert */
        Session::put('success', 'Save Successfull!');
        return redirect('/workspace#jobmappingsetup');
    }

    public function getJobMappingSetup($jobMappingId){

        $Jobmapping = new Jobmapping();
        $paramFilter['jobMappingId'] = $jobMappingId;
        $isFuture = $Jobmapping->getFutureJobmapping($jobMappingId);
        $isPast = $Jobmapping->getPastJobmapping($jobMappingId);
        $isCurrent = $Jobmapping->getCurrentJobmapping($jobMappingId);
        $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
        $paramFilter['countJobMapping'] = $Jobmapping->getVersionNumber($paramFilter)->count();

        $valeInput = array();
        foreach ($Jobmapping->getAllJobMapping($paramFilter) as $indexJobmapping => $rowJobmapping ){
            $valeInput['JOB_MAPPING_ID'] = $rowJobmapping->JOB_MAPPING_ID;
            $valeInput['NAME'] = $rowJobmapping->NAME;
            $valeInput['GENERAL_INSTRUCTION_NAME'] = $rowJobmapping->narration_name;
            $valeInput['GENERAL_INSTRUCTION_ID'] = $rowJobmapping->narration_id;
            $valeInput['FINAL_GREATING'] = $rowJobmapping->final_greating_name;
            $valeInput['FINAL_GREATING_ID'] = $rowJobmapping->final_greating_id;
            $valeInput['VERSION_ID'] = $rowJobmapping->VERSION_ID;
            $valeInput['VERSION_NUMBER'] = $rowJobmapping->VERSION_NUMBER;
            $valeInput['DESCRIPTION'] = $rowJobmapping->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowJobmapping->DATE_FROM;
            $valeInput['DATE_TO'] = $rowJobmapping->DATE_TO;

        }

        $versionNumberList = array();
        $versionNumber = '';



        foreach ($Jobmapping->getVersionNumber($paramFilter) as $indexJobmapping => $rowJobmapping ){
            if($paramFilter['countJobMapping'] == 1 ){
                $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'" selected>'.$rowJobmapping->VERSION_NUMBER.'</option>';
                if($paramFilter['isCurrent'] || $paramFilter['isPast']  ){
                    $versionNumber .= '<option value=New>New</option>';
                }
            }else{

                if($paramFilter['isFuture'] && ($maxVersionNumber[0]->version_number == $rowJobmapping->VERSION_NUMBER)){

                    $versionNumber .= '<option value="'.($maxVersionNumber[0]->version_number-1).'" selected>'.($maxVersionNumber[0]->version_number-1).'</option>';

                    $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'">'.$rowJobmapping->VERSION_NUMBER.'</option>';
                }else if($paramFilter['isCurrent'] && ($maxVersionNumber[0]->version_number == $rowJobmapping->VERSION_NUMBER)){
                    $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'" selected>'.$rowJobmapping->VERSION_NUMBER.'</option>';
                    $versionNumber .= '<option value=New>New</option>';

                }else if($paramFilter['isPast'] && ($maxVersionNumber[0]->version_number == $rowJobmapping->VERSION_NUMBER)){
                    $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'" selected>'.$rowJobmapping->VERSION_NUMBER.'</option>';
                    $versionNumber .= '<option value=New>New</option>';

                }else{
                    $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'">'.$rowJobmapping->VERSION_NUMBER.'</option>';

                }
             //   $versionNumber .= '<option value="'.$rowJobmapping->VERSION_NUMBER.'">'.$rowJobmapping->VERSION_NUMBER.'</option>';

            }
            $versionNumberList['VERSION_ID'][] = $rowJobmapping->VERSION_ID;
            $versionNumberList['STATE'][] = $rowJobmapping->STATE;

        }
        $valeInput['VERSION_NUMBER'] = $versionNumber;
        $valeInput['VERSION_NUMBER_LIST']= $versionNumberList;

        return $valeInput;
    }

    public function getJobmappingVersionSetup($paramFilter){

        $Jobmapping = new Jobmapping();
        $paramFilter['jobMappingId'] = $paramFilter['jobMappingId'];
        $paramFilter['versionNumber'] = $paramFilter['versionNumber'];
        $paramFilter['countJobMapping'] = $Jobmapping->getVersionNumber($paramFilter)->count();

        $valeInput = array();
        foreach ($Jobmapping->getJobmappingVersion($paramFilter) as $indexJobmapping => $rowJobmapping ){
            $valeInput['JOB_MAPPING_ID'] = $rowJobmapping->JOB_MAPPING_ID;
            $valeInput['NAME'] = $rowJobmapping->NAME;
            $valeInput['GENERAL_INSTRUCTION_NAME'] = $rowJobmapping->narration_name;
            $valeInput['GENERAL_INSTRUCTION_ID'] = $rowJobmapping->narration_id;
            $valeInput['FINAL_GREATING'] = '';
            $valeInput['FINAL_GREATING_ID'] = '';
            $valeInput['VERSION_ID'] = $rowJobmapping->VERSION_ID;
            $valeInput['VERSION_NUMBER'] = $rowJobmapping->VERSION_NUMBER;
            $valeInput['DESCRIPTION'] = $rowJobmapping->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowJobmapping->DATE_FROM;
            $valeInput['DATE_TO'] = $rowJobmapping->DATE_TO;

        }

        $versionNumberList = array();
        $versionNumber = '';

        return $valeInput;
    }

    public function getCategoryList($versionId,$jobMappingId,$isDisablePast = '',$isDisableCurrent='',$isDisable=''){
        $Jobmapping = new Jobmapping();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $isDisable = '';

        $isFuture = $Jobmapping->getFutureJobmapping($jobMappingId);
        $isPast = $Jobmapping->getPastJobmapping($jobMappingId);
        $isCurrent = $Jobmapping->getCurrentJobmapping($jobMappingId);
        $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';

        foreach ($Jobmapping->getJobCategoryList($paramFilter) as $indexJobmapping => $rowJobmapping ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'/> <span></span> </label></td>';
            $rowTable .='<td><label class="input"><input type="input" id="sub_category_name" class="sub_category_name" name="sub_category_name[]" value="'.$rowJobmapping->category_name.'" placeholder="Category Name" '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'><input type="hidden" name="category_id[]" class="category_id" value="'.$rowJobmapping->category_id.'" id="category_id"> <i class="icon-append fa fa-search"></i></label></td>';


            $rowTable .= '</tr>';

        }

        $valeInput['CATEGORY_LIST'] = $rowTable ;
        return $valeInput;
    }

    public function getCategoryListVersion($versionId,$jobMappingId){
        $Jobmapping = new Jobmapping();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';

        $isFuture = $Jobmapping->getFutureJobmapping($jobMappingId);
        $isPast = $Jobmapping->getPastJobmapping($jobMappingId);
        $isCurrent = $Jobmapping->getCurrentJobmapping($jobMappingId);
        $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }

        $index = 1;

        foreach ($Jobmapping->getJobCategoryList($paramFilter) as $indexJobmapping => $rowJobmapping ){
             $rowTable = '';
             $valeInput['CATEGORY_LIST'][$index]['CATEGORY'] = $rowJobmapping->category_name;
             $valeInput['CATEGORY_LIST'][$index]['CATEGORY_ID'] = $rowJobmapping->category_id;

            $index++;

        }
        return $valeInput;
    }

    public function getJobProfileScore($versionId,$jobMappingId,$isDisablePast = '',$isDisableCurrent='',$isDisable=''){

         $Jobmapping = new Jobmapping();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $isDisable = '';

        $isFuture = $Jobmapping->getFutureJobmapping($jobMappingId);
        $isPast = $Jobmapping->getPastJobmapping($jobMappingId);
        $isCurrent = $Jobmapping->getCurrentJobmapping($jobMappingId);
        $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';
        $isChecked = '';

        foreach ($Jobmapping->getJobProfile($paramFilter) as $indexJobmapping => $rowJobmapping ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes"
            '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.' /> <span></span> </label></td>';

            $rowTable .= '<td><label class="input"><input type="text" name="job_name[]" value="'.$rowJobmapping->job_name.'" class="job_name" placeholder="Job Name" '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'>
            <input type="hidden" name="job_id[]" value="'.$rowJobmapping->job_id.'"  class="job_id" id="job_id" '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'> <i class="icon-append fa fa-search"></i></label></td>';

            $paramFilter['jobProfileId'] = $rowJobmapping->job_profile_id;

            foreach ($Jobmapping->getJobProfileScore($paramFilter)  as $key => $rowJobmappingScore) {
                $isChecked = $rowJobmappingScore->mandatory == 1 ? 'checked' : '';

                $rowTable .=   '<td><label class="input"><input type="number" name="pass_score['.$rowJobmappingScore->category_id.'][]" placeholder="Raw Score" value="'.$rowJobmappingScore->pass_score.'"  class="pass_score" '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'></label><label class="checkbox"><input type="checkbox" name="mandatory['.$rowJobmappingScore->category_id.'][]" id="mandatory" '.$isChecked .' '.$isDisablePast.' '.$isDisableCurrent.' '. $isDisable.'> <i></i><br/> Is Mandatory</label></td>';
            }

            $rowTable .= '<td><label class="input"><input type="number" value="'.$rowJobmapping->total_pass_score.'"  readonly name="total_pass_score[]" id="total_pass_score" class="total_pass_score" placeholder=""> </label></td>';

            $rowTable .= '</tr>';

        }


        $valeInput['JOB_PROFILE'] = $rowTable ;

        return $valeInput;

    }

    public function getJobmappingAspecVersionList($versionId,$jobMappingId){

         $Jobmapping = new Jobmapping();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $rowData = array();
        $lookup = $this->lookupPsychogramAspect();

        $isDisable = '';

        $isFuture = $Jobmapping->getFutureJobmapping($jobMappingId);
        $isPast = $Jobmapping->getPastJobmapping($jobMappingId);
        $isCurrent = $Jobmapping->getCurrentJobmapping($jobMappingId);
        $maxVersionNumber = $Jobmapping->getMaxVersion($jobMappingId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';
        $index=1;

        foreach ($Jobmapping->getJobmappingAspect($paramFilter) as $indexJobmapping => $rowJobmapping ){

                $rowTable = '';

                $rowTable .= '<label class="select"><select name="PSYCHOGRAM_ASPECT[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowJobmapping->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label>';

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['PSYCHOGRAM_ASPECT'] = $rowTable;

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['DEFINITION'] = $rowJobmapping->DEFINITION;

                $index++;

        }

        return $valeInput;

    }
}
