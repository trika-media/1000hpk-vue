<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenyakitController extends Controller
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

        $penyakit = Penyakit::query()
            ->when($params['query'], function ($query, $value) {
                $query->where('kode', 'LIKE', "%$value%")
                    ->orWhere('nama', 'LIKE', "%$value%")
                    ->orWhere('kelompok', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('Master/Penyakit/Index', compact('penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompok = config('const.kelompok-penyakit');
        return inertia('Master/Penyakit/Create', compact('kelompok'));
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
            'kode' => ['required', 'string', 'min:2', 'max:225', 'unique:penyakit,kode'],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'kelompok' => ['required', 'string', Rule::in(config('const.kelompok-penyakit'))],
        ]);

        try {
            Penyakit::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'kelompok' => $request->kelompok,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data penyakit berhasil ditambahkan!');
        return redirect()->route('master.penyakit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyakit $penyakit)
    {
        $kelompok = config('const.kelompok-penyakit');
        return inertia('Master/Penyakit/Edit', compact('kelompok', 'penyakit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'kode' => ['required', 'string', 'min:2', 'max:225', 'unique:penyakit,kode,' . $penyakit->id],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'kelompok' => ['required', 'string', Rule::in(config('const.kelompok-penyakit'))],
        ]);

        try {
            $penyakit->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'kelompok' => $request->kelompok,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Data penyakit berhasil disunting!');
        return redirect()->route('master.penyakit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        session()->flash('success', 'Data penyakit berhasil dihapus!');
        return redirect()->route('master.penyakit.index');
    }
}
