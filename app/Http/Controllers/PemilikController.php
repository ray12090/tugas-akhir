<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Pemilik;
use App\Models\DetailKewarganegaraan;
use App\Models\DetailAgama;
use App\Models\DetailPerkawinan;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;
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
        $detailTempatLahir = City::all();
        $users = User::all();
        $detailAlamatProvinsi = Province::all();
        $detailAlamatKabupaten = City::all();
        $detailAlamatKecamatan = District::all();
        return view('pemilik.pemilik-create', compact('pemiliks', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahir', 'users', 'detailAlamatProvinsi', 'detailAlamatKabupaten', 'detailAlamatKecamatan'));
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
            'tempat_lahir_id' => 'required|exists:cities,id',
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'awal_huni' => 'required|date',
            'akhir_huni' => 'nullable|date',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat_village_id' => 'required|exists:villages,id',
        ]);

        

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat pemilik baru
        $pemilik = Pemilik::create([
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
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat_village_id' => $request->input('alamat_village_id'),
        ]);

        $pemilik->unit()->attach($request->input('unit_id'), [
            'awal_huni' => $request->input('awal_huni'),
            'akhir_huni' => $request->input('akhir_huni'),
        ]);

        return redirect()->route('pemilik.index')->with('success', 'pemilik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemilik = Pemilik::with('unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'detailTempatLahir', 'user', 'detailAlamatVillages')->findOrFail($id);
        return view('pemilik.pemilik-read', compact('pemilik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $units = Unit::all();
        $detailKewarganegaraans = DetailKewarganegaraan::all();
        $detailAgamas = DetailAgama::all();
        $detailPerkawinans = DetailPerkawinan::all();
        $detailTempatLahir = City::all();
        $users = User::where('tipe_user_id', '11')->get();
        $detailAlamatVillages = Village::all();
        $detailAlamatProvinsi = Province::all();
        $detailAlamatKabupaten = City::all();
        $detailAlamatKecamatan = District::all();

        return view('pemilik.pemilik-update', compact('pemilik', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahir', 'users', 'detailAlamatVillages', 'detailAlamatProvinsi', 'detailAlamatKabupaten', 'detailAlamatKecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:pemiliks,nik,' . $id,
            'unit_id' => 'required|exists:units,id',
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir_id' => 'required|exists:city,id',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'awal_huni' => 'required|date',
            'akhir_huni' => 'nullable|date',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat_village_id' => 'required|exists:villages,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update pemilik
        $pemilik = pemilik::findOrFail($id);
        $pemilik->update($request->all());

        $pemilik->unit()->syncWithoutDetaching([
            $request->input('unit_id') => [
                'awal_huni' => $request->input('awal_huni'),
                'akhir_huni' => $request->input('akhir_huni')
            ]
        ]);

        return redirect()->route('pemilik.index')->with('success', 'pemilik berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        try {
            $pemilik->delete();
            return redirect()->route('penyewa.index')->with('danger', 'Data Pembeli berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penyewa.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
    public function getKabupaten($provinsiId)
    {
        // Cari provinsi berdasarkan ID untuk mendapatkan kode provinsi
        $province = Province::find($provinsiId);

        // Jika provinsi ditemukan, cari kabupaten berdasarkan kode provinsi
        if ($province) {
            $provinceCode = $province->code;
            $cities = City::where('province_code', $provinceCode)->get(['code', 'name']);
            return response()->json($cities);
        } else {
            // Jika tidak ditemukan, kembalikan pesan error
            return response()->json(['error' => 'Provinsi tidak ditemukan'], 404);
        }
    }

    public function getKecamatan($cityCode)
    {
        // Mengambil data kecamatan berdasarkan city_code
        $districts = District::where('city_code', $cityCode)->get(['code', 'name']);
        return response()->json($districts);
    }

    public function getKelurahan($districtCode)
    {
        // Mengambil data kelurahan berdasarkan district_code
        $villages = Village::where('district_code', $districtCode)->get(['id', 'name']);
        return response()->json($villages);
    }
}
