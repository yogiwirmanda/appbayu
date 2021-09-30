<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Prb;
use Illuminate\Http\Request;

class PrbController extends Controller
{
    public function index()
    {
        $dataPasienPrb = Prb::select('prbs.*', 'dokters.nama as namaDokter', 'pasiens.nama as namaPasien', 'pasiens.alamat as alamatPasien', 'pasiens.no_rm as noRm')
            ->join('pasiens', 'pasiens.id', '=', 'prbs.id_pasien')
            ->join('dokters', 'dokters.id', '=', 'prbs.id_dokter')
            ->get();
        return view('prb.index', compact('dataPasienPrb'));
    }

    public function create()
    {
        $dataDokter = Dokter::all();
        return view('prb.create', compact('dataDokter'));
    }

    public function store(Request $request)
    {
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
        return redirect('prb');
    }
}
