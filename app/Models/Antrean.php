<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'kode', 'nama', 'tgl_lahir', 'alamat', 'provinsi', 'kota', 'kecamatan', 'kelurahan', 'cara_bayar', 'poli', 'tanggal'];
}
