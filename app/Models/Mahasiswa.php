<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use UUID;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'fakultas_id',
        'prodi_id',

        'nim',
        'nama',
        'angkatan',
        'nomor_ponsel',
        'alamat',
        'jenis_kelamin',
    ];

    public function akun()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault();
    }

    public function fakultas()
    {
        return $this->belongsTo('App\Models\Fakultas', 'fakultas_id', 'id')->withDefault();
    }

    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi', 'prodi_id', 'id')->withDefault();
    }
}
