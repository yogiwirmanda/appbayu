<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prb extends Model
{
    use HasFactory;
    protected $fillable = ['id_pasien', 'id_dokter', 'tensi', 'nadi', 'suhu', 'berat_badan', 'tinggi_badan', 'obat'];
}
