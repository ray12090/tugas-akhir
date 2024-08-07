<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Unit;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use App\Models\DetailTempatLahir;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;
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
                    ->orWhere('tempat_lahir_id', 'like', "%{$search}%")
                    ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('jenis_kelamin', 'like', "%{$search}%")
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

        if (Auth::user()->tipe_user_id == 12) {
            return redirect()->route('dashboard')->with('success', 'Datamu berhasil ditambah.');
        } else {
            return view('penyewa.penyewa', compact('penyewas', 'sort_by', 'sort_order'));
        }
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
        $detailTempatLahir = City::all();
        $users = User::all();
        $detailAlamatVillages = Village::all();
        $detailAlamatProvinsi = Province::all();
        $detailAlamatKabupaten = City::all();
        $detailAlamatKecamatan = District::all();
        return view('penyewa.penyewa-create', compact('penyewas', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahir', 'users', 'detailAlamatVillages', 'detailAlamatProvinsi', 'detailAlamatKabupaten', 'detailAlamatKecamatan'));
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
            'tempat_lahir_id' => 'nullable|exists:cities,id',
            'nama_penyewa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'awal_sewa' => 'required|date',
            'akhir_sewa' => 'required|date|after:awal_sewa',
            'alamat_village_id' => 'nullable|exists:villages,id',
            'alamat_kecamatan_id' => 'nullable|exists:districts,id',
            'alamat_kabupaten_id' => 'nullable|exists:cities,id',
            'alamat_provinsi_id' => 'nullable|exists:provinces,id',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile("foto_ktp")) {
            $image = $request->file("foto_ktp");
            $image->storeAs('public/foto_ktp', $image->hashName());
            $fotoPath = $image->hashName();
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
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('no_hp'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'awal_sewa' => $request->input('awal_sewa'),
            'akhir_sewa' => $request->input('akhir_sewa'),
            'alamat_village_id' => $request->input('alamat_village_id'),
            'alamat_kecamatan_id' => $request->input('alamat_kecamatan_id'),
            'alamat_kabupaten_id' => $request->input('alamat_kabupaten_id'),
            'alamat_provinsi_id' => $request->input('alamat_provinsi_id'),
            'foto_ktp' => $fotoPath ?? null,
        ]);

        if (Auth::user()->tipe_user_id == 12) {
            return redirect('/dashboard')->with('success', 'Datamu berhasil ditambah.');
        } else {
            return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penyewa = Penyewa::with('unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'detailTempatLahir', 'user', 'detailAlamatVillage', 'detailAlamatKecamatan', 'detailAlamatKabupaten', 'detailAlamatProvinsi')->findOrFail($id);
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
        $detailTempatLahir = City::all();
        $users = User::where('tipe_user_id', '12')->get();
        $detailAlamatVillages = Village::all();
        $detailAlamatProvinsi = Province::all();
        $detailAlamatKabupaten = City::all();
        $detailAlamatKecamatan = District::all();


        return view('penyewa.penyewa-update', compact('penyewa', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahir', 'users', 'detailAlamatVillages', 'detailAlamatProvinsi', 'detailAlamatKabupaten', 'detailAlamatKecamatan'));
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
            'tempat_lahir_id' => 'nullable|exists:villages,id',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'alamat_village_id' => 'nullable|exists:villages,id',
            'alamat_kecamatan_id' => 'nullable|exists:districts,id',
            'alamat_kabupaten_id' => 'nullable|exists:cities,id',
            'alamat_provinsi_id' => 'nullable|exists:provinces,id',
            'awal_sewa' => 'required|date',
            'akhir_sewa' => 'required|date|after:awal_sewa',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data penyewa
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->update($request->only([
            'nik',
            'unit_id',
            'warga_negara_id',
            'agama_id',
            'perkawinan_id',
            'user_id',
            'nama_penyewa',
            'no_hp',
            'tempat_lahir_id',
            'tanggal_lahir',
            'alamat',
            'jenis_kelamin',
            'alamat_village_id',
            'alamat_kecamatan_id',
            'alamat_kabupaten_id',
            'alamat_provinsi_id',
            'awal_sewa',
            'akhir_sewa',
        ]));

        // Update foto KTP jika ada
        if ($request->hasFile('foto_ktp')) {
            $image = $request->file('foto_ktp');
            $image->storeAs('public/foto_ktp', $image->hashName());
            $penyewa->update(['foto_ktp' => $image->hashName()]);
        }

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewa $penyewa)
    {
        try {
            $penyewa->delete();
            return redirect()->route('penyewa.index')->with('success', 'Data Penyewa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penyewa.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
}
