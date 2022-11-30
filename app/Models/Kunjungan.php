<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pasien',
        'no_rm',
        'id_poli',
        'tanggal',
        'bayar',
        'no_bpjs',
        'is_edit',
        'diagnosa',
        'diagnosa_main',
        'gdp',
        'hba1c',
        'kontrol',
        'kimia_darah',
        'type',
        'jenis_kasus'
    ];
}
