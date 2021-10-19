<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Obat::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Obat berhasil di tambahkan'],
        );
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
