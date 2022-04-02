<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
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

    public function countByMonth($idPasien, $month)
    {
        $modelKunjungan = Kunjungan::select('*')
            ->where('id_pasien', $idPasien)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at', 'DESC')
            ->first();

        if ($modelKunjungan) {
            $data['gdp'.$month] = $modelKunjungan['gdp'];
            $data['hba1c'.$month] = $modelKunjungan['hba1c'];
            $data['kontrol'.$month] = $modelKunjungan['kontrol'];
            $data['kimiaDarah'.$month] = $modelKunjungan['kimia_darah'];
        } else {
            $data['gdp'.$month] = 0;
            $data['hba1c'.$month] = 0;
            $data['kontrol'.$month] = 0;
            $data['kimiaDarah'.$month] = 0;
        }

        return $data;
    }

    public function pemeriksaan($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Diabetes Melitus')
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i);
                $getProlanis[$prolanis->id] = array_merge($getProlanis[$prolanis->id], $getCount);
            }
            $pasienBuild = [];
            $pasienBuild['id'] = $prolanis->id;
            $pasienBuild['nama'] = $prolanis->nama;
            $pasienBuild['no_rm'] = $prolanis->no_rm;
            $getProlanis[$prolanis->id] = \array_merge($getProlanis[$prolanis->id], $pasienBuild);
        }

        $dataLaporanKunjungan = $getProlanis;

        return view('laporan.prolanis.pemeriksaan', compact('dataLaporanKunjungan', 'type', 'tanggal', 'navActive'));
    }

    public function pemeriksaanHT($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Hipertensi')
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i);
                $getProlanis[$prolanis->id] = array_merge($getProlanis[$prolanis->id], $getCount);
            }
            $pasienBuild = [];
            $pasienBuild['id'] = $prolanis->id;
            $pasienBuild['nama'] = $prolanis->nama;
            $pasienBuild['no_rm'] = $prolanis->no_rm;
            $getProlanis[$prolanis->id] = \array_merge($getProlanis[$prolanis->id], $pasienBuild);
        }

        $dataLaporanKunjungan = $getProlanis;

        return view('laporan.prolanis.pemeriksaan-ht', compact('dataLaporanKunjungan', 'type', 'tanggal', 'navActive'));
    }
}
