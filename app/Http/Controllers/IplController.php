<?php

namespace App\Http\Controllers;

use App\Models\Ipl;
use App\Models\Unit;
use App\Models\Kepenghunian;
use App\Models\Tarif;
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

        $ipls = Ipl::with('unit', 'kepenghunian')
            ->when($search, function ($query, $search) {
                return $query->where('nomor_invoice', 'like', "%{$search}%")
                    ->orWhere('unit', 'like', "%{$search}%")
                    ->orWhere('kepenghunian', 'like', "%{$search}%")
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
    public function create(Request $request)
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

        // Ambil tarif terbaru
        $tarif = Tarif::orderBy('created_at', 'desc')->first();

        $units = Unit::all();
        $kepenghunians = Kepenghunian::all();

        return view('ipl.ipl-create', [
            'units' => $units,
            'kepenghunians' => $kepenghunians,
            'tarif' => $tarif,
            'nextInvoiceNumber' => $nextInvoiceNumber,

        ]);
    }

    public function getOwnerInfo($unit_id)
    {
        // Ambil data kepenghunian dengan status 'pemilik' berdasarkan unit_id
        $kepenghunian = Kepenghunian::where('unit_id', $unit_id)
            ->where('status', 'pemilik')
            ->first();

        if ($kepenghunian) {
            return response()->json([
                'nama' => $kepenghunian->nama,
                'alamat' => $kepenghunian->alamat,
            ]);
        }

        // Jika tidak ditemukan, kembalikan response kosong atau sesuaikan dengan kebutuhan Anda
        return response()->json([
            'nama' => '',
            'alamat' => '',
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
    public function store(StoreIplRequest $request)
    {
        // Generate the invoice number again to ensure it hasn't changed
        $lastInvoice = Ipl::orderBy('id', 'desc')->first();
        $nextInvoiceNumber = $lastInvoice ? $this->generateNextInvoiceNumber($lastInvoice->nomor_invoice) : $this->generateInitialInvoiceNumber();

        $validatedData = $request->validated();
        $validatedData['nomor_invoice'] = $nextInvoiceNumber;

        // Ensure the generated invoice number is unique
        $request->validate([
            'nomor_invoice' => 'required|unique:ipls,nomor_invoice',
            // Add other validation rules as needed
        ]);

        // Retrieve the tarif information
        $tarif = Tarif::findOrFail($validatedData['tarif_id']);
        $hargaAir = $tarif->harga_air;
        $biayaAdmin = $tarif->biaya_admin;

        // Calculate the usage and the costs
        $meterAirAwal = $validatedData['meter_air_awal'];
        $meterAirAkhir = $validatedData['meter_air_akhir'];
        $pemakaianAir = $meterAirAkhir - $meterAirAwal;
        $tagihanAir = $hargaAir * $pemakaianAir;

        // Calculate the total
        $total = $validatedData['total_tagihan_belum_dibayar'] +
            $validatedData['titipan_pengelolaan'] +
            $validatedData['titipan_air'] +
            $validatedData['iuran_pengelolaan'] +
            $validatedData['dana_cadangan'] +
            $tagihanAir +
            $biayaAdmin +
            $validatedData['denda'];

        $validatedData['total'] = $total;

        Ipl::create($validatedData);

        return redirect()->route('ipl.index')->with('success', 'IPL created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ipl $ipl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ipl $ipl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIplRequest $request, Ipl $ipl)
    {
        //
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
