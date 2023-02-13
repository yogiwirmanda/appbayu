<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Prb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PrbController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-prb';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('prb.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $dataPasienPrb = Prb::select('prbs.*', 'dokters.nama as namaDokter', 'pasiens.nama as namaPasien', 'pasiens.alamat as alamatPasien', 'pasiens.no_rm as noRm', 'pasiens.id as pasienId')
                ->join('pasiens', 'pasiens.id', '=', 'prbs.id_pasien')
                ->join('dokters', 'dokters.id', '=', 'prbs.id_dokter')
                ->get();


            return DataTables::of($dataPasienPrb)
                ->addIndexColumn()
                ->addColumn('download', function ($row) {
                    $actionBtn = '<a href="/prb/download/'.$row->pasienId.'" target="_blank" class="btn btn-sm btn-warning m-r-10">SPP</a>';
                    $actionBtn .= '<a href="/prb/downloadDokter/'.$row->pasienId.'" target="_blank" class="btn btn-sm btn-info">SPD</a>';
                    return $actionBtn;
                })
                ->addColumn('action', function ($row) {
                    $urlEdit = route("edit_prb", $row->id);
                    $actionBtn = '<a href='.$urlEdit.' class="btn btn-sm btn-primary m-r-10">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="btn btn-sm btn-danger table-action-delete" data-pasien-id=' . $row->id . ' data-pasien-nama=' . $row->nama .'>Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'download'])
                ->make(true);
        }
    }

    public function create()
    {
        $dataDokter = Dokter::all();
        $navActive = $this->navActive;

        return view('prb.create', compact('dataDokter', 'navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nadi' => 'required',
            'tensi' => 'required',
            'suhu' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $obatId = $request->id_obat;
            $obat = $request->obat;
            $takaran = $request->takaran;
            $dataObat = [];

            if (\is_array($obatId)) {
                foreach ($obatId as $key => $obatVal) {
                    $tempArray = [];
                    $tempArray['id'] = $obatVal;
                    $tempArray['nama'] = $obat[$key];
                    $tempArray['takaran'] = $takaran[$key];
                    $dataObat[] = $tempArray;
                }
            }


            $prb = new Prb([
                'id_pasien' => $request->idPasien,
                'id_dokter' => $request->dokter,
                'tensi' => $request->tensi,
                'nadi' => $request->nadi,
                'suhu' => $request->suhu,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'obat' => json_encode($dataObat),
            ]);

            $prb->save();

            $pasien = Pasien::find($request->idPasien);
            $pasien->status_prb = 1;
            $pasien->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Prb berhasil di tambahkan'],
        );
    }

    public function download($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/SURAT PERNYATAAN PERSETUJUAN PRB.docx');
        $templateProcessor->setValue('nama_pasien', $modelPasien->nama);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('tanggal_lahir', $modelPasien->tgl_lahir);
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('no_hp', $modelPasien->no_hp);
        $templateProcessor->setValue('tanggal_ttd', Date('d F Y'));
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _SPP.docx");
        $templateProcessorDokter->saveAs('php://output');
    }

    public function downloadDokter($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $modelPrb = Prb::where('id_pasien', $idPasien)->first();
        $modelDokter = Dokter::find($modelPrb->id_dokter);
        $templateProcessorDokter = new \PhpOffice\PhpWord\TemplateProcessor('doc/SURAT PERNYATAAN DOKTER PRB.docx');
        $templateProcessorDokter->setValue('nama_dokter', $modelDokter->nama);
        $templateProcessorDokter->setValue('nama_pasien', $modelPasien->nama);
        $templateProcessorDokter->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessorDokter->setValue('tanggal_lahir', $modelPasien->tgl_lahir);
        $templateProcessorDokter->setValue('alamat_pasien', $modelPasien->alamat);
        $templateProcessorDokter->setValue('tensi', $modelPrb->tensi);
        $templateProcessorDokter->setValue('suhu', $modelPrb->suhu);
        $templateProcessorDokter->setValue('nadi', $modelPrb->nadi);
        $templateProcessorDokter->setValue('berat_badan', $modelPrb->berat_badan);
        $templateProcessorDokter->setValue('tinggi_badan', $modelPrb->tinggi_badan);
        $templateProcessorDokter->setValue('obat', $modelPrb->obat);
        $templateProcessorDokter->setValue('tanggal_ttd', Date('d F Y'));
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _SPD.docx");

        $templateProcessorDokter->saveAs('php://output');
    }
}
