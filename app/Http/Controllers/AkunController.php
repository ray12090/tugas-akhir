<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'name');
        $sort_order = $request->input('sort_order', 'desc');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('usertype', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(5);

        return view('admin.admin-users', compact('users', 'sort_by', 'sort_order'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-users-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required',
            'usertype' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('akun.create')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->usertype == 'admin') {
            return redirect()->back()->with('danger', 'Tipe akun "Admin" tidak bisa dihapus');
        }
        $user->delete();
        return redirect()->route('akun.index')->with('danger', 'Akun berhasil dihapus.');
    }
}
