<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosaController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-diagnosa';
    }

    public function index()
    {
        $dataDiagnosa = Diagnosa::all();
        $navActive = $this->navActive;

        return view('diagnosa/index', compact('dataDiagnosa', 'navActive'));
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('diagnosa/create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'kode_icd' => 'required',
            'diagnosa' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Diagnosa::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Diagnosa berhasil di tambahkan'],
        );
    }

    public function edit($diagnosaId)
    {
        $dataDiagnosa = Diagnosa::find($diagnosaId);
        $navActive = $this->navActive;

        return view('diagnosa.edit', compact('dataDiagnosa', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'kode_icd' => 'required',
            'diagnosa' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $diagnosaId = $request->diagnosaId;
            $dataDokter = Diagnosa::find($diagnosaId);
            $dataDokter->kode_icd = $request->kode_icd;
            $dataDokter->diagnosa = $request->diagnosa;
            $dataDokter->keterangan = $request->keterangan;
            $dataDokter->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Diagnosa berhasil di tambahkan'],
        );
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
