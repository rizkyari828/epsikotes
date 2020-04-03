<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QueNarration;
use App\QueQuestion;
use App\Http\Resources\QueNarrationResource as queNarrationResource;
use App\Http\Resources\QuestionListResource as questList;
use App\Http\Resources\NarrationJobResource as jobResource;
use Illuminate\Support\Facades\Route;

class QueNarrationController extends Controller
{
    function index(Request $request)
    {
        $q =$request->input('q');
        $text = $request->input('text');
        $datas = QueNarration::where('NARRATION_NAME', 'like', '%' . $q . '%')
            ->Where ('NARRATION_TEXT', 'like', '%' . $text . '%')
            ->orderBy('LAST_UPDATE_DATE', 'desc')->get();
        // Return a collection of $users with pagination
        return queNarrationResource::collection($datas);
    }

    function jobMappingList(Request $request){
        $narrationId = $request->input('id');
        // find job version  that currently active
        $version = QueNarration::join('psy_job_mapping_versions','psy_job_mapping_versions.general_instruction','=','que_narrations.narration_id')
        ->where('psy_job_mapping_versions.date_from', '<=', now())
        ->where('psy_job_mapping_versions.date_to', '>=', now())
        ->where('psy_job_mapping_versions.general_instruction','=',$narrationId)
        ->max('psy_job_mapping_versions.VERSION_NUMBER');

        // find job datas by active version
        $datas = QueNarration::join('psy_job_mapping_versions','psy_job_mapping_versions.general_instruction','=','que_narrations.narration_id')
            ->join('psy_job_mappings','psy_job_mappings.job_mapping_id','=','psy_job_mapping_versions.job_mapping_id')
            ->where('psy_job_mapping_versions.general_instruction','=',$narrationId)
            ->get(['psy_job_mappings.name',
            'psy_job_mapping_versions.general_instruction',
            'psy_job_mapping_versions.final_greating']);

            //return as collection
            return jobResource::collection($datas);
    }
        function questionsList(Request $request){

            $narrationId = $request->input('id');
            // find questions version  that currently active
            $version = QueQuestion::join('que_sub_category_versions','que_questions.version_id', '=', 'que_sub_category_versions.version_id')
                ->where('que_questions.narration_id', '=', $narrationId)
                ->where('que_sub_category_versions.date_from', '<=', now())
                ->where('que_sub_category_versions.date_to', '>=', now())
                ->max('que_sub_category_versions.VERSION_NUMBER');

                //get sub cat and questions data
            $datas = QueNarration::join('que_questions', 'que_narrations.narration_id', '=', 'que_questions.narration_id')
                ->join('que_sub_category_versions','que_questions.version_id', '=', 'que_sub_category_versions.version_id')
                ->join('que_sub_categories', 'que_sub_category_versions.sub_category_id', '=', 'que_sub_categories.sub_category_id')
                ->where ('que_questions.narration_id', '=', $narrationId)
                ->where('que_sub_category_versions.VERSION_NUMBER', '=', $version)
                ->get(['que_sub_categories.sub_category_name',
                    'que_questions.question_text',
                    'que_questions.question_img',
                    'que_questions.is_actived',
                    'que_questions.example']);

            return questList::collection($datas);
        }

    function detail(Request $request){
        $q = $request->input('id');
        $datas = QueNarration::where('NARRATION_ID', '=',$q)->get();
        return queNarrationResource::collection($datas);
    }

    // create and update function
    function save(Request $request){
        $result = '';
        //check if data exist
        $check = QueNarration::where('NARRATION_NAME', '=', strtoupper($request->input('narrationName')))->first();

        $abc = $request->isMethod('put') ? QueNarration::findOrFail($request->narrationId) : new QueNarration;
        if($check === null || $request->input('narrationText') !== null){
            $textr = $request->input('narrationText');
            $abc->narration_id = $request->input('narrationId');
            $abc->narration_name = strtoupper($request->input('narrationName'));
            $abc->narration_text = $request->input('narrationText');
            $abc->CREATED_BY= 'SYSTEM'; //$request->input('createBy');
            $abc->CREATION_DATE= date('Y-m-d H:i:s');//$request->input('creationDate');
            $abc->LAST_UPDATED_BY= 'SYSTEM';//$request->input('lastUpdatedBy');
            $abc->LAST_UPDATE_DATE= date('Y-m-d H:i:s');//$request->input('lastUpdatedDate');

            if($abc->save()){
                return (new queNarrationResource($abc))
                    ->response()
                    ->setStatusCode(200);
            }
        }
        return (new queNarrationResource($abc))
        ->response()
        ->setStatusCode(201);
        // check if data exist it'll update data, else create new record


        // function findNarrations(Request $q){
        //     $datas = QueNarration::findOrFail($q->input('name');
        // }
    }

    function test(Request $request){
    //     $questions = Question::join('steps', 'questions.step_id', '=', 'steps.id')
    // ->orderBy('steps.number', 'asc')
    // ->get(['questions.*']);

        $id = $request->input('id');
        $version = QueQuestion::join('que_sub_category_versions','que_questions.version_id', '=', 'que_sub_category_versions.version_id')
                ->where('que_questions.narration_id', '=', 1)
                ->where('que_sub_category_versions.date_from', '<=', now())
                ->where('que_sub_category_versions.date_to', '>=', now())
                ->max('que_sub_category_versions.VERSION_NUMBER');

        $datas = QueNarration::join('psy_job_mapping_versions','psy_job_mapping_versions.general_instruction','=','que_narrations.narration_id')
            ->join('psy_job_mappings','psy_job_mappings.job_mapping_id','=','psy_job_mapping_versions.job_mapping_id')
            ->where('psy_job_mapping_versions.general_instruction','=',24)
            ->get(['psy_job_mappings.name',
            'psy_job_mapping_versions.general_instruction',
            'psy_job_mapping_versions.final_greating']);
            $mytime = Carbon\Carbon::now();
        return $mytime;
    }
}
