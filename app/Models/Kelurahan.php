<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $fillable = ['Nama_Kelurahan', 'Nama_Kecamatan', 'Nama_Kota'];
    
    // Relasi dengan tabel pasien
    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }
}
