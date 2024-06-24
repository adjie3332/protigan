<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'data_barang_masuk';
    protected $fillable = [
        'data_barang_id',
        'data_suplier_id',
        'jumlah_masuk',
        'tanggal_masuk',
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'data_suplier_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'data_barang_id', 'id');
    }
}
