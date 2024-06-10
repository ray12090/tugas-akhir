<?php

namespace App\Http\Controllers;

use App\Models\Kepenghunian;
use App\Http\Requests\StoreKepenghunianRequest;
use App\Http\Requests\UpdateKepenghunianRequest;
use Illuminate\Http\Request;

class KepenghunianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'tanggal_huni');
        $sort_order = $request->input('sort_order', 'desc');

        $kepenghunians = Kepenghunian::with('unit')
            ->when($search, function ($query, $search) {
                return $query->whereHas('unit', function ($q) use ($search) {
                    $q->where('unit', 'like', "%{$search}%")
                        ->orWhere('tower', 'like', "%{$search}%")
                        ->orWhere('lantai', 'like', "%{$search}%");
                })
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(5);

        return view('kepenghunian.kepenghunian', compact('kepenghunians', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKepenghunianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kepenghunian $kepenghunian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kepenghunian $kepenghunian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKepenghunianRequest $request, Kepenghunian $kepenghunian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kepenghunian $kepenghunian)
    {
        //
    }
}
