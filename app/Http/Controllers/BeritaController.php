<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
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

        $berita = Berita::query()
            ->when($params['query'], function ($query, $value) {
                $query->where('judul', 'LIKE', "%$value%")
                    ->orWhere('penulis', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('Berita/Index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Berita/Create');
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
            'judul' => ['required', 'string', 'min:2', 'max:255', 'unique:berita,judul'],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'tampil' => ['required', 'boolean'],
            'konten' => ['required', 'string']
        ]);

        try {
            Berita::create([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'gambar' => upload_file('data/berita/', $request->file('gambar')),
                'konten' => $request->konten,
                'penulis' => auth()->user()->name,

                'tampil' => $request->tampil,
            ]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Berita berhasil ditambahkan!');
        return redirect()->route('berita.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        return inertia('Berita/Show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return inertia('Berita/Edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => ['required', 'string', 'min:2', 'max:255', 'unique:berita,judul,' . $berita->id],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'tampil' => ['required', 'boolean'],
            'konten' => ['required', 'string']
        ]);

        try {
            $berita->update([
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'penulis' => auth()->user()->name,

                'tampil' => $request->tampil,
            ]);

            if ($request->gambar) {
                if ($berita->gambar) {
                    File::delete($berita->gambar);
                }

                $berita->update(['gambar' => upload_file('data/berita/', $request->file('gambar'))]);
            }
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Berita berhasil disunting!');
        return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            File::delete($berita->gambar);
        }

        $berita->delete();
        session()->flash('success', 'Berita berhasil dihapus!');
        return redirect()->route('berita.index');
    }

    public function status(Berita $berita)
    {
        $status = $berita->tampil ? false : true;

        $berita->update(['tampil' => $status]);
        session()->flash('success', 'Status berita berhasil disunting!');
        return redirect()->route('berita.index');
    }
}
