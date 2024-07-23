<?php

namespace App\Http\Controllers;

use App\Models\Ipl;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\StoreIplRequest;
use App\Http\Requests\UpdateIplRequest;

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
        // Ambil no invoice terkahir
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
        $kepenghunians = Kepenghunian::all();

        return view('ipl.ipl-create', [
            'units' => $units,
            'kepenghunians' => $kepenghunians,
            'tarif' => $tarif,
            'nextInvoiceNumber' => $nextInvoiceNumber,

        ]);
    }

    public function getOwnerInfoByName($unitName)
    {
        // Cari unit berdasarkan nama
        $unit = Unit::where('unit', $unitName)->first();

        if ($unit) {
            // Ambil data kepenghunian dengan status 'pemilik' berdasarkan unit_id
            $kepenghunian = Kepenghunian::where('unit_id', $unit->id)
                ->where('status', 'pemilik')
                ->first();

            if ($kepenghunian) {
                return response()->json([
                    'success' => true,
                    'unit' => $unit,
                    'kepenghunian' => [
                        'id' => $kepenghunian->id,
                    ],
                    'nama' => $kepenghunian->nama,
                    'alamat' => $kepenghunian->alamat,
                ]);
            }
        }

        // Jika tidak ditemukan, kembalikan response kosong atau sesuaikan dengan kebutuhan Anda
        return response()->json([
            'success' => false,
            'message' => 'Pemilik unit tidak ditemukan.'
        ]);
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
            'kepenghunian_id' => 'required|exists:kepenghunians,id',
            'total_tagihan_belum_dibayar' => 'nullable|numeric',
            'titipan_pengelolaan' => 'nullable|numeric',
            'titipan_air' => 'nullable|numeric',
            'iuran_pengelolaan' => 'nullable|numeric',
            'dana_cadangan' => 'nullable|numeric',
            'meter_air_awal' => 'nullable|numeric',
            'meter_air_akhir' => 'nullable|numeric',
            'denda' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        // Ambil data tarif
        $tarif = Tarif::findOrFail($request->tarif_id);

        // Hitung pemakaian air
        $pemakaian_air = $request->meter_air_akhir - $request->meter_air_awal;
        $tagihan_air = $pemakaian_air * $tarif->harga_air;
        $total_biaya_admin = $tarif->biaya_admin;

        // Hitung total akhir
        $total_akhir = $request->total_tagihan_belum_dibayar + $request->titipan_pengelolaan + $request->titipan_air + $request->iuran_pengelolaan + $request->dana_cadangan + $tagihan_air + $total_biaya_admin + $request->denda;

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
            'kepenghunian_id' => $request->kepenghunian_id,
            'total_tagihan_belum_dibayar' => $request->total_tagihan_belum_dibayar,
            'titipan_pengelolaan' => $request->titipan_pengelolaan,
            'titipan_air' => $request->titipan_air,
            'iuran_pengelolaan' => $request->iuran_pengelolaan,
            'dana_cadangan' => $request->dana_cadangan,
            'meter_air_awal' => $request->meter_air_awal,
            'meter_air_akhir' => $request->meter_air_akhir,
            'tarif_id' => $request->tarif_id,
            'pemakaian_air' => $pemakaian_air,
            'tagihan_air' => $tagihan_air,
            'denda' => $request->denda,
            'total' => $total_akhir,
            'foto_bukti_pembayaran' => $fotoBuktiPembayaran->hashName(),
            'status' => $request->status,
        ]);

        return redirect()->route('ipl.index')->with('success', 'Data pembayaran IPL berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ipl $ipl)
    {
        $tarif = Tarif::all();
        $tarif = $tarif->first();
        return view('ipl.ipl-read', compact('ipl', 'tarif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ipl $ipl)
    {
        $tarif = Tarif::all();
        $tarif = $tarif->first();
        return view('ipl.ipl-edit', compact('ipl', 'tarif'));
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
            'kepenghunian_id' => 'required|exists:kepenghunians,id',
            'total_tagihan_belum_dibayar' => 'nullable|numeric',
            'titipan_pengelolaan' => 'nullable|numeric',
            'titipan_air' => 'nullable|numeric',
            'iuran_pengelolaan' => 'nullable|numeric',
            'dana_cadangan' => 'nullable|numeric',
            'meter_air_awal' => 'nullable|numeric',
            'meter_air_akhir' => 'nullable|numeric',
            'denda' => 'nullable|numeric',
            'status' => 'required|string',
            'foto_bukti_pembayaran' => 'nullable|image|max:5120', // Maks 5MB
        ]);

        // Prepare data for update
        $tarif = Tarif::findOrFail($request->tarif_id);
        $pemakaian_air = $request->meter_air_akhir - $request->meter_air_awal;
        $tagihan_air = $pemakaian_air * $tarif->harga_air;
        $total_biaya_admin = $tarif->biaya_admin;

        $total_akhir = ($request->total_tagihan_belum_dibayar ?? 0) +
            ($request->titipan_pengelolaan ?? 0) +
            ($request->titipan_air ?? 0) +
            ($request->iuran_pengelolaan ?? 0) +
            ($request->dana_cadangan ?? 0) +
            $tagihan_air +
            $total_biaya_admin +
            ($request->denda ?? 0);

        $data = $request->except('foto_bukti_pembayaran');
        $data['pemakaian_air'] = $pemakaian_air;
        $data['tagihan_air'] = $tagihan_air;
        $data['total'] = $total_akhir;

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
