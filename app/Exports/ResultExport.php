<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Model\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\ScheduleHistories;

class ResultExport implements FromView
{
    private $paramApplicantName;
    private $paramApplicantid;
    private $paramKTP;
    private $paramPsiResult;
    private $paramRecomendation;
    private $paramNetwork;
    private $paramLocation;
    private $paramPlanDateFrom;
    private $paramPlanDateTo;
    private $paramActualDateFrom;
    private $paramActualDateTo;
    private $paramJobName;


    public function __construct(String $paramApplicantName,int $paramApplicantid, int $paramKTP, String $paramPsiResult, String $paramRecomendation,String $paramNetwork, String $paramLocation, String $paramPlanDateFrom, String $paramPlanDateTo, String $paramActualDateFrom, String $paramActualDateTo, String $paramJobName)
    {
        if($paramPlanDateFrom != '-')
            $paramPlanDateFrom = date('Y-m-d', strtotime($paramPlanDateFrom));
        if($paramPlanDateTo != '-')
            $paramPlanDateTo = date('Y-m-d', strtotime($paramPlanDateTo));
        if($paramActualDateFrom != '-')
            $paramActualDateFrom = date('Y-m-d', strtotime($paramActualDateFrom));
        if($paramActualDateTo != '-')
            $paramActualDateTo = date('Y-m-d', strtotime($paramActualDateTo));

        $this->paramApplicantName = $paramApplicantName;
        $this->paramApplicantId = $paramApplicantid;
        $this->paramKTP = $paramKTP;
        $this->paramPsiResult = $paramPsiResult;
        $this->paramRecomendation = $paramRecomendation;
        $this->paramNetwork = $paramNetwork;
        $this->paramLocation = $paramLocation;
        $this->paramPlanDateFrom = $paramPlanDateFrom;
        $this->paramPlanDateTo = $paramPlanDateTo;
        $this->paramActualDateFrom = $paramActualDateFrom;
        $this->paramActualDateTo = $paramActualDateTo;
        $this->paramJobName = $paramJobName;
    }
	public function view(): View
    {
        $dateNow = date('Y-m-d');
        $records2 = ScheduleHistories::select('mst_applicant.candidate_id','mst_applicant.full_name','mst_applicant.applicant_id','mst_applicant.ktp','psy_schedule_histories.test_status','psy_schedule_histories.plan_start_date','psy_schedule_histories.plan_end_date','psy_schedule_histories.actual_start_date','psy_schedule_histories.reschedule_seq','psy_schedule_histories.schedule_history_id')
        ->join("psy_schedules", 'psy_schedules.schedule_id', '=', 'psy_schedule_histories.schedule_id')
        ->join("mst_applicant", 'mst_applicant.candidate_id', '=', 'psy_schedules.candidate_id');
        
        if($this->paramPsiResult != '-')
                $records2->where('psy_schedule_histories.TEST_STATUS','=',$this->paramPsiResult);
        if($this->paramPlanDateFrom != '-')
                $records2->where('psy_schedule_histories.PLAN_START_DATE','>=',$this->paramPlanDateFrom);
        if($this->paramPlanDateTo != '-')
                $records2->where('psy_schedule_histories.PLAN_END_DATE','<=',$this->paramPlanDateTo);
    	// $records2 = Result::select('mst_applicant.FULL_NAME','mst_applicant.APPLICANT_ID','psy_schedule_histories.PLAN_START_DATE','psy_schedule_histories.PLAN_END_DATE','psy_schedule_histories.ACTUAL_START_DATE','psy_schedule_histories.TEST_STATUS','mst_applicant.BIRTH_DATE','mst_applicant.KTP','mst_applicant.GENDER','mst_applicant.KTP','mst_applicant.LAST_EDUCATIONS','mst_applicant.USER_NAME','mst_applicant.PHONE_NUMBER','psy_test_result.RECOMENDATION_BY_SYSTEM','psy_job_mappings.NAME','psy_schedules.SCHEDULE_ID')
        //     ->join("psy_schedules", 'psy_schedules.SCHEDULE_ID', '=', 'psy_test_result.SCHEDULE_ID')
        //     ->join("mst_applicant", 'mst_applicant.CANDIDATE_ID', '=', 'psy_schedules.CANDIDATE_ID')
        //     // ->join("psy_schedule_histories", 'psy_schedule_histories.SCHEDULE_ID', '=', 'psy_schedules.SCHEDULE_ID')
        //     ->join("psy_schedule_histories", 'psy_schedule_histories.SCHEDULE_HISTORY_ID', '=', 'psy_test_result.SCHEDULE_HISTORY_ID')
        //     ->join("psy_job_mapping_versions",'psy_job_mapping_versions.VERSION_ID','=','psy_schedule_histories.JOB_MAPPING_VERSION_ID')
        //     ->join("psy_job_mappings", 'psy_job_mappings.JOB_MAPPING_ID', '=', 'psy_job_mapping_versions.JOB_MAPPING_ID')
        //     ->join("mst_city", 'mst_city.CITY', '=', 'mst_applicant.CITY')
        //     ->where('psy_schedule_histories.TEST_STATUS','COMPLETE');
           
            // if($this->paramApplicantName != '-')
            //     $records2->where('mst_applicant.FULL_NAME','like','%'.$this->paramApplicantName.'%');
            // if($this->paramApplicantId != 0)
            //     $records2->where('mst_applicant.APPLICANT_ID','=',$this->paramApplicantId);
            // if($this->paramKTP != 0)
            //     $records2->where('mst_applicant.KTP','=',$this->paramKTP);
            // if($this->paramPsiResult != '-')
            //     $records2->where('psy_schedule_histories.TEST_STATUS','=',$this->paramPsiResult);
            // if($this->paramPlanDateFrom != '-')
            //     $records2->where('psy_schedule_histories.PLAN_START_DATE','>=',$this->paramPlanDateFrom);
            // if($this->paramPlanDateTo != '-')
            //     $records2->where('psy_schedule_histories.PLAN_END_DATE','<=',$this->paramPlanDateTo);
            // if($this->paramActualDateFrom != '-')
            //     $records2->where('psy_schedule_histories.ACTUAL_START_DATE','>=',$this->paramActualDateFrom);
            // if($this->paramActualDateTo != '-')
            //     $records2->where('psy_schedule_histories.ACTUAL_START_DATE','<=',$this->paramActualDateTo);
            // if($this->paramLocation != '-'){
            //     $records2->where('mst_applicant.CITY','=',$this->paramLocation);
            // }if($this->paramNetwork != '-'){
            //     $records2->join("mst_networks", 'mst_networks.NETWORK_ID', '=', 'mst_city.NETWORK_ID');
            //     $records2->where('mst_networks.NETWORK','=',$this->paramNetwork);
            // }if($this->paramJobName != '-'){
            //     $records2->where('psy_job_mappings.NAME','=',$this->paramJobName);
            // }

            // $records2->orderBy('psy_job_mappings.NAME','asc');
            // $records2->orderBy('psy_test_result.RECOMENDATION_BY_SYSTEM','asc');
            $records2 = $records2->distinct()->get();

        $categoriesResult = array();
        foreach ($records2 as $key => $value) {
            $totalScore = 0;
            for ($i=1; $i <= 6 ; $i++) { 
                $records = DB::table('psi.psy_test_categories')
                    ->select('STANDARD_SCORE')
                    ->where('SCHEDULE_ID',$value->SCHEDULE_ID)
                    ->where('CATEGORY_ID',$i)
                    ->where('IS_TEST_CATEGORY_ACTIVE', 1)
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
        // echo "<pre> " . $records2 . "</pre>";
        // die();

        return view('pages.PsikotesResultReport2')
            ->with('records2', $records2)
            ->with('categoriesResult',$categoriesResult);
    }
}