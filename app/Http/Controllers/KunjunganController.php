<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Klpcm;
use App\Models\Pasien;
use App\Models\Rujukan;
use App\Models\Rumahsakit;
use App\Models\Poli;
use App\Models\SuratSehat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            $tanggalAwal = $request->tanggalAwal;
            $tanggalAkhir = $request->tanggalAkhir;
            if ($tanggalAwal == null || $tanggalAkhir == null) {
                $tanggalAwal = Date('Y-m-d');
                $tanggalAkhir = Date('Y-m-d');
            }
            $dataKunjungan = DB::table('kunjungans')
                ->join('pasiens', 'kunjungans.id_pasien', '=', 'pasiens.id')
                ->join('polis', 'kunjungans.id_poli', '=', 'polis.id')
                ->where('kunjungans.tanggal', '>=', $tanggalAwal)
                ->where('kunjungans.tanggal', '<=', $tanggalAkhir)
                ->select('kunjungans.*', 'pasiens.*', 'kunjungans.jenis_kunjungan as jpk', 'kunjungans.no_rm as no_rmk', 'polis.nama as namaPoli', 'kunjungans.id as kunjunganId')
                ->get();

            return DataTables::of($dataKunjungan)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    $html = '<div>'.$row->nama.'</div>';
                    if ($row->is_prolanis == 1) {
                        $html .= '<span class="badge badge-danger">Prolanis</span>';
                    }
                    if ($row->is_prb == 1) {
                        $html .= '<span class="badge badge-info">Prb</span>';
                    }
                    return $html;
                })
                ->addColumn('bayar', function ($row) {
                    $html = '<div>'.$row->bayar.'</div>';
                    if ($row->bayar == 'BPJS') {
                        $html = '<div>'.$row->bayar.' - '.$row->no_bpjs.'</div>';
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $urlKelengkapan = route('kunjungan_klpcm', $row->kunjunganId);
                    $urlDetail = route("klpcm_index", $row->kunjunganId);
                    $urlDelete = route("kunjungan_pasien_delete", $row->kunjunganId);
                    $urlEdit = route("kunjungan_pasien_edit", $row->kunjunganId);
                    $urlSS = route("pasien_download_ss", $row->kunjunganId);
                    $urlCatin = route("pasien_download_catin", $row->kunjunganId);
                    $actionBtn = '<div class="d-flex justify-content-evenly">';
                    $actionBtn .= '<a href='.$urlEdit.' class="table-action btn btn-xs btn-pill btn-warning" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>';
                    if ($row->jpk == 2){
                        $actionBtn .= '<a href='.$urlSS.' class="table-action btn btn-xs btn-pill btn-primary"><i class="fa fa-print"></i> Surat Sehat</a>';
                    } else if(($row->jpk == 2)) {
                        $actionBtn .= '<a href='.$urlCatin.' class="table-action btn btn-xs btn-pill btn-info"><i class="fa fa-print"></i> Surat Catin</a>';
                    }else {
                        if ($row->is_edit === 0 && $row->diagnosa_main != 435) {
                            $actionBtn .= '<a href='.$urlKelengkapan.' class="table-action btn btn-xs btn-pill btn-success" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Kelengkapan"><i class="fa fa-book"></i></a>';
                        } else {
                            $actionBtn .= '<a href='.$urlDetail.' class="table-action btn btn-xs btn-pill btn-info" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-eye"></i></a>';
                        }
                    }
                    $actionBtn .= '<a href='.$urlDelete.' class="table-action-delete btn btn-xs btn-pill btn-danger" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>';

                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'nama', 'bayar'])
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
        $error = 0;
        $isPrb = $request->is_prb;
        $isProlanis = $request->is_prolanis;
        if ($isPrb == null) {
            $isPrb = 0;
        }
        if ($isProlanis == null) {
            $isProlanis = 0;
        }

        $checkKunjungan = Kunjungan::where('id_pasien', $request->get('id_pasien'))
            ->where('id_poli', $request->get('poli'))
            ->where('tanggal', $request->get('tanggal'))
            ->first();

        $dataPasien = Pasien::find($request->get('id_pasien'));

        $checkSuratSehat = $dataPasien->no_rm;
        $isSuratSehat = false;

        if ($request->jenis_kunjungan == '2'){
            $isSuratSehat = true;
        }

        if ($checkKunjungan == null) {
            $dataKunjungan = [
                'id_pasien' => $request->get('id_pasien'),
                'id_poli' => $request->get('poli'),
                'no_rm' => $request->get('noRm'),
                'tanggal' => $request->get('tanggal'),
                'bayar' => $request->get('caraBayar'),
                'no_bpjs' => $request->get('noBpjs'),
                'type' => $request->get('type'),
                'is_prb' => $isPrb,
                'is_prolanis' => $isProlanis,
                'jenis_pasien' => (int) $request->get('jenis_pasien'),
                'jenis_kunjungan' => (int) $request->get('jenis_kunjungan'),
                'is_edit' => 0,
            ];

            if ($isSuratSehat == true){
                $modelSS = SuratSehat::latest()->first();
                $lastSS = 645;
                if ($modelSS){
                    $lastSS = $modelSS->no_urut + 1;
                }
                $kunjungansSehat = [
                    'no_rm_kunjungan' => 'SS-' . $lastSS,
                    'diagnosa' => '[{"kode_icd":"Z00.0","diagnosa":"Pemeriksaan kesehatan"}]',
                    'diagnosa_main' => 435,
                ];

                $suratSehatInput = [
                    'nama' => $dataPasien->nama,
                    'no_rm' => 'SS-' . $lastSS,
                    'no_urut' => $lastSS,
                    'tahun' => Date('Y')
                ];

                SuratSehat::create($suratSehatInput);

                $dataKunjungan = \array_merge($dataKunjungan, $kunjungansSehat);
                $dataKunjungan['no_rm_kunjungan'] = 'SS-' . $lastSS;
            }


            $kunjungans = new Kunjungan($dataKunjungan);

            $kunjungans->save();

            return response()->json(
                ['error'=> 0, 'messages'=>'Pasien berhasil di tambahkan', 'dataId' => $kunjungans->id],
            );
        } else {
            return response()->json(
                ['error'=> 1, 'messages'=>'Pasien sudah terdafatar di poli yang sama hari ini'],
            );
        }
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
        $dataPoliRujukan = Rujukan::all();
        $dataRumahsakit = Rumahsakit::all();
        return view('klpcm.create', compact('title', 'dataKunjungan', 'idKunjungan', 'navActive', 'dataPoliRujukan', 'dataRumahsakit'));
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

    public function delete($kunjunganId)
    {
        $errCode = 0;
        $dataKunjungan = Kunjungan::find($kunjunganId);
        $dataKunjungan->delete();
        $dataKlpcm = Klpcm::where('id_kunjungan', $kunjunganId)->first();
        if ($dataKlpcm){

            $dataKlpcm->delete();
        }

        $data['errCode'] = $errCode;
        $data['data'] = $dataKunjungan;

        return redirect('/kunjungan');

        // return json_encode($data);
    }

    public function edit($kunjunganId)
    {
        $navActive = $this->navActive;
        $dataKunjungan = Kunjungan::find($kunjunganId);
        $title = "Kunjungan Pasien";
        $idPasien = $dataKunjungan->id_pasien;
        $dataPasien = Pasien::find($idPasien);
        $dataPoli = Poli::all();
        $tglLahir = date_create($dataPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y . ' Tahun '. $dateDiff->m. ' Bulan '. $dateDiff->d . ' Hari';
        $type = 0;
        return view('kunjungan.kunjungan-edit', compact('title', 'dataPasien', 'dataPoli', 'idPasien', 'type', 'umur', 'navActive', 'dataKunjungan', 'kunjunganId'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $modelKunjungan = Kunjungan::find($request->id_kunjungan);

        if ($modelKunjungan != null) {
            $modelKunjungan->id_poli = $request->poli;
            $modelKunjungan->save();
            return response()->json(
                ['error'=> 0, 'messages'=>'Kunjungan berhasil di ubah', 'dataId' => $request->id_kunjungan],
            );
        } else {
            return response()->json(
                ['error'=> 1, 'messages'=>'Kunjungan gagal di ubah'],
            );
        }
    }
}
