<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-dokter';
    }

    public function index()
    {
        $dataDokter = Dokter::all();
        $navActive = $this->navActive;

        return view('dokter/index', compact('dataDokter', 'navActive'));
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('dokter/create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nip' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Dokter::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Dokter berhasil di tambahkan'],
        );
    }

    public function edit($dokterId)
    {
        $dataDokter = Dokter::find($dokterId);
        $navActive = $this->navActive;

        return view('dokter.edit', compact('dataDokter', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nip' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $dokterId = $request->id_dokter;
            $dataDokter = Dokter::find($dokterId);
            $dataDokter->nama = $request->nama;
            $dataDokter->nip = $request->nip;
            $dataDokter->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Dokter berhasil di update'],
        );
    }

    public function delete($dokterId)
    {
        $errCode = 0;
        $dataDokter = Dokter::find($dokterId);
        $dataDokter->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataDokter;

        return json_encode($data);
    }
}
