<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $dataPoli = Poli::all();
        return view('poli/index', compact('dataPoli'));
    }

    public function create()
    {
        return view('poli/create');
    }

    public function store(Request $request)
    {
        $diagnosa = new Poli([
            'nama' => $request->nama,
        ]);

        $diagnosa->save();

        return redirect('poli');
    }

    public function edit($poliId)
    {
        $dataPoli = Poli::find($poliId);

        return view('poli.edit', compact('dataPoli'));
    }

    public function update(Request $request)
    {
        $poliId = $request->poliId;
        $dataPoli = Poli::find($poliId);
        $dataPoli->nama = $request->nama;
        $dataPoli->save();

        return redirect('poli');
    }

    public function delete($poliId)
    {
        $errCode = 0;
        $dataPoli = Poli::find($poliId);
        $dataPoli->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataPoli;

        return json_encode($data);
    }
}
