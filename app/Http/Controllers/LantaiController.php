<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'tower');
        $sortOrder = $request->input('sort_order', 'asc');

        $lantais = Lantai::query()
            ->when($search, function ($query, $search) {
                return $query->where('unit', 'like', "%{$search}%")
                    ->orWhere('lantai', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        return view('lantai.lantai', compact('lantais', 'sortBy', 'sortOrder'));
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
    public function show(lantai $lantai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lantai $lantai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lantai $lantai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lantai $lantai)
    {
        //
    }
}
