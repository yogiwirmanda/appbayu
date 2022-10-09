<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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

    public function prolanis()
    {
        $navActive = 'prolanis';
        $tanggal = Date('Y-m-d');
        return view('laporan.prolanis.index', compact('navActive', 'tanggal'));
    }

    public function dtAjaxProlanis(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::where('status_prolanis', 1);
            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
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

    public function pemeriksaan()
    {
        $navActive = 'pemeriksaan';
        $tanggal = Date('Y-m-d');
        return view('laporan.prolanis.pemeriksaan', compact('navActive', 'tanggal'));
    }

    public function pemeriksaanDM($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $getProlanis = [];

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
        return response()->json([
            'html' => view('laporan.prolanis.pemeriksaan-dm', compact('dataLaporanKunjungan', 'type', 'tanggal', 'navActive'))->render()
        ]);
    }

    public function pemeriksaanHT($type = 'harian', $tanggal = '')
    {
        $navActive = 'prolanis';
        if (strlen($tanggal) == 0) {
            $tanggal = Date('Y-m-d');
        }

        $getProlanis = [];

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
        return response()->json([
            'html' => view('laporan.prolanis.pemeriksaan-ht', compact('dataLaporanKunjungan', 'type', 'tanggal', 'navActive'))->render()
        ]);
    }

    private function getDataFromAge($yearStart, $yearEnd, $dateKunjungan)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->whereYear('p.tgl_lahir', '>=', $yearStart)
            ->whereYear('p.tgl_lahir', '<=', $yearEnd)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromBayar($dateKunjungan, $type)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('p.cara_bayar', $type)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromPoli($dateKunjungan, $idPoli)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('kunjungans.id_poli', $idPoli)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromPoliByBayar($dateKunjungan, $idPoli)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.cara_bayar = "UMUM" then 1 ELSE 0 END) as umum, SUM(CASE WHEN p.cara_bayar = "BPJS" then 1 ELSE 0 END) as bpjs, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('kunjungans.id_poli', $idPoli)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataRujuk($dateKunjungan)
    {
        $data = Kunjungan::select(DB::raw('count(klpcm.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->join('klpcms as klpcm', 'kunjungans.id', 'klpcm.id_kunjungan')
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromModel($result, $key, $defaultValue = [])
    {
        $resultValue = $defaultValue;
        if ($result != null) {
            $resultValue = (int) $result->{$key};
        }
        return $resultValue;
    }

    private function getDataFromKunjunganBaru($dateKunjungan)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->where('kunjungans.type', 1)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromKunjunganLama($dateKunjungan)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->where('kunjungans.type', 0)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    public function kunjungan()
    {
        $navActive = $this->navActive;
        $dataReturn = [];
        $yearNow = Date('Y');
        $monthNow = Date('m');
        $totalDayInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNow, $yearNow);

        for ($i=1; $i < $totalDayInMonth; $i++) {
            $age6Start = $yearNow - 6;
            $age55Start = $yearNow - 55;
            $ageMoreThan60 = $yearNow - 60;
            $dateKunjungan = $yearNow . '-' . $monthNow . '-' . $i;
            $age6List = self::getDataFromAge($age6Start, $yearNow, $dateKunjungan);
            $age6Between55List = self::getDataFromAge($age55Start, $age6Start, $dateKunjungan);
            $ageMoreThan60 = self::getDataFromAge($ageMoreThan60, 1900, $dateKunjungan);
            $caraBayar = self::getDataFromBayar($dateKunjungan, 'UMUM');
            $caraBayarBpjs = self::getDataFromBayar($dateKunjungan, 'BPJS');
            $poliUmum = self::getDataFromPoli($dateKunjungan, 1);
            $poliKia = self::getDataFromPoli($dateKunjungan, 3);
            $poliGigi = self::getDataFromPoli($dateKunjungan, 4);
            $poliUmumBayar = self::getDataFromPoliByBayar($dateKunjungan, 1);
            $poliKiaBayar = self::getDataFromPoliByBayar($dateKunjungan, 3);
            $poliGigiBayar = self::getDataFromPoliByBayar($dateKunjungan, 4);
            $rujuk = self::getDataRujuk($dateKunjungan);
            $kunjunganBaru = self::getDataFromKunjunganBaru($dateKunjungan);
            $kunjunganLama = self::getDataFromKunjunganLama($dateKunjungan);

            $tempArr = [];
            $tempArr['kunjunganBaruMale'] = self::getDataFromModel($kunjunganBaru, 'male', 0);
            $tempArr['kunjunganBaruFemale'] = self::getDataFromModel($kunjunganBaru, 'female', 0);
            $tempArr['kunjunganLamaMale'] = self::getDataFromModel($kunjunganLama, 'male', 0);
            $tempArr['kunjunganLamaFemale'] = self::getDataFromModel($kunjunganLama, 'female', 0);
            $tempArr['below6Male'] = self::getDataFromModel($age6List, 'male', 0);
            $tempArr['below6Female'] = self::getDataFromModel($age6List, 'female', 0);
            $tempArr['below6Between55Male'] = self::getDataFromModel($age6Between55List, 'male', 0);
            $tempArr['below6Between55Female'] = self::getDataFromModel($age6Between55List, 'female', 0);
            $tempArr['moreThan60Male'] = self::getDataFromModel($ageMoreThan60, 'male', 0);
            $tempArr['moreThan60Female'] = self::getDataFromModel($ageMoreThan60, 'female', 0);
            $tempArr['total'] = self::getDataFromModel($age6List, 'total', 0) + self::getDataFromModel($age6Between55List, 'total', 0) + self::getDataFromModel($ageMoreThan60, 'total', 0);
            $tempArr['umumMale'] = self::getDataFromModel($caraBayar, 'male', 0);
            $tempArr['umumFemale'] = self::getDataFromModel($caraBayar, 'female', 0);
            $tempArr['bpjsMale'] = self::getDataFromModel($caraBayarBpjs, 'male', 0);
            $tempArr['bpjsFemale'] = self::getDataFromModel($caraBayarBpjs, 'female', 0);
            $tempArr['totalCaraBayar'] = self::getDataFromModel($caraBayar, 'total', 0) + self::getDataFromModel($caraBayarBpjs, 'total', 0);
            $tempArr['poliUmumMale'] = self::getDataFromModel($poliUmum, 'male', 0);
            $tempArr['poliUmumFemale'] = self::getDataFromModel($poliUmum, 'female', 0);
            $tempArr['poliKiaMale'] = self::getDataFromModel($poliKia, 'male', 0);
            $tempArr['poliKiaFemale'] = self::getDataFromModel($poliKia, 'female', 0);
            $tempArr['poliGigiMale'] = self::getDataFromModel($poliGigi, 'male', 0);
            $tempArr['poliGigiFemale'] = self::getDataFromModel($poliGigi, 'female', 0);
            $tempArr['totalPoli'] = self::getDataFromModel($poliGigi, 'total', 0) + self::getDataFromModel($poliKia, 'total', 0) + self::getDataFromModel($poliGigi, 'total', 0);
            $tempArr['poliUmumUmum'] = self::getDataFromModel($poliUmumBayar, 'umum', 0);
            $tempArr['poliUmumBpjs'] = self::getDataFromModel($poliUmumBayar, 'bpjs', 0);
            $tempArr['poliKiaUmum'] = self::getDataFromModel($poliKiaBayar, 'umum', 0);
            $tempArr['poliKiaBpjs'] = self::getDataFromModel($poliKiaBayar, 'bpjs', 0);
            $tempArr['poliGigiUmum'] = self::getDataFromModel($poliGigiBayar, 'umum', 0);
            $tempArr['poliGigiBpjs'] = self::getDataFromModel($poliGigiBayar, 'bpjs', 0);
            $tempArr['totalPoliBayar'] = self::getDataFromModel($poliGigiBayar, 'total', 0) + self::getDataFromModel($poliKiaBayar, 'total', 0) + self::getDataFromModel($poliGigiBayar, 'total', 0);
            $tempArr['totalRujuk'] = self::getDataFromModel($rujuk, 'total', 0);
            $dataReturn[] = $tempArr;
        }

        return view('laporan.kunjungan.bulanan', compact('navActive', 'dataReturn'));
    }
}
