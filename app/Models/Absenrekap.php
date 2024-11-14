<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absenrekap extends Model
{
    use HasFactory;
    protected $fillable = ['file_name','kelas', 'jurusan', 'kode_walikelas'];

    public function Walikelas()
    {
        return $this->belongsTo(Walikelas::class, 'kode_walikelas', 'kode_walikelas');
    }
}
