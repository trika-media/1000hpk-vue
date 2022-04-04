<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = [
            'query' => $request->q,
            'perpage' => $request->per_page ?? 10,
        ];

        $mahasiswa = Mahasiswa::query()
            ->when($params['query'], function ($query, $value) {
                $query->where('nim', 'LIKE', "%$value%")
                    ->orWhere('nama', 'LIKE', "%$value%")
                    ->orWhere('angkatan', 'LIKE', "%$value%")
                    ->orWhere('nomor_ponsel', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('Mahasiswa/Index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_kelamin = config('const.jenis-kelamin');
        $user_id = Mahasiswa::query()
            ->distinct('user_id')
            ->whereNotNull('user_id')
            ->pluck('user_id');
        $pengguna = User::query()
            ->whereNotIn('id', $user_id)
            ->where('role', 'user')
            ->get(['id', 'name']);

        return inertia('Mahasiswa/Create', compact('jenis_kelamin', 'pengguna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'fakultas' => ['required', 'uuid'],
            'prodi' => ['required', 'uuid'],

            'nim' => ['required', 'string', 'min:2', 'max:255', 'unique:mahasiswa,nim'],
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'nomor_ponsel' => ['nullable', 'string', 'min:2', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'jenis_kelamin' => ['nullable', 'string', Rule::in(config('const.jenis-kelamin'))],
        ];

        if ($request->akun == 'select') {
            $rules['akun_id'] = ['required', 'uuid'];
        }

        if ($request->akun == 'input') {
            $rules['akun_email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
            $rules['akun_password'] = ['required', Password::defaults()];
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $mahasiswa = Mahasiswa::create([
                'fakultas_id' => $request->fakultas,
                'prodi_id' => $request->prodi,

                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'nomor_ponsel' => $request->nomor_ponsel,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            if ($request->akun == 'select') {
                $mahasiswa->update(['user_id' => $request->akun_id]);
            }

            if ($request->akun == 'input') {
                $user = User::create([
                    'name' => $request->nama,
                    'email' => $request->akun_email,
                    'password' => bcrypt($request->akun_password),
                    'role' => 'user',
                    'email_verified_at' => now(),
                ]);

                $mahasiswa->update(['user_id' => $user->id]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Mahasiswa berhasil ditambahkan!');
        return redirect()->route('mahasiswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load([
            'akun',
            'fakultas',
            'prodi',
        ]);

        return inertia('Mahasiswa/Show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $jenis_kelamin = config('const.jenis-kelamin');
        $user_id = Mahasiswa::query()
            ->distinct('user_id')
            ->whereNotNull('user_id')
            ->pluck('user_id');
        $pengguna = User::query()
            ->whereNotIn('id', $user_id)
            ->where('role', 'user')
            ->get(['id', 'name']);
        $mahasiswa->load(['akun']);

        return inertia('Mahasiswa/Edit', compact('jenis_kelamin', 'pengguna', 'mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'fakultas' => ['required', 'uuid'],
            'prodi' => ['required', 'uuid'],

            'nim' => ['required', 'string', 'min:2', 'max:255', 'unique:mahasiswa,nim,' . $mahasiswa->id],
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'nomor_ponsel' => ['nullable', 'string', 'min:2', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'jenis_kelamin' => ['nullable', 'string', Rule::in(config('const.jenis-kelamin'))],
        ];

        if ($mahasiswa->user_id == null) {
            $rules['akun_id'] = ['required', 'uuid'];
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $mahasiswa->update([
                'fakultas_id' => $request->fakultas,
                'prodi_id' => $request->prodi,

                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'nomor_ponsel' => $request->nomor_ponsel,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            if ($mahasiswa->user_id == null) {
                $mahasiswa->update(['user_id' => $request->akun_id]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Mahasiswa berhasil disunting!');
        return redirect()->route('mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        User::where('id', $mahasiswa->user_id)->delete();
        $mahasiswa->delete();

        session()->flash('success', 'Mahasiswa berhasil dihapus!');
        return redirect()->route('mahasiswa.index');
    }
}
