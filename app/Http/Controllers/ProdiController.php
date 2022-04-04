<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
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

        $prodi = Prodi::query()
            ->with(['fakultas'])
            ->when($params['query'], function ($query, $value) {
                $query->where('kode', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('Master/Prodi/Index', compact('prodi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fakultas = Fakultas::all(['id', 'nama']);
        return inertia('Master/Prodi/Create', compact('fakultas'));
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
            'fakultas' => ['required', 'uuid'],
        ]);

        try {
            Prodi::create([
                'nama' => $request->nama,
                'fakultas_id' => $request->fakultas,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data prodi berhasil ditambahkan!');
        return redirect()->route('master.prodi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::all(['id', 'nama']);
        return inertia('Master/Prodi/Edit', compact('fakultas', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'fakultas' => ['required', 'uuid'],
        ]);

        try {
            $prodi->update([
                'nama' => $request->nama,
                'fakultas_id' => $request->fakultas,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data prodi berhasil disunting!');
        return redirect()->route('master.prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        session()->flash('success', 'Data prodi berhasil dihapus!');
        return redirect()->route('master.prodi.index');
    }
}
