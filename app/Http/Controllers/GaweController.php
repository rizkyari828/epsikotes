<?php

namespace App\Http\Controllers;

use App\Model\Applicant;
use App\Model\ScheduleHistories;
use App\Model\Schedules;

use App\Model\Jobmapping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GaweController extends Controller
{
    public function createSchedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kandidat.applicant_id' => 'required|numeric',
            'kandidat.email' => 'required|email|max:127',
            'kandidat.full_name' => 'required|max:127',
            'kandidat.gender' => 'required|in:MALE,FEMALE',
            'kandidat.ktp' => 'required|digits:16',
            'kandidat.address' => 'required|max:127',
            'kandidat.coverage_id' => 'required|numeric',
            'kandidat.last_education_id' => 'required|in:2,4,5,6,7,8,9,10',
            'kandidat.birth_date' => 'required|date',
            'kandidat.phone_number' => 'required|max:32',
            'kandidat.plan_start_date' => 'required|date',
            'kandidat.plan_end_date' => 'required|date',
            'kandidat.job_id' => 'required|numeric',
            'kandidat.network_id' => 'required|numeric',
            'kandidat.sim_id' => 'required|numeric',
            'kandidat.id_schedule' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }
        $kandidat = $request->get('kandidat');
        $applicant = Applicant::firstOrNew(['APPLICANT_ID' => $kandidat['applicant_id']]);
        $kandidat['LAST_EDUCATIONS'] = $kandidat['last_education_id'];
        $kandidat['CITY'] = $kandidat['coverage_id'];
        foreach ($kandidat as $key => $value) {
            if (!in_array($key, ['last_education_id', 'coverage_id', 'plan_start_date', 'plan_end_date', 'job_id', 'network_id', 'sim_id', 'id_schedule'])) {
                $applicant[strtoupper($key)] = $value;
            }
        }
        $applicant['CREATED_BY'] = 'API';
        $applicant['LAST_UPDATED_BY'] = 'API';
	$applicant['CABANG_ID'] = $kandidat['network_id'];
        $applicant->save();
        $schedule = new Schedules();
	$schedule->SCHEDULE_GAWE_ID = $kandidat['id_schedule'];
        $schedule->CANDIDATE_ID = $applicant->CANDIDATE_ID;
        //$schedule->CREATED_BY = 'API';
        $schedule->CREATED_BY = $kandidat['sim_id'];
        $schedule->CREATION_DATE = date('Y-m-d H:m:s');
        $schedule->LAST_UPDATED_BY = 'API';
        $schedule->LAST_UPDATE_DATE = date('Y-m-d H:m:s');
        $schedule->save();
        $history = new ScheduleHistories();
        $history->SCHEDULE_ID = $schedule->id;
        $history->JOB_MAPPING_ID = $kandidat['job_id'];

        $Jobmapping = new Jobmapping();
        $maxVersionNumber = $Jobmapping->getMaxVersion($kandidat['job_id']); 

        $history->JOB_MAPPING_VERSION_ID = $maxVersionNumber[0]->version_number;
        $history->PLAN_START_DATE =  date('Y-m-d',strtotime($kandidat['plan_start_date']));
        $history->PLAN_END_DATE = date('Y-m-d',strtotime($kandidat['plan_end_date']));
        $history->RESCHEDULE_SEQ = 0;
        $history->TEST_STATUS = 'NOT_ATTEMPT';
        $history->CREATED_BY = 'API';
        $history->CREATION_DATE = date('Y-m-d H:m:s');
        $history->LAST_UPDATED_BY = 'API';
        $history->LAST_UPDATE_DATE = date('Y-m-d H:m:s');
        $history->save();
        return $this->successResponse("Data received successfully", $applicant);
    }

    private function errorResponse($errorMessage)
    {
        return response()->json([
            "kdStatus" => 0,
            "ketStatus" => $errorMessage,
            "responseDate" => Carbon::now()->toIso8601String()
        ], 400);
    }

    private function successResponse($successMessage, $data)
    {
        return response()->json([
            "kdStatus" => 0,
            "ketStatus" => $successMessage,
            "url" => "http://epsikotest.gawe.id/auth/" . base64_encode($data['APPLICANT_ID']),
            "data" => $data,
            "responseDate" => Carbon::now()->toIso8601String()
        ], 200);
    }

}
