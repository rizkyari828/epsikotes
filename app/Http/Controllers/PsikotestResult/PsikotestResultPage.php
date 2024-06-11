<?php

namespace App\Http\Controllers\PsikotestResult;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use Elibyy\TCPDF\Facades\TCPDF;
// use Excel;
// use Barryvdh\DomPDF\DomPDF;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use App\Model\Result;
use App\Model\Schedules;
use App\Model\ScheduleHistories;
use App\Model\Applicant;
use App\Exports\ResultExport;

class PsikotestResultPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        
            // ->toSql();
            // dd($records2);
        $applicantData = Applicant::get();
        $network = DB::table('mst_networks')->get();
        $location = DB::table('mst_city')->get();
        $jobs = DB::table('psy_job_mappings')->get();
        return view('pages.PsikotestResultInquiry')
            ->with('applicantData',$applicantData)
            ->with('network', $network)
            ->with('location', $location)
            ->with('jobs', $jobs);
    }

    public function getAllResult(){
        // $dateNow = date('Y-m-d', strtotime( '-5 days' ));
        $dateNow = date('Y-m-d');

        $records2 = ScheduleHistories::select('mst_applicant.candidate_id','mst_applicant.full_name','mst_applicant.applicant_id','mst_applicant.ktp','psy_schedule_histories.test_status','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.reschedule_seq','psy_schedule_histories.schedule_history_id')
            ->join("psy_schedules", 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->join("mst_applicant", 'mst_applicant.candidate_id', '=', 'psy_schedules.candidate_id')
            // ->where('psy_schedule_histories.plan_start_date','<=',$dateNow)
            // ->where('psy_schedule_histories.plan_end_date','>=',$dateNow)
            ->distinct()->get();

        $records = array();

        foreach ($records2 as $indexrec => $rowrec ){
            $records['data'][] = array('<a href="#getResultDetail/'.$rowrec->candidate_id.'/'.$rowrec->schedule_history_id.'">detail</a>',$rowrec->full_name,$rowrec->applicant_id,$rowrec->ktp, $rowrec->test_status, $rowrec->plan_start_date,$rowrec->plan_end_date , $rowrec->actual_start_date, $rowrec->reschedule_seq );
        }


        echo json_encode($records);
        // return $records;
    }

    public function getResultByParameter(Request $request){
        // $dateNow = date('Y-m-d', strtotime( '-5 days' ));
        //$request->psi_result  
        //$request->network
        //$request->planDateFrom
        //$request->planDateTo
    //    print_r($request->network);
    //     die();
        $dateNow = date('Y-m-d');
        $paramApplicantName = $request->full_name;
        $paramApplicantId = $request->applicant_id;
        $paramKTP = $request->ktp;
        $paramPsiResult = $request->psi_result;
        $paramRecomendation = $request->recomendation;
        $paramNetwork = $request->network;
        $paramLocation = $request->location;
        if($request->planDateFrom)
            $paramPlanDateFrom = date('Y-m-d', strtotime($request->planDateFrom));
        if($request->planDateTo)
            $paramPlanDateTo = date('Y-m-d', strtotime($request->planDateTo));
        if($request->startDateFrom)
            $paramActualDateFrom = date('Y-m-d', strtotime($request->startDateFrom));
        if($request->startDateTo)
            $paramActualDateTo = date('Y-m-d', strtotime($request->startDateTo));
        $paramJobName = $request->jobName;

        // $records2 = ScheduleHistories::select('mst_applicant.candidate_id','mst_applicant.full_name','mst_applicant.applicant_id','mst_applicant.ktp','psy_schedule_histories.test_status','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.reschedule_seq','psy_schedule_histories.schedule_history_id')
        //     ->join("psy_schedules", 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
        //     ->join("mst_applicant", 'mst_applicant.candidate_id', '=', 'psy_schedules.candidate_id')
        //     ->join("mst_city", 'mst_city.city', '=', 'mst_applicant.city')
        //     ->join("mst_networks", 'mst_networks.network_id', '=', 'mst_city.network_id')
        //     ->join("psy_job_mapping_versions", 'psy_job_mapping_versions.job_mapping_id', '=', 'psy_schedule_histories.job_mapping_id');
        //     $records2 = $records2->distinct()->get();

        $records2 = ScheduleHistories::select('mst_applicant.candidate_id','mst_applicant.full_name','mst_applicant.applicant_id','mst_applicant.ktp','psy_schedule_histories.test_status','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.reschedule_seq','psy_schedule_histories.schedule_history_id')
            ->join("psy_schedules", 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->join("mst_applicant", 'mst_applicant.candidate_id', '=', 'psy_schedules.candidate_id');
            // ->where('psy_schedule_histories.plan_start_date','<=',$dateNow)
            // ->where('psy_schedule_histories.plan_end_date','>=',$dateNow)
            // ->join("mst_city", 'mst_city.city', '=', 'mst_applicant.city')
            // ->join("mst_networks", 'mst_networks.network_id', '=', 'mst_city.network_id');
            if($paramPsiResult != null)
               $records2->where('psy_schedule_histories.TEST_STATUS','=',$paramPsiResult);
            if($request->planDateFrom){
                $records2->where('psy_schedule_histories.PLAN_START_DATE','>=',$request->planDateFrom);
            }
            if($request->planDateTo){
                $records2->where('psy_schedule_histories.PLAN_END_DATE','<=',$request->planDateTo); 
            }  
            // if($paramNetwork != null){
            //     $records2->where('mst_networks.NETWORK','=',$paramNetwork);
            // }
            $records2 = $records2->distinct()->get();  

          
            // if($paramApplicantName != null)
            //     $records2->where('mst_applicant.full_name','like','%'.$paramApplicantName.'%');
            // if($paramApplicantId != null)
            //     $records2->where('mst_applicant.applicant_id','=',$paramApplicantId);
            // if($paramKTP != null)
            //     $records2->where('mst_applicant.ktp','=',$paramKTP);
            // if($paramPsiResult != null)
            //     $records2->where('psy_schedule_histories.test_status','=',$paramPsiResult);
            // if($paramRecomendation != null){
            //     $records2->join("psy_test_result", 'psy_test_result.schedule_id', '=', 'psy_schedules.schedule_id');
            //     $records2->where('psy_test_result.recomendation_by_system','=',$paramRecomendation);
            // }
            // if($request->planDateFrom)
            //     $records2->where('psy_schedule_histories.plan_start_date','>=',$paramPlanDateFrom);
            // if($request->planDateTo)
            //     $records2->where('psy_schedule_histories.plan_end_date','<=',$paramPlanDateTo);
            // if($request->startDateFrom)
            //     $records2->whereDate('psy_schedule_histories.actual_start_date','>=',$paramActualDateFrom);
            // if($request->startDateTo)
            //     $records2->whereDate('psy_schedule_histories.actual_start_date','<=',$paramActualDateTo);
            // if($paramLocation != null)
            //     $records2->where('mst_applicant.city','=',$paramLocation);
            // if($paramNetwork != null)
            //     $records2->where('mst_networks.network','=',$paramNetwork);
            // if($paramJobName != null){
            //     $records2->join("psy_job_mappings", 'psy_job_mappings.job_mapping_id', '=', 'psy_job_mapping_versions.job_mapping_id');
            //     $records2->where('psy_job_mappings.name','=',$paramJobName);
            // }
      

        //


        $records = array();

        foreach ($records2 as $indexrec => $rowrec ){
            $records['data'][] = array('<a href="#getResultDetail/'.$rowrec->candidate_id.'/'.$rowrec->schedule_history_id.'">detail</a>',$rowrec->full_name,$rowrec->applicant_id,$rowrec->ktp, $rowrec->test_status, $rowrec->plan_start_date,$rowrec->plan_end_date , $rowrec->actual_start_date, $rowrec->reschedule_seq );
        }


        echo json_encode($records);
        // return $records;
    }

    public function getResultByParameterDownload($paramApplicantName,$paramApplicantId,$paramKTP,$paramPsiResult,$paramRecomendation,$paramNetwork,$paramLocation,$paramPlanDateFrom,$paramPlanDateTo,$paramActualDateFrom,$paramActualDateTo,$paramJobName){
        // $dateNow = date('Y-m-d', strtotime( '-5 days' ));
        $dateNow = date('Y-m-d');
        if($paramPlanDateFrom != '-')
            $paramPlanDateFrom = date('Y-m-d', strtotime($paramPlanDateFrom));
        if($paramPlanDateTo != '-')
            $paramPlanDateTo = date('Y-m-d', strtotime($paramPlanDateTo));
        if($paramActualDateFrom != '-')
            $paramActualDateFrom = date('Y-m-d', strtotime($paramActualDateFrom));
        if($paramActualDateTo != '-')
            $paramActualDateTo = date('Y-m-d', strtotime($paramActualDateTo));

        $records2 = Result::select('mst_applicant.full_name','mst_applicant.applicant_id','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.test_status','mst_applicant.birth_date','mst_applicant.ktp','mst_applicant.gender','mst_applicant.ktp','mst_applicant.last_educations','mst_applicant.user_name','mst_applicant.phone_nuumber','psy_test_result.recomendation_by_system','psy_job_mappings.name','psy_schedules.schedule_id')
            ->join("psy_schedules", 'psy_schedules.schedule_id', '=', 'psy_test_result.schedule_id')
            ->join("mst_applicant", 'mst_applicant.candidate_id', '=', 'psy_schedules.candidate_id')
            // ->join("psy_schedule_histories", 'psy_schedule_histories.schedule_id', '=', 'psy_schedules.schedule_id')
            ->join("psy_schedule_histories", 'psy_schedule_histories.schedule_history_id', '=', 'psy_test_result.schedule_history_id')
            ->join("psy_job_mapping_versions",'psy_job_mapping_versions.version_id','=','psy_schedule_histories.job_mapping_version_id')
            ->join("psy_job_mappings", 'psy_job_mappings.job_mapping_id', '=', 'psy_job_mapping_versions.job_mapping_id')
            ->where('psy_schedule_histories.test_status','complete');
            // ->orderBy('mst_jobs.JOB_NAME','asc')
            // ->orderBy('psy_test_result.RECOMENDATION_BY_SYSTEM','asc')
            // ->get();
            if($paramApplicantName != '-')
                $records2->where('mst_applicant.full_name','like','%'.$paramApplicantName.'%');
            if($paramApplicantId != 0)
                $records2->where('mst_applicant.applicant_id','=',$paramApplicantId);
            if($paramKTP != 0)
                $records2->where('mst_applicant.ktp','=',$paramKTP);
            if($paramPsiResult != '-')
                $records2->where('psy_schedule_histories.test_status','=',$paramPsiResult);
            if($paramPlanDateFrom != '-')
                $records2->where('psy_schedule_histories.plan_start_date','>=',$paramPlanDateFrom);
            if($paramPlanDateTo != '-')
                $records2->where('psy_schedule_histories.plan_end_date','<=',$paramPlanDateTo);
            if($paramActualDateFrom != '-')
                $records2->where('psy_schedule_histories.actual_start_date','>=',$paramActualDateFrom);
            if($paramActualDateTo != '-')
                $records2->where('psy_schedule_histories.actual_start_date','<=',$paramActualDateTo);
            if($paramLocation != '-' && $paramNetwork == '-'){
                $records2->join("mst_city", 'mst_city.city', '=', 'mst_applicant.city');
                $records2->where('mst_applicant.CITY','=',$paramLocation);
            }if($paramNetwork != '-' && $paramLocation == '-'){
                $records2->join("mst_city", 'mst_city.city', '=', 'mst_applicant.city');
                $records2->join("mst_networks", 'mst_networks.network_id', '=', 'mst_city.network_id');
                $records2->where('mst_applicant.city','=',$paramLocation);
                $records2->where('mst_networks.network','=',$paramNetwork);
            }if($paramLocation != '-' && $paramNetwork != '-'){
                $records2->join("mst_city", 'mst_city.city', '=', 'mst_applicant.city');
                $records2->join("mst_networks", 'mst_networks.network_id', '=', 'mst_city.network_id');
                $records2->where('mst_networks.network','=',$paramNetwork);
            }if($paramJobName != '-'){
                $records2->where('psy_job_mappings.name','=',$paramJobName);
            }

            $records2->orderBy('psy_job_mappings.name','asc');
            $records2->orderBy('psy_test_result.recomendation_by_system','asc');
            $records2 = $records2->distinct()->get();

        $categoriesResult = array();
        foreach ($records2 as $key => $value) {
            $totalScore = 0;
            for ($i=1; $i <= 6 ; $i++) { 
                $records = DB::table('psi.psy_test_categories')
                    ->select('standard_score')
                    ->where('schedule_id',$value->SCHEDULE_ID)
                    ->where('category_id',$i)
                    ->where('is_test_category_active', 1)
                    ->first();
                if($records){
                    $categoriesResult[$key][] = $records->STANDARD_SCORE;
                    $totalScore += $records->STANDARD_SCORE; 
                }else{
                    $categoriesResult[$key][] = 0;
                }
            }
            $categoriesResult[$key][] = $totalScore;
        }

        return view('pages.PsikotestResultReport')
            ->with('records2', $records2)
            ->with('categoriesResult',$categoriesResult);
        // Excel::create('Report', function($excel) use($records2,$categoriesResult) {
        //     $excel->sheet('New sheet', function($sheet) use($records2,$categoriesResult) {
        //       $sheet->loadView('pages.PsikotestResultReport',$records2, $categoriesResult);
        //     });
        //   })->export('xls');
        
        // return $records;
        // return 'yes';
    }

    public function reportResultExcel($paramApplicantName,$paramApplicantId,$paramKTP,$paramPsiResult,$paramRecomendation,$paramNetwork,$paramLocation,$paramPlanDateFrom,$paramPlanDateTo,$paramActualDateFrom,$paramActualDateTo,$paramJobName){
        $nama_file = 'Result_Report_'.date('d-m-Y').'.xlsx';
        return Excel::download(new ResultExport($paramApplicantName,$paramApplicantId,$paramKTP,$paramPsiResult,$paramRecomendation,$paramNetwork,$paramLocation,$paramPlanDateFrom,$paramPlanDateTo,$paramActualDateFrom,$paramActualDateTo,$paramJobName), $nama_file);
        // return Excel::download(new getResultByParameterDownload, 'users.xlsx');
    }

    public function getResultDetail($applicantId,$scheduleHistoryId){

        $applicantData = Applicant::find($applicantId);
        $anotherApplicant = Applicant::where('KTP',$applicantData->ktp)
            ->whereNotIn('applicant_id',[$applicantData->applicant_id])
            ->get();
        $scheduleData = ScheduleHistories::select('test_status','psy_job_mappings.name','psy_schedules.schedule_id','plan_start_date','plan_end_date','actual_start_date','psy_schedule_histories.job_mapping_id')
            ->join('psy_schedules', 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
            ->join('psy_job_mappings', 'psy_job_mappings.job_mapping_id', '=', 'psy_schedule_histories.job_mapping_id')
            ->where('psy_schedules.candidate_id',$applicantId)
            ->where('psy_schedule_histories.schedule_history_id',$scheduleHistoryId)
            ->orderBy('schedule_history_id', 'desc')
            ->first();
        $categoriesResult = array();
        $totalScore = 0;
        for ($i=1; $i <= 6 ; $i++) { 
            $records = DB::table('psi.psy_test_categories')
                ->select('standard_score')
                ->where('schedule_id',$scheduleData->schedule_id)
                ->where('category_id',$i)
                ->where('is_test_category_active', 1)
                ->first();
            if($records){
                $categoriesResult[] = $records->standard_score;
                $totalScore += $records->standard_score; 
            }else{
                $categoriesResult[] = 0;
            }
        }
        $categoriesResult[] = $totalScore;
        $resultData = Result::select('job_name','recomendation_by_system','psy_test_result.job_id')
            ->join('mst_jobs','mst_jobs.job_id','=','psy_test_result.job_id')
            ->where('schedule_history_id',$scheduleHistoryId)
            ->distinct()
            ->get();
        return view('pages.PsikotestResultDetail')
            ->with('applicantData',$applicantData)
            ->with('scheduleData',$scheduleData)
            ->with('categoriesResult',$categoriesResult)
            ->with('resultData',$resultData)
            ->with('anotherApplicant',$anotherApplicant);
    }

    public function getPsychogram($applicantId,$name,$jobname,$recomendation,$date,$scheduleId,$jobMapingId,$jobId){
        $dateNow = date('Y-m-d');
        $categoriesResult = array();
        $passScore = array();
        
        $verIdJob = DB::table('psi.psy_job_mapping_versions')
            ->select('version_id')
            ->where('psy_job_mapping_versions.job_mapping_id', $jobMapingId)
            ->whereRaw('? between psy_job_mapping_versions.date_from and psy_job_mapping_versions.date_to', $dateNow)
            ->first();
        
        for ($i=1; $i <= 6 ; $i++) { 
            $records = DB::table('psi.psy_test_categories')
                ->select('standard_score')
                ->where('schedule_id',$scheduleId)
                ->where('category_id',$i)
                ->where('is_test_category_active', 1)
                ->first();

            $records2= DB::table('psi.psy_job_profile_score')
                ->select('pass_score')
                ->join("psy_job_profiles",'psy_job_profiles.JOB_PROFILE_ID','=','psy_job_profile_score.job_profile_id')
                ->where('psy_job_profiles.version_id',$verIdJob->version_id)
                ->where('psy_job_profiles.job_id',$jobId)
                ->where('psy_job_profile_score.category_id',$i)
                ->first();
            ;
            if($records){
                $categoriesResult['standard'][] = $records->standard_score;
                $categoriesResult['definition'][] = $this->getNormaDefinition($records->standard_score,$i);
            }else{
                $categoriesResult['standard'][] = 0;
                $categoriesResult['definition'][] = "";
            }

            if($records2){
                $categoriesResult['pass'][] = $records2->pass_score;
            }else{
                $categoriesResult['pass'][] = 0;
            }
        } 
        $data[] = $name;
        $data[] = $jobname;
        $data[] = $recomendation;
        $data[] = $date;
        $data[] = $scheduleId;

        // return view('pages.Psychogram')
        //     ->with('data',$data)
        //     ->with('categoriesResult',$categoriesResult);
        $nama_file = 'Psychogram'.$applicantId.'_'.date('d-m-Y').'.pdf';
        $view = \View::make('pages.Psychogram2', ['data'=>$data, 'categoriesResult'=>$categoriesResult]);
          $html = $view->render();
          // $pdf = new TCPDF();
          PDF::SetTitle('Psychogram');
          PDF::AddPage();
          PDF::writeHTML($html, true, false, true, false, '');
          PDF::Output($nama_file);
    }


    private function getNormaDefinition($standard_score,$category_id){
        $definition = "";
        $dataScore = DB::table('psy_norma')
                ->join("psy_norma_versions", 'psy_norma_versions.NORMA_ID', '=', 'psy_norma.NORMA_ID')
                ->join("psy_norma_score", 'psy_norma_score.VERSION_ID', '=', 'psy_norma_versions.VERSION_ID') 
                ->where('psy_norma_score.STANDARD_SCORE',$standard_score)
                ->where('psy_norma.CATEGORY_ID',$category_id) 
                ->limit(1)
                ->select('psy_norma_score.VERSION_ID','psy_norma_score.PSYCHOGRAM_ASPECT')->get()->toArray(); 

        if(!empty($dataScore)){
            $data = DB::table('psy_norma_aspect')
                 
                ->where('psy_norma_aspect.VERSION_ID',$dataScore[0]->VERSION_ID)
                ->where('psy_norma_aspect.PSYCHOGRAM_ASPECT',$dataScore[0]->PSYCHOGRAM_ASPECT)  
                ->select('psy_norma_aspect.DEFINITION')->get()->toArray(); 
            if(!empty($data)){
                $definition = $data[0]->DEFINITION;
            }
        }

         return $definition;

        
    }
}
