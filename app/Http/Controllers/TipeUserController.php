<?php

namespace App\Http\Controllers;

use App\Models\tipeUser;
use Illuminate\Http\Request;

class TipeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'nama_tipe_user');
        $sort_order = $request->input('sort_order', 'asc');

        $tipeUser = tipeUser::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_tipe_user', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('admin.admin-usertype', compact('tipeUser', 'sort_by', 'sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-usertype-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        tipeUser::create([
            'nama_tipe_user' => $request->input('nama_tipe_user'),
        ]);

        return redirect()->route('tipe_user.index')->with('success', 'Tipe user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(tipeUser $tipeUser)
    {
        return view('admin.admin-usertype-read', compact('tipeUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tipeUser $tipeUser)
    {
        return view('admin.admin-usertype-edit', compact('tipeUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tipeUser $tipeUser)
    {
        $tipeUser->update([
            'nama_tipe_user' => $request->input('nama_tipe_user'),
        ]);

        return redirect()->route('tipe_user.index')->with('success', 'Tipe user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tipeUser $tipeUser)
    {
        try {
            $tipeUser->delete();
            return redirect()->route('tipe_user.index')->with('danger', 'Data tipe user berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tipe_user.index')->withErrors(['msg' => 'Error deleting tipe user. Please try again.']);
        }
    }
}
