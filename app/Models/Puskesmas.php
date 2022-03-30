<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use UUID;

    protected $table = 'puskesmas';

    protected $fillable = [
        'nama',
        'alamat',

        'kelurahan_id',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',

        'lat',
        'lng',
    ];

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
}
