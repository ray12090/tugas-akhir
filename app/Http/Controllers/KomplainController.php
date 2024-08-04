<?php

namespace App\Http\Controllers;

use App\Models\Komplain;
use App\Models\Unit;
use App\Models\JenisKomplain;
use App\Models\LokasiKomplain;
use App\Models\StatusKomplain;
use App\Models\User;
use App\Models\Penanganan;
use App\Http\Requests\StoreKomplainRequest;
use App\Http\Requests\UpdateKomplainRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nomor_laporan');
        $sort_order = $request->input('sort_order', 'desc');

        $komplains = Komplain::with('unit', 'jenisKomplain', 'lokasiKomplains')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_laporan', 'like', "%{$search}%")
                    ->orWhere('tanggal_laporan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhereHas('unit', function ($query) use ($search) {
                        $query->where('nama_unit', 'like', "%{$search}%");
                    })
                    ->orWhereHas('jenisKomplain', function ($query) use ($search) {
                        $query->where('nama_jenis_komplain', 'like', "%{$search}%");
                    })
                    ->orWhereHas('lokasiKomplains', function ($query) use ($search) {
                        $query->where('nama_lokasi_komplain', 'like', "%{$search}%");
                    });
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
        $users = User::whereNotIn('tipe_user_id', [11, 12])->get();
        return view('komplain.komplain-create', compact('units', 'jenisKomplains', 'lokasiKomplains', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nomorLaporan = Komplain::generateNomorLaporan();
        $request->validate([
            'jenis_komplain_id' => 'required|exists:jenis_komplains,id',
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'nama_pelapor' => 'required|string',
            'no_hp' => 'required|string',
            'lokasi_komplain.*.lokasi_id' => 'required|exists:lokasi_komplains,id',
            'users_id' => 'nullable|array',
            'users_id.*' => 'exists:users,id',
        ]);

        $komplain = Komplain::create([
            'jenis_komplain_id' => $request->jenis_komplain_id,
            'nomor_laporan' => $nomorLaporan,
            'tanggal_laporan' => $request->tanggal_laporan,
            'unit_id' => $request->unit_id,
            'nama_pelapor' => $request->nama_pelapor,
            'no_hp' => $request->no_hp,
        ]);

        if ($request->has('lokasi_komplain')) {
            foreach ($request->lokasi_komplain as $index => $data) {
                $uraian = $data['uraian_komplain'] ?? null;
                $fotoPath = null;
                $lokasiId = $data['lokasi_id']; // Ambil lokasi_id dari array

                // Menggunakan $index untuk mengakses file dalam array multidimensi
                if ($request->hasFile("lokasi_komplain.$index.foto_komplain")) {
                    $image = $request->file("lokasi_komplain.$index.foto_komplain");
                    $image->storeAs('public/foto_komplain', $image->hashName());
                    $fotoPath = $image->hashName();
                }

                DB::table('komplain_lokasi_pivot')->insert([
                    'komplain_id' => $komplain->id,
                    'lokasi_komplain_id' => $lokasiId,
                    'uraian_komplain' => $uraian,
                    'foto_komplain' => $fotoPath,
                ]);

                // Buat penanganan untuk setiap lokasi komplain
                $nomorPenanganan = Penanganan::generateFreshNomorPenanganan();
                $penanganan = Penanganan::create([
                    'komplain_id' => $komplain->id,
                    'lokasi_komplain_id' => $lokasiId,
                    'nomor_penanganan' => $nomorPenanganan,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                ]);

                if ($request->has('users_id')) {
                    $penanganan->users()->sync($request->users_id);
                }
            }
        }

        if (Auth::user()->tipe_user_id != 11 && Auth::user()->tipe_user_id != 12) {
            return redirect()->route('komplain.index')->with('success', 'Komplain berhasil ditambahkan');
        }
        return redirect()->route('dashboard')->with('success', 'Komplain berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $komplain = Komplain::with('lokasiKomplains')->findOrFail($id);
        $jenisKomplains = JenisKomplain::all();
        $statusKomplains = StatusKomplain::all();
        $units = Unit::all();
        $lokasiKomplains = LokasiKomplain::all();
        $jenisKomplains = JenisKomplain::all();
        return view('komplain.komplain-read', compact('komplain', 'jenisKomplains', 'statusKomplains', 'units', 'lokasiKomplains'));
    }

    public function edit($id)
    {
        $komplain = Komplain::with('lokasiKomplains')->findOrFail($id);
        $jenisKomplains = JenisKomplain::all();
        $statusKomplains = StatusKomplain::all();
        $units = Unit::all();
        $lokasiKomplains = LokasiKomplain::all();
        return view('komplain.komplain-edit', compact('komplain', 'jenisKomplains', 'statusKomplains', 'units', 'lokasiKomplains'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nomor_laporan' => 'required|string|unique:komplains,nomor_laporan,' . $id,
            'tanggal_laporan' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'jenis_komplain_id' => 'required|exists:jenis_komplains,id',
            'status_komplain_id' => 'required|exists:status_komplains,id',
            'nama_pelapor' => 'required|string',
            'no_hp' => 'required|string',
            'lokasi_komplain.*.lokasi_komplain_id' => 'required|exists:lokasi_komplains,id',
            'lokasi_komplain.*.uraian_komplain' => 'nullable|string',
            'lokasi_komplain.*.foto_komplain' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data komplain
        $komplain = Komplain::findOrFail($id);
        $komplain->update($request->only([
            'nomor_laporan', 'tanggal_laporan', 'unit_id',
            'jenis_komplain_id', 'status_komplain_id', 'nama_pelapor', 'no_hp'
        ]));

        // Proses data lokasi komplain
        $lokasiKomplainData = [];
        foreach ($request->input('lokasi_komplain') as $index => $lokasi) {
            $lokasiId = $lokasi['lokasi_komplain_id'];
            $pivotData = [
                'uraian_komplain' => $lokasi['uraian_komplain'] ?? null,
            ];

            // Jika ada file foto baru, upload dan update nama file
            if ($request->hasFile("lokasi_komplain.$index.foto_komplain")) {
                $image = $request->file("lokasi_komplain.$index.foto_komplain");
                $imagePath = $image->storeAs('public/foto_komplain', $image->hashName());
                $pivotData['foto_komplain'] = $image->hashName();
            } else {
                // Jika tidak ada foto baru, pertahankan foto lama
                $existingPivot = $komplain->lokasiKomplains()->where('lokasi_komplain_id', $lokasiId)->first();
                if ($existingPivot) {
                    $pivotData['foto_komplain'] = $existingPivot->pivot->foto_komplain;
                }
            }

            $lokasiKomplainData[$lokasiId] = $pivotData;
        }

        // Update atau attach lokasi komplain
        foreach ($lokasiKomplainData as $lokasiId => $pivotData) {
            if ($komplain->lokasiKomplains()->where('lokasi_komplain_id', $lokasiId)->exists()) {
                $komplain->lokasiKomplains()->updateExistingPivot($lokasiId, $pivotData);
            } else {
                $komplain->lokasiKomplains()->attach($lokasiId, $pivotData);
            }
        }

        return redirect()->route('komplain.index')->with('success', 'Data komplain berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komplain $komplain)
    {
        try {
            $komplain->delete();
            return redirect()->route('komplain.index')->with('success', 'Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('komplain.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
    public function getUnits($unit)
    {
        $units = Unit::where('id', $unit)->get();
        return response()->json(['id' => $units]);
    }
}
