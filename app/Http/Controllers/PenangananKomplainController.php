<?php

namespace App\Http\Controllers;

use App\Models\penangananKomplain;
use Illuminate\Http\Request;

class PenangananKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_laporan');
        $sort_order = $request->input('sort_order', 'desc');

        $komplains = Komplain::with('unit', 'jenisKomplain', 'bagianKomplains')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('jenis_komplain', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        // dd($komplains);

        return view('komplain.komplain', compact('komplains', 'sort_by', 'sort_order'));
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
    public function show(penangananKomplain $penangananKomplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penangananKomplain $penangananKomplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, penangananKomplain $penangananKomplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penangananKomplain $penangananKomplain)
    {
        //
    }
}
