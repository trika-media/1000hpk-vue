<?php

namespace App\Http\Controllers;

use App\Models\Puskesmas;
use Illuminate\Http\Request;

class PuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puskesmas = Puskesmas::latest()->paginate(10);
        return inertia('Master/Puskesmas/Index', compact('puskesmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Master/Puskesmas/Create');
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
            'alamat' => ['required', 'string'],

            'provinsi' => ['required', 'numeric'],
            'kabupaten' => ['required', 'numeric'],
            'kecamatan' => ['required', 'numeric'],
            'kelurahan' => ['required', 'numeric'],

            'lat' => ['nullable', 'string', 'min:2', 'max:225'],
            'lng' => ['nullable', 'string', 'min:2', 'max:225'],
        ]);

        try {
            Puskesmas::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,

                'kelurahan_id' => $request->kelurahan,
                'kecamatan_id' => $request->kecamatan,
                'kabupaten_id' => $request->kabupaten,
                'provinsi_id' => $request->provinsi,

                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data puskesmas berhasil ditambahkan!');
        return redirect()->route('master.puskesmas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function show(Puskesmas $puskesmas)
    {
        $puskesmas->load([
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
        ]);

        return inertia('Master/Puskesmas/Show', compact('puskesmas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function edit(Puskesmas $puskesmas)
    {
        return inertia('Master/Puskesmas/Edit', compact('puskesmas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puskesmas $puskesmas)
    {
        $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'alamat' => ['required', 'string'],

            'provinsi' => ['required', 'numeric'],
            'kabupaten' => ['required', 'numeric'],
            'kecamatan' => ['required', 'numeric'],
            'kelurahan' => ['required', 'numeric'],

            'lat' => ['nullable', 'string', 'min:2', 'max:225'],
            'lng' => ['nullable', 'string', 'min:2', 'max:225'],
        ]);

        try {
            $puskesmas->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,

                'kelurahan_id' => $request->kelurahan,
                'kecamatan_id' => $request->kecamatan,
                'kabupaten_id' => $request->kabupaten,
                'provinsi_id' => $request->provinsi,

                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data puskesmas berhasil disunting!');
        return redirect()->route('master.puskesmas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puskesmas $puskesmas)
    {
        $puskesmas->delete();
        session()->flash('success', 'Data puskesmas berhasil dihapus!');
        return redirect()->route('master.puskesmas.index');
    }
}
