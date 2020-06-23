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
        $kandidat['last_educations'] = $kandidat['last_education_id'];
        $kandidat['city'] = $kandidat['coverage_id'];
        $applicant->fill($kandidat);
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
