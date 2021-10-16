<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $dataObat = Obat::all();
        return view('obat/index', compact('dataObat'));
    }

    public function create()
    {
        return view('obat/create');
    }

    public function store(Request $request)
    {
        $dokter = new Obat([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        $dokter->save();

        return redirect('obat');
    }

    public function edit($obatId)
    {
        $dataObat = Obat::find($obatId);

        return view('obat.edit', compact('dataObat'));
    }

    public function update(Request $request)
    {
        $obatId = $request->obatId;
        $dataObat = Obat::find($obatId);
        $dataObat->nama = $request->nama;
        $dataObat->keterangan = $request->keterangan;
        $dataObat->save();

        return redirect('obat');
    }

    public function delete($obatId)
    {
        $errCode = 0;
        try {
            $dataObat = Obat::find($obatId);
            $dataObat->delete();
        } catch (Exception $ex) {
            $errCode++;
        }

        $data['errCode'] = $errCode;
        $data['data'] = $dataObat;

        return json_encode($data);
    }
}
