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

        'nim',
        'nama',
        'angkatan',
        'nomor_ponsel',
        'alamat',
        'jenis_kelamin',
    ];

    public function akun()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
