<?php

namespace App\Http\Controllers;

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
        $item->fill($request->all());
        $item->save();
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