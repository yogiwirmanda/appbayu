<?php

namespace App\Http\Controllers;

use App\Models\SuratSehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuratSehatController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'transaksi-surat-sehat';
    }

    public function index()
    {
        $dataSuratSehat = SuratSehat::all();
        $navActive = $this->navActive;

        return view('surat-sehat/index', compact('dataSuratSehat', 'navActive'));
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('surat-sehat/create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            SuratSehat::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Surat Sehat berhasil di tambahkan'],
        );
    }

    public function edit($id)
    {
        $dataSuratSehat = SuratSehat::find($id);
        $navActive = $this->navActive;

        return view('surat-sehat.edit', compact('dataSuratSehat', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $suratSehatId = $request->suratSehatId;
            $dataSuratSehat = SuratSehat::find($suratSehatId);
            $dataSuratSehat->nama = $request->nama;
            $dataSuratSehat->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Surat Sehat berhasil di update'],
        );
    }

    public function delete($poliId)
    {
        $errCode = 0;
        $dataSuratSehat = SuratSehat::find($poliId);
        $dataSuratSehat->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataSuratSehat;

        return json_encode($data);
    }
}
