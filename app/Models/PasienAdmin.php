<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienAdmin extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'no_rm', 'no_urut', 'nama', 'no_ktp', 'tgl_lahir', 'jk',
        'alamat', 'agama', 'no_hp', 'kategori', 'kepala_keluarga', 'cara_bayar', 'no_bpjs', 'pekerjaan', 'tempat_lahir',
        'alamat_dom', 'rt', 'rw', 'province', 'regency', 'district', 'kewarganegaraan',
        'gol_darah', 'status_kawin', 'village', 'wilayah', 'status_prb', 'status_prolanis', 'statu_retensi', 'keterangan_prolanis', 'last_kunjungan',
        'last_kunjungan_prolanis', 'hba1c', 'gdp', 'kontrol', 'kimia_darah'
    ];
}
