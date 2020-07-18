<?php

namespace App\Http\Controllers;

use App\PsiQuestion;
use App\PsiSubCategoryVersion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestSubCategoryVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(PsiSubCategoryVersion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = new PsiSubCategoryVersion();
        if ($request->has('copy_from')) {
            $copy_from = PsiSubCategoryVersion::findOrFail($request->get('copy_from'));
            $copy_from_data = $copy_from->toArray();
            unset($copy_from_data['VERSION_ID']);
            $copy_from_data['VERSION_NUMBER'] = PsiSubCategoryVersion::query()->where('SUB_CATEGORY_ID', $copy_from->SUB_CATEGORY_ID)->max('VERSION_NUMBER') + 1;
            $item->fill($copy_from_data);
            $item->save();

            foreach ($copy_from->questions as $question) {
                $question_data = $question->toArray();
                unset($question_data['QUESTION_ID']);
                $question_data['VERSION_ID'] = $item->VERSION_ID;
                $copied_question = new PsiQuestion();
                $copied_question->fill($question_data);
                $copied_question->save();
            }
        } else {
            $item->fill($request->all());
            $item->save();
        }
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiSubCategoryVersion  $psiSubCategoryVersion
     * @return JsonResponse
     */
    public function show(PsiSubCategoryVersion $psiSubCategoryVersion)
    {
        return response()->json($psiSubCategoryVersion->load('questions')->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PsiSubCategoryVersion  $psiSubCategoryVersion
     * @return JsonResponse
     */
    public function update(Request $request, PsiSubCategoryVersion $psiSubCategoryVersion)
    {
        $psiSubCategoryVersion->fill($request->all());
        $psiSubCategoryVersion->save();
        return response()->json($psiSubCategoryVersion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PsiSubCategoryVersion  $psiSubCategoryVersion
     * @return JsonResponse
     */
    public function destroy(PsiSubCategoryVersion $psiSubCategoryVersion)
    {
        $psiSubCategoryVersion->delete();
        return response()->json($psiSubCategoryVersion);
    }
}
