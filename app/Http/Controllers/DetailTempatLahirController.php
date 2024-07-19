<?php

namespace App\Http\Controllers;

use App\Models\detailTempatLahir;
use Illuminate\Http\Request;

class DetailTempatLahirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('detail_tempat_lahir.detail_tempat_lahir');
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
    public function show(detailTempatLahir $detailTempatLahir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailTempatLahir $detailTempatLahir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailTempatLahir $detailTempatLahir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailTempatLahir $detailTempatLahir)
    {
        //
    }
}
