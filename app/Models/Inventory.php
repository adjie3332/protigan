<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'data_inventory';
    protected $fillable = [
     'nama_barang',
     'kategori', 
     'jumlah',
     'satuan'
    ];

    public function inventoryMasuk()
    {
        return $this->hasMany(InventoryMasuk::class, 'data_inventory_id', 'id');
    }

    public function inventoryKeluar()
    {
        return $this->hasMany(InventoryKeluar::class, 'data_inventory_id', 'id');
    }
}
