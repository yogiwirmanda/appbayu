<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Klpcm;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlpcmController extends Controller
{
    public function __construct()
    {
        $this->nav = 'kunjungan';
    }

    public function index($idKunjungan)
    {
        $nav = $this->nav;
        $title = 'Data KLPCM';
        $dataKunjungan = DB::table('kunjungans')
            ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
            ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
            ->where('kunjungans.id', '=', $idKunjungan)
            ->select('kunjungans.*', 'pasiens.*', 'pasiens.nama as nama_pasien', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
            ->first();
        $dataKLPCM = Klpcm::where('id_kunjungan', '=', $idKunjungan)->first();

        return view('klpcm.index', compact('title', 'dataKunjungan', 'idKunjungan', 'dataKLPCM', 'nav'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $diagnosa = '';
        $jmlTotal = 15;
        $jmlTotalDaftar = 6;
        $jmlTotalPoli = 9;
        $jmlLengkap = (int)$request->get('jmlLengkap');
        $jmlLengkapDaftar = (int)$request->get('jmlLengkapDaftar');
        $jmlLengkapPoli = (int)$request->get('jmlLengkapPoli');

        $diagnosaId = $request->id_diagnosa;
        $getIcd = $request->kodeIcd;
        $getDiagnosa = $request->diagnosa;
        $diagnosaTemp = [];
        foreach ($getDiagnosa as $key => $value) {
            $tempArray = [];
            $tempArray['kode_icd'] = $getIcd[$key];
            $tempArray['diagnosa'] = $value;
            $diagnosaTemp[] = $tempArray;
        }

        $jmlTidakLengkap = $jmlTotal - $jmlLengkap;
        $prosentaseLengkap = $jmlLengkap / $jmlTotal * 100;
        $prosentaseTidakLengkap = $jmlTidakLengkap / $jmlTotal * 100;

        $jmlTidakLengkapDaftar = $jmlTotalDaftar - $jmlLengkapDaftar;
        $prosentaseLengkapDaftar = $jmlLengkapDaftar / $jmlTotalDaftar * 100;
        $prosentaseTidakLengkapDaftar = $jmlTidakLengkapDaftar / $jmlTotalDaftar * 100;

        $jmlTidakLengkapPoli = $jmlTotalPoli - $jmlLengkapPoli;
        $prosentaseLengkapPoli = $jmlLengkapPoli / $jmlTotalPoli * 100;
        $prosentaseTidakLengkapPoli = $jmlTidakLengkapPoli / $jmlTotalPoli * 100;

        $klpcm = new Klpcm([
                'id_kunjungan' => $request->get('idKunjungan'),
                'klnorm' => $request->get('klnorm'),
                'klnama' => $request->get('klnama'),
                'kltgl_lahir' => $request->get('kltglLahir'),
                'kljk' => $request->get('kljk'),
                'klalamat' => $request->get('klalamat'),
                'klno_bpjs' => $request->get('klnoBpjs'),
                'kls' => $request->get('kls'),
                'klo' => $request->get('klo'),
                'kla' => $request->get('kla'),
                'klp' => $request->get('klp'),
                'klkie' => $request->get('klkie'),
                'kldx' => $request->get('kldx'),
                'kldy' => $request->get('kldy'),
                'klnama_petugas' => $request->get('namaPetugas'),
                'klttd_petugas' => $request->get('ttdPetugas'),
                'kode_icd' => $request->get('kodeIcd'),
                'jml_lengkap' => $jmlLengkap,
                'jml_tidak_lengkap' => $jmlTidakLengkap,
                'prosentase_lengkap' => $prosentaseLengkap,
                'prosentase_tidak_lengkap' => $prosentaseTidakLengkap,
                'jml_lengkap_daftar' => $jmlLengkapDaftar,
                'jml_tidak_lengkap_daftar' => $jmlTidakLengkapDaftar,
                'prosentase_lengkap_daftar' => $prosentaseLengkapDaftar,
                'prosentase_tidak_lengkap_daftar' => $prosentaseTidakLengkapDaftar,
                'jml_lengkap_poli' => $jmlLengkapPoli,
                'jml_tidak_lengkap_poli' => $jmlTidakLengkapPoli,
                'prosentase_lengkap_poli' => $prosentaseLengkapPoli,
                'prosentase_tidak_lengkap_poli' => $prosentaseTidakLengkapPoli
        ]);

        $kunjungan = Kunjungan::find($request->get('idKunjungan'));
        $kunjungan->diagnosa = json_encode($diagnosaTemp);
        $kunjungan->diagnosa_main = $diagnosaId[0];
        $kunjungan->is_edit = 1;
        $kunjungan->save();

        $klpcm->save();
        return redirect('kunjungan');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function checkIcd(Request $request)
    {
        $keyword = $request->get('keyword');
        $getDiagnosa = Diagnosa::where('kode_icd', 'like', '%'.$keyword.'%')
            ->orWhere('diagnosa', 'like', '%'.$keyword.'%')
            ->get();

        return json_encode($getDiagnosa);
    }

    public function checkObat(Request $request)
    {
        $keyword = $request->get('keyword');
        $getObat = Obat::where('nama', 'like', '%'.$keyword.'%')
            ->get();

        return json_encode($getObat);
    }

    public function checkKasus(Request $request)
    {
        $jenisKasus = 'lama';
        $idPasien = $request->idPasien;
        $diagnosaId = $request->diagnosaId;
        $kunjungan = Kunjungan::where('id_pasien', '=', $idPasien)
            ->where('diagnosa_main', '=', $diagnosaId)
            ->first();
        if ($kunjungan != null) {
            $jenisKasus = 'baru';
        }
        return $jenisKasus;
    }
}
