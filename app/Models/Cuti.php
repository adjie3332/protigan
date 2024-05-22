<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'data_cuti';
    protected $fillable = [
        'data_karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_hari',
        'keterangan',
        'status',
    ];

    // Mendefinisikan relasi many-to-one dengan model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'data_karyawan_id', 'id');
    }
}
