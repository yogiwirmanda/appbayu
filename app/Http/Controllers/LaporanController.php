<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Export\BuildExport;
use App\Models\Klpcm;
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

    public function klpcm(){
        return view('laporan.klpcm.index');
    }

    public function loadGraphUmum()
    {
        $navActive = $this->navActive;

        $modelKunjunganUmum = Kunjungan::where('id_poli', 1)->get();
        $jmlTotalPoliUmum = count($modelKunjunganUmum) * 15;
        $jmlLengkapPoliUmum = 0;
        $jmlTidakLengkapPoliUmum = 0;
        foreach ($modelKunjunganUmum as $kunjungan) {
            $modelKlpcm = Klpcm::where('id_kunjungan', $kunjungan->id)->first();
            if ($modelKlpcm) {
                $jmlLengkapPoliUmum = $jmlLengkapPoliUmum + $modelKlpcm->jml_lengkap;
                $jmlTidakLengkapPoliUmum = $jmlTidakLengkapPoliUmum + $modelKlpcm->jml_tidak_lengkap;
            }
        }

        $dataUmum = [$jmlLengkapPoliUmum, $jmlTidakLengkapPoliUmum];

        return $dataUmum;
    }

    public function loadGraphLansia(){
        $modelKunjunganLansia = Kunjungan::where('id_poli', 2)->get();
        $jmlTotalPoliLansia = count($modelKunjunganLansia) * 15;
        $jmlLengkapPoliLansia = 0;
        $jmlTidakLengkapPoliLansia = 0;
        foreach ($modelKunjunganLansia as $kunjungan) {
            $modelKlpcm = Klpcm::where('id_kunjungan', $kunjungan->id)->first();
            if ($modelKlpcm) {
                $jmlLengkapPoliLansia = $jmlLengkapPoliLansia + $modelKlpcm->jml_lengkap;
                $jmlTidakLengkapPoliLansia = $jmlTidakLengkapPoliLansia + $modelKlpcm->jml_tidak_lengkap;
            }
        }

        $dataLansia = [$jmlLengkapPoliLansia, $jmlTidakLengkapPoliLansia];

        return $dataLansia;
    }

    public function loadGraphKia(){
        $modelKunjunganKia = Kunjungan::where('id_poli', 3)->get();
        $jmlTotalPoliKia = count($modelKunjunganKia) * 15;
        $jmlLengkapPoliKia = 0;
        $jmlTidakLengkapPoliKia = 0;
        foreach ($modelKunjunganKia as $kunjungan) {
            $modelKlpcm = Klpcm::where('id_kunjungan', $kunjungan->id)->first();
            if ($modelKlpcm) {
                $jmlLengkapPoliKia = $jmlLengkapPoliKia + $modelKlpcm->jml_lengkap;
                $jmlTidakLengkapPoliKia = $jmlTidakLengkapPoliKia + $modelKlpcm->jml_tidak_lengkap;
            }
        }

        $dataKia = [$jmlLengkapPoliKia, $jmlTidakLengkapPoliKia];

        return $dataKia;
    }

    public function loadGraphGigi(){
        $modelKunjunganGigi = Kunjungan::where('id_poli', 4)->get();
        $jmlTotalPoliGigi = count($modelKunjunganGigi) * 15;
        $jmlLengkapPoliGigi = 0;
        $jmlTidakLengkapPoliGigi = 0;
        foreach ($modelKunjunganGigi as $kunjungan) {
            $modelKlpcm = Klpcm::where('id_kunjungan', $kunjungan->id)->first();
            if ($modelKlpcm) {
                $jmlLengkapPoliGigi = $jmlLengkapPoliGigi + $modelKlpcm->jml_lengkap;
                $jmlTidakLengkapPoliGigi = $jmlTidakLengkapPoliGigi + $modelKlpcm->jml_tidak_lengkap;
            }
        }

        $dataGigi = [$jmlLengkapPoliGigi, $jmlTidakLengkapPoliGigi];

        return $dataGigi;

    }

    public function countTidakLengkap($idPoli)
    {
        $klnorm = 0;
        $klnama = 0;
        $kltgl_lahir = 0;
        $kljk = 0;
        $klalamat = 0;
        $klnobpjs = 0;
        $kls = 0;
        $klo = 0;
        $kla = 0;
        $klp = 0;
        $klkie = 0;
        $kldx = 0;
        $kldy = 0;
        $klnama_petugas = 0;
        $klttd_petugas = 0;
        $tesKl = [];

        $modelKunjungan = Kunjungan::where('id_poli', $idPoli)->get();

        foreach($modelKunjungan as $kunjungan){
            $klnorm = ((int) Klpcm::select('klnorm')->where('id_kunjungan', $kunjungan->id)->first()->klnorm) + $klnorm;
            $klnama = ((int) Klpcm::select('klnama')->where('id_kunjungan', $kunjungan->id)->first()->klnama) + $klnama;
            $kltgl_lahir = ((int) Klpcm::select('kltgl_lahir')->where('id_kunjungan', $kunjungan->id)->first()->kltgl_lahir) + $kltgl_lahir;
            $kljk = ((int) Klpcm::select('kljk')->where('id_kunjungan', $kunjungan->id)->first()->kljk) + $kljk;
            $klalamat = ((int) Klpcm::select('klalamat')->where('id_kunjungan', $kunjungan->id)->first()->klalamat) + $klalamat;
            $klnobpjs = ((int) Klpcm::select('klno_bpjs')->where('id_kunjungan', $kunjungan->id)->first()->klno_bpjs) + $klnobpjs;
            $kls = ((int) Klpcm::select('kls')->where('id_kunjungan', $kunjungan->id)->first()->kls) + $kls;
            $klo = ((int) Klpcm::select('klo')->where('id_kunjungan', $kunjungan->id)->first()->klo) + $klo;
            $kla = ((int) Klpcm::select('kla')->where('id_kunjungan', $kunjungan->id)->first()->kla) + $kla;
            $klp = ((int) Klpcm::select('klp')->where('id_kunjungan', $kunjungan->id)->first()->klp) + $klp;
            $klkie = ((int) Klpcm::select('klkie')->where('id_kunjungan', $kunjungan->id)->first()->klkie) + $klkie;
            $kldx = ((int) Klpcm::select('kldx')->where('id_kunjungan', $kunjungan->id)->first()->kldx) + $kldx;
            $kldy = ((int) Klpcm::select('kldy')->where('id_kunjungan', $kunjungan->id)->first()->kldy) + $kldy;
            $klnama_petugas = ((int) Klpcm::select('klnama_petugas')->where('id_kunjungan', $kunjungan->id)->first()->klnama_petugas) + $klnama_petugas;
            $klttd_petugas = ((int) Klpcm::select('klttd_petugas')->where('id_kunjungan', $kunjungan->id)->first()->klttd_petugas) + $klttd_petugas;
        }

        $data['klnorm'] = $klnorm;
        $data['klnama'] = $klnama;
        $data['kltgl_lahir'] = $kltgl_lahir;
        $data['kljk'] = $kljk;
        $data['klalamat'] = $klalamat;
        $data['klnobpjs'] = $klnobpjs;
        $data['kls'] = $kls;
        $data['klo'] = $klo;
        $data['kla'] = $kla;
        $data['klp'] = $klp;
        $data['klkie'] = $klkie;
        $data['kldx'] = $kldx;
        $data['kldy'] = $kldy;
        $data['klnama_petugas'] = $klnama_petugas;
        $data['klttd_petugas'] = $klttd_petugas;

        return $data;
    }

    public function loadListTidakLengkap($idPoli){
        $klnorm = 0;
        $klnama = 0;
        $kltgl_lahir = 0;
        $kljk = 0;
        $klalamat = 0;
        $klnobpjs = 0;
        $kls = 0;
        $klo = 0;
        $kla = 0;
        $klp = 0;
        $klkie = 0;
        $kldx = 0;
        $kldy = 0;
        $klnama_petugas = 0;
        $klttd_petugas = 0;
        $tesKl = [];

        $modelKunjungan = Kunjungan::where('id_poli', $idPoli)->get();

        foreach($modelKunjungan as $kunjungan){
            $klnorm = ((int) Klpcm::select('klnorm')->where('id_kunjungan', $kunjungan->id)->first()->klnorm) + $klnorm;
            $klnama = ((int) Klpcm::select('klnama')->where('id_kunjungan', $kunjungan->id)->first()->klnama) + $klnama;
            $kltgl_lahir = ((int) Klpcm::select('kltgl_lahir')->where('id_kunjungan', $kunjungan->id)->first()->kltgl_lahir) + $kltgl_lahir;
            $kljk = ((int) Klpcm::select('kljk')->where('id_kunjungan', $kunjungan->id)->first()->kljk) + $kljk;
            $klalamat = ((int) Klpcm::select('klalamat')->where('id_kunjungan', $kunjungan->id)->first()->klalamat) + $klalamat;
            $klnobpjs = ((int) Klpcm::select('klno_bpjs')->where('id_kunjungan', $kunjungan->id)->first()->klno_bpjs) + $klnobpjs;
            $kls = ((int) Klpcm::select('kls')->where('id_kunjungan', $kunjungan->id)->first()->kls) + $kls;
            $klo = ((int) Klpcm::select('klo')->where('id_kunjungan', $kunjungan->id)->first()->klo) + $klo;
            $kla = ((int) Klpcm::select('kla')->where('id_kunjungan', $kunjungan->id)->first()->kla) + $kla;
            $klp = ((int) Klpcm::select('klp')->where('id_kunjungan', $kunjungan->id)->first()->klp) + $klp;
            $klkie = ((int) Klpcm::select('klkie')->where('id_kunjungan', $kunjungan->id)->first()->klkie) + $klkie;
            $kldx = ((int) Klpcm::select('kldx')->where('id_kunjungan', $kunjungan->id)->first()->kldx) + $kldx;
            $kldy = ((int) Klpcm::select('kldy')->where('id_kunjungan', $kunjungan->id)->first()->kldy) + $kldy;
            $klnama_petugas = ((int) Klpcm::select('klnama_petugas')->where('id_kunjungan', $kunjungan->id)->first()->klnama_petugas) + $klnama_petugas;
            $klttd_petugas = ((int) Klpcm::select('klttd_petugas')->where('id_kunjungan', $kunjungan->id)->first()->klttd_petugas) + $klttd_petugas;
        }

        $data['No RM'] = $klnorm;
        $data['Nama'] = $klnama;
        $data['Tanggal Lahir'] = $kltgl_lahir;
        $data['Jenis Kelamin'] = $kljk;
        $data['Alamat'] = $klalamat;
        $data['No BPJS'] = $klnobpjs;
        $data['Subjek'] = $kls;
        $data['Objek'] = $klo;
        $data['Assesmen'] = $kla;
        $data['Plan'] = $klp;
        $data['Komunikasi Informasi Edukasi'] = $klkie;
        $data['Diagnosa'] = $kldx;
        $data['Kode Diagnosa'] = $kldy;
        $data['Nama Petugas'] = $klnama_petugas;
        $data['Ttd Petugas'] = $klttd_petugas;

        $totalTransaksi = $modelKunjungan->count();

        $dataReport = $data;

        asort($dataReport);

        return view('laporan.klpcm.report', \compact('dataReport', 'totalTransaksi'));
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
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->whereYear('p.tgl_lahir', '>=', $yearStart)
            ->whereYear('p.tgl_lahir', '<=', $yearEnd)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
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
            ->first();

        return $data;
    }

    private function getDataFromBayar($dateKunjungan, $type)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('p.cara_bayar', $type)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->first();

        return $data;
    }

    private function getDataFromPoli($dateKunjungan, $idPoli)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('kunjungans.id_poli', $idPoli)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
            ->first();

        return $data;
    }

    private function getDataFromPoliByBayar($dateKunjungan, $idPoli)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.cara_bayar = "UMUM" then 1 ELSE 0 END) as umum, SUM(CASE WHEN p.cara_bayar = "BPJS" then 1 ELSE 0 END) as bpjs, count(p.id) as total'))
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->where('kunjungans.id_poli', $idPoli)
            ->whereDate('kunjungans.created_at', $dateKunjungan)
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
            ->where('kunjungans.jenis_pasien', 1)
            ->whereDate('kunjungans.tanggal', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->first();

        return $data;
    }

    private function getDataFromKunjunganLama($dateKunjungan)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->where('kunjungans.jenis_pasien', 2)
            ->whereDate('kunjungans.tanggal', $dateKunjungan)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->first();

        return $data;
    }

    public function kunjungan($month = '', $year = '')
    {
        $navActive = $this->navActive;
        $dataReturn = [];
        $yearNow = Date('Y');
        $monthNow = Date('m');

        if ($month != ''){
            $monthNow = $month;
        }

        if ($year != ''){
            $yearNow = $year;
        }
        $totalDayInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNow, $yearNow);

        for ($i=1; $i <= $totalDayInMonth; $i++) {
            $age6Start = $yearNow - 6;
            $age55Start = $yearNow - 55;
            $ageMoreThan60 = $yearNow - 60;
            $dateKunjungan = $yearNow . '-' . $monthNow . '-' . $i;
            $age6List = self::getDataFromAge($age6Start, $yearNow, $dateKunjungan);
            $age6Between55List = self::getDataFromAge($age55Start, $age6Start, $dateKunjungan);
            $ageMoreThan60 = self::getDataFromAge(1900, $ageMoreThan60, $dateKunjungan);
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
            $tempArr['total'] = self::getDataFromModel($kunjunganBaru, 'total', 0) + self::getDataFromModel($kunjunganLama, 'total', 0);
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
            $tempArr['totalPoli'] = self::getDataFromModel($poliUmum, 'total', 0) + self::getDataFromModel($poliKia, 'total', 0) + self::getDataFromModel($poliGigi, 'total', 0);
            $tempArr['poliUmumUmum'] = self::getDataFromModel($poliUmumBayar, 'umum', 0);
            $tempArr['poliUmumBpjs'] = self::getDataFromModel($poliUmumBayar, 'bpjs', 0);
            $tempArr['poliKiaUmum'] = self::getDataFromModel($poliKiaBayar, 'umum', 0);
            $tempArr['poliKiaBpjs'] = self::getDataFromModel($poliKiaBayar, 'bpjs', 0);
            $tempArr['poliGigiUmum'] = self::getDataFromModel($poliGigiBayar, 'umum', 0);
            $tempArr['poliGigiBpjs'] = self::getDataFromModel($poliGigiBayar, 'bpjs', 0);
            $tempArr['totalPoliBayar'] = self::getDataFromModel($poliUmumBayar, 'total', 0) + self::getDataFromModel($poliGigiBayar, 'total', 0) + self::getDataFromModel($poliKiaBayar, 'total', 0);
            $tempArr['totalRujuk'] = self::getDataFromModel($rujuk, 'total', 0);
            $dataReturn[] = $tempArr;
        }

        return view('laporan.kunjungan.bulanan', compact('navActive', 'dataReturn', 'monthNow', 'yearNow'));
    }

    public function lb1Download()
    {
        return Excel::download(new BuildExport, 'lb1.xlsx');
    }

    public function lb1()
    {
        $navActive = $this->navActive;
        return view('laporan.lb1.index', compact('navActive'));
    }
}
