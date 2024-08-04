<?php

namespace App\Http\Controllers;

use App\Models\detailBiayaAdmin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailBiayaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_awal_berlaku');
        $sort_order = $request->input('sort_order', 'asc');

        $validSortByFields = ['biaya_admin', 'tanggal_awal_berlaku', 'tanggal_akhir_berlaku', 'created_at', 'updated_at'];

        if (!in_array($sort_by, $validSortByFields)) {
            $sort_by = 'tanggal_awal_berlaku';
        }

        $detailBiayaAdmin = detailBiayaAdmin::query()
            ->when($search, function ($query, $search) {
                return $query->where('biaya_admin', 'like', "%{$search}%")
                    ->orWhere('tanggal_awal_berlaku', 'like', "%{$search}%")
                    ->orWhere('tanggal_akhir_berlaku', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%")
                    ->orWhere('updated_at', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('detail_biaya_admin.detail_biaya_admin', compact('detailBiayaAdmin', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detail_biaya_admin.detail_biaya_admin-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'biaya_admin' => 'required|numeric|min:0',
            'tanggal_awal_berlaku' => 'required|date',
            'tanggal_akhir_berlaku' => 'nullable|date|after_or_equal:tanggal_awal_berlaku',
        ]);

        // Perbarui data biaya admin sebelumnya
        $biayaAdminSebelumnya = detailBiayaAdmin::whereNull('tanggal_akhir_berlaku')->first();
        if ($biayaAdminSebelumnya) {
            $biayaAdminSebelumnya->update([
                'tanggal_akhir_berlaku' => $request->input('tanggal_awal_berlaku'),
            ]);
        }

        // Tambahkan data baru
        detailBiayaAdmin::create([
            'biaya_admin' => $request->input('biaya_admin'),
            'tanggal_awal_berlaku' => $request->input('tanggal_awal_berlaku'),
            'tanggal_akhir_berlaku' => $request->input('tanggal_akhir_berlaku'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_admin.index')->with('success', 'Biaya admin berhasil ditambahkan');
    }

    public function getBiayaAdmin(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $biayaAdmin = DetailBiayaAdmin::where('tanggal_awal_berlaku', '<=', $tanggal)
            ->where(function ($query) use ($tanggal) {
                $query->whereNull('tanggal_akhir_berlaku')
                    ->orWhere('tanggal_akhir_berlaku', '>=', $tanggal);
            })
            ->orderBy('tanggal_awal_berlaku', 'desc')
            ->first();

        return response()->json([
            'biaya_admin' => $biayaAdmin ? $biayaAdmin->biaya_admin : 0,
            'biaya_admin_id' => $biayaAdmin ? $biayaAdmin->id : null,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(detailBiayaAdmin $detailBiayaAdmin)
    {
        return view('detail_biaya_admin.detail_biaya_admin-read', compact('detailBiayaAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailBiayaAdmin $detailBiayaAdmin)
    {
        return view('detail_biaya_admin.detail_biaya_admin-update', compact('detailBiayaAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailBiayaAdmin $detailBiayaAdmin)
    {
        // Validasi input dari form
        $request->validate([
            'biaya_admin' => 'required|numeric|min:0',
            'tanggal_awal_berlaku' => 'required|date',
            'tanggal_akhir_berlaku' => 'nullable|date|after_or_equal:tanggal_awal_berlaku',
        ]);

        $detailBiayaAdmin->update([
            'biaya_admin' => $request->input('biaya_admin'),
            'tanggal_awal_berlaku' => $request->input('tanggal_awal_berlaku'),
            'tanggal_akhir_berlaku' => $request->input('tanggal_akhir_berlaku'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_admin.index')->with('success', 'Biaya admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailBiayaAdmin $detailBiayaAdmin)
    {
        try {
            $detailBiayaAdmin->delete();
            return redirect()->route('detail_biaya_admin.index')->with('success', 'Data biaya admin berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_biaya_admin.index')->withErrors(['msg' => 'Error deleting biaya admin. Please try again.']);
        }
    }
}
