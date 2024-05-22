<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryKeluar extends Model
{
    use HasFactory;

    protected $table = 'data_inventory_keluar';
    protected $fillable = [
        'data_karyawan_id',
        'data_inventory_id',
        'jumlah_keluar',
        'tanggal_keluar',
        'keperluan',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'data_inventory_id', 'id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'data_karyawan_id', 'id');
    }
}
