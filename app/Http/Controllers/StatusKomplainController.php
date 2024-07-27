<?php

namespace App\Http\Controllers;

use App\Models\statusKomplain;
use Illuminate\Http\Request;

class StatusKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_status_komplain');
        $sort_order = $request->input('sort_order', 'asc');

        $statuses = statusKomplain::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_status_komplain', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('status_komplain.status_komplain', compact('statuses', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('status_komplain.status_komplain-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        statusKomplain::create([
            'nama_status_komplain' => $request->input('nama_status_komplain'),
        ]);

        return redirect()->route('status_komplain.index')->with('success', 'Status Komplain berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(statusKomplain $statusKomplain)
    {
        return view('status_komplain.status_komplain-read', compact('statusKomplain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(statusKomplain $statusKomplain)
    {
        return view('status_komplain.status_komplain-update', compact('statusKomplain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, statusKomplain $statusKomplain)
    {
        $statusKomplain->update([
            'nama_status_komplain' => $request->input('nama_status_komplain'),
        ]);

        return redirect()->route('status_komplain.index')->with('success', 'Status Komplain berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(statusKomplain $statusKomplain)
    {
        try {
            $statusKomplain->delete();
            return redirect()->route('status_komplain.index')->with('danger', 'Data Status Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('status_komplain.index')->withErrors(['msg' => 'Error deleting status komplain. Please try again.']);
        }
    }
}
