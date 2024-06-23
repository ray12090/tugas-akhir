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
    public function create()
    {
        // Ambil tarif terbaru
        $tarif = Tarif::orderBy('created_at', 'desc')->first();

        return view('ipl.ipl-create', [
            'units' => Unit::all(),
            'kepenghunians' => Kepenghunian::all(),
            'tarif' => $tarif,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIplRequest $request)
    {
        //
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
        try {
            $ipl->delete();
            return redirect()->route('ipl.index')->with('danger', 'IPL berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('ipl.index')->withErrors(['msg' => 'Error deleting IPL. Please try again.']);
        }
    }
}
