<?php

namespace App\Http\Controllers\Schedulepsikotes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Schedules;
use App\Model\Lookup;
use App\Model\Applicant;
use App\Model\ScheduleHistories;



class SchedulepsikotesPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */


    public function index(Request $request)
    {	
        $roleType  = $request->session()->get('user.roleType');


		$valeInput['RESCHEDULE_REASON'] =  $this->lookUpLastReasonReschedule();
                                    $disableState = '';

        if($roleType === 'VIEW_ALL_NETWORK'){
                $isDisableByRole = '';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = '';
                $valeInput['NETWORK_ID'] = '';
                $valeInput['CABANG_ID'] = '';
                $disableState = '';

            }else if($roleType === 'VIEW_BY_NETWORK'){
                $isDisableByRole = 'readonly';
                $disableState = 'state-disabled';
                $valeInput['ROLE'] = '';
                $valeInput['ROLE_ID'] = '';
                $valeInput['NETWORK'] = $request->session()->get('user.network');
                $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
                $valeInput['CABANG_ID'] = $request->session()->get('user.cabangId');
            }
        $param = array('valeInput' => $valeInput,'disableState'=>$disableState,'isDisableByRole'=>$isDisableByRole);
        return view('pages.PsikotestSchedulePageInquiry',$param);
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

    public function getPsikotestSchedulleAll(Request $request){

        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');

        $Applicant = new Applicant();
                $Schedules = new Schedules();

        $records = array();

        $roleType  = $request->session()->get('user.roleType');

        $linkReschdule = '';
        $linkView = '';
        $linkCancel = '';

       

        foreach ($Applicant->getAllAplicant($paramFilters) as $indexApplicant => $rowApplicant ){

            $linkReschdule = '<a href="psikotestscheduledetail/'.$rowApplicant->candidate_id.'" link_type="reschedule">Reschedule</a>';
            $linkView = '<a href="psikotestscheduledetail/'.$rowApplicant->candidate_id.'"> View </a>';

            $isCurrent = $Schedules->getCurrentSchedule($rowApplicant->candidate_id);

            $paramFilter['isCurrent'] = $isCurrent->isEmpty() ? 0 : 1;



            if($roleType == 'VIEW_ALL_NETWORK'){
                if(!$paramFilter['isCurrent']){
                    if(($rowApplicant->test_status != 'CANCEL')   ) { 
                        $linkCancel = '| <a href="cancelScheduleForm/'.$rowApplicant->schedule_history_id.'" link_type="cancel" data-toggle="modal" data-target=".remoteModal" id="'.$rowApplicant->schedule_history_id.'" name="btnCancel">cancel</a>'; 
                    }else{
                       $linkCancel = ''; 
                    }
                }else{
                    $linkCancel = ''; 
                }
            }else{
                $linkCancel = '';
            }

           $records['data'][] = array('checkbox'=>'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','action'=>$linkReschdule.' '.$linkCancel,'applicantName'=>$rowApplicant->full_name,'applicantId'=>$rowApplicant->applicant_id,'ktp'=>$rowApplicant->ktp,'psikotestStatus'=>$rowApplicant->test_status,'planDateFrom'=>date("d-M-Y",strtotime($rowApplicant->plan_start_date)),'planDateTo'=>date("d-M-Y",strtotime($rowApplicant->plan_end_date)),'actualStartFrom'=>$rowApplicant->actual_start_date==null ? '' : date("d-M-Y",strtotime($rowApplicant->actual_start_date)),'totalReschedule'=>$rowApplicant->reschedule_seq,'rescheduleReason'=>$rowApplicant->reschedule_reason_code,'lastUpdateDate'=>$rowApplicant->last_update_date,'lastUpdateBy'=>$rowApplicant->last_updated_by);

        }

        if(!isset($rowApplicant->applicant_id)){
            $records['data'] =  array('checkbox'=>null,'action'=>null,'applicantName'=>null,'applicantId'=>null,'ktp'=>null,'psikotestStatus'=>null,'planDateFrom'=>null,'planDateTo'=>null,'actualStartFrom'=>null,'totalReschedule'=>null,'rescheduleReason'=>null,'lastUpdateDate'=>null,'lastUpdateBy'=>null);

        } 

        echo json_encode($records);
    }

    public function getUserName(){

        $this->middleware('auth');

        $userName = \Request::input('userName');
        $Applicant = new Applicant();
        $records = array();


        foreach ($Applicant->getUserName($userName) as $indexApplicant => $rowApplicant ){
            $records['data_rows'][] = array('name'=>$rowApplicant->full_name);


        }

        echo json_encode($records);
    }

    public function getUserId(){

        $this->middleware('auth');

        $userId = \Request::input('applicantId');
        $Applicant = new Applicant();
        $records = array();


        foreach ($Applicant->getUserId($userId) as $indexApplicant => $rowApplicant ){
            $records['data_rows'][] = array('applicantId'=>$rowApplicant->applicant_id);


        }

        echo json_encode($records);
    }
	
	public function cancelSchedule(Request $request){

        $this->middleware('auth');
        $param = $request->all();

        $scheduleHistory = new ScheduleHistories();

        $updateSchedule = $scheduleHistory->cancelSchedule($param['history_id']);
		
		return redirect('/workspace#psikotestschedule');

    }

    public function cancelScheduleForm($schedule_history_id){

        $param = array('scheduleHistoryId' => $schedule_history_id);
        return view('pages.PsikotestScheduleCancelForm',$param);

    }
}
