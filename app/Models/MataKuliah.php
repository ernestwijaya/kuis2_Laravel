<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'nama',
        'kode_mk',
        'prodi_id'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'parodi_id');
    }
}
