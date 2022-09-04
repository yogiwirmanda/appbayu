<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RetensiController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-retensi';
    }

    public function index()
    {
        $navActive = $this->navActive;

        return view('retensi.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $year = Date('Y');
            $yearRetensi = $year - 2;
            $data = Pasien::select('kunjungans.*', 'pasiens.nama', 'pasiens.no_rm')
                ->join('kunjungans', 'pasiens.id', '=', 'kunjungans.id_pasien')
                ->where('pasiens.status_retensi', 0)
                ->whereRaw('year(pasiens.last_kunjungan) <= ' . $yearRetensi)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pilih', function ($row) {
                    return '<input type="checkbox" name="pasien[]" class="checkbox-retensi" value="'.$pasien->id_pasien.'">';
                })
                ->addColumn('diagnosa', function ($row) {
                    return strlen($row->diagnosa) > 0 ? $row->diagnosa : '-';
                })
                ->make(true);
        }
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
