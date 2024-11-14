<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapelangaran extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_pelangaran', 'poin'];

    public function Pelanggarans()
    {
        return $this->hasMany(pelanggaran::class, 'id_pelanggaran', 'id');
    }
}

