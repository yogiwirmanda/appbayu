<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Prb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrbController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-prb';
    }

    public function index()
    {
        $dataPasienPrb = Prb::select('prbs.*', 'dokters.nama as namaDokter', 'pasiens.nama as namaPasien', 'pasiens.alamat as alamatPasien', 'pasiens.no_rm as noRm')
            ->join('pasiens', 'pasiens.id', '=', 'prbs.id_pasien')
            ->join('dokters', 'dokters.id', '=', 'prbs.id_dokter')
            ->get();
        $navActive = $this->navActive;

        return view('prb.index', compact('dataPasienPrb', 'navActive'));
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

            foreach ($obatId as $key => $obatVal) {
                $tempArray = [];
                $tempArray['id'] = $obatVal;
                $tempArray['nama'] = $obat[$key];
                $tempArray['takaran'] = $takaran[$key];
                $dataObat[] = $tempArray;
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
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Prb berhasil di tambahkan'],
        );
    }
}
