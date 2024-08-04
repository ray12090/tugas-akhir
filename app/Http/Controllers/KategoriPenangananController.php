<?php

namespace App\Http\Controllers;

use App\Models\kategoriPenanganan;
use Illuminate\Http\Request;

class KategoriPenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_kategori_penanganan');
        $sort_order = $request->input('sort_order', 'asc');

        $kategoris = kategoriPenanganan::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_kategori_penanganan', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('kategori_penanganan.kategori_penanganan', compact('kategoris', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori_penanganan.kategori_penanganan-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_penanganan' => 'required',
        ]);

        kategoriPenanganan::create($request->all());

        return redirect()->route('kategori_penanganan.index')
            ->with('success', 'Kategori Penanganan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategoriPenanganan $kategoriPenanganan)
    {
        return view('kategori_penanganan.kategori_penanganan-read', compact('kategoriPenanganan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategoriPenanganan $kategoriPenanganan)
    {
        return view('kategori_penanganan.kategori_penanganan-update', compact('kategoriPenanganan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategoriPenanganan $kategoriPenanganan)
    {
        $request->validate([
            'nama_kategori_penanganan' => 'required',
        ]);

        $kategoriPenanganan->update($request->all());

        return redirect()->route('kategori_penanganan.index')
            ->with('success', 'Kategori Penanganan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategoriPenanganan $kategoriPenanganan)
    {
        try {
            $kategoriPenanganan->delete();
            return redirect()->route('kategori_penanganan.index')->with('success', 'Data Kategori Penanganan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kategori_penanganan.index')->withErrors(['msg' => 'Error deleting kategori penanganan. Please try again.']);
        }
    }
}
