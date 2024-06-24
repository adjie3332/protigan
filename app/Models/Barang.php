<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'data_barang';
    protected $fillable = [
     'nama_barang',
     'id_jenis_barang',
     'jumlah',
     'satuan'
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis_barang', 'id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'data_barang_id', 'id');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'data_barang_id', 'id');
    }
}
