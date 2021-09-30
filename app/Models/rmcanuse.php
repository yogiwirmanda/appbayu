<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rmcanuse extends Model
{
    use HasFactory;

    protected $fillable = ['no_urut', 'kategori', 'wilayah', 'status'];
}
