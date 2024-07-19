<?php

namespace App\Http\Controllers;

use App\Models\detailAgama;
use Illuminate\Http\Request;

class DetailAgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_agama');
        $sort_order = $request->input('sort_order', 'asc');

        $agamas = detailAgama::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_agama', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('detail_agama.detail_agama', compact('agamas', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detail_agama.detail_agama-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        detailAgama::create([
            'nama_agama' => $request->input('nama_agama'),
        ]);

        return redirect()->route('detail_agama.index')->with('success', 'Agama berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(detailAgama $detailAgama)
    {
        return view('detail_agama.detail_agama-read', compact('detailAgama'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailAgama $detailAgama)
    {
        return view('detail_agama.detail_agama-update', compact('detailAgama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailAgama $detailAgama)
    {
        $detailAgama->update([
            'nama_agama' => $request->input('nama_agama'),
        ]);

        return redirect()->route('detail_agama.index')->with('success', 'Agama berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailAgama $detailAgama)
    {
        try {
            $detailAgama->delete();
            return redirect()->route('detail_agama.index')->with('danger', 'Data Agama berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_agama.index')->withErrors(['msg' => 'Error deleting agama. Please try again.']);
        }
    }
}
