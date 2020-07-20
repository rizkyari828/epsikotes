<?php

namespace App\Http\Controllers\Norma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Categories;
use App\Model\Lookup;
use App\Model\Norma;


class NormaAddPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request,$normaId = 0)
    {
        $lookup = $this->lookupPsychogramAspect();
        $valeInput = array();
        $norma = new Norma();

        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';
        $page = '';

        if(!$normaId){
            $valeInput['NORMA_ID'] = '';
            $valeInput['CATEGORY_NAME'] = '';
            $valeInput['CATEGORY_ID'] = '';
            $valeInput['VERSION_NUMBER'] = '<option value=New>New</option>';
            $valeInput['DESCRIPTION'] = '';
            $valeInput['DATE_FROM'] = '';
            $valeInput['DATE_TO'] = '';
            $valeInput['RAW_SCORE'] = '';
            $valeInput['PSYCHOGRAM_ASPECT'] = '';
            $page = 'NEW';
        }else{
            $isFuture = $norma->getFutureNorma($normaId);
            $isPast = $norma->getPastNorma($normaId);
            $isCurrent = $norma->getCurrentNorma($normaId);
            $maxVersionNumber = $norma->getMaxVersion($normaId);
            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;


            $normasetup = $this->getNormaSetup($normaId);

            $normascore = $this->getNormaScoreList($normasetup['VERSION_ID'],$normaId);
            $normaaspect = $this->getNormaAspecList($normasetup['VERSION_ID'],$normaId);

            $valeInput = $normasetup;
             //array_push($valeInput,$normasetup);
            $valeInput += $normascore;
           // array_push($valeInput,$normascore);
            $valeInput += $normaaspect;
            if($paramFilter['isCurrent']){
                $isDisableCurrent = 'disabled';
                $isDisable = 'disabled';
            }else if($paramFilter['isPast']){
                $isDisablePast = 'disabled';
                $isDisable = 'disabled';
            }else if($paramFilter['isFuture']){
                $isDisable = 'disabled';
            }


        }



        $aspectNameList = '<label class="select"><select name="PSYCHOGRAM_ASPECT[]">';
        foreach ($lookup  as $key => $value) {
            $aspectNameList .= '<option value="'.$value.'" selected="">'.$value.'</option>';
        }
        $aspectNameList .= '</select><i></i></label>';


        $aspectNameRawScoreList = '<label class="select"><select name="PSYCHOGRAM_ASPECT_RAW[]">';
        foreach ($lookup  as $key => $value) {
            $aspectNameRawScoreList .= '<option value="'.$value.'" selected="">'.$value.'</option>';
        }
        $aspectNameRawScoreList .= '</select><i></i></label>';


        $param = array('aspectNameSelect'=>$aspectNameList,'aspectNameRawScoreList'=>$aspectNameRawScoreList,'valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'isDisableCurrent'=>$isDisableCurrent,'isDisablePast'=>$isDisablePast);

        return view('pages.NormaPageAdd',$param);
    }

    public function getNormaByVersion(){

            $normaId = \Request::input('normaId');
            $versionNumber = \Request::input('versionNumber');
            $norma = new Norma();

            $isFuture = $norma->getFutureVersion($versionNumber,$normaId);
            $isPast = $norma->getPastVersion($versionNumber,$normaId);
            $isCurrent = $norma->getCurrentVersion($versionNumber,$normaId);
            $maxVersionNumber = $norma->getMaxVersion($normaId);
            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
            $paramFilter['normaId'] = $normaId;
            $paramFilter['versionNumber'] = $versionNumber;
            $normasetup = $this->getNormaVersionSetup($paramFilter);
            $normascore = $this->getNormaVersionScoreList($normasetup['VERSION_ID'],$normaId);
            $normaaspect = $this->getNormaAspecVersionList($normasetup['VERSION_ID'],$normaId);

            $valeInput = $normasetup;
             //array_push($valeInput,$normasetup);
            $valeInput += $normascore;
           // array_push($valeInput,$normascore);
            $valeInput += $normaaspect;

            if($paramFilter['isCurrent']){
                $isDisableCurrent = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isPast']){
                $isDisablePast = 'readonly';
                $isDisable = 'readonly';
            }else if($paramFilter['isFuture']){
                $isDisable = 'readonly';
            }

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

    public function processNorma(Request $request){

        $norma = new Norma();

        $this->middleware('auth');
        $param = $request->all();

        /*insert psy_norma*/
        if(($param['version_number'] == 'New') && ($param['NORMA_ID'] == null) ){
          
           
            $paramInsert['CATEGORY_ID'] = $param['category_id'];
            $paramInsert['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsert['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsert['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsert['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

            $idNorma = $norma->insertNorma($paramInsert); 

            $paramInsertNormaVersion['NORMA_ID'] = $idNorma;
            $paramInsertNormaVersion['VERSION_NUMBER'] = 1;
            $paramInsertNormaVersion['DATE_FROM'] = date( "Y-m-d", strtotime( $param['date_from'] ) );
            $paramInsertNormaVersion['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
            $paramInsertNormaVersion['DESCRIPTION'] = $param['description'];
            $paramInsertNormaVersion['CREATED_BY'] = $request->session()->get('user.username');
            $paramInsertNormaVersion['CREATION_DATE'] = date("Y-m-d h:i:s");
            $paramInsertNormaVersion['LAST_UPDATED_BY'] = $request->session()->get('user.username');
            $paramInsertNormaVersion['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


            $idNormaVersion = $norma->insertNormaVersions($paramInsertNormaVersion);

            foreach ($param['raw_score'] as $key => $value) {
                $paramInsertNormaRawScore['VERSION_ID'] = $idNormaVersion;
                $paramInsertNormaRawScore['RAW_SCORE'] = $param['raw_score'][$key];
                $paramInsertNormaRawScore['STANDARD_SCORE'] = $param['standard_score'][$key];
                $paramInsertNormaRawScore['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT_RAW'][$key];

                $norma->insertNormaScore($paramInsertNormaRawScore);
            }

            foreach ($param['PSYCHOGRAM_ASPECT'] as $key => $value) {
                $paramInsertNormaAspect['VERSION_ID'] = $idNormaVersion;
                $paramInsertNormaAspect['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT'][$key];
                $paramInsertNormaAspect['DEFINITION'] = $param['DEFINITION'][$key];

                $norma->insertNormaAspect($paramInsertNormaAspect);
            }

        }else{
            $isFuture = $norma->getFutureNorma($param['NORMA_ID']);
            $isPast = $norma->getPastNorma($param['NORMA_ID']);
            $isCurrent = $norma->getCurrentNorma($param['NORMA_ID']);
            $maxVersionNumber = $norma->getMaxVersion($param['NORMA_ID']);
            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

            if(($param['version_number'] == 'New') &&  $paramFilter['isCurrent']){ 

                $paramFilter['normaId'] = $param['NORMA_ID'];
                $paramFilter['versionNumber'] = $maxVersionNumber[0]->version_number;
                $paramFilter['value']['DATE_TO'] =  date("Y-m-d");
                $paramFilter['value']['LAST_UPDATED_BY'] =  $request->session()->get('user.username');
                $paramFilter['value']['LAST_UPDATE_DATE'] =  date("Y-m-d h:i:s");

                $norma->updateVersionActive($paramFilter);
                

                $paramInsertNormaVersion['NORMA_ID'] = $param['NORMA_ID'];
                $paramInsertNormaVersion['VERSION_NUMBER'] = $maxVersionNumber[0]->version_number + 1;
                $paramInsertNormaVersion['DATE_FROM'] = date( "Y-m-d", strtotime( $param['date_from'] ) );
                $paramInsertNormaVersion['DATE_TO'] =  isset($param['date_to']) ? date( "Y-m-d", strtotime( $param['date_to'] ) ) : date( "Y-m-d", strtotime( '4712-12-31' ) ) ;
                $paramInsertNormaVersion['DESCRIPTION'] = $param['description'];
                $paramInsertNormaVersion['CREATED_BY'] = $request->session()->get('user.username');
                $paramInsertNormaVersion['CREATION_DATE'] = date("Y-m-d h:i:s");
                $paramInsertNormaVersion['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                $paramInsertNormaVersion['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


                $idNormaVersion = $norma->insertNormaVersions($paramInsertNormaVersion);

                foreach ($param['raw_score'] as $key => $value) {
                    $paramInsertNormaRawScore['VERSION_ID'] = $idNormaVersion;
                    $paramInsertNormaRawScore['RAW_SCORE'] = $param['raw_score'][$key];
                    $paramInsertNormaRawScore['STANDARD_SCORE'] = $param['standard_score'][$key];
                    $paramInsertNormaRawScore['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT_RAW'][$key];

                    $norma->insertNormaScore($paramInsertNormaRawScore);
                }

                foreach ($param['PSYCHOGRAM_ASPECT'] as $key => $value) {
                    $paramInsertNormaAspect['VERSION_ID'] = $idNormaVersion;
                    $paramInsertNormaAspect['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT'][$key];
                    $paramInsertNormaAspect['DEFINITION'] = $param['DEFINITION'][$key];

                    $norma->insertNormaAspect($paramInsertNormaAspect);
                }
            }else{
                $paramFilter['normaId'] = $param['NORMA_ID'];
                $paramFilter['versionNumber'] = $param['version_number']; 

                $dataNorma = $norma->getNormaVersion($paramFilter);
                $paramFilter['value']['DATE_TO'] =  $param['date_to'];
                $paramFilter['value']['DATE_FROM'] =  $param['date_from'];
                $paramFilter['value']['DESCRIPTION'] =  $param['description'];
                $paramFilter['value']['LAST_UPDATED_BY'] =  $request->session()->get('user.username');
                $paramFilter['value']['LAST_UPDATE_DATE'] =  date("Y-m-d h:i:s");

                $norma->updateVersionActive($paramFilter); 
                 // echo $dataNorma[0]->VERSION_ID;
                 // die()
                $norma->deleteNormaScore($dataNorma[0]->VERSION_ID);
                foreach ($param['raw_score'] as $key => $value) {
                    $paramInsertNormaRawScore['VERSION_ID'] = $dataNorma[0]->VERSION_ID;
                    $paramInsertNormaRawScore['RAW_SCORE'] = $param['raw_score'][$key];
                    $paramInsertNormaRawScore['STANDARD_SCORE'] = $param['standard_score'][$key];
                    $paramInsertNormaRawScore['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT_RAW'][$key];

                    $norma->insertNormaScore($paramInsertNormaRawScore);
                }
                $norma->deleteNormaAspect($dataNorma[0]->VERSION_ID);
                foreach ($param['PSYCHOGRAM_ASPECT'] as $key => $value) {
                    $paramInsertNormaAspect['VERSION_ID'] = $dataNorma[0]->VERSION_ID;
                    $paramInsertNormaAspect['PSYCHOGRAM_ASPECT'] = $param['PSYCHOGRAM_ASPECT'][$key];
                    $paramInsertNormaAspect['DEFINITION'] = (!empty($param['DEFINITION'][$key]))?$param['DEFINITION'][$key]:""; 
                    $norma->insertNormaAspect($paramInsertNormaAspect);
                }

            }

        }
        return redirect('/workspace#normasetup');
        
    }

    public function getNormaSetup($normaId){

        $norma = new Norma();
        $paramFilter['normaId'] = $normaId;
        $isFuture = $norma->getFutureNorma($normaId);
        $isPast = $norma->getPastNorma($normaId);
        $isCurrent = $norma->getCurrentNorma($normaId);
        $maxVersionNumber = $norma->getMaxVersion($normaId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;
        $paramFilter['countNorma'] = $norma->getVersionNumber($paramFilter)->count();
     
        $valeInput = array();
        foreach ($norma->getAllNorma($paramFilter) as $indexNorma => $rowNorma ){
            $valeInput['NORMA_ID'] = $rowNorma->NORMA_ID;
            $valeInput['CATEGORY_NAME'] = $rowNorma->CATEGORY_NAME;
            $valeInput['CATEGORY_ID'] = $rowNorma->CATEGORY_ID;
            $valeInput['VERSION_ID'] = $rowNorma->VERSION_ID;
            $valeInput['VERSION_NUMBER'] = $rowNorma->VERSION_NUMBER;
            $valeInput['DESCRIPTION'] = $rowNorma->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowNorma->DATE_FROM;
            $valeInput['DATE_TO'] = $rowNorma->DATE_TO;

        }

        $versionNumberList = array();
        $versionNumber = '';


        
        foreach ($norma->getVersionNumber($paramFilter) as $indexNorma => $rowNorma ){
            if($paramFilter['countNorma'] == 1 ){
                $versionNumber .= '<option value="'.$rowNorma->VERSION_NUMBER.'" selected>'.$rowNorma->VERSION_NUMBER.'</option>';
                if($paramFilter['isCurrent'] || $paramFilter['isPast']  ){
                    $versionNumber .= '<option value=New>New</option>';
                }
            }else{
               
                if($paramFilter['isFuture'] && ($maxVersionNumber[0]->version_number == $rowNorma->VERSION_NUMBER)){ 

                    $versionNumber .= '<option value="'.$rowNorma->VERSION_NUMBER.'" selected>'.$rowNorma->VERSION_NUMBER.'</option>';

                    $versionNumber .= '<option value=New>New</option>';
                }else if($paramFilter['isCurrent'] && ($maxVersionNumber[0]->version_number == $rowNorma->VERSION_NUMBER)){
                    $versionNumber .= '<option value="'.$rowNorma->VERSION_NUMBER.'" selected>'.$rowNorma->VERSION_NUMBER.'</option>';
                    $versionNumber .= '<option value=New>New</option>';

                }else if($paramFilter['isPast'] && ($maxVersionNumber[0]->version_number == $rowNorma->VERSION_NUMBER)){
                    $versionNumber .= '<option value="'.$rowNorma->VERSION_NUMBER.'" selected>'.$rowNorma->VERSION_NUMBER.'</option>';
                    $versionNumber .= '<option value=New>New</option>';

                }else{
                    $versionNumber .= '<option value="'.$rowNorma->VERSION_NUMBER.'">'.$rowNorma->VERSION_NUMBER.'</option>';
                }

            }
            $versionNumberList['VERSION_ID'][] = $rowNorma->VERSION_ID;
            $versionNumberList['STATE'][] = $rowNorma->STATE;

        }
        $valeInput['VERSION_NUMBER'] = $versionNumber;
        $valeInput['VERSION_NUMBER_LIST']= $versionNumberList;
       
        return $valeInput;
    }

    public function getNormaVersionSetup($paramFilter){

        $norma = new Norma();
        $paramFilter['normaId'] = $paramFilter['normaId'];
        $paramFilter['versionNumber'] = $paramFilter['versionNumber'];
        $paramFilter['countNorma'] = $norma->getVersionNumber($paramFilter)->count();
     
        $valeInput = array();
        foreach ($norma->getNormaVersion($paramFilter) as $indexNorma => $rowNorma ){
            $valeInput['NORMA_ID'] = $rowNorma->NORMA_ID;
            $valeInput['CATEGORY_NAME'] = $rowNorma->CATEGORY_NAME;
            $valeInput['CATEGORY_ID'] = $rowNorma->CATEGORY_ID;
            $valeInput['VERSION_ID'] = $rowNorma->VERSION_ID;
            $valeInput['VERSION_NUMBER'] = $rowNorma->VERSION_NUMBER;
            $valeInput['DESCRIPTION'] = $rowNorma->DESCRIPTION;
            $valeInput['DATE_FROM'] = $rowNorma->DATE_FROM;
            $valeInput['DATE_TO'] = $rowNorma->DATE_TO;

        }

        $versionNumberList = array();
        $versionNumber = '';
       
        return $valeInput;
    }

    public function getNormaScoreList($versionId,$normaId){
        $norma = new Norma();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';

        $isFuture = $norma->getFutureNorma($normaId);
        $isPast = $norma->getPastNorma($normaId);
        $isCurrent = $norma->getCurrentNorma($normaId);
        $maxVersionNumber = $norma->getMaxVersion($normaId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';

        foreach ($norma->getNormaScore($paramFilter) as $indexNorma => $rowNorma ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label></td>';    
            $rowTable .='<td><label class="input"><input type="text" value="'.$rowNorma->RAW_SCORE.'" name="raw_score[]" placeholder="Raw Score" '.$isDisable.'> </label></td>';
            $rowTable .='<td><label class="input"><input type="text" value="'.$rowNorma->STANDARD_SCORE.'" name="standard_score[]" placeholder="Standard Score" '.$isDisable.'> </label></td>';
             $rowTable .= '<td><label class="select"><select name="PSYCHOGRAM_ASPECT_RAW[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowNorma->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label></td>';

            $rowTable .= '</tr>';

        }

        $valeInput['RAW_SCORE'] = $rowTable ;
        return $valeInput;
    }

    public function getNormaVersionScoreList($versionId,$normaId){
        $norma = new Norma();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();
        $isDisable = '';

        $isFuture = $norma->getFutureNorma($normaId);
        $isPast = $norma->getPastNorma($normaId);
        $isCurrent = $norma->getCurrentNorma($normaId);
        $maxVersionNumber = $norma->getMaxVersion($normaId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        

        $index = 1;

        foreach ($norma->getNormaScore($paramFilter) as $indexNorma => $rowNorma ){
             $rowTable = '';
             $valeInput['RAW_SCORE'][$index]['RAW_SCORES'] = $rowNorma->RAW_SCORE;
             $valeInput['RAW_SCORE'][$index]['STANDARD_SCORE'] = $rowNorma->STANDARD_SCORE;
             $rowTable .= '<label class="select"><select name="PSYCHOGRAM_ASPECT_RAW[]">';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowNorma->PSYCHOGRAM_ASPECT){
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

    public function getNormaAspecList($versionId,$normaId){

         $norma = new Norma();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $lookup = $this->lookupPsychogramAspect();

        $isDisable = '';

        $isFuture = $norma->getFutureNorma($normaId);
        $isPast = $norma->getPastNorma($normaId);
        $isCurrent = $norma->getCurrentNorma($normaId);
        $maxVersionNumber = $norma->getMaxVersion($normaId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';

        foreach ($norma->getNormaAspect($paramFilter) as $indexNorma => $rowNorma ){

            $rowTable .= '<tr>';
            $rowTable .='<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"> <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /> <span></span> </label></td>';    
             $rowTable .= '<td><label class="select"><select name="PSYCHOGRAM_ASPECT[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowNorma->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label></td>';
            $rowTable .= '<td><label class="textarea"><textarea rows="5" name="DEFINITION[]" placeholder="Definition" '.$isDisable.'>'.$rowNorma->DEFINITION.'</textarea></label></td>';


            $rowTable .= '</tr>';

        }

        $valeInput['PSYCHOGRAM_ASPECT'] = $rowTable ;


        return $valeInput;

    }

    public function getNormaAspecVersionList($versionId,$normaId){

         $norma = new Norma();
        $paramFilter['versionId'] = $versionId;
        $valeInput = array();
        $rowData = array();
        $lookup = $this->lookupPsychogramAspect();

        $isDisable = '';

        $isFuture = $norma->getFutureNorma($normaId);
        $isPast = $norma->getPastNorma($normaId);
        $isCurrent = $norma->getCurrentNorma($normaId);
        $maxVersionNumber = $norma->getMaxVersion($normaId);
        $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
        $paramFilter['isPast'] = $isPast->isEmpty() ? 0 : 1;
        $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

        if($paramFilter['isCurrent'] || $paramFilter['isPast']){
            $isDisable = 'disabled';
        }


        $rowTable = '';
        $index=1;

        foreach ($norma->getNormaAspect($paramFilter) as $indexNorma => $rowNorma ){

                $rowTable = '';

                $rowTable .= '<label class="select"><select name="PSYCHOGRAM_ASPECT[]" '.$isDisable.'>';
                foreach ($lookup  as $key => $value) {
                    if($value == $rowNorma->PSYCHOGRAM_ASPECT){
                        $rowTable .= '<option value="'.$value.'" selected="">'.$value.'</option>';
                    }else{
                        $rowTable .= '<option value="'.$value.'" >'.$value.'</option>';

                    }
                }
                $rowTable .= '</select><i></i></label>';

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['PSYCHOGRAM_ASPECT'] = $rowTable;

                $valeInput['PSYCHOGRAM_ASPECT'][$index]['DEFINITION'] = $rowNorma->DEFINITION;

                $index++;

        }

        return $valeInput;

    }

}
