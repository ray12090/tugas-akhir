<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Pemilik;
use App\Models\Penyewa;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
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
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
    public function indexUnitdanIPLOwner($id)
    {
        // Ambil data pemilik berdasarkan ID, termasuk unit dan ipl
        $pemilik = Pemilik::with(['unit'])->findOrFail($id);
        return view('pemilik.pemilik-unit-ipl', compact('pemilik'));
    }
    public function indexUnitdanIPLRenter($id)
    {
        // Ambil data pemilik berdasarkan ID, termasuk unit dan ipl
        $penyewa = Penyewa::with(['unit'])->findOrFail($id);
        return view('penyewa.penyewa-unit-ipl', compact('penyewa'));
    }
}
