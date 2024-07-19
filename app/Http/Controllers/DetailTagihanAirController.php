<?php

namespace App\Http\Controllers;

use App\Models\detailTagihanAir;
use Illuminate\Http\Request;

class DetailTagihanAirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('detail_tagihan_air.detail_tagihan_air');
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
    public function show(detailTagihanAir $detailTagihanAir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailTagihanAir $detailTagihanAir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailTagihanAir $detailTagihanAir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailTagihanAir $detailTagihanAir)
    {
        //
    }
}
