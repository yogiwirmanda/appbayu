<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-kunjungan';
    }

    public function index()
    {
        $navActive = $this->navActive;
        $title = 'Kunjungan Pasien';
        $navActive = $this->navActive;
        $tanggal = Date('Y-m-d');

        return view('kunjungan.index', compact('title', 'tanggal', 'navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $tanggal = $request->tanggal;
            $dateNow = date('Y-m-d');
            if ($tanggal == null) {
                $tanggal = $dateNow;
            }
            $dataKunjungan = DB::table('kunjungans')
                ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
                ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
                ->where('kunjungans.tanggal', '=', $tanggal)
                ->select('kunjungans.*', 'pasiens.*', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
                ->get();

            return DataTables::of($dataKunjungan)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    $html = '<div>'.$row->nama.'</div>';
                    if ($row->status_prolanis == 1) {
                        $html .= '<span class="badge badge-danger">Prolanis</span>';
                    }
                    if ($row->status_prb == 1) {
                        $html .= '<span class="badge badge-info">Prb</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $urlKelengkapan = route('kunjungan_klpcm', $row->kunjunganId);
                    $urlDetail = route("klpcm_index", $row->kunjunganId);
                    $actionBtn = '<div class="d-flex justify-content-evenly">';
                    if ($row->is_edit === 0) {
                        $actionBtn .= '<a href='.$urlKelengkapan.' class="table-action btn btn-xs btn-pill btn-success"<i class="fa fa-plane"></i> Kelengkapan</a>';
                    } else {
                        $actionBtn .= '<a href='.$urlDetail.' class="table-action btn btn-xs btn-pill btn-info"><i class="fa fa-pencil-square-o"></i> Detail</a>';
                    }
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'nama'])
                ->make(true);
        }
    }

    public function create($idPasien = '', $type = 0)
    {
        $navActive = $this->navActive;
        $title = "Kunjungan Pasien";
        $dataPasien = Pasien::find($idPasien);
        $dataPoli = Poli::all();
        $tglLahir = date_create($dataPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y . ' Tahun '. $dateDiff->m. ' Bulan '. $dateDiff->d . ' Hari';
        $type = (int) $type;
        return view('kunjungan.kunjungan', compact('title', 'dataPasien', 'dataPoli', 'idPasien', 'type', 'umur', 'navActive'));
    }


    public function store(Request $request)
    {
        $isPrb = $request->is_prb;
        $isProlanis = $request->is_prolanis;
        if ($isPrb == null) {
            $isPrb = 0;
        }
        if ($isProlanis == null) {
            $isProlanis = 0;
        }

        $kunjungans = new Kunjungan([
            'id_pasien' => $request->get('id_pasien'),
            'no_rm' => $request->get('noRm'),
            'id_poli' => $request->get('poli'),
            'tanggal' => $request->get('tanggal'),
            'bayar' => $request->get('caraBayar'),
            'no_bpjs' => $request->get('noBpjs'),
            'type' => $request->get('type'),
            'is_prb' => $isPrb,
            'is_prolanis' => $isProlanis,
            'is_edit' => 0,
        ]);
        $kunjungans->save();
        return redirect('/kunjungan');
    }

    public function klpcm($idKunjungan)
    {
        $navActive = $this->navActive;
        $title = 'KLPCM';
        $dataKunjungan = DB::table('kunjungans')
                ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
                ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
                ->where('kunjungans.id', '=', $idKunjungan)
                ->select('kunjungans.*', 'pasiens.*', 'pasiens.nama as nama_pasien', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
                ->first();
        return view('klpcm.create', compact('title', 'dataKunjungan', 'idKunjungan', 'navActive'));
    }

    public function formKunjungan()
    {
        $idPasien = 110;
        $type = 0;
        $navActive = $this->navActive;
        $title = "Kunjungan Pasien";
        $dataPasien = Pasien::find($idPasien);
        $dataPoli = Poli::all();
        $tglLahir = date_create($dataPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y . ' Tahun '. $dateDiff->m. ' Bulan '. $dateDiff->d . ' Hari';
        $type = (int) $type;
        return view('kunjungan.kunjungan', compact('title', 'dataPasien', 'dataPoli', 'idPasien', 'type', 'umur', 'navActive'));
    }
}
