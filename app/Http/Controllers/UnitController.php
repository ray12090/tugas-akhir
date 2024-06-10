<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'tower');
    $sortOrder = $request->input('sort_order', 'asc');

    $units = Unit::query()
        ->when($search, function ($query, $search) {
            return $query->where('unit', 'like', "%{$search}%")
                ->orWhere('tower', 'like', "%{$search}%")
                ->orWhere('lantai', 'like', "%{$search}%");
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(5);

    return view('unit.unit', compact('units', 'sortBy', 'sortOrder'));
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
    public function store(StoreUnitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
