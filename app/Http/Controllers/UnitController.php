<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Tower;
use App\Models\Lantai;
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
        $sortBy = $request->input('sort_by', 'nama_unit');
        $sortOrder = $request->input('sort_order', 'asc');

        $units = Unit::query()
            ->join('lantais', 'units.lantai_id', '=', 'lantais.id')
            ->join('towers', 'lantais.tower_id', '=', 'towers.id')
            ->select('units.*', 'lantais.nama_lantai', 'towers.nama_tower')
            ->when($search, function ($query, $search) {
                return $query->where('units.nama_unit', 'like', "%{$search}%")
                    ->orWhere('lantais.nama_lantai', 'like', "%{$search}%")
                    ->orWhere('towers.nama_tower', 'like', "%{$search}%");
            })
            ->when($sortBy === 'nama_unit', function ($query) use ($sortOrder) {
                return $query->orderByRaw('LENGTH(units.nama_unit), units.nama_unit ' . $sortOrder);
            }, function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(10);

        return view('unit.unit', compact('units', 'sortBy', 'sortOrder'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $towers = Tower::all();
        $lantais = Lantai::all();
        return view('unit.unit-create', compact('towers', 'lantais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getLantais($tower_id)
    {
        $lantais = Lantai::where('tower_id', $tower_id)->get();
        return response()->json($lantais);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lantai_id' => 'required|exists:lantais,id',
            'units' => 'required|array',
            'units.*' => 'required|string|max:255',
        ]);

        foreach ($request->units as $unit) {
            Unit::create([
                'lantai_id' => $request->lantai_id,
                'nama_unit' => $unit,
            ]);
        }

        return redirect()->route('unit.index')->with('success', 'Units berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        $tower = Tower::all();
        $lantais = Lantai::all();
        return view('unit.unit-read', compact('unit', 'tower', 'lantais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $towers = Tower::all();
        $lantais = Lantai::where('tower_id', $unit->lantai->tower_id)->get();

        return view('unit.unit-update', compact('unit', 'towers', 'lantais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:255',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->nama_unit = $request->nama_unit;
        $unit->save();

        return redirect()->route('unit.index')->with('success', 'Unit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            return redirect()->route('unit.index')->with('danger', 'Unit berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('unit.index')->withErrors(['msg' => 'Error deleting unit. Please try again.']);
        }
    }
}
