<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetensiController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-retensi';
    }

    public function index()
    {
        $dataRetensi = Pasien::select('kunjungans.*', 'pasiens.nama', 'pasiens.no_rm')
                    ->join('kunjungans', 'pasiens.id', '=', 'kunjungans.id_pasien')
                    ->where('pasiens.status_retensi', 0)
                    ->whereRaw('year(pasiens.last_kunjungan) <= 2016')
                    ->get();

        $navActive = $this->navActive;

        return view('retensi.index', compact('dataRetensi', 'navActive'));
    }

    public function store(Request $request)
    {
        $getPasienArray = $request->pasien;
        foreach ($getPasienArray as $pasien) {
            $dataPasien = Pasien::find($pasien);
            $dataPasien->status_retensi = 1;
            $dataPasien->update();
        }

        return json_encode('success');
    }

    public function report()
    {
        $dataPasien = Pasien::select('pasiens.*', 'kunjungans.diagnosa', 'kunjungans.tgl_kunjungan', 'kunjungans.keterangan')
            ->join('kunjungans', 'kunjungans.id_pasien', '=', 'pasiens.id')
            ->where('status_retensi', 1)
            ->get();
        $navActive = 'retensi-report';
        return view('retensi.report', compact('dataPasien', 'navActive'));
    }
}
