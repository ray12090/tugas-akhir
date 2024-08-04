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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if (Auth::user()->tipe_user_id == 1 || Auth::user()->tipe_user_id == 2 || Auth::user()->tipe_user_id == 3) {
            return view('pemilik.pemilik', compact('pemiliks', 'sort_by', 'sort_order'));
        } else {
            return redirect('/dashboard');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemiliks = Pemilik::all();
        $units = Unit::all();
        $pemilik_units_ids = Pemilik::with('unit')->get()->pluck('unit.id')->flatten()->toArray();
        $detailKewarganegaraans = DetailKewarganegaraan::all();
        $detailAgamas = DetailAgama::all();
        $detailPerkawinans = DetailPerkawinan::all();
        $detailTempatLahir = City::all();
        $users = User::all();

        $detailAlamatProvinsi = Province::all();
        $detailAlamatKabupaten = City::all();
        $detailAlamatKecamatan = District::all();
        return view('pemilik.pemilik-create', compact('pemiliks', 'units', 'detailKewarganegaraans', 'detailAgamas', 'detailPerkawinans', 'detailTempatLahir', 'users', 'detailAlamatProvinsi', 'detailAlamatKabupaten', 'detailAlamatKecamatan', 'pemilik_units_ids'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:pemiliks,nik',
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'tempat_lahir_id' => 'required|exists:cities,id',
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat_village_id' => 'required|exists:villages,id',
            'alamat_kecamatan_id' => 'required|exists:districts,id',
            'alamat_kabupaten_id' => 'required|exists:cities,id',
            'alamat_provinsi_id' => 'required|exists:provinces,id',
            'unit_id.*.unit_id' => 'required|exists:units,id',
            'unit_id.*.awal_huni' => 'required|date',
            'unit_id.*.akhir_huni' => 'nullable|date|after:unit_id.*.awal_huni',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat pemilik baru
        $pemilik = Pemilik::create([
            'nik' => $request->input('nik'),
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
            'alamat_kecamatan_id' => $request->input('alamat_kecamatan_id'),
            'alamat_kabupaten_id' => $request->input('alamat_kabupaten_id'),
            'alamat_provinsi_id' => $request->input('alamat_provinsi_id'),
        ]);

        if ($request->has('unit_id')) {
            foreach ($request->unit_id as $index => $data) {
                $awal_huni = $data['awal_huni'] ?? null;
                $akhir_huni = $data['akhir_huni'] ?? null;
                $unitId = $data['unit_id'];

                DB::table('pemilik_units')->insert([
                    'pemilik_id' => $pemilik->id,
                    'unit_id' => $unitId,
                    'awal_huni' => $awal_huni,
                    'akhir_huni' => $akhir_huni,
                ]);
            }
        }

        if (Auth::user()->tipe_user_id == 11) {
            return redirect('/dashboard')->with('success', 'Datamu berhasil ditambah.');
        } else {
            return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
        }
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemilik = Pemilik::with('unit', 'detailKewarganegaraan', 'detailAgama', 'detailPerkawinan', 'detailTempatLahir', 'user', 'detailAlamatVillages', 'detailAlamatKecamatan', 'detailAlamatKabupaten', 'detailAlamatProvinsi')->findOrFail($id);
        return view('pemilik.pemilik-read', compact('pemilik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemilik = Pemilik::with('unit')->findOrFail($id);
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

        // Ambil id unit yang sudah dipilih oleh pemilik
        $selectedUnitIds = $pemilik->unit->pluck('id')->toArray();

        return view(
            'pemilik.pemilik-update',
            compact(
                'pemilik',
                'units',
                'detailKewarganegaraans',
                'detailAgamas',
                'detailPerkawinans',
                'detailTempatLahir',
                'users',
                'detailAlamatVillages',
                'detailAlamatProvinsi',
                'detailAlamatKabupaten',
                'detailAlamatKecamatan',
                'selectedUnitIds' // Ditambahkan untuk di view
            )
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:20|unique:pemiliks,nik,' . $id,
            'warga_negara_id' => 'required|exists:detail_kewarganegaraans,id',
            'agama_id' => 'required|exists:detail_agamas,id',
            'perkawinan_id' => 'required|exists:detail_perkawinans,id',
            'user_id' => 'nullable|exists:users,id',
            'nama_pemilik' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir_id' => 'required|exists:villages,id',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'alamat_village_id' => 'required|exists:villages,id',
            'alamat_kecamatan_id' => 'required|exists:districts,id',
            'alamat_kabupaten_id' => 'required|exists:cities,id',
            'alamat_provinsi_id' => 'required|exists:provinces,id',
            'units.*.unit_id' => 'required|exists:units,id',
            'units.*.awal_huni' => 'required|date',
            'units.*.akhir_huni' => 'nullable|date|after:units.*.awal_huni',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data pemilik
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update($request->only([
            'nik',
            'warga_negara_id',
            'agama_id',
            'perkawinan_id',
            'user_id',
            'nama_pemilik',
            'no_hp',
            'tempat_lahir_id',
            'tanggal_lahir',
            'alamat',
            'jenis_kelamin',
            'alamat_village_id',
            'alamat_kecamatan_id',
            'alamat_kabupaten_id',
            'alamat_provinsi_id'
        ]));

        // Update data unit
        $unitData = [];
        if ($request->has('units')) {
            foreach ($request->input('units') as $unit) {
                $unitData[$unit['unit_id']] = [
                    'awal_huni' => $unit['awal_huni'],
                    'akhir_huni' => $unit['akhir_huni'],
                ];
            }
            $pemilik->unit()->syncWithoutDetaching($unitData);
        }

        return redirect()->route('pemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        try {
            $pemilik->delete();
            return redirect()->route('pemilik.index')->with('success', 'Data pemilik berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pemilik.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
    public function getKabupaten($provinsiId)
    {
        // Cari provinsi berdasarkan ID untuk mendapatkan kode provinsi
        $province = Province::find($provinsiId);

        // Jika provinsi ditemukan, cari kabupaten berdasarkan kode provinsi
        if ($province) {
            $provinceCode = $province->code;
            $cities = City::where('province_code', $provinceCode)->get(['id', 'name']);
            return response()->json($cities);
        } else {
            // Jika tidak ditemukan, kembalikan pesan error
            return response()->json(['error' => 'Provinsi tidak ditemukan'], 404);
        }
    }
    public function getKecamatan($cityId)
    {
        // Cari city berdasarkan ID untuk mendapatkan kode city
        $city = City::find($cityId);

        // Jika city ditemukan, cari kecamatan berdasarkan kode city
        if ($city) {
            $cityCode = $city->code;
            $districts = District::where('city_code', $cityCode)->get(['id', 'name']);
            return response()->json($districts);
        } else {
            // Jika tidak ditemukan, kembalikan pesan error
            return response()->json(['error' => 'Kota tidak ditemukan'], 404);
        }
    }

    public function getKelurahan($districtId)
    {
        // Cari district berdasarkan ID untuk mendapatkan kode district
        $district = District::find($districtId);

        // Jika district ditemukan, cari kelurahan berdasarkan kode district
        if ($district) {
            $districtCode = $district->code;
            $villages = Village::where('district_code', $districtCode)->get(['id', 'name']);
            return response()->json($villages);
        } else {
            // Jika tidak ditemukan, kembalikan pesan error
            return response()->json(['error' => 'Kecamatan tidak ditemukan'], 404);
        }
    }

    public function getPemilikByNIK($nik)
    {
        $pemilik = Pemilik::where('nik', $nik)->first();

        if ($pemilik) {
            return response()->json($pemilik);
        } else {
            return response()->json(['message' => 'Pemilik tidak ditemukan'], 404);
        }
    }
}
