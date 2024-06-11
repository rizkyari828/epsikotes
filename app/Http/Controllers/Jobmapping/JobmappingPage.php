<?php

namespace App\Http\Controllers\Jobmapping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Job;
use App\Model\Jobmapping;



class JobmappingPage extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('pages.JobmappingPageInquiry');
    }

    public function jobs(){

        $this->middleware('auth');

        $jobName = \Request::input('jobName');
        $Job = new Job();
        $records = array();


        foreach ($Job->getJob($jobName) as $indexJob => $rowJob ){
            $records['data_rows'][] = array('jobName'=>$rowJob->job_name,'jobId'=>$rowJob->job_id );
        }

        echo json_encode($records);
    }

    public function jobMapping(){

        $this->middleware('auth');

        $jobMappingName = \Request::input('jobMappingName');
        $JobMapping = new Jobmapping();
        $records = array();

        $paramFilter['jobMappingName'] = $jobMappingName;


        foreach ($JobMapping->getJobMapping($paramFilter) as $indexJobMapping => $rowJobMapping ){
            $records['data_rows'][] = array('jobMappingName'=>$rowJobMapping->name,'jobMappingId'=>$rowJobMapping->job_mapping_id,'versionId' => $rowJobMapping->version_id  );
        }

        echo json_encode($records);
    }

    public function jobMappingAll(){

        $this->middleware('auth');

        $paramFilters = \Request::input('paramFilters');
        $JobMapping = new Jobmapping(); 
        $records = array();


        foreach ($JobMapping->getAllJobMappingActive($paramFilters) as $indexJobMapping => $rowJobMapping ){
           
            $records['data'][] = array('<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /><span></span></label>','<a href="jobMappingView/'.$rowJobMapping->JOB_MAPPING_ID.'">detail</a>',$rowJobMapping->NAME,$rowJobMapping->random_category == 1 ? 'Yes' : 'No',$rowJobMapping->last_update_date,$rowJobMapping->last_updated_by );
        }

        echo json_encode($records);
    }
}
