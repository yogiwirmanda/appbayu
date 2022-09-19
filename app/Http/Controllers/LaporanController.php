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
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female'))
            ->whereYear('p.tgl_lahir', '>=', $yearStart)
            ->whereYear('p.tgl_lahir', '<=', $yearEnd)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
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

            $tempArr = [];
            $tempArr['below6Male'] = self::getDataFromModel($age6List, 'male', 0);
            $tempArr['below6Female'] = self::getDataFromModel($age6List, 'female', 0);
            $tempArr['below6Between55Male'] = self::getDataFromModel($age6Between55List, 'male', 0);
            $tempArr['below6Between55Female'] = self::getDataFromModel($age6Between55List, 'female', 0);
            $tempArr['moreThan60Male'] = self::getDataFromModel($ageMoreThan60, 'male', 0);
            $tempArr['moreThan60Female'] = self::getDataFromModel($ageMoreThan60, 'female', 0);
            $tempArr['total'] = $tempArr['below6Male'] + $tempArr['below6Female'] + $tempArr['below6Between55Male'] + $tempArr['below6Between55Female'] + $tempArr['moreThan60Male'] + $tempArr['moreThan60Female'];
            $dataReturn[] = $tempArr;
        }

        return view('laporan.kunjungan.bulanan', compact('navActive', 'dataReturn'));
    }
}
