<?php

namespace App\Http\Controllers;

use App\PsiAnswerChoice;
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
        if ($psiQuestion->TYPE_ANSWER == "MULTIPLE_CHOICE" && $request->has('answers')) {
            $answers = $request->get('answers');
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
                $answer_choice->ANS_SEQUENCE = $id;
                $answer_choice->save();
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
