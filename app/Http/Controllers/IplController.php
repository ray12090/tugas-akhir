<?php

namespace App\Http\Controllers;

use App\Models\Ipl;
use App\Models\Unit;
use App\Models\detailTagihanAir;
use App\Models\detailBiayaAdmin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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

        if ($lastInvoice) {
            // Extract the invoice number and increment it
            $lastInvoiceNumber = $lastInvoice->nomor_invoice;
            $nextInvoiceNumber = $this->generateNextInvoiceNumber($lastInvoiceNumber);
        } else {
            // If no invoices exist yet, start with a default number
            $nextInvoiceNumber = $this->generateInitialInvoiceNumber();
        }

        $units = Unit::all();
        return view('ipl.ipl-create', ['units' => $units, 'nextInvoiceNumber' => $nextInvoiceNumber]);
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
        $nextNumber = str_pad((int)$lastNumber + 1, 5, '0', STR_PAD_LEFT);

        // Get the current month and year
        $currentMonth = now()->format('m');
        $currentYear = now()->format('y');

        return "IPL/{$currentMonth}/{$currentYear}/{$nextNumber}";
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
            'denda_id' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        // Ambil data tagihan air dari detail_tagihan_airs
        $detailTagihanAir = detailTagihanAir::find($request->tagihan_air_id);
        $tagihanAir = $detailTagihanAir ? $detailTagihanAir->tagihan_air : 0;

        // Ambil biaya admin dari tabel detail_biaya_admin
        $biayaAdmin = detailBiayaAdmin::first()->biaya_admin;

        // Hitung total akhir
        $totalAkhir = ($request->tagihan_awal_id ?? 0) +
                    ($request->titipan_pengelolaan_id ?? 0) +
                    ($request->titipan_air_id ?? 0) +
                    ($request->iuran_pengelolaan_id ?? 0) +
                    ($request->dana_cadangan_id ?? 0) +
                    $tagihanAir +
                    $biayaAdmin +
                    ($request->denda_id ?? 0);

        // Simpan bukti pembayaran jika ada
        if ($request->hasFile('foto_bukti_pembayaran')) {
            $fotoBuktiPembayaran = $request->file('foto_bukti_pembayaran');
            $fotoBuktiPembayaran->storeAs('public/bukti_pembayaran', $fotoBuktiPembayaran->hashName());
        } else {
            $fotoBuktiPembayaran = null;
        }

        // Simpan data ke dalam tabel `ipls`
        Ipl::create([
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
            'total' => $totalAkhir,
            'foto_bukti_pembayaran' => $fotoBuktiPembayaran,
            'status' => $request->status,
        ]);

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
        // Validate the form
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

        // Ambil data tagihan air dari detail_tagihan_airs
        $detailTagihanAir = detailTagihanAir::find($request->tagihan_air_id);
        $tagihanAir = $detailTagihanAir ? $detailTagihanAir->tagihan_air : 0;

        // Ambil biaya admin dari tabel detail_biaya_admin
        $biayaAdmin = detailBiayaAdmin::first()->biaya_admin;

        // Hitung total akhir
        $totalAkhir = ($request->tagihan_awal_id ?? 0) +
                    ($request->titipan_pengelolaan_id ?? 0) +
                    ($request->titipan_air_id ?? 0) +
                    ($request->iuran_pengelolaan_id ?? 0) +
                    ($request->dana_cadangan_id ?? 0) +
                    $tagihanAir +
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

        // Redirect with success message
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