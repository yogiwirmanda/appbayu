<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSehat extends Model
{
    use HasFactory;

    protected $table = 'surat_sehat';

    protected $fillable = ['nama', 'no_rm', 'no_urut', 'tahun'];
}
