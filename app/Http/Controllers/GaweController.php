<?php

namespace App\Http\Controllers;

use App\Model\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GaweController extends Controller
{
    public function createSchedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate.applicant_id' => 'required|numeric',
            'candidate.email' => 'required|email|max:127',
            'candidate.user_name' => 'required|max:127',
            'candidate.full_name' => 'required|max:127',
            'candidate.gender' => 'required|in:MALE,FEMALE',
            'candidate.ktp' => 'required|digits:16',
            'candidate.address' => 'required|max:127',
            'candidate.coverage_id' => 'required|numeric',
            'candidate.last_education_id' => 'required|in:2,4,5,6,7,8,9,10',
            'candidate.birth_date' => 'required|date',
            'candidate.phone_number' => 'required|max:32',
            'candidate.plan_start_date' => 'required|date',
            'candidate.plan_end_date' => 'required|date',
            'candidate.job_id' => 'required|numeric',
            'candidate.network_id' => 'required|numeric',
            'candidate.sim_id' => 'required|numeric',
            'candidate.undangan_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }
        $candidate = $request->get('candidate');
        $applicant = Applicant::firstOrNew(['APPLICANT_ID' => $candidate['applicant_id']]);
        $candidate['last_educations'] = $candidate['last_education_id'];
        $candidate['city'] = $candidate['coverage_id'];
        $applicant->fill($candidate);
//        $applicant->save();
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
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return response()->json([
            "kdStatus" => 0,
            "ketStatus" => $successMessage,
            "url" => "/auth/" . substr(str_shuffle($permitted_chars), 0, 10),
            "data" => $data,
            "responseDate" => Carbon::now()->toIso8601String()
        ], 200);
    }

}
