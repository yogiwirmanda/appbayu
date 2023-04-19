<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm', 'no_urut', 'nama', 'no_ktp', 'tgl_lahir', 'jk',
        'alamat', 'agama', 'no_hp', 'kategori', 'kepala_keluarga', 'cara_bayar', 'no_bpjs', 'pekerjaan', 'tempat_lahir',
        'alamat_dom', 'rt', 'rw', 'province', 'regency', 'district', 'kewarganegaraan',
        'gol_darah', 'status_kawin', 'village', 'wilayah', 'count_send_reminder', 'head_rm'
    ];
}
