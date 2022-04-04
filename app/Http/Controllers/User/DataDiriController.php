<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_kelamin = config('const.jenis-kelamin');
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();

        return inertia('User/DataDiri/Index', compact('jenis_kelamin', 'mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();

        $request->validate([
            'nim' => ['required', 'string', 'min:2', 'max:255', 'unique:mahasiswa,nim,' . $mahasiswa->id],
            'nama' => ['required', 'string', 'min:2', 'max:255'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'nomor_ponsel' => ['nullable', 'string', 'min:2', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'jenis_kelamin' => ['nullable', 'string', Rule::in(config('const.jenis-kelamin'))],
        ]);

        try {
            $mahasiswa->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'nomor_ponsel' => $request->nomor_ponsel,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data diri berhasil disunting!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
