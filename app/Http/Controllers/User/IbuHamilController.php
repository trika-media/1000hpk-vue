<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IbuHamil;
use App\Models\KeluhanIbuHamil;
use App\Models\Mahasiswa;
use App\Models\Penyakit;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IbuHamilController extends Controller
{
    public function checkBukanMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::query()
            ->where('user_id', auth()->user()->id)
            ->first();

        $ibuhamil = IbuHamil::query()
            ->where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if (!$ibuhamil) {
            session()->flash('warning', 'Bukan anda yang input data ini!');
            return true;
        }
    }

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
            ->where('user_id', auth()->user()->id)
            ->first();

        $ibuhamil = IbuHamil::query()
            ->with(['mahasiswa'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->when($params['query'], function ($query, $value) {
                $query->where('identitas', 'LIKE', "%$value%")
                    ->orWhere('nama', 'LIKE', "%$value%")
                    ->orWhere('alamat', 'LIKE', "%$value%")
                    ->orWhere('nomor_ponsel', 'LIKE', "%$value%");
            })
            ->latest()
            ->paginate($params['perpage'])
            ->withQueryString();

        return inertia('User/IbuHamil/Index', compact('ibuhamil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puskesmas = Puskesmas::all(['id', 'nama']);
        $penyakit = Penyakit::all(['id', 'nama']);

        return inertia('User/IbuHamil/Create', compact('puskesmas', 'penyakit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::query()
            ->where('user_id', auth()->user()->id)
            ->first();

        $request->validate([
            'identitas' => ['required', 'string', 'min:2', 'max:225', 'unique:ibu_hamil,identitas'],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'nomor_ponsel' => ['required', 'string', 'min:2', 'max:225'],
            'tanggal_lahir' => ['required', 'string', 'date_format:Y-m-d'],
            'alamat' => ['required', 'string'],

            'puskesmas' => ['required', 'uuid'],
            'keluhan' => ['required', 'array'],
            'keluhan.*.id' => ['required', 'uuid'],
            'keluhan.*.nama' => ['required', 'string'],

            'provinsi' => ['required', 'numeric'],
            'kabupaten' => ['required', 'numeric'],
            'kecamatan' => ['required', 'numeric'],
            'kelurahan' => ['required', 'numeric'],

            'lat' => ['required'],
            'lng' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $bumil = IbuHamil::create([
                'identitas' => $request->identitas,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nomor_ponsel' => $request->nomor_ponsel,
                'tanggal_lahir' => $request->tanggal_lahir,

                'puskesmas_id' => $request->puskesmas,

                'kelurahan_id' => $request->kelurahan,
                'kecamatan_id' => $request->kecamatan,
                'kabupaten_id' => $request->kabupaten,
                'provinsi_id' => $request->provinsi,

                'lat' => $request->lat,
                'lng' => $request->lng,

                'mahasiswa_id' => $mahasiswa->id,
                'ditambahkan_oleh' => auth()->user()->name,
            ]);

            foreach ($request->keluhan as $keluhan) {
                KeluhanIbuHamil::create([
                    'ibu_hamil_id' => $bumil->id,
                    'penyakit_id' => $keluhan['id'],
                    'nama_penyakit' => $keluhan['nama'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Ibu hamil berhasil ditambahkan!');
        return redirect()->route('user.ibu-hamil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function show(IbuHamil $ibuHamil)
    {
        if ($this->checkBukanMahasiswa($ibuHamil->id)) {
            return redirect()->route('user.ibu-hamil.index');
        }

        $ibuHamil->load([
            'puskesmas',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'provinsi',
            'mahasiswa',
            'keluhan.penyakit',
        ]);

        return inertia('User/IbuHamil/Show', compact('ibuHamil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function edit(IbuHamil $ibuHamil)
    {
        if ($this->checkBukanMahasiswa($ibuHamil->id)) {
            return redirect()->route('user.ibu-hamil.index');
        }

        $ibuHamil->load('keluhan');
        $puskesmas = Puskesmas::all(['id', 'nama']);
        $penyakit = Penyakit::all(['id', 'nama']);

        return inertia('User/IbuHamil/Edit', compact('puskesmas', 'penyakit', 'ibuHamil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
        if ($this->checkBukanMahasiswa($ibuHamil->id)) {
            return redirect()->route('user.ibu-hamil.index');
        }

        $request->validate([
            'identitas' => ['required', 'string', 'min:2', 'max:225', 'unique:ibu_hamil,identitas,' . $ibuHamil->id],
            'nama' => ['required', 'string', 'min:2', 'max:225'],
            'nomor_ponsel' => ['required', 'string', 'min:2', 'max:225'],
            'tanggal_lahir' => ['required', 'string', 'date_format:Y-m-d'],
            'alamat' => ['required', 'string'],

            'puskesmas' => ['required', 'uuid'],
            'keluhan' => ['required', 'array'],
            'keluhan.*.id' => ['required', 'uuid'],
            'keluhan.*.nama' => ['required', 'string'],

            'provinsi' => ['required', 'numeric'],
            'kabupaten' => ['required', 'numeric'],
            'kecamatan' => ['required', 'numeric'],
            'kelurahan' => ['required', 'numeric'],

            'lat' => ['required'],
            'lng' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $ibuHamil->update([
                'identitas' => $request->identitas,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nomor_ponsel' => $request->nomor_ponsel,
                'tanggal_lahir' => $request->tanggal_lahir,

                'puskesmas_id' => $request->puskesmas,

                'kelurahan_id' => $request->kelurahan,
                'kecamatan_id' => $request->kecamatan,
                'kabupaten_id' => $request->kabupaten,
                'provinsi_id' => $request->provinsi,

                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            $ids = [];
            $inputKeluhan = [];

            foreach ($request->keluhan as $keluhan) {
                $inputKeluhan[] = KeluhanIbuHamil::updateOrCreate(
                    [
                        'ibu_hamil_id' => $ibuHamil->id,
                        'penyakit_id' => $keluhan['id'],
                        'nama_penyakit' => $keluhan['nama'],
                    ],
                    []
                );
            }

            foreach ($inputKeluhan as $input) {
                $ids[] = $input->id;
            }

            KeluhanIbuHamil::query()
                ->where('ibu_hamil_id', $ibuHamil->id)
                ->whereNotIn('id', $ids)
                ->delete();

            DB::commit();
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'Ibu hamil berhasil disunting!');
        return redirect()->route('user.ibu-hamil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        if ($this->checkBukanMahasiswa($ibuHamil->id)) {
            return redirect()->route('user.ibu-hamil.index');
        }

        $ibuHamil->keluhan()->delete();
        $ibuHamil->delete();

        session()->flash('success', 'Ibu hamil berhasil dihapus!');
        return redirect()->route('user.ibu-hamil.index');
    }
}
