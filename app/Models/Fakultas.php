<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use UUID;

    protected $table = 'fakultas';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function keluhan()
    {
        return $this->hasMany('App\Models\Prodi', 'fakultas_id', 'id');
    }
}
