<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = User::latest()->paginate(10);
        return inertia('Master/Pengguna/Index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = config('const.roles');
        return inertia('Master/Pengguna/Create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', Rule::in(config('const.roles'))],
            'avatar' => ['nullable', 'image', 'max:1024'],
        ]);

        try {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'avatar' => upload_file('data/avatars/', $request->file('avatar')),
                'email_verified_at' => now(),
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data pengguna berhasil ditambahkan!');
        return redirect()->route('master.pengguna.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(User $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
        $roles = config('const.roles');
        return inertia('Master/Pengguna/Edit', compact('roles', 'pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $pengguna->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', Rule::in(config('const.roles'))],
            'avatar' => ['nullable', 'image', 'max:1024'],
        ]);

        try {
            $pengguna->update([
                'name' => $request->nama,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            if ($request->password) {
                $pengguna->update(['password' => bcrypt($request->password)]);
            }

            if ($request->avatar) {
                Storage::delete($pengguna->avatar);
                $pengguna->update(['avatar' => upload_file('data/avatars/', $request->file('avatar'))]);
            }
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data pengguna berhasil disunting!');
        return redirect()->route('master.pengguna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        if ($pengguna->id == auth()->user()->id) {
            session()->flash('warning', 'Tidak dapat menghapus diri sendiri!');
            return redirect()->back();
        }

        $pengguna->delete();
        session()->flash('success', 'Data pengguna berhasil dihapus!');
        return redirect()->route('master.pengguna.index');
    }

    public function status(User $pengguna)
    {
        $status = $pengguna->email_verified_at ? null : now();

        $pengguna->update(['email_verified_at' => $status]);
        session()->flash('success', 'Status pengguna berhasil disunting!');
        return redirect()->route('master.pengguna.index');
    }
}
