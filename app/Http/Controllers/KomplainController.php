<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Http\Requests\StoreKomplainRequest;
use App\Http\Requests\UpdateKomplainRequest;
use Illuminate\Http\Request;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_laporan');
        $sort_order = $request->input('sort_order', 'desc');

        $komplains = Komplain::with('unit')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('kategori_laporan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('nomor_kontak', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(5);

        return view('komplain.komplain', compact('komplains', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('komplain.komplain-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_laporan' => 'required|unique:komplains',
            'tanggal_laporan' => 'required|date',
            'tower' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'kategori_laporan' => 'required|string|max:255',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:255',
            'uraian_komplain' => 'required|string',
            'kategori' => 'required|array',
            'foto_analisis_awal' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'foto_hasil_perbaikan' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_analisis_awal')) {
            $data['foto_analisis_awal'] = $request->file('foto_analisis_awal')->store('analisis_awal');
        }

        if ($request->hasFile('foto_hasil_perbaikan')) {
            $data['foto_hasil_perbaikan'] = $request->file('foto_hasil_perbaikan')->store('hasil_perbaikan');
        }

        Komplain::create($data);

        return redirect()->route('keluhan.create')->with('success', 'Keluhan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komplain $komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komplain $komplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKomplainRequest $request, Komplain $komplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komplain $komplain)
    {
        //
    }
}
