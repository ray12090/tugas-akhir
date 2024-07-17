<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_pemilik');
        $sort_order = $request->input('sort_order', 'desc');

        $pemiliks = Pemilik::with(['unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('nik', 'like', "%{$search}%")
                    ->orWhere('nama_pemilik', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
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

        return view('pemilik.pemilik', compact('pemiliks', 'sort_by', 'sort_order'));
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
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        //
    }
}
