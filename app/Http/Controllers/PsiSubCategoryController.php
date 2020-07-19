<?php

namespace App\Http\Controllers;

use App\PsiSubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PsiSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return Response
     */
    public function show(PsiSubCategory $psiSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return View
     */
    public function edit(PsiSubCategory $psiSubCategory)
    {
        return view('psi.sub_category.edit', ['data' => $psiSubCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return Response
     */
    public function update(Request $request, PsiSubCategory $psiSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PsiSubCategory  $psiSubCategory
     * @return Response
     */
    public function destroy(PsiSubCategory $psiSubCategory)
    {
        //
    }
}
