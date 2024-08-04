<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use Illuminate\Http\Request;
use App\Models\Tower;

class LantaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'nama_lantai');
        $sortOrder = $request->input('sort_order', 'asc');

        $lantais = Lantai::with('tower')
            ->when($search, function ($query, $search) {
                return $query->where('nama_lantai', 'like', "%{$search}%")
                    ->orWhereHas('tower', function ($query) use ($search) {
                        $query->where('nama_tower', 'like', "%{$search}%");
                    });
            })
            ->when($sortBy === 'nama_lantai', function ($query) use ($sortOrder) {
                return $query->orderByRaw('LENGTH(nama_lantai), nama_lantai ' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(10);

        return view('lantai.lantai', compact('lantais', 'sortBy', 'sortOrder'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $towers = Tower::all();
        return view('lantai.lantai-create', compact('towers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tower_id' => 'required|exists:towers,id',
            'floors' => 'required|array',
            'floors.*' => 'required|string|max:255',
        ]);

        $tower = Tower::findOrFail($request->tower_id);

        foreach ($request->floors as $floor) {
            Lantai::create([
                'tower_id' => $tower->id,
                'nama_lantai' => $floor,
            ]);
        }

        return redirect()->route('lantai.index')->with('success', 'Tower dan lantai berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(lantai $lantai)
    {
        $tower = Tower::all();
        return view('lantai.lantai-read', compact('lantai', 'tower'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lantai = Lantai::findOrFail($id);
        return view('lantai.lantai-update', compact('lantai'));
    }

    // Fungsi update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lantai' => 'required|string|max:255',
        ]);

        $lantai = Lantai::findOrFail($id);
        $lantai->update([
            'nama_lantai' => $request->nama_lantai,
        ]);

        return redirect()->route('lantai.index')->with('success', 'Lantai berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lantai $lantai)
    {
        try {
            $lantai->delete();
            return redirect()->route('lantai.index')->with('success', 'Lantai berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('lantai.index')->withErrors(['msg' => 'Error deleting lantai. Please try again.']);
        }
    }
}
