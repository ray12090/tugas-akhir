<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Unit;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use App\Models\DetailTempatLahir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_penyewa');
        $sort_order = $request->input('sort_order', 'desc');

        $penyewas = Penyewa::with(['unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'user', 'detailTempatLahir'])
            ->when($search, function ($query, $search) {
                return $query->where('nik', 'like', "%{$search}%")
                    ->orWhere('nama_penyewa', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('awal_sewa', 'like', "%{$search}%")
                    ->orWhere('akhir_sewa', 'like', "%{$search}%")
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

        return view('penyewa.penyewa', compact('penyewas', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penyewas = Penyewa::all();
        $units = Unit::all();
        $detailKewarganegaraans = DetailKewarganegaraan::all();
        $detailAgamas = DetailAgama::all();
        $detailPerkawinans = DetailPerkawinan::all();
        $detailTempatLahirs = DetailTempatLahir::all();
        $users = User::all();
        return view('penyewa.penyewa-create', compact('penyewas', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahirs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:penyewas',
            'unit_id' => 'required|exists:units,id',
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'tempat_lahir_id' => 'required|exists:detail_tempat_lahirs,id',
            'nama_penyewa' => 'required|string|max:255',
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

        // Buat penyewa baru
        Penyewa::create([
            'nik' => $request->input('nik'),
            'unit_id' => $request->input('unit_id'),
            'warga_negara_id' => $request->input('warga_negara_id'),
            'agama_id' => $request->input('agama_id'),
            'perkawinan_id' => $request->input('perkawinan_id'),
            'user_id' => $request->input('user_id'),
            'tempat_lahir_id' => $request->input('tempat_lahir_id'),
            'nama_penyewa' => $request->input('nama_penyewa'),
            'no_hp' => $request->input('no_hp'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'awal_sewa' => $request->input('awal_sewa'),
            'akhir_sewa' => $request->input('akhir_sewa'),
        ]);

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penyewa = Penyewa::with('unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'detailTempatLahir', 'user')->findOrFail($id);
        return view('penyewa.penyewa-read', compact('penyewa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $units = Unit::all();
        $detailKewarganegaraans = DetailKewarganegaraan::all();
        $detailAgamas = DetailAgama::all();
        $detailPerkawinans = DetailPerkawinan::all();
        $detailTempatLahirs = DetailTempatLahir::all();
        $users = User::where('usertype', 'user')->get();

        return view('penyewa.penyewa-update', compact('penyewa', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahirs', 'users'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:penyewas,nik,' . $id,
            'unit_id' => 'required|exists:units,id',
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'nama_penyewa' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir_id' => 'required|exists:detail_tempat_lahirs,id',
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

        // Update penyewa
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->update($request->all());

        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        //
    }
}
