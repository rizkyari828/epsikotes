<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Questions extends Model
{

    public function getQuestionByVersionId($versionId){

        $question = DB::table('psi.que_questions')
            ->join('psi.que_narrations', 'psi.que_narrations.NARRATION_ID', '=', 'psi.que_questions.NARRATION_ID')
            ->where('psi.que_questions.VERSION_ID', $versionId)
            ->get();

        return $question;
    }

    public function getQuestionByVersionId2($versionId){

        $question = DB::table('que_questions')
            ->where('que_questions.VERSION_ID', $versionId)
            ->get();

        return $question;
    }

    public function getAnsChoicesByQuestionId($questionId){

        $ans = DB::table('que_ans_choices')
        ->where('QUESTION_ID', $questionId)
        ->get();
        return $ans;
    }

    public function getAnsGroupByQuestionId($questionId){

        $ans = DB::table('psi.que_ans_group')
        ->where('QUESTION_ID', $questionId)
        ->get();
        return $ans;
    }

    public function getAnsTextSeriesByQuestionId($questionId){

        $ans = DB::table('psi.que_ans_text_series')
        ->where('QUESTION_ID', $questionId)
        ->get();
        return $ans;
    }



    public function insertQuestions($QueList){
       return DB::table('psi.que_questions')->insertGetId($QueList);
    }

    public function insertAnsMultChoice($AnsList){
       return DB::table('psi.que_ans_choices')->insertGetId($AnsList);
    }

    public function insertAnsTxtSeries($AnsList){
       return DB::table('psi.que_ans_text_series')->insertGetId($AnsList);
    }

    public function insertAnsMultGroup($AnsList){
       return DB::table('psi.que_ans_group')->insertGetId($AnsList);
    }

    public function updateQuestions($QueList){
            DB::table('psi.que_questions')->where('QUESTION_ID',$QueList['QUESTION_ID'])->update($QueList);
    }
     public function getQuestionOnSubCategory($versionId){

        $question = DB::table('que_questions')
         ->join('que_narrations', 'que_narrations.NARRATION_ID', '=', 'que_questions.NARRATION_ID','LEFT')
            ->where('que_questions.VERSION_ID', $versionId)
            ->get();

        return $question;
    }
}
