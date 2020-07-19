<?php

namespace App\Http\Controllers;

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
        $item->fill($request->all());
        $item->save();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiQuestion  $psiQuestion
     * @return JsonResponse
     */
    public function show(PsiQuestion $psiQuestion)
    {
        return response()->json($psiQuestion);
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
        $psiQuestion->fill($request->all());
        $psiQuestion->save();
        return response()->json($psiQuestion);
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
