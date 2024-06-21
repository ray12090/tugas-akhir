<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Unit;
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

        $komplains = Komplain::with('unit')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('kategori_laporan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('nomor_kontak', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(5);

        return view('komplain.komplain', compact('komplains', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('komplain.komplain-create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the form
        $request->validate([
            'nomor_laporan' => 'required|unique:komplains',
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|string|max:255',
            'kategori_laporan' => 'required|string|max:255',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:255',
            'uraian_komplain' => 'required|string',
            'kategori' => 'required|array',
            'respon' => 'nullable|string',
            'analisis_awal' => 'nullable|string',
            'keterangan_selesai' => 'nullable|string',
            'foto_analisis_awal' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'foto_hasil_perbaikan' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        // Prepare data for storage
        $data = $request->except('foto_analisis_awal', 'foto_hasil_perbaikan');
        $data['kategori'] = json_encode($request->kategori); // Encode to JSON

        // Handle file upload for foto_analisis_awal
        if ($request->hasFile('foto_analisis_awal')) {
            $image = $request->file('foto_analisis_awal');
            $image->storeAs('public/analisis_awal', $image->hashName());
            $data['foto_analisis_awal'] = $image->hashName();
        }

        // Handle file upload for foto_hasil_perbaikan
        if ($request->hasFile('foto_hasil_perbaikan')) {
            $image = $request->file('foto_hasil_perbaikan');
            $image->storeAs('public/hasil_perbaikan', $image->hashName());
            $data['foto_hasil_perbaikan'] = $image->hashName();
        }

        // Create Komplain record
        Komplain::create($data);

        // Redirect with success message
        return redirect()->route('komplain.create')->with('success', 'Komplain berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Komplain $komplain)
    {
        $komplain->kategori = json_decode($komplain->kategori, true); // Decode to array
        // dd(Komplain::find($komplain->id)->toArray());
        return view('komplain.komplain-read', compact('komplain'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komplain $komplain)
    {
        $komplain->kategori = json_decode($komplain->kategori, true); // Decode JSON to array
        $units = Unit::all();
        return view('komplain.komplain-edit', compact('komplain', 'units'));
    }

    public function update(Request $request, Komplain $komplain): RedirectResponse
    {
        // Validate the form
        $request->validate([
            'nomor_laporan' => 'required|unique:komplains,nomor_laporan,' . $komplain->id,
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|string|max:255',
            'kategori_laporan' => 'required|string|max:255',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:255',
            'uraian_komplain' => 'required|string',
            'kategori' => 'required|array',
            'respon' => 'nullable|string',
            'analisis_awal' => 'nullable|string',
            'keterangan_selesai' => 'nullable|string',
            'foto_analisis_awal' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'foto_hasil_perbaikan' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        // Prepare data for update
        $data = $request->except('foto_analisis_awal', 'foto_hasil_perbaikan');
        $data['kategori'] = json_encode($request->kategori); // Encode to JSON

        // Handle file upload for foto_analisis_awal
        if ($request->hasFile('foto_analisis_awal')) {
            $image = $request->file('foto_analisis_awal');
            $image->storeAs('public/analisis_awal', $image->hashName());
            $data['foto_analisis_awal'] = $image->hashName();
        }

        // Handle file upload for foto_hasil_perbaikan
        if ($request->hasFile('foto_hasil_perbaikan')) {
            $image = $request->file('foto_hasil_perbaikan');
            $image->storeAs('public/hasil_perbaikan', $image->hashName());
            $data['foto_hasil_perbaikan'] = $image->hashName();
        }

        // Update Komplain record
        $komplain->update($data);

        // Redirect with success message
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
