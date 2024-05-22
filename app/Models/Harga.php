<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga_karet';
    protected $fillable = [
        'kategori',
        'harga_per_kg',
    ];

    // Mendefinisikan relasi one-to-many dengan model Panen
    public function panen()
    {
        return $this->hasMany(Panen::class, 'harga_karet_id', 'id');
    }
}
