<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';
    protected $fillable = [
        'data_karyawan_id',
        'data_inventory_id',
        'data_panen_id',
        'keterangan',
        'pemasukan',
        'pengeluaran',
        'total'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'data_karyawan_id', 'id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'data_inventory_id', 'id');
    }

    public function panen()
    {
        return $this->belongsTo(Panen::class, 'data_panen_id', 'id');
    }
}
