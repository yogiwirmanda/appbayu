<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klpcm extends Model
{
    use HasFactory;

    protected $fillable = ['id_kunjungan','klnorm','klnama','kltgl_lahir','kljk','klalamat','klno_bpjs',
    'kls','klo','kla','klp','klkie','kldx','kldy','klnama_petugas','klttd_petugas','klkode_icd',
    'jml_lengkap','jml_tidak_lengkap','prosentase_lengkap','prosentase_tidak_lengkap',
    'jml_lengkap_daftar','jml_tidak_lengkap_daftar','prosentase_lengkap_daftar','prosentase_tidak_lengkap_daftar',
    'jml_lengkap_poli','jml_tidak_lengkap_poli','prosentase_lengkap_poli','prosentase_tidak_lengkap_poli'];
}
