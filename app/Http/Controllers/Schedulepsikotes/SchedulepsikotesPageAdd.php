<?php

namespace App\Http\Controllers\Schedulepsikotes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Http\Controllers\Controller;
use App\Model\Network;
use App\Model\Applicant;
use App\Model\Schedules;
use App\Model\Lookup;
use App\Model\Location;
use \GuzzleHttp\Client;
use App\Mail\PsikotestScheduleMail;






class SchedulepsikotesPageAdd extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        $valeInput = array();
        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';
        $page = '';
        $fields_string = '';




        $client = new Client();
          $Schedules = new Schedules();
                  $applicant = new Applicant();

        $url = "https://gawe.id/employer/api";
        $myBody['id_cabang'] = $request->session()->get('user.cabangId');

        $response = $client->request('POST', $url, ['form_params' => $myBody]);

        $applicantList = json_decode($response->getBody());

        $listApplicant = '';

       // print_r($applicantList);
      //  exit();

     

        $valeInput['APPLICANT_LIST'][0] = (object) array(
            'employee_id' => '',
            'applicant_id' => '',
            'applicant_name' => '',
            'nik' => '',
            'umur' => '',
            'group_id' => '',
            'username' => '',
            'last_login' => '',
            'email' => '',
            'alamat_domisili' => '',
            'universitas' => '',
            'gender' => '',
            'city_id' => '',
            'alamat_ktp' => '',
            'status_psikotes' => '',
            'file_ktp' => '',
            'hp' => '',
            'pendidikan_id' => '',
            'start_date_psikotes' => '',
            'end_date_psikotes' => '',
            'status_api' => '',
            'tgl_lahir' => '',
            'user_id' => ''
        ); //$applicantList->result;

      //  print_r($valeInput['APPLICANT_LIST']);
      //  exit();

        $roleType  = $request->session()->get('user.roleType');
         $isDisableByRole = '';

         if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
                $disableState = '';
                $listApplicant = '';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = '';
                $valeInput['NETWORK_ID'] = '';
                $valeInput['CABANG_ID'] = '';

            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'readonly';
                $disableState = 'state-disabled';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = $request->session()->get('user.network');
                $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
                $valeInput['CABANG_ID'] = $request->session()->get('user.cabangId');


                $client = new Client();
                $url = "https://gawe.id/employer/api";
                $myBody['id_cabang'] = $request->session()->get('user.cabangId'); //'145';



                $curl = curl_init();
              

                //url-ify the data for the POST
                foreach($myBody as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                //rtrim($fields_string, '&');

                $fields_string = rtrim($fields_string,'&');


                curl_setopt_array($curl, array(
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => $fields_string,
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: your-api-key"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);


                $applicantList = json_decode($response);


                $valeInput['APPLICANT_LIST'] =  $applicantList->result;
                //$param = array('valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'page'=>$page);


                $records = array();

                if(isset($valeInput['APPLICANT_LIST'])){
                    foreach ($valeInput['APPLICANT_LIST'] as $key => $value) {
                        $existingApplicant = $applicant->getUserId($value->applicant_id);
                        
                        if($existingApplicant->isEmpty()){
                        # code..
                          $listApplicant .= '<option value="'.$value->applicant_id.'">'.$value->applicant_name.' - '.$value->applicant_id.'</option>';
                          //  $records['data_rows'][] = array('applicantId'=>$value->applicant_id,'applicantName'=>$value->applicant_name );
                       }
                    }
                }else{
                    $listApplicant = '';
                    //$records['data_rows'][] = array('applicantId'=>null,'applicantName'=>null );
                }  

            }


        


        $param = array('valeInput' => $valeInput,'isDisableByRole'=> $isDisableByRole,'disableState' => $disableState,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'page'=>$page,'listApplicant'=>$listApplicant);

        return view('pages.PsikotestSchedulePageAdd',$param);
    }

     public function lookupAdressSMA(){

        $this->middleware('auth');

        $lookup = new Lookup();
        $records = array();

        foreach ($lookup->getLookup('MST_EDUCATION') as $indexLookup => $rowLookup ){
            $records[] = $rowLookup->detail_code;

        }
    }
        

    public function findApplicant(){

        $applicant = new Applicant();
        $valeInput = array();
        $isReadOnly = '';
        $isDisable = '';
        $isDisableCurrent = '';
        $isDisablePast = '';
        $page = '';
        $fields_string = '';


        $this->middleware('auth');
        $param = \Request::input('param');



        $client = new Client();
        $url = "https://gawe.id/employer/api";
        $myBody['id_cabang'] = $param['cabang_id']; //'145';

        if(isset($param['full_name'])){
            $myBody['name'] = $param['full_name']; //'145';
        }

        if(isset($param['applicant_id'])){
            $myBody['user_id'] = $param['applicant_id']; //'145';
        }

        if(isset($param['last_educations'])){
            $myBody['education'] = $param['last_educations']; //'145';
        }

        if(isset($param['birth_date'])){
            $myBody['tgl_lahir'] = $param['birth_date']; //'145';
        }

        if(isset($param['age'])){
            $myBody['age'] = $param['age']; //'145';
        }

        if(isset($param['ktp'])){
            $myBody['nik'] = $param['ktp']; //'145';
        }

        if(isset($param['city_id'])){
            $myBody['city_id'] = $param['city_id']; //'145';
        }



         $curl = curl_init();
      

        //url-ify the data for the POST
        foreach($myBody as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        //rtrim($fields_string, '&');

        $fields_string = rtrim($fields_string,'&');


        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $fields_string,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: your-api-key"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        $applicantList = json_decode($response);


        $valeInput['APPLICANT_LIST'] =  $applicantList->result;
        //$param = array('valeInput' => $valeInput,'isReadOnly'=>$isReadOnly,'isDisable'=>$isDisable,'page'=>$page);


        $records = array();

        if(isset($valeInput['APPLICANT_LIST'])){
            foreach ($valeInput['APPLICANT_LIST'] as $key => $value) {
                $existingApplicant = $applicant->getUserId($value->applicant_id);
                
                if($existingApplicant->isEmpty()){
                # code..
                    $records['data_rows'][] = array('applicantId'=>$value->applicant_id,'applicantName'=>$value->applicant_name );
               }
            }
        }else{
            $records['data_rows'][] = array('applicantId'=>null,'applicantName'=>null );
        }   

        echo json_encode($records);


        exit();

       // return view('pages.PsikotestSchedulePageAdd',$param);
    }

    public function detail($applicantId){
        $applicant = new Applicant();
        $Schedules = new Schedules();

        $paramFilter['candidateId'] = $applicantId;



        $applicantDetail = $applicant->getApplicant($paramFilter);
        $valeInput['full_name'] =   $applicantDetail[0]->full_name;
        $valeInput['applicant_id'] =   $applicantDetail[0]->applicant_id;
        $valeInput['ktp'] =   $applicantDetail[0]->ktp;
        $valeInput['candidate_id'] =   $applicantDetail[0]->candidate_id;
        $valeInput['birth_date'] =   $applicantDetail[0]->birth_date;

         $valeInput['RESCHEDULE_REASON'] =  $this->lookUpLastReasonReschedule();

         $candidateId = $applicantDetail[0]->candidate_id;

         
         


            $isFuture = $Schedules->getFutureSchedule($candidateId);
            $isStatusScheduleNotAllowReschedule = $Schedules->getStatusScheduleNotAllowReschedule($candidateId);
            $isCurrent = $Schedules->getCurrentSchedule($candidateId);
            $isMaxScheduleStatus = $Schedules->getMaxScheduleStatus($candidateId);

                    


            $paramFilter['isFuture'] = $isFuture->isEmpty() ? 0 : 1;
            $paramFilter['isStatusScheduleNotAllowReschedule'] = $isStatusScheduleNotAllowReschedule->isEmpty() ? 0 : 1;
            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;

          

            if( $paramFilter['isFuture'] ){
              $disableState = 'state-disabled';
              $isDisable = 'disabled';
              $textWarning = 'This schedules cannot be reschedule because have active future schedules';
            }else if($paramFilter['isStatusScheduleNotAllowReschedule']){
              $disableState = 'state-disabled';
              $isDisable = 'disabled';
              $textWarning = 'This schedules cannot be reschedule because has been complete the schedules';
            }else if($paramFilter['isCurrent']){
              $disableState = 'state-disabled';
              $isDisable = 'disabled';
              $textWarning = 'This schedules cannot be reschedule because have active schedules';
            }else if($isMaxScheduleStatus->test_status === 'CANCEL'){
              $disableState = 'state-disabled';
              $isDisable = 'disabled';
              $textWarning = 'This schedules cannot be reschedule because have cancel schedules';
            }else{
              $disableState = '';
              $isDisable = '';
              $textWarning = '';

            }

  

         $param = array('valeInput' => $valeInput,'isDisable'=>$isDisable,'disableState'=>$disableState,'disableState'=>$disableState,'textWarning'=>$textWarning);
        return view('pages.PsikotestSchedulePageDetail',$param);

    }

    public function networks(){

        $this->middleware('auth');

        $networkName = \Request::input('networkName');
        $network = new Network();
        $records = array();


        foreach ($network->getNetwork($networkName) as $indexNetwork => $rowNetwork ){
            $records['data_rows'][] = array('networkId'=>$rowNetwork->network_id,'cabangId'=>$rowNetwork->cabang_id,'networkName'=>$rowNetwork->network,'network'=>$rowNetwork->network_id );


        }

        echo json_encode($records);
    }

    public function locations(){

        $this->middleware('auth');

        $networkId = \Request::input('networkId');
        $locationName = \Request::input('locationName');
        $locations = new Location();
        $records = array();


        foreach ($locations->getLocation($networkId,$locationName) as $indexLocation => $rowLocation ){
            $records['data_rows'][] = array('id_city_gawe'=>$rowLocation->id_city_gawe,'city_id'=>$rowLocation->city_id,'city'=>$rowLocation->city );


        }

        echo json_encode($records);
    }

    public function lookUpLastEducations(){

        $this->middleware('auth');

        $lookupDtlMeaning = \Request::input('lookupDtlMeaning');
        $lookupName = \Request::input('lookupName');
        $lookup = new Lookup();
        $records = array();


        foreach ($lookup->getLookupDtl($lookupName,$lookupDtlMeaning) as $indexLookup => $rowLookup ){
            $records['data_rows'][] = array('detailCodeLookUp'=>$rowLookup->detail_code,'meaningLookUp'=>$rowLookup->meaning );


        }

        echo json_encode($records);
    }


    public function lookUpLastReasonReschedule(){

        $this->middleware('auth');

        $lookupName = 'MST_RESCHEDULE_REASON';
        $lookup = new Lookup();
        $records = array();


        foreach ($lookup->getLookup($lookupName) as $indexLookup => $rowLookup ){
            $records['data_rows'][] = array('detailCodeLookUp'=>$rowLookup->detail_code,'meaningLookUp'=>$rowLookup->meaning );


        }

        return $records['data_rows'];
    }

    public function processScheduled(Request $request){



        $applicant = new Applicant();
        $schedules = new Schedules();
        $lookup = new Lookup();
        $locations = new Location();

        $this->middleware('auth');
        $param = $request->all();

        $valeInput = array();
        $gaweParam = array();
        $gaweParamPsikotestStatus = array();
		
		

        $applicantList = array_unique($param['candidate']);


	//print_r($param);
	//exit();

        $client = new Client();
        $url = "https://gawe.id/employer/api";
        $myBody['id_cabang'] =  $param['cabang'];



       $employee_id = 0;

        foreach ($applicantList as $keyCandidate => $valueCandidate) {

                $myBody['user_id'] = $valueCandidate;
                $response = $client->request('POST', $url, ['form_params' => $myBody]);
                $applicantList = json_decode($response->getBody());
					

                $employee_id = $applicantList->result[0]->employee_id;

                $existingApplicant = $applicant->getExistsUserid($valueCandidate);
                              
                if(!isset($existingApplicant)){
                  $educations =  $lookup->getLookupDtl('MST_EDUCATION',$applicantList->result[0]->pendidikan_id);
                  $cityName =  $locations->getLocationByGaweId($applicantList->result[0]->city_id);

            
                  $valeInput['DATA_SOURCE'] =  'API_GAWE';//$param['DATA_SOURCE'][$valueCandidate];
                  $valeInput['APPLICANT_ID'] =  $valueCandidate;
                  $valeInput['USER_NAME'] =  $applicantList->result[0]->username;
                  $valeInput['PASSWORD'] =  '';
                  $valeInput['FULL_NAME'] =  $applicantList->result[0]->applicant_name;
                  $valeInput['CABANG_ID'] =  $param['cabang'];
                  $valeInput['BIRTH_DATE'] = $applicantList->result[0]->tgl_lahir;
                  $valeInput['GENDER'] =  $applicantList->result[0]->gender == 'L' ? 'MALE' : 'FEMALE';
                  $valeInput['KTP'] =  $applicantList->result[0]->nik;
                  $valeInput['ADDRESS'] =  $applicantList->result[0]->alamat_domisili;
                  $valeInput['CITY'] =  $cityName->city; //$applicantList->result[0]->applicant_name;
                  $valeInput['PHONE_NUMBER'] =  $applicantList->result[0]->hp;
                  $valeInput['EMAIL'] =  $applicantList->result[0]->email;
                  $valeInput['LAST_EDUCATIONS'] = $educations[0]->meaning; //$applicantList->result[0]->applicant_name;
                  $valeInput['CREATED_BY'] = $request->session()->get('user.username');
                  $valeInput['CREATION_DATE'] = date("Y-m-d h:i:s");
                  $valeInput['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                  $valeInput['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


                  $candidateId = $applicant->insertApplicant($valeInput);

                }else{
                  $candidateId = $existingApplicant->candidate_id;
                }


                $valeInputSchedule['CANDIDATE_ID'] = $candidateId;
                $valeInputSchedule['CREATED_BY'] = $request->session()->get('user.username');
                $valeInputSchedule['CREATION_DATE'] = date("Y-m-d h:i:s");
                $valeInputSchedule['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                $valeInputSchedule['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

                $scheduleId = $schedules->insertSchedule($valeInputSchedule);

                 $valeInputScheduleHistory['SCHEDULE_ID'] = $scheduleId;
                 $valeInputScheduleHistory['RESCHEDULE_SEQ'] = 0;
                 $valeInputScheduleHistory['RESCHEDULE_REASON_CODE'] = '';
                 $valeInputScheduleHistory['RESCHEDULE_REASON_TEXT'] = '';
                 $valeInputScheduleHistory['JOB_MAPPING_ID'] = $param['job_mapping_id'];
				         $valeInputScheduleHistory['JOB_MAPPING_VERSION_ID'] = $param['job_mapping_version_id'];

                 $valeInputScheduleHistory['PLAN_START_DATE'] = date("Y-m-d",strtotime($param['plan_start_date']));
                 $valeInputScheduleHistory['PLAN_END_DATE']= date("Y-m-d",strtotime($param['plan_end_date']));
                 
                 $valeInputScheduleHistory['TEST_STATUS'] = 'NOT_ATTEMPT';
                 $valeInputScheduleHistory['CREATED_BY'] = $request->session()->get('user.username');
                 $valeInputScheduleHistory['CREATION_DATE'] = date("Y-m-d h:i:s");
                 $valeInputScheduleHistory['LAST_UPDATED_BY'] = $request->session()->get('user.username');
                 $valeInputScheduleHistory['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");


                $gaweParam[] = array('id' => $valueCandidate, 'start_date' => date("Y-m-d",strtotime($param['plan_start_date'])),'end_date' => date("Y-m-d",strtotime($param['plan_end_date'])) );

                $gaweParamPsikotestStatus[] = array('id' => $valueCandidate, 'TEST_STATUS' => $valeInputScheduleHistory['TEST_STATUS']);


                 $schedules->insertHistory($valeInputScheduleHistory);
                 // $paramFilter['job_mapping_id'] = $param['job_mapping_id'];
                 // foreach ($schedules->getCategoryScore($paramFilter) as $key => $value) {
                 //    $valeInputCategoryList['SCHEDULE_ID'] = $scheduleId;
                 //    $valeInputCategoryList['CATEGORY_SEQ'] = $value->category_seq;
                 //    $valeInputCategoryList['CATEGORY_ID'] = $$value->category_id;
                 //    $valeInputCategoryList['SUB_CATEGORY_ID'] = $value->sub_category_id;
                 //    $valeInputCategoryList['IS_TEST_CATEGORY_ACTIVE'] = 1;
                 //    $valeInputCategoryList['SUM_RAWSCORE'] = $value->sum_rawscore;
                 //    $valeInputCategoryList['STANDARD_SCORE'] = $value->standard_score;
                 //    $valeInputCategoryList['CREATION_DATE'] = date("Y-m-d h:i:s");
                 //    $valeInputCategoryList['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");
                 //    $schedules->insertTestCategory($valeInputCategoryList);
                 // }

                $applicantName = $applicantList->result[0]->applicant_name;
                $planStartDate = $param['plan_start_date'];
                $planEndDate =  $param['plan_end_date'];

                //$toEmail = "ajie.darmawan106@gmail.com";
		          

                $toEmail = $applicantList->result[0]->email;



                Mail::to($toEmail)->send(new PsikotestScheduleMail($applicantName,$planStartDate,$planEndDate));

                // echo $toEmail;
                // die;

        }
        
       $gaweParamValue = json_encode($gaweParam);
        $gaweParamPsikotestStatusValue = json_encode($gaweParamPsikotestStatus);

        // echo "<pre>";
        // print_r($gaweParamValue);
        // echo "</pre>";

        // die;


        $client = new Client();
        $url = "https://gawe.id/employer/json_update2";
        $myBody['id'] = $gaweParamValue;
        $response = $client->request('POST', $url, ['form_params' => $myBody]);
        $applicantList = json_decode($response->getBody());



        $url = "https://gawe.id/employer/status_psikotes";
        $myBody['id'] = $gaweParamPsikotestStatusValue;
        $response = $client->request('POST', $url, ['form_params' => $myBody]);
        $applicantList = json_decode($response->getBody()); 


        $testJson = '[{"id":'.$employee_id.',"up_table":"module_employee","related_type":"job_interview","related_module":"lamaran\/psikotes","related_link_from":"lamaran\/psikotes\/","related_name":"PT Swakarya Insan Mandiri","related_text":"mengundang kamu untuk Melakukan Psikotes","related_last":"Surveyor Malang","related_link_text":"Mulai Psikotes","redirect_link":"lamaran\/psikotes\/","redirect_link_refid":"0","ctd":"2019-04-22 16:41:20","mdd":"2019-04-22 16:41:20","read_is":0,"read_at":"2019-04-22 16:41:20"}]';
        // $url = "https://gawe.id/employer/tes_notif";
        // $myBody['id'] = $testJson;
        // $response = $client->request('POST', $url, ['form_params' => $myBody]);
        // $applicantList = json_decode($response->getBody());
        
        return redirect('/workspace#psikotestschedule');
    }


     public function processRescheduled(Request $request){



        $applicant = new Applicant();
        $schedules = new Schedules();


        $this->middleware('auth');
        $param = $request->all();

        $valeInput = array();
        $gaweParam = array();
        $gaweParamPsikotestStatus = array();
		
		 $paramFilter['candidateId'] = $param['candidate_id'];
        $scheduleHistory = $schedules->getScheduledHistoryList($paramFilter);
        $countSchedule = count($scheduleHistory);
        $validate = "true";

        // CEK FUTURE SCHEDULE


        foreach ($scheduleHistory as $key => $value) {
            // VALIDASI TANGGAL IRISAN
            if($value->plan_start_date >= $param['startdate'] && $param['startdate'] <= $value->plan_end_date)
                $validate = "false";
            if($value->plan_start_date >= $param['enddate'] && $param['enddate'] <= $value->plan_end_date)
                $validate = "false";

            // VALIDASI TEST STATUS DI SCHEDULE TERAKHIR
            if($key == ($countSchedule-1) ){
                if($value->test_status == 'COMPLETE' OR $value->test_status == 'CANCEL')
                    $validate = "false";
            }
        }
		
		if($validate == "true"){
			$schedulesId = $schedules->getScheduledByCandidateId($param['candidate_id']);


			 $valeInputScheduleHistory['SCHEDULE_ID'] = $schedulesId->schedule_id;
			 $seq = $schedules->getScheduledSeq($schedulesId->schedule_id);
			 $valeInputScheduleHistory['RESCHEDULE_SEQ'] = $seq+1;
			 $valeInputScheduleHistory['RESCHEDULE_REASON_CODE'] = $param['RESCHEDULE_REASON'];
			 $valeInputScheduleHistory['RESCHEDULE_REASON_TEXT'] = $param['RESCHEDULE_REASON_TEXT'];
			 $valeInputScheduleHistory['JOB_MAPPING_ID'] = $param['job_mapping_id'];
			 $valeInputScheduleHistory['JOB_MAPPING_VERSION_ID'] = $schedulesId->job_mapping_version_id;
			 $valeInputScheduleHistory['PLAN_START_DATE'] = $param['startdate'];
			 $valeInputScheduleHistory['PLAN_END_DATE']= $param['enddate'];
			 $valeInputScheduleHistory['TEST_STATUS'] = $schedulesId->test_status;
			 $valeInputScheduleHistory['CREATED_BY'] = $request->session()->get('user.username');
			 $valeInputScheduleHistory['CREATION_DATE'] = date("Y-m-d h:i:s");
			 $valeInputScheduleHistory['LAST_UPDATED_BY'] = $request->session()->get('user.username');
			 $valeInputScheduleHistory['LAST_UPDATE_DATE'] = date("Y-m-d h:i:s");

			 $schedules->insertHistory($valeInputScheduleHistory);
			 

            $applicant = new Applicant();
            $paramFilter['candidateId'] = $param['candidate_id'];



            $applicantDetail = $applicant->getApplicant($paramFilter);
            $valeInput['full_name'] =   $applicantDetail[0]->full_name;
            $valeInput['applicant_id'] =   $applicantDetail[0]->applicant_id;
            $valeInput['ktp'] =   $applicantDetail[0]->ktp;
            $valeInput['candidate_id'] =   $applicantDetail[0]->candidate_id;
            $valeInput['birth_date'] =   $applicantDetail[0]->birth_date;

			$applicantName = $valeInput['full_name'];
			$planStartDate = $param['startdate'];
			$planEndDate =  $param['enddate'];

			//$toEmail = "muktiputut@gmail.com";
			$toEmail =  $applicantDetail[0]->email;
			Mail::to($toEmail)->send(new PsikotestScheduleMail($applicantName,$planStartDate,$planEndDate));

			
			return redirect('/workspace#psikotestschedule');
				// $valeInput['alert'] = "Reschedule created";
        }else{
            // $valeInput['alert'] = "Reschedule isn't created";
            return redirect('/workspace#psikotestscheduledetail/'.$param['candidate_id'].'');
        }
    }

    public function getAllScheduleHistory(){

        $Schedules = new Schedules();
        $records = array();

        $candidateId = \Request::input('candidateId');

        $paramFilter['candidateId'] = $candidateId ;


        foreach ($Schedules->getScheduledHistoryList($paramFilter) as $indexSchedules => $rowSchedules ){

           $records['data'][] = array('<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>',$rowSchedules->name,$rowSchedules->plan_start_date,$rowSchedules->plan_end_date,$rowSchedules->plan_end_date,$rowSchedules->test_status,$rowSchedules->reschedule_reason_code,$rowSchedules->inductive,$rowSchedules->deductive,$rowSchedules->reading,$rowSchedules->arithmatic,$rowSchedules->spatials,$rowSchedules->memory);

        }

        echo json_encode($records);
    }
}
