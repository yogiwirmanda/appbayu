<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Antrean;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AntreanController extends Controller
{
    public function index()
    {
        $dataProvince = Province::all();
        $dataPoli = Poli::all();
        return view('antrean.index', compact('dataProvince', 'dataPoli'));
    }

    public function list()
    {
        return view('antrean.list');
    }

    function makeKodeAntrean($poli){
        $kodePoli = '';
        switch ($poli) {
            case 1:
                $kodePoli = 'A-';
                break;

            case 2:
                $kodePoli = 'B-';
                break;

            case 3:
                $kodePoli = 'C-';
                break;

            default:
                $kodePoli = 'D-';
                break;
        }

        return $kodePoli;
    }

    function createNoAntrean($poli){
        $check = Antrean::where('poli', $poli)->whereDate('tanggal', Date('Y-m-d'))->count();
        return $check + 1;
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required',
        ]);

        $dataCreate = $request->all();
        $kodeAntrean = self::makeKodeAntrean($request->poli);
        $noAntrean = self::createNoAntrean($request->poli);
        $dataCreate['kode'] = $kodeAntrean.$noAntrean;

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error' => $error, 'field' => $validator->errors()->keys()]
            );
        } else {
            $modelAntrean = Antrean::create($dataCreate);
        }

        return response()->json(
            ['error' => $error, 'messages' => 'Antrean berhasil di tambahkan', 'dataId' => $modelAntrean->id],
        );
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Antrean::select('polis.nama as namaPoli', 'antreans.*')
                ->join('polis', 'polis.id', 'antreans.poli')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function result($idAntrean) {
        $antrean = Antrean::select('polis.nama as namaPoli', 'antreans.*')
        ->join('polis', 'polis.id', 'antreans.poli')
        ->where('antreans.id', $idAntrean)
        ->first();
        return view('antrean.result', compact('antrean'));
    }
}
