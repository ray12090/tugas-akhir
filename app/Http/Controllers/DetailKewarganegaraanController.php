<?php

namespace App\Http\Controllers;

use App\Models\detailKewarganegaraan;
use Illuminate\Http\Request;

class DetailKewarganegaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'status_kewarganegaraan');
        $sort_order = $request->input('sort_order', 'asc');

        $kewarganegaraans = detailKewarganegaraan::query()
            ->when($search, function ($query, $search) {
                return $query->where('status_kewarganegaraan', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('detail_kewarganegaraan.detail_kewarganegaraan', compact('kewarganegaraans', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detail_kewarganegaraan.detail_kewarganegaraan-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        detailKewarganegaraan::create([
            'status_kewarganegaraan' => $request->input('status_kewarganegaraan'),
        ]);

        return redirect()->route('detail_kewarganegaraan.index')->with('success', 'Status kewarganegaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(detailKewarganegaraan $detailKewarganegaraan)
    {
        return view('detail_kewarganegaraan.detail_kewarganegaraan-read', compact('detailKewarganegaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailKewarganegaraan $detailKewarganegaraan)
    {
        return view('detail_kewarganegaraan.detail_kewarganegaraan-update', compact('detailKewarganegaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailKewarganegaraan $detailKewarganegaraan)
    {
        $detailKewarganegaraan->update([
            'status_kewarganegaraan' => $request->input('status_kewarganegaraan'),
        ]);

        return redirect()->route('detail_kewarganegaraan.index')->with('success', 'Status kewarganegaraan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailKewarganegaraan $detailKewarganegaraan)
    {
        try {
            $detailKewarganegaraan->delete();
            return redirect()->route('detail_kewarganegaraan.index')->with('danger', 'Kewarganegaraan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_kewarganegaraan.index')->withErrors(['msg' => 'Error deleting status kewarganegaraan. Please try again.']);
        }
    }
}
