<?php

namespace App\Http\Controllers;


use App\Models\Ipl;
use App\Models\Unit;
use App\Models\detailTagihanAir;
use App\Models\detailBiayaAdmin;
use App\Models\detailTagihanAwal;
use App\Models\detailTitipanAir;
use App\Models\detailIuranPengelolaan;
use App\Models\detailDanaCadangan;
use App\Models\detailDenda;
use App\Models\detailTitipanPengelolaan;
use App\Models\detailBiayaAir;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
            'tagihan_awal_id' => 'nullable|numeric',
            'titipan_pengelolaan_id' => 'nullable|numeric',
            'titipan_air_id' => 'nullable|numeric',
            'iuran_pengelolaan_id' => 'nullable|numeric',
            'dana_cadangan_id' => 'nullable|numeric',
            'tagihan_air_id' => 'nullable|exists:detail_tagihan_airs,id',
            'pemakaian_air' => 'required|numeric|min:0',
            'tagihan_air' => 'required|numeric|min:0',
            'denda_id' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        DB::transaction(function () use ($request) {
            // Simpan data ke tabel detail_tagihan_airs
            $detailTagihanAir = detailTagihanAir::create([
                'biaya_air_id' => $request->biaya_air_id,
                'meter_air_awal' => $request->meter_air_awal,
                'meter_air_akhir' => $request->meter_air_akhir,
                'pemakaian_air' => $request->pemakaian_air,
                'tagihan_air' => $request->tagihan_air,
            ]);

            // Ambil biaya admin dari tabel detail_biaya_admin
            $biayaAdmin = detailBiayaAdmin::first()->biaya_admin;

            

            // Simpan bukti pembayaran jika ada
            if ($request->hasFile('foto_bukti_pembayaran')) {
                $fotoBuktiPembayaran = $request->file('foto_bukti_pembayaran');
                $fotoBuktiPembayaran->storeAs('public/bukti_pembayaran', $fotoBuktiPembayaran->hashName());
            } else {
                $fotoBuktiPembayaran = null;
            }

            // Simpan data ke dalam tabel `ipls`
            $ipl = Ipl::create([
                'nomor_invoice' => $request->nomor_invoice,
                'bulan_ipl' => $request->bulan_ipl,
                'tanggal_invoice' => $request->tanggal_invoice,
                'jatuh_tempo' => $request->jatuh_tempo,
                'unit_id' => $request->unit_id,
                'tagihan_awal_id' => $request->tagihan_awal_id,
                'titipan_pengelolaan_id' => $request->titipan_pengelolaan_id,
                'titipan_air_id' => $request->titipan_air_id,
                'iuran_pengelolaan_id' => $request->iuran_pengelolaan_id,
                'dana_cadangan_id' => $request->dana_cadangan_id,
                'tagihan_air_id' => $request->tagihan_air_id,
                'denda_id' => $request->denda_id,
                'total' => $request->totalAkhir,
                'foto_bukti_pembayaran' => $fotoBuktiPembayaran,
                'status' => $request->status,
            ]);

            // Simpan detail tagihan terkait
            if ($request->tagihan_awal_id) {
                detailTagihanAwal::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->tagihan_awal_id]
                );
            }

            if ($request->titipan_pengelolaan_id) {
                detailTitipanPengelolaan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->titipan_pengelolaan_id]
                );
            }

            if ($request->iuran_pengelolaan_id) {
                detailIuranPengelolaan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->iuran_pengelolaan_id]
                );
            }

            if ($request->titipan_air_id) {
                detailTitipanAir::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->titipan_air_id]
                );
            }

            if ($request->dana_cadangan_id) {
                detailDanaCadangan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->dana_cadangan_id]
                );
            }

            if ($request->tagihan_air_id) {
                detailTagihanAir::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->tagihan_air_id]
                );
            }

            if ($request->denda_id) {
                detailDenda::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->denda_id]
                );
            }
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
        return view('ipl.ipl-edit', compact('ipl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ipl $ipl): RedirectResponse
    {
        // Validasi input dari form
        $request->validate([
            'nomor_invoice' => 'required|string',
            'bulan_ipl' => 'required|string',
            'tanggal_invoice' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'tagihan_awal_id' => 'nullable|numeric',
            'titipan_pengelolaan_id' => 'nullable|numeric',
            'titipan_air_id' => 'nullable|numeric',
            'iuran_pengelolaan_id' => 'nullable|numeric',
            'dana_cadangan_id' => 'nullable|numeric',
            'tagihan_air_id' => 'nullable|exists:detail_tagihan_airs,id',
            'denda_id' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        DB::transaction(function () use ($request, $ipl) {
            // Perbarui atau buat data di tabel detail_tagihan_airs
            $detailTagihanAir = DetailTagihanAir::updateOrCreate(
                ['id' => $request->tagihan_air_id],
                [
                    'biaya_air_id' => $request->biaya_air_id,
                    'meter_air_awal' => $request->meter_air_awal,
                    'meter_air_akhir' => $request->meter_air_akhir,
                    'pemakaian_air' => $request->pemakaian_air,
                    'tagihan_air' => $request->tagihan_air,
                ]
            );

            // Ambil biaya admin dari tabel detail_biaya_admin
            $biayaAdmin = DetailBiayaAdmin::first()->biaya_admin;

            // Hitung total akhir
            $totalAkhir = ($request->tagihan_awal_id ?? 0) +
                ($request->titipan_pengelolaan_id ?? 0) +
                ($request->titipan_air_id ?? 0) +
                ($request->iuran_pengelolaan_id ?? 0) +
                ($request->dana_cadangan_id ?? 0) +
                $detailTagihanAir->tagihan_air +
                $biayaAdmin +
                ($request->denda_id ?? 0);

            // Prepare data for update
            $data = $request->only([
                'nomor_invoice',
                'bulan_ipl',
                'tanggal_invoice',
                'jatuh_tempo',
                'unit_id',
                'tagihan_awal_id',
                'titipan_pengelolaan_id',
                'titipan_air_id',
                'iuran_pengelolaan_id',
                'dana_cadangan_id',
                'tagihan_air_id',
                'denda_id',
                'status',
            ]);
            $data['total'] = $totalAkhir;

            // Handle file upload for foto_bukti_pembayaran
            if ($request->hasFile('foto_bukti_pembayaran')) {
                $image = $request->file('foto_bukti_pembayaran');
                $image->storeAs('public/bukti_pembayaran', $image->hashName());
                $data['foto_bukti_pembayaran'] = $image->hashName();
            }

            // Update IPL record
            $ipl->update($data);

            // Perbarui atau buat detail tagihan terkait
            if ($request->tagihan_awal_id) {
                DetailTagihanAwal::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->tagihan_awal_id]
                );
            }

            if ($request->titipan_pengelolaan_id) {
                DetailTitipanPengelolaan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->titipan_pengelolaan_id]
                );
            }

            if ($request->iuran_pengelolaan_id) {
                DetailIuranPengelolaan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->iuran_pengelolaan_id]
                );
            }

            if ($request->titipan_air_id) {
                DetailTitipanAir::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->titipan_air_id]
                );
            }

            if ($request->dana_cadangan_id) {
                DetailDanaCadangan::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->dana_cadangan_id]
                );
            }

            if ($request->tagihan_air_id) {
                DetailTagihanAir::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->tagihan_air_id]
                );
            }

            if ($request->denda_id) {
                DetailDenda::updateOrCreate(
                    ['ipl_id' => $ipl->id],
                    ['jumlah' => $request->denda_id]
                );
            }
        });

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ipl $ipl)
    {
        $invoiceNumber = $ipl->nomor_invoice;
        try {
            $ipl->delete();
            return redirect()->route('ipl.index')->with('danger', "Data IPL dengan nomor invoice {$invoiceNumber} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('ipl.index')->withErrors(['msg' => 'Error deleting IPL. Please try again.']);
        }
    }
}