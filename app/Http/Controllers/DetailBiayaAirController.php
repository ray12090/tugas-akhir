<?php

namespace App\Http\Controllers;

use App\Models\detailBiayaAir;
use Illuminate\Http\Request;

class DetailBiayaAirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biayaAirList = detailBiayaAir::orderBy('created_at', 'desc')->get();

        return view('detail_biaya_air.detail_biaya_air', compact('biayaAirList'));
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
    public function show(detailBiayaAir $detailBiayaAir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailBiayaAir $detailBiayaAir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailBiayaAir $detailBiayaAir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailBiayaAir $detailBiayaAir)
    {
        //
    }
}
