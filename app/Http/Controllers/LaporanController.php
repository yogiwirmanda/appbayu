<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'laporan-klpcm';
    }

    public function modelPasien($tanggal)
    {
        $modelPasien = DB::table('klpcms')
            ->join('kunjungans', 'klpcms.id_kunjungan', '=', 'kunjungans.id')
            ->where('kunjungans.tanggal', '=', $tanggal);
        return $modelPasien;
    }

    public function klpcm($type = 'harian', $tanggal = '')
    {
        $navActive = $this->navActive;
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $dataPoli = Poli::all();
        $dataLaporan = [];
        foreach ($dataPoli as $poli) {
            $modelKunjungan = DB::table('klpcms')
                ->join('kunjungans', 'klpcms.id_kunjungan', '=', 'kunjungans.id');
            if ($type == 'harian') {
                $modelKunjungan = $modelKunjungan->where('kunjungans.tanggal', '=', $tanggal);
            } else {
                $modelKunjungan = $modelKunjungan->whereMonth('kunjungans.tanggal', '=', $tanggal);
            }
            $modelKunjungan = $modelKunjungan->where('kunjungans.id_poli', $poli->id);

            $totalPasienPoli = $modelKunjungan->count('klpcms.id');
            $totalPasienPoliLengkap = $modelKunjungan->sum('klpcms.jml_lengkap_poli');
            if ($totalPasienPoli > 0) {
                $laporanDaftarPoli = number_format($totalPasienPoliLengkap / ($totalPasienPoli * 9) * 100, 2);
                $laporanDaftarPoliTidakLengkap = 100 - $laporanDaftarPoli;
            } else {
                $laporanDaftarPoli = 0;
                $laporanDaftarPoliTidakLengkap = 0;
            }
            $dataTemp['namaPoli'] = $poli->nama;
            $dataTemp['totalPasienLengkap'] = $laporanDaftarPoli;
            $dataTemp['totalPasienTidakLengkap'] = $laporanDaftarPoliTidakLengkap;
            $dataLaporan[] = $dataTemp;
        }

        return view('laporan.klpcm.index', compact('dataLaporan', 'navActive', 'tanggal', 'type'));
    }

    public function prolanis($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $dataLaporan = [];

        $dataLaporan = Pasien::where('status_prolanis', 1)->get();
        return view('laporan.prolanis.index', compact('dataLaporan', 'type', 'tanggal', 'navActive'));
    }

    public function pemeriksaan($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $dataLaporan = [];

        $dataLaporan = Pasien::where('status_prolanis', 1)->get();
        return view('laporan.prolanis.pemeriksaan', compact('dataLaporan', 'type', 'tanggal', 'navActive'));
    }
}
