<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;

class HomeController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::selectRaw('count(id) as total')->first();
        $totalPasienProlanis = Pasien::selectRaw('count(id) as total')->where('status_prolanis', 1)->first();
        $totalPasienPendatang = Pasien::selectRaw('count(id) as total')->where('wilayah', 6)->first();
        $pasienPoliUmum = Kunjungan::selectRaw('count(id) as total')->where('id_poli', 1)->first();
        $pasienPoliLansia = Kunjungan::selectRaw('count(id) as total')->where('id_poli', 2)->first();
        $pasienPoliKia = Kunjungan::selectRaw('count(id) as total')->where('id_poli', 3)->first();
        $pasienPoliGigi = Kunjungan::selectRaw('count(id) as total')->where('id_poli', 4)->first();
        $perPoli = json_encode([$pasienPoliUmum->total,$pasienPoliLansia->total,$pasienPoliKia->total,$pasienPoliGigi->total]);
        $totalPasienPoli = $pasienPoliUmum->total+$pasienPoliLansia->total+$pasienPoliKia->total+$pasienPoliGigi->total;
        $listPasienTerbaru = Pasien::limit(5)->latest()->get();
        return view('dashboard', compact('totalPasien', 'totalPasienProlanis', 'totalPasienPendatang', 'perPoli', 'totalPasienPoli', 'listPasienTerbaru'));
    }
}
