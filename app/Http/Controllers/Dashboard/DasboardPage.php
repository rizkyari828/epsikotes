<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use \GuzzleHttp\Client;
use App\Model\Schedules;
use App\Model\Job;
use App\Model\Network;

class DasboardPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paramFilter = array();
        $valueTotalStatus = array('COMPLETE'=>0,'INCOMPLETE'=>0,'NOT_ATTEMPT'=>0,'CANCEL'=>0);
        $roleType  = $request->session()->get('user.roleType');
        $scheduleResult = null;

        $Schedule = new Schedules();

        if($roleType === 'VIEW_ALL_NETWORK'){
            $disableState = '';
            $isDisableByRole = '';
            $paramFilter['cabangId'] = null;
            $valeInput['NETWORK'] = '';
            $valeInput['NETWORK_ID'] = '';
            $valeInput['CABANG_ID'] = '';
            $scheduleResult = $Schedule->countScheduleByStatusPsikotest($paramFilter);

        }else if($roleType === 'VIEW_BY_NETWORK'){
            $isDisableByRole = 'readonly';
            $disableState = 'state-disabled';
            $valeInput['NETWORK'] = $request->session()->get('user.network');
            $valeInput['NETWORK_ID'] = $request->session()->get('user.networkId');
            $valeInput['CABANG_ID'] = $request->session()->get('user.cabangId');
            $paramFilter['cabangId'] = $request->session()->get('user.cabangId');
            $scheduleResult = $Schedule->countScheduleByStatusPsikotest($paramFilter);
        }


        if($scheduleResult != null){
            foreach ($scheduleResult as $indexScheduleResult => $rowScheduleResult) {
                $valueTotalStatus[$rowScheduleResult->test_status] = $rowScheduleResult->total_test_status;
            }
        }
        $valueTotalStatus['isDisableByRole'] = $isDisableByRole;

        $valueTotalStatus['disableState'] = $disableState;
        $valueTotalStatus['valeInput'] = $valeInput;
        $valueTotalStatus['cabangId'] = $paramFilter['cabangId'];

        $param = $valueTotalStatus;



        return view('pages.Dashboard',$param);
    }

    public function getRecomendationByJob(){
        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $Schedule = new Schedules();
        $records = array();

        $linkReschdule = '';
        $linkView = '';
        $linkCancel = '';


        foreach ($Schedule->countResultByJob($paramFilters) as $indexResultPsikotest => $rowResultPsikotest ){



            $records['data'][] =  array('jobName'=>$rowResultPsikotest->job_name,'totalResult'=>$rowResultPsikotest->total_test_status);

        }

        if(!isset($rowResultPsikotest->total_test_status)){
            $records['data'] =  array('jobName'=>null,'totalResult'=>null);

        }

        echo json_encode($records);
    }

    public function getRecomendationByNetwork(){
        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $Schedule = new Schedules();
        $Job = new Job();
        $Network = new Network();
        $records = array();
        $tempDataBuilder = array();
        $tempJob = array();


        $linkReschdule = '';
        $linkView = '';
        $linkCancel = '';

        foreach ($Network->getAllNetwork($paramFilters) as $indexNetwork => $rowNetwork ){
            foreach ($Job->getAllJob() as $key => $value) {
                $tempDataBuilder[$rowNetwork->network][$value->job_id]=0;
            }

        }

        foreach ($Schedule->countResultByJobAndNetwork($paramFilters) as $indexResultPsikotest => $rowResultPsikotest ){
            /*$records['data'][] =  array('network'=>$rowResultPsikotest->network,$rowResultPsikotest->job_id=>$rowResultPsikotest->total_test_status);

            $records['columns'][] = array('data'=>$rowResultPsikotest->job_id,'name'=>$rowResultPsikotest->job_name);
            $records['columns'][] = array('data'=>'network','name'=>$rowResultPsikotest->network);*/

            $tempDataBuilder[$rowResultPsikotest->network][$rowResultPsikotest->job_id]=$rowResultPsikotest->total_test_status;
            $tempJob[$rowResultPsikotest->job_id] = $rowResultPsikotest->job_name;
        }




        if(!isset($rowResultPsikotest->total_test_status)){
            $records['data'] =  array('network'=>null);
            $records['columns'][]= array('data'=>'network','name'=>'Network');
            foreach ($Job->getAllJob() as $key => $value) {
                $records['data'][$value->job_id] = null;
                $records['columns'][]= array('data'=>$value->job_id,'name'=>$value->job_name);

            }

        }else{
            $indexBuilder = 0;

            $records['columns'][] = array('data'=>'network','name'=>'Network');
            foreach ($Job->getAllJob() as $key => $value) {
                $records['columns'][]= array('data'=>$value->job_id,'name'=>$value->job_name);

            }


            foreach ($tempDataBuilder as $key => $value) {
                $records['data'][$indexBuilder]['network'] =  $key;
                foreach ($value as $keys => $values) {
                    $records['data'][$indexBuilder][$keys] =  $values;

                }
                $indexBuilder++;
            }
        }

        echo json_encode($records);
    }

}
