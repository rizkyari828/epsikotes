<?php

namespace App\Http\Controllers;

use App\PsiNarration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestNarrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(PsiNarration::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = new PsiNarration();
        $item->fill($request->all());
        $item->save();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiNarration  $psiNarration
     * @return JsonResponse
     */
    public function show(PsiNarration $psiNarration)
    {
        return response()->json($psiNarration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PsiNarration  $psiNarration
     * @return JsonResponse
     */
    public function update(Request $request, PsiNarration $psiNarration)
    {
        $psiNarration->fill($request->all());
        $psiNarration->save();
        return response()->json($psiNarration);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PsiNarration  $psiNarration
     * @return JsonResponse
     */
    public function destroy(PsiNarration $psiNarration)
    {
        $psiNarration->delete();
        return response()->json($psiNarration);
    }
}
