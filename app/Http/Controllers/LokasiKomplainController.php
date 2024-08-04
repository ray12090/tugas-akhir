<?php

namespace App\Http\Controllers;

use App\Models\lokasiKomplain;
use Illuminate\Http\Request;

class LokasiKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_lokasi_komplain');
        $sort_order = $request->input('sort_order', 'asc');

        $lokasies = lokasiKomplain::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_lokasi_komplain', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('lokasi_komplain.lokasi_komplain', compact('lokasies', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi_komplain.lokasi_komplain-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        lokasiKomplain::create([
            'nama_lokasi_komplain' => $request->input('nama_lokasi_komplain'),
        ]);

        return redirect()->route('lokasi_komplain.index')->with('success', 'Lokasi Komplain berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(lokasiKomplain $lokasiKomplain)
    {
        return view('lokasi_komplain.lokasi_komplain-read', compact('lokasiKomplain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lokasiKomplain $lokasiKomplain)
    {
        return view('lokasi_komplain.lokasi_komplain-update', compact('lokasiKomplain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lokasiKomplain $lokasiKomplain)
    {
        $lokasiKomplain->update([
            'nama_lokasi_komplain' => $request->input('nama_lokasi_komplain'),
        ]);

        return redirect()->route('lokasi_komplain.index')->with('success', 'Lokasi Komplain berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lokasiKomplain $lokasiKomplain)
    {
        try {
            $lokasiKomplain->delete();
            return redirect()->route('lokasi_komplain.index')->with('success', 'Data Lokasi Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('lokasi_komplain.index')->withErrors(['msg' => 'Error deleting lokasi komplain. Please try again.']);
        }
    }
}
