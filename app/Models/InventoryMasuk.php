<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMasuk extends Model
{
    use HasFactory;

    protected $table = 'data_inventory_masuk';
    protected $fillable = [
        'data_inventory_id',
        'jumlah_masuk',
        'harga',
        'tanggal_masuk',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'data_inventory_id', 'id');
    }
}
