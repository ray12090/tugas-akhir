<?php

namespace App\Http\Controllers;

use App\Models\Ipl;
use App\Models\Unit;
use App\Models\detailTagihanAir;
use App\Models\detailTagihanAwal;
use App\Models\detailTitipanAir;
use App\Models\detailIuranPengelolaan;
use App\Models\detailDanaCadangan;
use App\Models\detailDenda;
use App\Models\detailTitipanPengelolaan;
use App\Models\detailBiayaAir;
use App\Models\detailBiayaAdmin;
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
            ->paginate(5);

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

        if ($lastInvoice) {
            // Extract the invoice number and increment it
            $lastInvoiceNumber = $lastInvoice->nomor_invoice;
            $nextInvoiceNumber = $this->generateNextInvoiceNumber($lastInvoiceNumber);
        } else {
            // If no invoices exist yet, start with a default number
            $nextInvoiceNumber = $this->generateInitialInvoiceNumber();
        }

        $units = Unit::all();
        return view('ipl.ipl-create', ['units' => $units, 'nextInvoiceNumber' => $nextInvoiceNumber, 'biaya_air' => $biaya_air, 'biaya_admin' => $biaya_admin, 'pemiliks' => $pemiliks]);
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
            'tagihan_awal_id' => 'nullable|numeric',
            'titipan_pengelolaan_id' => 'nullable|numeric',
            'titipan_air_id' => 'nullable|numeric',
            'iuran_pengelolaan_id' => 'nullable|numeric',
            'dana_cadangan_id' => 'nullable|numeric',
            'tagihan_air_id' => 'nullable|exists:detail_tagihan_airs,id',
            'meter_air_awal' => 'required|numeric|min:0',
            'meter_air_akhir' => 'required|numeric|min:0|gte:meter_air_awal',
            'denda_id' => 'nullable|numeric',
            'biaya_admin_id' => 'required|exists:detail_biaya_admins,id',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
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

            $detailTagihanAwal = detailTagihanAwal::create([
                'jumlah' => $request->tagihan_awal,
            ]);

            $detailTitipanPengelolaan = detailTitipanPengelolaan::create([
                'jumlah' => $request->titipan_pengelolaan,
            ]);

            $detailTitipanAir = detailTitipanAir::create([
                'jumlah' => $request->titipan_air,
            ]);

            $detailIuranPengelolaan = detailIuranPengelolaan::create([
                'jumlah' => $request->iuran_pengelolaan,
            ]);

            $detailDanaCadangan = detailDanaCadangan::create([
                'jumlah' => $request->dana_cadangan,
            ]);

            $detailDenda = detailDenda::create([
                'jumlah' => $request->denda,
            ]);

            // Ambil biaya admin dari tabel detail_biaya_admin
            $detailBiayaAdmin = $request->biaya_admin_id ? detailBiayaAdmin::find($request->biaya_admin_id) : null;

            // Hitung total akhir
            $totalAkhir = ($detailTagihanAwal ? $detailTagihanAwal->jumlah : 0) +
                ($detailTitipanPengelolaan ? $detailTitipanPengelolaan->jumlah : 0) +
                ($detailTitipanAir ? $detailTitipanAir->jumlah : 0) +
                ($detailIuranPengelolaan ? $detailIuranPengelolaan->jumlah : 0) +
                ($detailDanaCadangan ? $detailDanaCadangan->jumlah : 0) +
                $tagihan_air +
                ($detailBiayaAdmin ? $detailBiayaAdmin->biaya_admin : 0) +
                ($detailDenda ? $detailDenda->jumlah : 0);

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
                'tagihan_awal_id' => $detailTagihanAwal ? $detailTagihanAwal->id : null,
                'titipan_pengelolaan_id' => $detailTitipanPengelolaan ? $detailTitipanPengelolaan->id : null,
                'titipan_air_id' => $detailTitipanAir ? $detailTitipanAir->id : null,
                'iuran_pengelolaan_id' => $detailIuranPengelolaan ? $detailIuranPengelolaan->id : null,
                'dana_cadangan_id' => $detailDanaCadangan ? $detailDanaCadangan->id : null,
                'tagihan_air_id' => $detailTagihanAir->id,
                'denda_id' => $detailDenda ? $detailDenda->id : null,
                'biaya_admin_id' => $request->biaya_admin_id,
                'total' => $totalAkhir,
                'foto_bukti_pembayaran' => $fotoBuktiPembayaran,
                'status' => $request->status,
            ]);
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ipl $ipl)
    {
        return view('ipl.ipl-read', compact('ipl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ipl $ipl)
    {
        $biaya_air = detailBiayaAir::orderBy('id', 'desc')->first();
        $biaya_admin = detailBiayaAdmin::orderBy('id', 'desc')->first();
        $pemiliks = Pemilik::all();

        $units = Unit::all();
        return view('ipl.ipl-edit', compact('ipl', 'units', 'biaya_air', 'biaya_admin', 'pemiliks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ipl $ipl)
    {
        // Validasi input dari form
        $request->validate([
            'nomor_invoice' => 'required|string',
            'bulan_ipl' => 'required|string',
            'tanggal_invoice' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
            'tagihan_awal_id' => 'nullable|numeric',
            'titipan_pengelolaan_id' => 'nullable|numeric',
            'titipan_air_id' => 'nullable|numeric',
            'iuran_pengelolaan_id' => 'nullable|numeric',
            'dana_cadangan_id' => 'nullable|numeric',
            'tagihan_air_id' => 'nullable|exists:detail_tagihan_airs,id',
            'meter_air_awal' => 'required|numeric|min:0',
            'meter_air_akhir' => 'required|numeric|min:0|gte:meter_air_awal',
            'denda_id' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        // Hitung pemakaian dan tagihan air
        $pemakaian_air = $request->meter_air_akhir - $request->meter_air_awal;
        $biaya_air = detailBiayaAir::firstOrFail()->biaya_air;
        $tagihan_air = $pemakaian_air * $biaya_air;

        DB::transaction(function () use ($request, $ipl, $pemakaian_air, $tagihan_air) {
            // Update atau buat data di tabel detail_tagihan_airs
            $detailTagihanAir = detailTagihanAir::updateOrCreate(
                ['id' => $ipl->tagihan_air_id],
                [
                    'biaya_air_id' => $ipl->detailTagihanAir->biaya_air_id,
                    'meter_air_awal' => $request->meter_air_awal,
                    'meter_air_akhir' => $request->meter_air_akhir,
                    'pemakaian_air' => $pemakaian_air,
                    'tagihan_air' => $tagihan_air,
                ]
            );

            // Update atau buat data di tabel detail_tagihan_awals
            $detailTagihanAwal = detailTagihanAwal::updateOrCreate(
                ['id' => $ipl->tagihan_awal_id],
                ['jumlah' => $request->tagihan_awal]
            );

            // Update atau buat data di tabel detail_titipan_pengelolaans
            $detailTitipanPengelolaan = detailTitipanPengelolaan::updateOrCreate(
                ['id' => $ipl->titipan_pengelolaan_id],
                ['jumlah' => $request->titipan_pengelolaan]
            );

            // Update atau buat data di tabel detail_titipan_airs
            $detailTitipanAir = detailTitipanAir::updateOrCreate(
                ['id' => $ipl->titipan_air_id],
                ['jumlah' => $request->titipan_air]
            );

            // Update atau buat data di tabel detail_iuran_pengelolaans
            $detailIuranPengelolaan = detailIuranPengelolaan::updateOrCreate(
                ['id' => $ipl->iuran_pengelolaan_id],
                ['jumlah' => $request->iuran_pengelolaan]
            );

            // Update atau buat data di tabel detail_dana_cadangans
            $detailDanaCadangan = detailDanaCadangan::updateOrCreate(
                ['id' => $ipl->dana_cadangan_id],
                ['jumlah' => $request->dana_cadangan]
            );

            // Update atau buat data di tabel detail_dendas
            $detailDenda = detailDenda::updateOrCreate(
                ['id' => $ipl->denda_id],
                ['jumlah' => $request->denda]
            );

            // Ambil biaya admin dari tabel detail_biaya_admin
            $detailBiayaAdmin = detailBiayaAdmin::firstOrFail();

            // Hitung total akhir
            $totalAkhir = ($detailTagihanAwal ? $detailTagihanAwal->jumlah : 0) +
                ($detailTitipanPengelolaan ? $detailTitipanPengelolaan->jumlah : 0) +
                ($detailTitipanAir ? $detailTitipanAir->jumlah : 0) +
                ($detailIuranPengelolaan ? $detailIuranPengelolaan->jumlah : 0) +
                ($detailDanaCadangan ? $detailDanaCadangan->jumlah : 0) +
                $tagihan_air +
                $detailBiayaAdmin->biaya_admin +
                ($detailDenda ? $detailDenda->jumlah : 0);

            // Simpan bukti pembayaran jika ada
            $fotoBuktiPembayaran = $ipl->foto_bukti_pembayaran;
            if ($request->hasFile('foto_bukti_pembayaran')) {
                if ($fotoBuktiPembayaran) {
                    // Hapus foto lama jika ada
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
                'tagihan_awal_id' => $detailTagihanAwal ? $detailTagihanAwal->id : null,
                'titipan_pengelolaan_id' => $detailTitipanPengelolaan ? $detailTitipanPengelolaan->id : null,
                'titipan_air_id' => $detailTitipanAir ? $detailTitipanAir->id : null,
                'iuran_pengelolaan_id' => $detailIuranPengelolaan ? $detailIuranPengelolaan->id : null,
                'dana_cadangan_id' => $detailDanaCadangan ? $detailDanaCadangan->id : null,
                'tagihan_air_id' => $detailTagihanAir->id,
                'denda_id' => $detailDenda ? $detailDenda->id : null,
                'biaya_admin_id' => $detailBiayaAdmin->id,
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
            $ipl = Ipl::findOrFail($id);

            // Hapus data terkait di tabel detail
            detailTagihanAir::where('id', $ipl->tagihan_air_id)->delete();
            detailTagihanAwal::where('id', $ipl->tagihan_awal_id)->delete();
            detailTitipanPengelolaan::where('id', $ipl->titipan_pengelolaan_id)->delete();
            detailTitipanAir::where('id', $ipl->titipan_air_id)->delete();
            detailIuranPengelolaan::where('id', $ipl->iuran_pengelolaan_id)->delete();
            detailDanaCadangan::where('id', $ipl->dana_cadangan_id)->delete();
            detailDenda::where('id', $ipl->denda_id)->delete();

            // Hapus data utama
            $ipl->delete();
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil dihapus.');
    }

}

