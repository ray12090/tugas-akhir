<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Pemilik;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use App\Models\DetailTempatLahir;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_pemilik');
        $sort_order = $request->input('sort_order', 'desc');

        $pemiliks = Pemilik::with(['unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('nik', 'like', "%{$search}%")
                    ->orWhere('nama_pemilik', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir_id', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhereHas('unit', function ($query) use ($search) {
                        $query->where('nama_unit', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailKewarganegaraan', function ($query) use ($search) {
                        $query->where('status_kewarganegaraan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailAgama', function ($query) use ($search) {
                        $query->where('nama_agama', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailPerkawinan', function ($query) use ($search) {
                        $query->where('status_perkawinan', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('email', 'like', "%{$search}%");
                    });
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('pemilik.pemilik', compact('pemiliks', 'sort_by', 'sort_order'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemiliks = Pemilik::all();
        $units = Unit::all();
        $detailKewarganegaraans = DetailKewarganegaraan::all();
        $detailAgamas = DetailAgama::all();
        $detailPerkawinans = DetailPerkawinan::all();
        $detailTempatLahirs = DetailTempatLahir::all();
        $users = User::all();
        return view('pemilik.pemilik-create', compact('pemiliks', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahirs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:pemiliks',
            'unit_id' => 'required|exists:units,id',
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'tempat_lahir_id' => 'required|exists:detail_tempat_lahirs,id',
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'awal_sewa' => 'required|date',
            'akhir_sewa' => 'required|date|after:awal_sewa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat pemilik baru
        Pemilik::create([
            'nik' => $request->input('nik'),
            'unit_id' => $request->input('unit_id'),
            'warga_negara_id' => $request->input('warga_negara_id'),
            'agama_id' => $request->input('agama_id'),
            'perkawinan_id' => $request->input('perkawinan_id'),
            'user_id' => $request->input('user_id'),
            'tempat_lahir_id' => $request->input('tempat_lahir_id'),
            'nama_pemilik' => $request->input('nama_pemilik'),
            'no_hp' => $request->input('no_hp'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'awal_sewa' => $request->input('awal_sewa'),
            'akhir_sewa' => $request->input('akhir_sewa'),
        ]);

        return redirect()->route('pemilik.index')->with('success', 'pemilik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        //
    }
}