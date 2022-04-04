<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use UUID;

    protected $table = 'prodi';

    protected $fillable = [
        'fakultas_id',
        'nama'
    ];

    public function fakultas()
    {
        return $this->belongsTo('App\Models\Fakultas', 'fakultas_id', 'id');
    }
}
