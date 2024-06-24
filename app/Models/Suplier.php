<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'data_suplier';
    protected $fillable = [
        'nama_suplier',
        'alamat',
        'no_telp',
        'email'
    ];
}
