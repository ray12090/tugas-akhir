<?php

namespace App\Http\Controllers;

use App\Models\Penanganan;
use Illuminate\Http\Request;
use App\Models\Komplain;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPenanganan;
use Illuminate\Http\RedirectResponse;

class PenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_penanganan');
        $sort_order = $request->input('sort_order', 'desc');
        $user = auth()->user();

        $penanganans = Penanganan::with(['komplain', 'kategoriPenanganan', 'createdBy', 'updatedBy'])
            ->when($search, function ($query, $search) {
                return $query->where('nomor_penanganan', 'like', "%{$search}%")
                    ->orWhereHas('komplain', function ($query) use ($search) {
                        $query->where('nomor_laporan', 'like', "%{$search}%");
                    })
                    ->orWhere('tanggal_penanganan', 'like', "%{$search}%")
                    ->orWhereHas('createdBy', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('updatedBy', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($user->usertype !== 'tr' && $user->usertype !== 'admin', function ($query) use ($user) {
                return $query->whereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('penanganan.penanganan', compact('penanganans', 'sort_by', 'sort_order'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $komplains = Komplain::all();
        $users = User::all();
        $kategoriPenanganans = KategoriPenanganan::all();

        $groupedUsers = $users->groupBy('usertype');

        return view('penanganan.penanganan-create', compact('komplains', 'users', 'kategoriPenanganans', 'groupedUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $nomorPenanganan = Penanganan::generateNomorPenanganan();
        $validatedData = $request->validate([
            'komplain_id' => 'required',
            // 'nomor_penanganan' => 'required|string|max:255',
            'tanggal_penanganan' => 'required|date',
            'time' => 'required',
            'kategori_penanganan_id' => 'nullable|array',
            'kategori_penanganan_id.*' => 'exists:kategori_penanganans,id',
            'respon_awal' => 'nullable|string',
            'pemeriksaan_awal' => 'nullable|string',
            'penyelesaian_komplain' => 'nullable|string',
            'foto_pemeriksaan_awal' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'foto_hasil_perbaikan' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $penanganan = Penanganan::create([
            'komplain_id' => $validatedData['komplain_id'],
            'nomor_penanganan' => $nomorPenanganan,
            'tanggal_penanganan' => $validatedData['tanggal_penanganan'] . ' ' . $validatedData['time'],
            'respon_awal' => $validatedData['respon_awal'],
            'pemeriksaan_awal' => $validatedData['pemeriksaan_awal'],
            'penyelesaian_komplain' => $validatedData['penyelesaian_komplain'],
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        if ($request->hasFile('foto_pemeriksaan_awal')) {
            $image = $request->file('foto_pemeriksaan_awal');
            $image->storeAs('public/foto_pemeriksaan_awal', $image->hashName());
            $penanganan['foto_pemeriksaan_awal'] = $image->hashName();
        }

        if ($request->hasFile('foto_hasil_perbaikan')) {
            $image = $request->file('foto_hasil_perbaikan');
            $image->storeAs('public/foto_hasil_perbaikan', $image->hashName());
            $penanganan['foto_hasil_perbaikan'] = $image->hashName();
        }

        if ($request->has('kategori_penanganan_id')) {
            $penanganan->kategoriPenanganan()->sync($request->kategori_penanganan_id);
        }

        if ($request->has('users_id')) {
            $penanganan->users()->sync($request->users_id);
        }

        $penanganan->save();

        return redirect()->route('penanganan.index')->with('success', 'Penanganan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penanganan $penanganan)
    {
        $users = User::all();
        $groupedUsers = $users->groupBy('usertype');
        // $penanganan = Penanganan::with('komplains', 'kategoriPenanganans', 'users')->findOrFail($id);
        return view('penanganan.penanganan-read', compact('penanganan', 'groupedUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penanganan = Penanganan::with('kategoriPenanganan', 'users', 'komplain')->findOrFail($id);
        $komplains = Komplain::all();
        $kategoriPenanganans = KategoriPenanganan::all();
        $groupedUsers = User::all()->groupBy('usertype');

        return view('penanganan.penanganan-edit', compact('penanganan', 'komplains', 'kategoriPenanganans', 'groupedUsers'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_penanganan' => 'required|unique:penanganans,nomor_penanganan,' . $id,
            'komplain_id' => 'required',
            'tanggal_penanganan' => 'required|date',
            'time' => 'required|date_format:H:i',
            'kategori_penanganan_id' => 'nullable|array',
            'kategori_penanganan_id.*' => 'exists:kategori_penanganans,id',
            'users_id' => 'nullable|array',
            'users_id.*' => 'exists:users,id',
            'respon_awal' => 'nullable|string',
            'pemeriksaan_awal' => 'nullable|string',
            'penyelesaian_komplain' => 'nullable|string',
            'foto_pemeriksaan_awal' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'foto_hasil_perbaikan' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'persetujuan_selesai_tr' => 'nullable|boolean',
            'persetujuan_selesai_pelaksana' => 'nullable|boolean',
        ]);

        $penanganan = Penanganan::findOrFail($id);
        $penanganan->fill($request->except('time', 'kategori_penanganan_id', 'users_id'));
        $penanganan->tanggal_penanganan = \Carbon\Carbon::parse($request->tanggal_penanganan . ' ' . $request->time);
        $penanganan->updated_by = Auth::user()->id;

        if ($request->hasFile('foto_pemeriksaan_awal')) {
            $image = $request->file('foto_pemeriksaan_awal');
            $image->storeAs('public/foto_pemeriksaan_awal', $image->hashName());
            $penanganan['foto_pemeriksaan_awal'] = $image->hashName();
        }

        if ($request->hasFile('foto_hasil_perbaikan')) {
            $image = $request->file('foto_hasil_perbaikan');
            $image->storeAs('public/foto_hasil_perbaikan', $image->hashName());
            $penanganan['foto_hasil_perbaikan'] = $image->hashName();
        }

        $penanganan->save();

        if (is_array($request->kategori_penanganan_id)) {
            $penanganan->kategoriPenanganan()->sync($request->kategori_penanganan_id);
        }

        if (is_array($request->users_id)) {
            $penanganan->users()->sync($request->users_id);
        }
        // dd($penanganan);

        return redirect()->route('penanganan.index')->with('success', 'Penanganan berhasil diubah.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penanganan $penanganan)
    {
        try {
            $penanganan->delete();
            return redirect()->route('penanganan.index')->with('danger', 'Penanganan Komplain berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penanganan.index')->withErrors(['msg' => 'Error deleting komplain. Please try again.']);
        }
    }
}
