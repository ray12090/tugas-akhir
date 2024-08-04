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
        $sort_by = $request->input('sort_by', 'tanggal_awal_berlaku');
        $sort_order = $request->input('sort_order', 'asc');

        $validSortByFields = ['biaya_air', 'tanggal_awal_berlaku', 'tanggal_akhir_berlaku', 'created_at', 'updated_at'];

        if (!in_array($sort_by, $validSortByFields)) {
            $sort_by = 'tanggal_awal_berlaku';
        }

        $detailBiayaAir = detailBiayaAir::query()
            ->when($search, function ($query, $search) {
                return $query->where('biaya_air', 'like', "%{$search}%")
                    ->orWhere('tanggal_awal_berlaku', 'like', "%{$search}%")
                    ->orWhere('tanggal_akhir_berlaku', 'like', "%{$search}%");
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
        // Validasi input dari form
        $request->validate([
            'biaya_air' => 'required|numeric|min:0',
            'tanggal_awal_berlaku' => 'required|date',
            'tanggal_akhir_berlaku' => 'nullable|date|after_or_equal:tanggal_awal_berlaku',
        ]);

        // Perbarui data biaya air sebelumnya
        $biayaAirSebelumnya = detailBiayaAir::whereNull('tanggal_akhir_berlaku')->first();
        if ($biayaAirSebelumnya) {
            $biayaAirSebelumnya->update([
                'tanggal_akhir_berlaku' => $request->input('tanggal_awal_berlaku'),
            ]);
        }

        // Tambahkan data baru
        detailBiayaAir::create([
            'biaya_air' => $request->input('biaya_air'),
            'tanggal_awal_berlaku' => $request->input('tanggal_awal_berlaku'),
            'tanggal_akhir_berlaku' => $request->input('tanggal_akhir_berlaku'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_air.index')->with('success', 'Biaya air berhasil ditambahkan');
    }

    public function getBiayaAir(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $biayaAir = DetailBiayaAir::where('tanggal_awal_berlaku', '<=', $tanggal)
            ->where(function ($query) use ($tanggal) {
                $query->whereNull('tanggal_akhir_berlaku')
                    ->orWhere('tanggal_akhir_berlaku', '>=', $tanggal);
            })
            ->orderBy('tanggal_awal_berlaku', 'desc')
            ->first();

        return response()->json([
            'biaya_air' => $biayaAir ? $biayaAir->biaya_air : 0,
            'biaya_air_id' => $biayaAir ? $biayaAir->id : null,
        ]);
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
        // Validasi input dari form
        $request->validate([
            'biaya_air' => 'required|numeric|min:0',
            'tanggal_awal_berlaku' => 'required|date',
            'tanggal_akhir_berlaku' => 'nullable|date|after_or_equal:tanggal_awal_berlaku',
        ]);

        $detailBiayaAir->update([
            'biaya_air' => $request->input('biaya_air'),
            'tanggal_awal_berlaku' => $request->input('tanggal_awal_berlaku'),
            'tanggal_akhir_berlaku' => $request->input('tanggal_akhir_berlaku'),
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
            return redirect()->route('detail_biaya_air.index')->with('success', 'Data biaya air berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_biaya_air.index')->withErrors(['msg' => 'Error deleting biaya air. Please try again.']);
        }
    }
}
