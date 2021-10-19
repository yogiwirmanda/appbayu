<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index()
    {
        $dataDokter = Dokter::all();
        return view('dokter/index', compact('dataDokter'));
    }

    public function create()
    {
        return view('dokter/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nip' => 'required',
        ]);

        Dokter::create($request->all());

        return redirect('dokter');
    }

    public function edit($dokterId)
    {
        $dataDokter = Dokter::find($dokterId);

        return view('dokter.edit', compact('dataDokter'));
    }

    public function update(Request $request)
    {
        $dokterId = $request->id_dokter;
        $dataDokter = Dokter::find($dokterId);
        $dataDokter->nama = $request->nama;
        $dataDokter->nip = $request->nip;
        $dataDokter->save();

        return redirect('dokter');
    }

    public function delete($dokterId)
    {
        $dataDokter = Dokter::find($dokterId);
        $dataDokter->delete();

        return redirect('dokter');
    }
}
