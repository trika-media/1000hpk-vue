<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
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

        $fakultas = Fakultas::query()
            ->when($params['query'], function ($query, $value) {
                $query->where('kode', 'LIKE', "%$value%")
                    ->orWhere('nama', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('Master/Fakultas/Index', compact('fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Master/Fakultas/Create');
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
            'kode' => ['required', 'string', 'min:2', 'max:225', 'unique:fakultas,kode'],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
        ]);

        try {
            Fakultas::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data fakultas berhasil ditambahkan!');
        return redirect()->route('master.fakultas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakultas $fakultas)
    {
        return inertia('Master/Fakultas/Edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'kode' => ['required', 'string', 'min:2', 'max:225', 'unique:fakultas,kode,' . $fakultas->id],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
        ]);

        try {
            $fakultas->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data fakultas berhasil disunting!');
        return redirect()->route('master.fakultas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();
        session()->flash('success', 'Data fakultas berhasil dihapus!');
        return redirect()->route('master.fakultas.index');
    }
}
