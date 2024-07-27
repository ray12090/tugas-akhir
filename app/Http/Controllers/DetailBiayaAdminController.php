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
    $sort_by = $request->input('sort_by', 'created_at');
    $sort_order = $request->input('sort_order', 'asc');

    // Valid fields that can be sorted by
    $validSortByFields = ['biaya_admin', 'created_at', 'updated_at'];

    // Ensure the sort_by field is valid
    if (!in_array($sort_by, $validSortByFields)) {
        $sort_by = 'biaya_admin';
    }

    $detailBiayaAdmin = detailBiayaAdmin::query()
        ->when($search, function ($query, $search) {
            return $query->where('biaya_admin', 'like', "%{$search}%");
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
        detailBiayaAdmin::create([
            'biaya_admin' => $request->input('biaya_admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('detail_biaya_admin.index')->with('success', 'Biaya admin berhasil ditambahkan');
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
        $detailBiayaAdmin->update([
            'biaya_admin' => $request->input('biaya_admin'),
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
            return redirect()->route('detail_biaya_admin.index')->with('danger', 'Data biaya admin berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('detail_biaya_admin.index')->withErrors(['msg' => 'Error deleting biaya admin. Please try again.']);
        }
    }
}
