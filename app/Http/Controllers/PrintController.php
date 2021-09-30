<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function index($pasienId)
    {
        $pasien = Pasien::find($pasienId);
        return view('print/print', compact('pasien'));
    }
}
