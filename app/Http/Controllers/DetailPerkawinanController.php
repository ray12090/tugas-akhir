<?php

namespace App\Http\Controllers;

use App\Models\detailPerkawinan;
use Illuminate\Http\Request;

class DetailPerkawinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'status_perkawinan');
        $sort_order = $request->input('sort_order', 'asc');

        $perkawinans = detailPerkawinan::query()
            ->when($search, function ($query, $search) {
                return $query->where('status_perkawinan', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('detail_perkawinan.detail_perkawinan', compact('perkawinans', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detail_perkawinan.detail_perkawinan-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        detailPerkawinan::create([
            'status_perkawinan' => $request->input('status_perkawinan'),
        ]);

        return redirect()->route('detail_perkawinan.index')->with('success', 'Status perkawinan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(detailPerkawinan $detailPerkawinan)
    {
        return view('detail_perkawinan.detail_perkawinan-read', compact('detailPerkawinan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detailPerkawinan $detailPerkawinan)
    {
        return view('detail_perkawinan.detail_perkawinan-update', compact('detailPerkawinan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detailPerkawinan $detailPerkawinan)
    {
        $detailPerkawinan->update([
            'status_perkawinan' => $request->input('status_perkawinan'),
        ]);

        return redirect()->route('detail_perkawinan.index')->with('success', 'Status perkawinan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detailPerkawinan $detailPerkawinan)
    {
        try {
            $detailPerkawinan->delete();
            return redirect()->route('detail_perkawinan.index')->with('danger', 'Status perkawinan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_perkawinan.index')->withErrors(['msg' => 'Error deleting status perkawinan. Please try again.']);
        }
    }
}
