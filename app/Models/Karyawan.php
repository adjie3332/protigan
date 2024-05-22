<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'data_karyawan';
    protected $fillable = [
        'users_id',
        'nama',
        'alamat',
        'tanggal_lahir',
        'no_telepon',
        'jenis_kelamin',
        'umur',
        'foto',
    ];

    // Mendefinisikan relasi many-to-one dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // Mendefinisikan relasi one-to-many dengan model Panen
    public function panen()
    {
        return $this->hasMany(Panen::class, 'data_karyawan_id', 'id');
    }

    // Mendefinisikan relasi one-to-many dengan model Cuti
    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'data_karyawan_id', 'id');
    }
}
