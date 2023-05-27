<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'ID_Pasien';
    public $incrementing = false;
    protected $fillable = [
        'ID_Pasien',
        'Nama_Pasien',
        'Alamat',
        'No_Telepon',
        'RT',
        'RW',
        'kelurahan_id',
        'Tanggal_Lahir',
        'Jenis_Kelamin'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
}
