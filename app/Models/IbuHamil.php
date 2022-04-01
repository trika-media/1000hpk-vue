<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use UUID;

    protected $table = 'ibu_hamil';

    protected $fillable = [
        'identitas',
        'nama',
        'alamat',
        'nomor_ponsel',

        'puskesmas_id',
        'kelurahan_id',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',

        'lat',
        'lng',

        'mahasiswa_id',
        'ditambahkan_oleh',
    ];

    public function puskesmas()
    {
        return $this->belongsTo('App\Models\Puskesmas', 'puskesmas_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Village', 'kelurahan_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\District', 'kecamatan_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo('App\Models\Regency', 'kabupaten_id', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Province', 'provinsi_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa', 'mahasiswa_id', 'id');
    }

    public function keluhan()
    {
        return $this->hasMany('App\Models\KeluhanIbuHamil', 'ibu_hamil_id', 'id');
    }
}
