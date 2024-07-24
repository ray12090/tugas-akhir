<?php

namespace App\Http\Controllers;

use App\Models\detailTagihanAir;
use App\Models\detailBiayaAir;


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
        // Validasi input dari form
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'meter_air_awal' => 'required|numeric',
            'meter_air_akhir' => 'required|numeric|gte:meter_air_awal',
            'biaya_air_id' => 'required|exists:detail_biaya_airs,id',
        ]);

        // Hitung pemakaian air
        $pemakaianAir = $request->meter_air_akhir - $request->meter_air_awal;

        // Ambil biaya air
        $biayaAir = detailBiayaAir::find($request->biaya_air_id)->biaya_air;

        // Hitung tagihan air
        $tagihanAir = $pemakaianAir * $biayaAir;

        // Simpan data ke dalam tabel `detail_tagihan_airs`
        detailTagihanAir::create([
            'unit_id' => $request->unit_id,
            'meter_air_awal' => $request->meter_air_awal,
            'meter_air_akhir' => $request->meter_air_akhir,
            'pemakaian_air' => $pemakaianAir,
            'tagihan_air' => $tagihanAir,
            'biaya_air_id' => $request->biaya_air_id,
        ]);

        return redirect()->route('detail_tagihan_air.index')->with('success', 'Detail tagihan air berhasil ditambahkan.');
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
        // Validasi input dari form
        $request->validate([
            'meter_air_awal' => 'required|numeric',
            'meter_air_akhir' => 'required|numeric|gte:meter_air_awal',
            'biaya_air_id' => 'required|exists:detail_biaya_airs,id',
        ]);

        // Hitung pemakaian air
        $pemakaianAir = $request->meter_air_akhir - $request->meter_air_awal;

        // Ambil biaya air
        $biayaAir = detailBiayaAir::find($request->biaya_air_id)->biaya_air;

        // Hitung tagihan air
        $tagihanAir = $pemakaianAir * $biayaAir;

        // Update data di dalam tabel `detail_tagihan_airs`
        $detailTagihanAir->update([
            'meter_air_awal' => $request->meter_air_awal,
            'meter_air_akhir' => $request->meter_air_akhir,
            'pemakaian_air' => $pemakaianAir,
            'tagihan_air' => $tagihanAir,
            'biaya_air_id' => $request->biaya_air_id,
        ]);

        return redirect()->route('detail_tagihan_air.index')->with('success', 'Detail tagihan air berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailTagihanAir $detailTagihanAir)
    {
        $detailTagihanAir->delete();
        return redirect()->route('detail_tagihan_air.index')->with('success', 'Detail tagihan air berhasil dihapus.');
    }
}