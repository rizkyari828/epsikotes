<?php

namespace App\Http\Controllers;

use App\PsiSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(PsiSubCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = new PsiSubCategory();
        $item->fill($request->toArray());
        $item->save();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return JsonResponse
     */
    public function show(PsiSubCategory $psiSubCategory)
    {
        return response()->json($psiSubCategory->load(['versions'])->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return JsonResponse
     */
    public function update(Request $request, PsiSubCategory $psiSubCategory)
    {
        $psiSubCategory->fill($request->toArray());
        $psiSubCategory->save();
        return response()->json($psiSubCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return JsonResponse
     */
    public function destroy(PsiSubCategory $psiSubCategory)
    {
        $psiSubCategory->delete();
        return response()->json($psiSubCategory);
    }

}
