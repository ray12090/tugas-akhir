<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;

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
                return $query->where('nama_tower', 'like', "%{$search}%");})
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view('tower.tower', compact('towers', 'sortBy', 'sortOrder'));
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
    public function show(tower $tower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tower $tower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tower $tower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tower $tower)
    {
        //
    }
}
