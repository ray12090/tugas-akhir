<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_penyewa');
        $sort_order = $request->input('sort_order', 'desc');

        $penyewas = Penyewa::with(['unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('nik', 'like', "%{$search}%")
                    ->orWhere('nama_penyewa', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('awal_sewa', 'like', "%{$search}%")
                    ->orWhere('akhir_sewa', 'like', "%{$search}%")
                    ->orWhereHas('unit', function ($query) use ($search) {
                        $query->where('nama_unit', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailKewarganegaraan', function ($query) use ($search) {
                        $query->where('status_kewarganegaraan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailAgama', function ($query) use ($search) {
                        $query->where('nama_agama', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailPerkawinan', function ($query) use ($search) {
                        $query->where('status_perkawinan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('email', 'like', "%{$search}%");
                    });
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('penyewa.penyewa', compact('penyewas', 'sort_by', 'sort_order'));
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
    public function show(Penyewa $penyewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewa $penyewa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewa $penyewa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        //
    }
}
