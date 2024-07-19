<?php

namespace App\Http\Controllers;

use App\Models\detailPerkawinan;
use Illuminate\Http\Request;

class DetailPerkawinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('detail_perkawinan.detail_perkawinan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(detailPerkawinan $detailPerkawinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailPerkawinan $detailPerkawinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailPerkawinan $detailPerkawinan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailPerkawinan $detailPerkawinan)
    {
        //
    }
}
