<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Unit;
use App\Models\JenisKomplain;
use App\Models\BagianKomplain;
use App\Http\Requests\StoreKomplainRequest;
use App\Http\Requests\UpdateKomplainRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_laporan');
        $sort_order = $request->input('sort_order', 'desc');

        $komplains = Komplain::with('unit', 'jenisKomplain', 'bagianKomplains')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('jenis_komplain', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        // dd($komplains);

        return view('komplain.komplain', compact('komplains', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $jenisKomplains = JenisKomplain::all();
        $bagianKomplains = BagianKomplain::all();
        return view('komplain.komplain-create', compact('units', 'jenisKomplains', 'bagianKomplains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nomor_laporan' => 'required|string|unique:komplains,nomor_laporan',
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'jenis_komplain_id' => 'required|exists:jenis_komplains,id',
            'nama_pelapor' => 'required|string',
            'no_hp' => 'required|numeric',
            'uraian_komplain' => 'nullable|string',
            'bagian_komplain_id' => 'required|array',
            'bagian_komplain_id.*' => 'exists:bagian_komplains,id',
            'foto_komplain' => 'nullable|image'
        ]);

        $data = $request->except('foto_komplain');

        if ($request->hasFile('foto_komplain')) {
            $image = $request->file('foto_komplain');
            $image->storeAs('public/foto_komplain', $image->hashName());
            $data['foto_komplain'] = $image->hashName();
        }

        $komplain = Komplain::create($data);

        $komplain->bagianKomplains()->sync($request->bagian_komplain_id);

        return redirect()->route('komplain.create')->with('success', 'Komplain berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Komplain $komplain)
    {
        return view('komplain.komplain-read', compact('komplain'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komplain $komplain)
    {
        $units = Unit::all();
        $jenisKomplains = JenisKomplain::all();
        $bagianKomplains = BagianKomplain::all();
        return view('komplain.komplain-edit', compact('komplain', 'units', 'jenisKomplains', 'bagianKomplains'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nomor_laporan' => 'required|string|unique:komplains,nomor_laporan,' . $id,
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'jenis_komplain_id' => 'required|exists:jenis_komplains,id',
            'nama_pelapor' => 'required|string',
            'no_hp' => 'required|numeric',
            'uraian_komplain' => 'nullable|string',
            'bagian_komplain_id' => 'required|array',
            'bagian_komplain_id.*' => 'exists:bagian_komplains,id',
            'foto_komplain' => 'nullable|image'
        ]);

        $data = $request->except('foto_komplain');

        if ($request->hasFile('foto_komplain')) {
            $image = $request->file('foto_komplain');
            $image->storeAs('public/foto_komplain', $image->hashName());
            $data['foto_komplain'] = $image->hashName();
        }

        $komplain = Komplain::findOrFail($id);
        $komplain->update($data);

        $komplain->bagianKomplains()->sync($request->bagian_komplain_id);

        return back()->with('success', 'Komplain berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komplain $komplain)
    {
        try {
            $komplain->delete();
            return redirect()->route('komplain.index')->with('danger', 'Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('komplain.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
    public function getUnits($unit)
    {
        $units = Unit::where('unit', $unit)->get();
        return response()->json(['units' => $units]);
    }
}
