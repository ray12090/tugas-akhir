<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'nama_tower');
        $sortOrder = $request->input('sort_order', 'asc');

        $towers = Tower::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_tower', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view('tower.tower', compact('towers', 'sortBy', 'sortOrder'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tower.tower-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tower::create([
            'nama_tower' => $request->input('nama_tower'),
        ]);

        return redirect()->route('tower.index')->with('success', 'Tower berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(tower $tower)
    {
        return view('tower.tower-read', compact('tower'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tower $tower)
    {
        return view('tower.tower-update', compact('tower'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tower $tower)
    {
        $validator = Validator::make($request->all(), [
            'nama_tower' => 'required|string|max:20'
        ]);

        $tower->update($request->all());

        return redirect()->route('tower.index')->with('success', 'Data Tower berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tower $tower)
    {
        try {
            $tower->delete();
            return redirect()->route('tower.index')->with('danger', 'Data Tower berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tower.index')->withErrors(['msg' => 'Error deleting tower. Please try again.']);
        }
    }
}
