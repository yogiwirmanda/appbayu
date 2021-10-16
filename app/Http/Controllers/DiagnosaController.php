<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $dataDiagnosa = Diagnosa::all();
        return view('diagnosa/index', compact('dataDiagnosa'));
    }

    public function create()
    {
        return view('diagnosa/create');
    }

    public function store(Request $request)
    {
        $diagnosa = new Diagnosa([
            'kode_icd' => $request->kode_icd,
            'diagnosa' => $request->diagnosa,
            'keterangan' => $request->keterangan
        ]);

        $diagnosa->save();

        return redirect('diagnosa');
    }

    public function edit($diagnosaId)
    {
        $dataDiagnosa = Diagnosa::find($diagnosaId);

        return view('diagnosa.edit', compact('dataDiagnosa'));
    }

    public function update(Request $request)
    {
        $diagnosaId = $request->diagnosaId;
        $dataDokter = Diagnosa::find($diagnosaId);
        $dataDokter->kode_icd = $request->kode_icd;
        $dataDokter->diagnosa = $request->diagnosa;
        $dataDokter->keterangan = $request->keterangan;
        $dataDokter->save();

        return redirect('diagnosa');
    }

    public function delete($diagnosaId)
    {
        $errCode = 0;
        $dataDiagnosa = Diagnosa::find($diagnosaId);
        $dataDiagnosa->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataDiagnosa;

        return json_encode($data);
    }
}
