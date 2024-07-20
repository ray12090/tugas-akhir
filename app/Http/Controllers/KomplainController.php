<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Unit;
use App\Models\JenisKomplain;
use App\Models\LokasiKomplain;
use App\Http\Requests\StoreKomplainRequest;
use App\Http\Requests\UpdateKomplainRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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

        $komplains = Komplain::with('unit', 'jenisKomplain', 'lokasiKomplains')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('nama_jenis_komplain', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('komplain.komplain', compact('komplains', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $jenisKomplains = JenisKomplain::all();
        $lokasiKomplains = LokasiKomplain::all();
        return view('komplain.komplain-create', compact('units', 'jenisKomplains', 'lokasiKomplains'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_komplain_id' => 'required',
            'nomor_laporan' => 'required',
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required',
            'nama_pelapor' => 'required',
            'no_hp' => 'required',
        ]);

        $komplain = Komplain::create([
            'jenis_komplain_id' => $request->jenis_komplain_id,
            'nomor_laporan' => $request->nomor_laporan,
            'tanggal_laporan' => $request->tanggal_laporan,
            'unit_id' => $request->unit_id,
            'nama_pelapor' => $request->nama_pelapor,
            'no_hp' => $request->no_hp,
        ]);

        if ($request->has('uraian_komplain')) {
            foreach ($request->uraian_komplain as $lokasiId => $uraian) {
                $fotoPath = null;
                if ($request->hasFile("foto_komplain.$lokasiId")) {
                    $image = $request->file("foto_komplain.$lokasiId");
                    $image->storeAs('public/foto_komplain', $image->hashName());
                    $fotoPath = $image->hashName();
                }

                DB::table('komplain_lokasi_pivot')->insert([
                    'komplain_id' => $komplain->id,
                    'lokasi_komplain_id' => $lokasiId,
                    'uraian_komplain' => $uraian,
                    'foto_komplain' => $fotoPath,
                ]);
            }
        }

        return redirect()->route('komplain.index')->with('success', 'Komplain berhasil ditambahkan');
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $komplain = Komplain::with('lokasiKomplains')->findOrFail($id);
        $jenisKomplains = JenisKomplain::all();
        return view('komplain.komplain-read', compact('komplain', 'jenisKomplains'));
    }

    public function edit($id)
    {
        $komplain = Komplain::with('lokasiKomplains')->findOrFail($id);
        $jenisKomplains = JenisKomplain::all();
        return view('komplain.komplain-edit', compact('komplain', 'jenisKomplains'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_laporan' => 'required|string|unique:komplains,nomor_laporan,' . $id,
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'jenis_komplain_id' => 'required|exists:jenis_komplains,id',
            'nama_pelapor' => 'required|string',
            'no_hp' => 'required|string',
            'lokasi_komplain.*.uraian_komplain' => 'nullable|string',
            'lokasi_komplain.*.foto_komplain' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $komplain = Komplain::findOrFail($id);
        $komplain->update($request->only(['nomor_laporan', 'tanggal_laporan', 'unit_id', 'jenis_komplain_id', 'nama_pelapor', 'no_hp']));

        foreach ($request->lokasi_komplain as $lokasiId => $data) {
            $lokasiData = ['uraian_komplain' => $data['uraian_komplain'] ?? null];

            if ($request->hasFile("lokasi_komplain.$lokasiId.foto_komplain")) {
                $image = $request->file("lokasi_komplain.$lokasiId.foto_komplain");
                $image->storeAs('public/foto_komplain', $image->hashName());
                $lokasiData['foto_komplain'] = $image->hashName();
            }

            $komplain->lokasiKomplains()->updateExistingPivot($lokasiId, $lokasiData);
        }

        return redirect()->route('komplain.show', $komplain->id)->with('success', 'Komplain updated successfully');
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
