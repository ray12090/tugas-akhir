<?php

namespace App\Http\Controllers;

use App\Models\kategoriKomplain;
use Illuminate\Http\Request;

class KategoriKomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_kategori_komplain');
        $sort_order = $request->input('sort_order', 'asc');

        $kategoris = kategoriKomplain::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_kategori_komplain', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('kategori_komplain.kategori_komplain', compact('kategoris', 'sort_by', 'sort_order'));
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
    public function show(kategoriKomplain $kategoriKomplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategoriKomplain $kategoriKomplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategoriKomplain $kategoriKomplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategoriKomplain $kategoriKomplain)
    {
        //
    }
}
