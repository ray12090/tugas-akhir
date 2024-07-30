<?php

namespace App\Http\Controllers;

use App\Models\Ipl;
use App\Models\Unit;
use App\Models\detailTagihanAir;
use App\Models\detailBiayaAir;
use App\Models\detailBiayaAdmin;
use App\Models\detailJenisTagihan;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IplController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'jatuh_tempo');
        $sort_order = $request->input('sort_order', 'desc');

        $ipls = Ipl::with('unit', 'pemilik')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_invoice', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('pemilik', 'like', "%{$search}%")
                    ->orWhere('tanggal_invoice', 'like', "%{$search}%")
                    ->orWhere('jatuh_tempo', 'like', "%{$search}%")
                    ->orWhere('total', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('ipl.ipl', compact('ipls', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil no invoice terakhir
        $lastInvoice = Ipl::orderBy('id', 'desc')->first();
        $biaya_air = detailBiayaAir::orderBy('id', 'desc')->first();
        $biaya_admin = detailBiayaAdmin::orderBy('id', 'desc')->first();
        $pemiliks = Pemilik::all();
        $jenisTagihans = detailJenisTagihan::all();

        if ($lastInvoice) {
            // Extract the invoice number and increment it
            $lastInvoiceNumber = $lastInvoice->nomor_invoice;
            $nextInvoiceNumber = $this->generateNextInvoiceNumber($lastInvoiceNumber);
        } else {
            // If no invoices exist yet, start with a default number
            $nextInvoiceNumber = $this->generateInitialInvoiceNumber();
        }

        $units = Unit::all();
        return view('ipl.ipl-create', ['units' => $units, 'nextInvoiceNumber' => $nextInvoiceNumber, 'biaya_air' => $biaya_air, 'biaya_admin' => $biaya_admin, 'pemiliks' => $pemiliks, 'jenisTagihans' => $jenisTagihans]);
    }

    private function generateInitialInvoiceNumber()
    {
        $currentMonth = now()->format('m');
        $currentYear = now()->format('y');
        $initialNumber = '00001'; // Starting sequence number

        return "IPL/{$currentMonth}/{$currentYear}/{$initialNumber}";
    }

    private function generateNextInvoiceNumber($lastInvoiceNumber)
    {
        // Extract parts of the last invoice number
        $parts = explode('/', $lastInvoiceNumber);
        $lastNumber = end($parts);

        // Increment the numeric part of the invoice number
        $nextNumber = str_pad((int) $lastNumber + 1, 5, '0', STR_PAD_LEFT);

        // Get the current month and year
        $currentMonth = now()->format('m');
        $currentYear = now()->format('y');

        return "IPL/{$currentMonth}/{$currentYear}/{$nextNumber}";
    }

    public function getUnitsByPemilik($pemilikId)
    {
        // Ambil unit berdasarkan pemilik_id dari tabel pivot, dengan mempertimbangkan akhir_huni null atau lebih besar dari tanggal hari ini
        $units = DB::table('units')
            ->join('pemilik_units', 'units.id', '=', 'pemilik_units.unit_id')
            ->where('pemilik_units.pemilik_id', $pemilikId)
            ->where(function ($query) {
                $query->whereNull('pemilik_units.akhir_huni')
                    ->orWhere('pemilik_units.akhir_huni', '>', now());
            })
            ->select('units.id', 'units.nama_unit') // pastikan 'nama_unit' adalah nama kolom yang benar untuk unit
            ->get();

        // Return response as JSON
        return response()->json(['units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nomor_invoice' => 'required|string',
            'bulan_ipl' => 'required|string',
            'tanggal_invoice' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
            'meter_air_awal' => 'required|numeric|min:0',
            'meter_air_akhir' => 'required|numeric|min:0|gte:meter_air_awal',
            'biaya_admin_id' => 'required|exists:detail_biaya_admins,id',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
            'jenis_tagihan.*.jenis_tagihan_id' => 'required|exists:detail_jenis_tagihans,id',
            'jenis_tagihan.*.jumlah' => 'required|numeric|min:0',
        ]);

        // Hitung pemakaian dan tagihan air
        $pemakaian_air = $request->meter_air_akhir - $request->meter_air_awal;
        $biaya_air = detailBiayaAir::find($request->biaya_air_id)->biaya_air;
        $tagihan_air = $pemakaian_air * $biaya_air;

        DB::transaction(function () use ($request, $pemakaian_air, $tagihan_air) {
            // Simpan data ke tabel detail_tagihan_airs
            $detailTagihanAir = detailTagihanAir::create([
                'biaya_air_id' => $request->biaya_air_id,
                'meter_air_awal' => $request->meter_air_awal,
                'meter_air_akhir' => $request->meter_air_akhir,
                'pemakaian_air' => $pemakaian_air,
                'tagihan_air' => $tagihan_air,
            ]);

            // Proses masing-masing detail tagihan
            $totalDetailTagihan = 0;
            foreach ($request->jenis_tagihan as $tagihan) {
                $totalDetailTagihan += $tagihan['jumlah'];
            }
            // Ambil biaya admin dari tabel detail_biaya_admin
            $biayaAdmin = $request->biaya_admin_id ? detailBiayaAdmin::find($request->biaya_admin_id)->biaya_admin : 0;

            // Hitung total akhir
            $totalAkhir = $totalDetailTagihan + $tagihan_air + $biayaAdmin;
            // Simpan bukti pembayaran jika ada
            $fotoBuktiPembayaran = null;
            if ($request->hasFile('foto_bukti_pembayaran')) {
                $foto = $request->file('foto_bukti_pembayaran');
                $foto->storeAs('public/bukti_pembayaran', $foto->hashName());
                $fotoBuktiPembayaran = $foto->hashName();
            }

            // Simpan data ke dalam tabel `ipls`
            $ipl = Ipl::create([
                'nomor_invoice' => $request->nomor_invoice,
                'bulan_ipl' => $request->bulan_ipl,
                'tanggal_invoice' => $request->tanggal_invoice,
                'jatuh_tempo' => $request->jatuh_tempo,
                'unit_id' => $request->unit_id,
                'pemilik_id' => $request->pemilik_id,
                'tagihan_air_id' => $detailTagihanAir->id,
                'biaya_admin_id' => $request->biaya_admin_id,
                'total' => $totalAkhir,
                'foto_bukti_pembayaran' => $fotoBuktiPembayaran,
                'status' => $request->status,
            ]);
            foreach ($request->jenis_tagihan as $tagihan) {
                DB::table('ipl_jenis_tagihans_pivot')->insert([
                    'ipl_id' => $ipl->id,
                    'jenis_tagihan_id' => $tagihan['jenis_tagihan_id'],
                    'jumlah' => $tagihan['jumlah'],
                ]);
            }
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Ipl $ipl)
    {
        $detailTagihanAir = detailTagihanAir::find($ipl->tagihan_air_id);
        $detailTagihans = DB::table('ipl_jenis_tagihans_pivot')->where('ipl_id', $ipl->id)->get();
        $biaya_air = detailBiayaAir::orderBy('id', 'desc')->first();
        $biaya_admin = detailBiayaAdmin::orderBy('id', 'desc')->first();
        $pemiliks = Pemilik::all();
        $jenisTagihans = detailJenisTagihan::all();
        return view('ipl.ipl-read', compact('ipl', 'detailTagihanAir', 'detailTagihans', 'biaya_air', 'biaya_admin', 'pemiliks', 'jenisTagihans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ipl $ipl)
    {
        $biaya_air = detailBiayaAir::orderBy('id', 'desc')->first();
        $biaya_admin = detailBiayaAdmin::orderBy('id', 'desc')->first();
        $pemiliks = Pemilik::all();
        $jenisTagihans = detailJenisTagihan::all();
        $detailTagihanAir = detailTagihanAir::find($ipl->tagihan_air_id);
        $detailTagihans = DB::table('ipl_jenis_tagihans_pivot')->where('ipl_id', $ipl->id)->get();

        $units = Unit::all();
        return view('ipl.ipl-edit', compact('ipl', 'units', 'biaya_air', 'biaya_admin', 'pemiliks', 'jenisTagihans', 'detailTagihanAir', 'detailTagihans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'nomor_invoice' => 'required|string',
            'bulan_ipl' => 'required|string',
            'tanggal_invoice' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
            'meter_air_awal' => 'required|numeric|min:0',
            'meter_air_akhir' => 'required|numeric|min:0|gte:meter_air_awal',
            'biaya_admin_id' => 'required|exists:detail_biaya_admins,id',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
            'jenis_tagihan.*.jenis_tagihan_id' => 'required|exists:detail_jenis_tagihans,id',
            'jenis_tagihan.*.jumlah' => 'required|numeric|min:0',
        ]);

        // Cari data IPL berdasarkan ID
        $ipl = Ipl::findOrFail($id);

        // Hitung pemakaian dan tagihan air
        $pemakaian_air = $request->meter_air_akhir - $request->meter_air_awal;
        $biaya_air = detailBiayaAir::find($request->biaya_air_id)->biaya_air;
        $tagihan_air = $pemakaian_air * $biaya_air;

        DB::transaction(function () use ($request, $ipl, $pemakaian_air, $tagihan_air) {
            // Update data di tabel detail_tagihan_airs
            $detailTagihanAir = detailTagihanAir::updateOrCreate(
                ['id' => $ipl->tagihan_air_id],
                [
                    'biaya_air_id' => $request->biaya_air_id,
                    'meter_air_awal' => $request->meter_air_awal,
                    'meter_air_akhir' => $request->meter_air_akhir,
                    'pemakaian_air' => $pemakaian_air,
                    'tagihan_air' => $tagihan_air,
                ]
            );

            // Update masing-masing detail tagihan
            $totalDetailTagihan = 0;
            DB::table('ipl_jenis_tagihans_pivot')->where('ipl_id', $ipl->id)->delete();
            foreach ($request->jenis_tagihan as $tagihan) {
                DB::table('ipl_jenis_tagihans_pivot')->insert([
                    'ipl_id' => $ipl->id,
                    'jenis_tagihan_id' => $tagihan['jenis_tagihan_id'],
                    'jumlah' => $tagihan['jumlah'],
                ]);
                $totalDetailTagihan += $tagihan['jumlah'];
            }

            // Ambil biaya admin dari tabel detail_biaya_admin
            $biayaAdmin = $request->biaya_admin_id ? detailBiayaAdmin::find($request->biaya_admin_id)->biaya_admin : 0;

            // Hitung total akhir
            $totalAkhir = $totalDetailTagihan + $tagihan_air + $biayaAdmin;

            // Update bukti pembayaran jika ada
            $fotoBuktiPembayaran = $ipl->foto_bukti_pembayaran;
            if ($request->hasFile('foto_bukti_pembayaran')) {
                if ($fotoBuktiPembayaran) {
                    Storage::delete('public/bukti_pembayaran/' . $fotoBuktiPembayaran);
                }
                $foto = $request->file('foto_bukti_pembayaran');
                $foto->storeAs('public/bukti_pembayaran', $foto->hashName());
                $fotoBuktiPembayaran = $foto->hashName();
            }

            // Update data di tabel `ipls`
            $ipl->update([
                'nomor_invoice' => $request->nomor_invoice,
                'bulan_ipl' => $request->bulan_ipl,
                'tanggal_invoice' => $request->tanggal_invoice,
                'jatuh_tempo' => $request->jatuh_tempo,
                'unit_id' => $request->unit_id,
                'pemilik_id' => $request->pemilik_id,
                'tagihan_air_id' => $detailTagihanAir->id,
                'biaya_admin_id' => $request->biaya_admin_id,
                'total' => $totalAkhir,
                'foto_bukti_pembayaran' => $fotoBuktiPembayaran,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil diperbarui.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            // Temukan data IPL berdasarkan ID
            $ipl = Ipl::findOrFail($id);

            // Hapus data terkait di tabel detail_tagihan_airs
            detailTagihanAir::where('id', $ipl->tagihan_air_id)->delete();

            // Hapus data terkait di tabel pivot untuk jenis tagihan
            DB::table('ipl_jenis_tagihans_pivot')->where('ipl_id', $ipl->id)->delete();

            // Hapus file bukti pembayaran jika ada
            if ($ipl->foto_bukti_pembayaran) {
                Storage::delete('public/bukti_pembayaran/' . $ipl->foto_bukti_pembayaran);
            }

            // Hapus data utama dari tabel `ipls`
            $ipl->delete();
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil dihapus.');
    }
}
