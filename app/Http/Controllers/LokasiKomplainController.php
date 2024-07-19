<?php

namespace App\Http\Controllers;

use App\Models\lokasiKomplain;
use Illuminate\Http\Request;

class LokasiKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lokasi_komplain.lokasi_komplain');
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
    public function show(lokasiKomplain $lokasiKomplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lokasiKomplain $lokasiKomplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lokasiKomplain $lokasiKomplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lokasiKomplain $lokasiKomplain)
    {
        //
    }
}
