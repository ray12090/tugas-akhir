<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Users;
use App\Models\tipeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'id');
        $sort_order = $request->input('sort_order', 'asc');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('tipe_user_id', 'like', "%{$search}%");
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);
        // dd($users);

        return view('admin.admin-users', compact('users', 'sort_by', 'sort_order'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipeUsers = tipeUser::all();
        return view('admin.admin-users-create', compact('tipeUsers'));
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
            'tipe_user_id' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('akun.create')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipeUsers = tipeUser::all();
        $user = User::findOrFail($id);
        return view('admin.admin-users-read', compact('user', 'tipeUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipeUsers = tipeUser::all();
        $user = User::findOrFail($id);
        return view('admin.admin-users-edit', compact('user', 'tipeUsers'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            // Retrieve user by ID
            $data = User::findOrFail($id);

            // Validate input
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $data->id],
                'password' => ['nullable', 'string', 'min:8'],
                'tipe_user_id' => ['required', 'exists:tipe_users,id'],
            ], [
                'email.unique' => 'Email sudah digunakan. Silakan pilih email lain.',
            ]);

            // Prepare data to update
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'tipe_user_id' => $request->tipe_user_id,
            ];

            // Update password only if provided
            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            // Update user data
            $data->update($updateData);

            return redirect()->route('akun.index')->with(['success' => 'Detail akun berhasil diubah!']);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan saat mengubah akun. Silakan coba lagi.'])->withInput();
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->tipe_user_id == '1') {
            return redirect()->back()->with('danger', 'Tipe akun "Admin" tidak boleh dihapus');
        }
        $user->delete();
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
