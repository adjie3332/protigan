<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'data_panen';
    protected $fillable = [
        'data_karyawan_id',
        'harga_karet_id',
        'tanggal_panen',
        'hasil_kg',
        'total_hasil_kg',
        'total_gaji',
        'hasil_pemilik',
    ];

    // Mendefinisikan relasi many-to-one dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'data_karyawan_id', 'id');
    }

    // Mendefinisikan relasi many-to-one dengan model HargaKaret
    public function harga()
    {
        return $this->belongsTo(Harga::class, 'harga_karet_id', 'id');
    }
    
}
