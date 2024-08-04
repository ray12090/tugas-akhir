<?php

namespace App\Http\Controllers;

use App\Models\jenisKomplain;
use Illuminate\Http\Request;

class JenisKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_jenis_komplain');
        $sort_order = $request->input('sort_order', 'asc');

        $jenises = jenisKomplain::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_jenis_komplain', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('jenis_komplain.jenis_komplain', compact('jenises', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_komplain.jenis_komplain-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        jenisKomplain::create([
            'nama_jenis_komplain' => $request->input('nama_jenis_komplain'),
        ]);

        return redirect()->route('jenis_komplain.index')->with('success', 'Jenis Komplain berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenisKomplain $jenisKomplain)
    {
        return view('jenis_komplain.jenis_komplain-read', compact('jenisKomplain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenisKomplain $jenisKomplain)
    {
        return view('jenis_komplain.jenis_komplain-update', compact('jenisKomplain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenisKomplain $jenisKomplain)
    {
        $jenisKomplain->update([
            'nama_jenis_komplain' => $request->input('nama_jenis_komplain'),
        ]);

        return redirect()->route('jenis_komplain.index')->with('success', 'Jenis Komplain berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenisKomplain $jenisKomplain)
    {
        try {
            $jenisKomplain->delete();
            return redirect()->route('jenis_komplain.index')->with('success', 'Data Jenis Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis_komplain.index')->withErrors(['msg' => 'Error deleting jenis komplain. Please try again.']);
        }
    }
}
