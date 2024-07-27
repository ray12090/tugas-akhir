<?php

namespace App\Http\Controllers;

use App\Models\detailBiayaAir;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailBiayaAirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'created_at');
        $sort_order = $request->input('sort_order', 'asc');

        $validSortByFields = ['biaya_air', 'created_at', 'updated_at'];

        if (!in_array($sort_by, $validSortByFields)) {
            $sort_by = 'biaya_air';
        }

        $detailBiayaAir = detailBiayaAir::query()
            ->when($search, function ($query, $search) {
                return $query->where('biaya_air', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('detail_biaya_air.detail_biaya_air', compact('detailBiayaAir', 'sort_by', 'sort_order'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detail_biaya_air.detail_biaya_air-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        detailBiayaAir::create([
            'biaya_air' => $request->input('biaya_air'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_air.index')->with('success', 'Biaya air berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(detailBiayaAir $detailBiayaAir)
    {
        return view('detail_biaya_air.detail_biaya_air-read', compact('detailBiayaAir'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailBiayaAir $detailBiayaAir)
    {
        return view('detail_biaya_air.detail_biaya_air-update', compact('detailBiayaAir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailBiayaAir $detailBiayaAir)
    {
        $detailBiayaAir->update([
            'biaya_air' => $request->input('biaya_air'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_air.index')->with('success', 'Biaya air berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailBiayaAir $detailBiayaAir)
    {
        try {
            $detailBiayaAir->delete();
            return redirect()->route('detail_biaya_air.index')->with('danger', 'Data biaya air berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_biaya_air.index')->withErrors(['msg' => 'Error deleting biaya air. Please try again.']);
        }
    }
}
