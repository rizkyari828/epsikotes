<?php

namespace App\Http\Controllers;

use App\PsiAnswerChoice;
use App\PsiAnswerGroup;
use App\PsiAnswerTextSeries;
use App\PsiQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(PsiQuestion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = new PsiQuestion();
        return $this->update($request, $item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiQuestion  $psiQuestion
     * @return JsonResponse
     */
    public function show(PsiQuestion $psiQuestion)
    {
        return response()->json($psiQuestion->load(['answerChoices', 'answerGroups', 'answerTextSeries', 'subCategoryVersion'])->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PsiQuestion  $psiQuestion
     * @return JsonResponse
     */
    public function update(Request $request, PsiQuestion $psiQuestion)
    {
        $psiQuestion->fill($request->except(['answers']));
        if ($request->hasFile('HINT_IMG')) {
            $hint_img = $request->file('HINT_IMG');
            $hint_img->store('', 'public');
            $psiQuestion->HINT_IMG = $hint_img->hashName();
        }
        if ($request->hasFile('QUESTION_IMG')) {
            $question_img = $request->file('QUESTION_IMG');
            $question_img->store('', 'public');
            $psiQuestion->QUESTION_IMG = $question_img->hashName();
        }
        $psiQuestion->save();
        $answers = $request->get('answers');
        if ($psiQuestion->TYPE_ANSWER == "MULTIPLE_CHOICE" && $request->has('answers')) {
            $ids = [];
            $sequence = 1;
            foreach ($answers['ANS_CHOICE_ID'] as $id => $answer) {
                $answer_choice = PsiAnswerChoice::findOrNew($id);
                $answer_choice->CHOICE_TEXT = isset($answers['CHOICE_TEXT'][$id]) ? $answers['CHOICE_TEXT'][$id] : null;
                if ($request->hasFile('answers.CHOICE_IMG.'.$id)) {
                    $choice_image = $request->file('answers.CHOICE_IMG.'.$id);
                    $choice_image->store('', 'public');
                    $answer_choice->CHOICE_IMG = $choice_image->hashName();
                }
                $answer_choice->CORRECT_ANSWER = isset($answers['CORRECT_ANSWER'][$id]) ? $answers['CORRECT_ANSWER'][$id] : 0;
                $answer_choice->QUESTION_ID = $psiQuestion->QUESTION_ID;
                $answer_choice->ANS_SEQUENCE = $sequence;
                $answer_choice->save();
                array_push($ids, $answer_choice->ANS_CHOICE_ID);
                $sequence += 1;
            }
            $answer_choices = PsiAnswerChoice::query()
                ->where('QUESTION_ID', $psiQuestion->QUESTION_ID)
                ->get();
            foreach ($answer_choices as $answer_choice) {
                if (!in_array($answer_choice->ANS_CHOICE_ID, $ids)) {
                    $answer_choice->delete();
                }
            }
        }
        if ($psiQuestion->TYPE_ANSWER == "TEXT_SERIES" && $request->has('answers')) {
            $ids = [];
            $sequence = 1;
            foreach ($answers['ANS_TEXT_SERIES_ID'] as $id => $answer) {
                $answer_text_series = PsiAnswerTextSeries::findOrNew($id);
                $answer_text_series->CORRECT_TEXT = $answers['CORRECT_TEXT'][$id];
                $answer_text_series->QUESTION_ID = $psiQuestion->QUESTION_ID;
                $answer_text_series->ANS_SEQUENCE = $sequence;
                $answer_text_series->save();
                array_push($ids, $answer_text_series->ANS_TEXT_SERIES_ID);
                $sequence += 1;
            }
            $answer_text_series_array = PsiAnswerTextSeries::query()
                ->where('QUESTION_ID', $psiQuestion->QUESTION_ID)
                ->get();
            foreach ($answer_text_series_array as $answer_text_series) {
                if (!in_array($answer_text_series->ANS_TEXT_SERIES_ID, $ids)) {
                    $answer_text_series->delete();
                }
            }
        }
        if ($psiQuestion->TYPE_ANSWER == "MULTIPLE_GROUP" && $request->has('answers')) {
            $ids = [];
            foreach ($answers['QUE_ANS_GROUP_ID'] as $id => $answer) {
                $answer_group = PsiAnswerGroup::findOrNew($id);
                $answer_group->IMG_SEQUENCE = $answers['IMG_SEQUENCE'][$id] ?: "";
                $answer_group->GROUP_IMG = $answers['GROUP_IMG'][$id] ?: "";
                $answer_group->QUESTION_ID = $psiQuestion->QUESTION_ID;
                $answer_group->save();
                array_push($ids, $answer_group->QUE_ANS_GROUP_ID);
            }
            $answer_groups = PsiAnswerGroup::query()
                ->where('QUESTION_ID', $psiQuestion->QUESTION_ID)
                ->get();
            foreach ($answer_groups as $answer_group) {
                if (!in_array($answer_group->QUE_ANS_GROUP_ID, $ids)) {
                    $answer_group->delete();
                }
            }
        }
        return $this->show($psiQuestion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PsiQuestion  $psiQuestion
     * @return JsonResponse
     */
    public function destroy(PsiQuestion $psiQuestion)
    {
        $psiQuestion->delete();
        return response()->json($psiQuestion);
    }
}
