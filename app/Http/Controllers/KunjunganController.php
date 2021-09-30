<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->nav = 'kunjungan';
    }

    public function index($tanggal = null)
    {
        $nav = $this->nav;
        $dateNow = date('Y-m-d');
        if ($tanggal == null) {
            $tanggal = $dateNow;
        }
        $title = 'Kunjungan Pasien';
        $dataKunjungan = DB::table('kunjungans')
                        ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
                        ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
                        ->where('kunjungans.tanggal', '=', $tanggal)
                        ->select('kunjungans.*', 'pasiens.*', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
                        ->get();
        return view('kunjungan/index', compact('title', 'dataKunjungan', 'tanggal', 'nav'));
    }

    public function create($idPasien)
    {
        $nav = $this->nav;
        $title = "Kunjungan Pasien";
        $dataPasien = Pasien::find($idPasien);
        $dataPoli = Poli::all();
        return view('kunjungan.kunjungan', compact('title', 'dataPasien', 'dataPoli', 'idPasien', 'nav'));
    }


    public function store(Request $request)
    {
        $kunjungans = new Kunjungan([
            'id_pasien' => $request->get('id_pasien'),
            'no_rm' => $request->get('noRm'),
            'id_poli' => $request->get('poli'),
            'tanggal' => $request->get('tanggal'),
            'bayar' => $request->get('caraBayar'),
            'no_bpjs' => $request->get('noBpjs'),
            'is_edit' => 0,
        ]);
        $kunjungans->save();
        return redirect('/kunjungan');
    }

    public function klpcm($idKunjungan)
    {
        $nav = 'klpcm';
        $title = 'KLPCM';
        $dataKunjungan = DB::table('kunjungans')
                ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
                ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
                ->where('kunjungans.id', '=', $idKunjungan)
                ->select('kunjungans.*', 'pasiens.*', 'pasiens.nama as nama_pasien', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
                ->first();
        return view('klpcm.create', compact('title', 'dataKunjungan', 'idKunjungan', 'nav'));
    }
}
