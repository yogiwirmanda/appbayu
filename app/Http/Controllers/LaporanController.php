<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Export\BuildExport;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Excel;
use TemplateProcessor;

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

    public function klpcm()
    {
        $navActive = $this->navActive;

        return view('laporan.klpcm.index', compact('navActive'));
    }

    public function loadKlpcm(Request $request)
    {
        $dataPoli = Poli::all();
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if (strlen($startDate) == 0) {
            $startDate = Date('Y-m-d');
        }

        if (strlen($endDate) == 0) {
            $endDate = Date('Y-m-d');
        }

        $dataLaporan = [];
        foreach ($dataPoli as $poli) {
            $modelKunjungan = DB::table('klpcms')
                ->join('kunjungans', 'klpcms.id_kunjungan', '=', 'kunjungans.id');
            $modelKunjungan = $modelKunjungan->whereDate('kunjungans.tanggal', '>=', $startDate)
                ->where('kunjungans.tanggal', '<=', $endDate);
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

        return response()->json([
            'html' => view('laporan.klpcm.table', compact('dataLaporan'))->render()
        ]);
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

    public function countByMonth($idPasien, $month, $year)
    {
        $modelKunjungan = Kunjungan::select('*')
            ->where('id_pasien', $idPasien)
            ->where('is_prolanis', 1)
            ->whereMonth('created_at', $month);

        if (strlen($year) > 0) {
            $modelKunjungan = $modelKunjungan->whereYear('created_at', $year);
        }

        $modelKunjungan = $modelKunjungan->orderBy('created_at', 'DESC')
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

    public function countByMonthPrb($idPasien, $month, $year)
    {
        $modelKunjungan = Kunjungan::select('*')
            ->where('id_pasien', $idPasien)
            ->where('is_prb', 1)
            ->whereMonth('created_at', $month);

        if (strlen($year) > 0) {
            $modelKunjungan = $modelKunjungan->whereYear('created_at', $year);
        }

        $modelKunjungan = $modelKunjungan->orderBy('created_at', 'DESC')
            ->first();

        if ($modelKunjungan) {
            $data[$month] = 1;
        } else {
            $data[$month] = 0;
        }

        return $data;
    }

    public function pemeriksaan()
    {
        $navActive = 'pemeriksaan';
        $tanggal = Date('Y-m-d');
        return view('laporan.prolanis.pemeriksaan', compact('navActive', 'tanggal'));
    }

    public function pemeriksaanPrb()
    {
        $navActive = 'pemeriksaan';
        $tanggal = Date('Y-m-d');
        return view('laporan.prb.pemeriksaan', compact('navActive', 'tanggal'));
    }

    public function loadPrb(Request $request)
    {
        $navActive = 'prolanis';
        $year = $request->year;

        $getPrb = [];

        $dataLaporanKunjungan = [];
        $dataPrbPasien = Pasien::where('status_prb', 1)
            ->get();

        if ($dataPrbPasien) {
            foreach ($dataPrbPasien as $prb) {
                $getPrb[$prb->id] = [];
                for ($i=1;$i<=12;$i++) {
                    $getCount = [];
                    $getCount = self::countByMonthPrb($prb->id, $i, $year);
                    $getPrb[$prb->id] = array_merge($getPrb[$prb->id], $getCount);
                }
                $pasienBuild = [];
                $pasienBuild['id'] = $prb->id;
                $pasienBuild['nama'] = $prb->nama;
                $pasienBuild['no_rm'] = $prb->no_rm;
                $getPrb[$prb->id] = \array_merge($getPrb[$prb->id], $pasienBuild);
            }
        }

        $dataLaporanKunjungan = $getPrb;
        return response()->json([
            'html' => view('laporan.prb.pemeriksaan-prb', compact('dataLaporanKunjungan', 'navActive'))->render()
        ]);
    }

    public function loadPrbWithId($idPasien)
    {
        $getPrb = [];

        $dataLaporanKunjungan = [];
        $dataPrbPasien = Pasien::where('status_prb', 1)
            ->where('id', $idPasien)
            ->get();

        foreach ($dataPrbPasien as $prb) {
            $getPrb[$prb->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonthPrb($prb->id, $i, '');
                $getPrb[$prb->id] = array_merge($getPrb[$prb->id], $getCount);
            }
            $pasienBuild = [];
            $pasienBuild['id'] = $prb->id;
            $pasienBuild['nama'] = $prb->nama;
            $pasienBuild['no_rm'] = $prb->no_rm;
            $getPrb[$prb->id] = \array_merge($getPrb[$prb->id], $pasienBuild);
        }

        $dataLaporanKunjungan = $getPrb;
        return response()->json([
            'html' => view('laporan.prb.pemeriksaan-prb', compact('dataLaporanKunjungan'))->render()
        ]);
    }

    public function pemeriksaanDM(Request $request)
    {
        $navActive = 'prolanis';
        $year = $request->year;

        $getProlanis = [];

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Diabetes Melitus')
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i, $year);
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
            'html' => view('laporan.prolanis.pemeriksaan-dm', compact('dataLaporanKunjungan', 'year', 'navActive'))->render()
        ]);
    }

    public function pemeriksaanDMWithId($idPasien = '')
    {
        $getProlanis = [];

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Diabetes Melitus')
            ->where('id', $idPasien)
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i, '');
                $getProlanis[$prolanis->id] = array_merge($getProlanis[$prolanis->id], $getCount);
            }
            $pasienBuild = [];
            $pasienBuild['id'] = $prolanis->id;
            $pasienBuild['nama'] = $prolanis->nama;
            $pasienBuild['no_rm'] = $prolanis->no_rm;
            $getProlanis[$prolanis->id] = \array_merge($getProlanis[$prolanis->id], $pasienBuild);
        }

        $type = 'dm';

        $dataLaporanKunjungan = $getProlanis;
        return response()->json([
            'html' => view('laporan.prolanis.pemeriksaan-dm', compact('dataLaporanKunjungan', 'type'))->render()
        ]);
    }



    public function pemeriksaanHT(Request $request)
    {
        $navActive = 'prolanis';
        $year = $request->year;

        $getProlanis = [];

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Hipertensi')
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i, $year);
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
            'html' => view('laporan.prolanis.pemeriksaan-ht', compact('dataLaporanKunjungan', 'year', 'navActive'))->render()
        ]);
    }

    public function pemeriksaanHTWithId($idPasien)
    {
        $type = 'ht';

        $getProlanis = [];

        $dataLaporanKunjungan = [];
        $dataProlanisPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', 'Hipertensi')
            ->where('id', $idPasien)
            ->get();

        foreach ($dataProlanisPasien as $prolanis) {
            $getProlanis[$prolanis->id] = [];
            for ($i=1;$i<=12;$i++) {
                $getCount = [];
                $getCount = self::countByMonth($prolanis->id, $i, '');
                $getProlanis[$prolanis->id] = array_merge($getProlanis[$prolanis->id], $getCount);
            }
            $pasienBuild = [];
            $pasienBuild['id'] = $prolanis->id;
            $pasienBuild['nama'] = $prolanis->nama;
            $pasienBuild['no_rm'] = $prolanis->no_rm;
            $getProlanis[$prolanis->id] = \array_merge($getProlanis[$prolanis->id], $pasienBuild);
        }

        $type = 'ht';

        $dataLaporanKunjungan = $getProlanis;
        return response()->json([
            'html' => view('laporan.prolanis.pemeriksaan-ht', compact('dataLaporanKunjungan', 'type'))->render()
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

    private function getDataFromAgeByDay($startDate, $endDate, $monthKunjungan, $jenisKasus)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->whereDate('p.tgl_lahir', '>=', $startDate)
            ->whereDate('p.tgl_lahir', '<=', $endDate)
            ->whereMonth('kunjungans.created_at', $monthKunjungan)
            ->where('kunjungans.jenis_kasus', $jenisKasus)
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
            $tempArr['totalPoliBayar'] = self::getDataFromModel($poliUmumBayar, 'total', 0) + self::getDataFromModel($poliGigiBayar, 'total', 0) + self::getDataFromModel($poliKiaBayar, 'total', 0) + self::getDataFromModel($poliGigiBayar, 'total', 0);
            $tempArr['totalRujuk'] = self::getDataFromModel($rujuk, 'total', 0);
            $dataReturn[] = $tempArr;
        }

        return view('laporan.kunjungan.bulanan', compact('navActive', 'dataReturn'));
    }

    public function lb1()
    {
        return Excel::download(new BuildExport, 'lb1.xlsx');
    }
}
