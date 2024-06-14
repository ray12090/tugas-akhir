<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Kepenghunian;
use App\Http\Requests\StoreKepenghunianRequest;
use App\Http\Requests\UpdateKepenghunianRequest;
use Illuminate\Http\Request;

class KepenghunianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_huni');
        $sort_order = $request->input('sort_order', 'desc');

        $kepenghunians = Kepenghunian::with('unit')
            ->when($search, function ($query, $search) {
                return $query->whereHas('unit', function ($q) use ($search) {
                    $q->where('unit', 'like', "%{$search}%")
                        ->orWhere('tower', 'like', "%{$search}%")
                        ->orWhere('lantai', 'like', "%{$search}%");
                })
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(5);

        return view('kepenghunian.kepenghunian', compact('kepenghunians', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all(); // Adjust as necessary to fetch units data
        return view('kepenghunian.kepenghunian-create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKepenghunianRequest $request)
{

    $data = $request->validate([
        'unit_id' => 'required|string',
        'tanggal_huni' => 'required|date',
        'status' => 'required|string',
        'nama' => 'required|string',
        'no_hp' => 'required|numeric|digits_between:10,15',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'warga_negara' => 'required|string',
        'no_ktp' => 'required|numeric|digits:16',
        'agama' => 'required|string',
        'alamat' => 'required|string',
        'awal_sewa' => 'nullable|date',
        'akhir_sewa' => 'nullable|date',
    ]);

    Kepenghunian::create($data);
    return redirect()->route('kepenghunian.create')->with('success', 'Data penghuni berhasil ditambahkan.');
}


    public function show(Kepenghunian $kepenghunian)
    {
        $units = Unit::all(); 
        return view('kepenghunian.kepenghunian-read', compact('kepenghunian', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kepenghunian $kepenghunian)
    { 
        $units = Unit::all();
        return view('kepenghunian.kepenghunian-update', compact('kepenghunian', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKepenghunianRequest $request, Kepenghunian $kepenghunian)
    {
        $data = $request->validate([
            'unit_id' => 'required|string',
            'tanggal_huni' => 'required|date',
            'status' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'warga_negara' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'awal_sewa' => 'nullable|date',
            'akhir_sewa' => 'nullable|date',
        ]);
    
        $kepenghunian->update($data);
        return back()->with('success', 'Data penghuni berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kepenghunian $kepenghunian)
    {
        try {
            $kepenghunian->delete();
            return redirect()->route('kepenghunian.index')->with('danger', 'Data penghuni berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kepenghunian.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
}