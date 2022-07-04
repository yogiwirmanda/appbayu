<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PoliController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-poli';
    }

    public function index()
    {
        $navActive = $this->navActive;

        return view('poli.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Poli::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route("edit_poli", $row->id);
                    $actionBtn = '<a href='.$urlEdit.' class="btn btn-sm btn-primary m-r-10">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="btn btn-sm btn-danger table-action-delete" data-poli-id="'.$row->id.'" data-poli-nama="'.$row->nama.'">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('poli/create', compact('navActive'));
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
            Poli::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Poli berhasil di tambahkan'],
        );
    }

    public function edit($poliId)
    {
        $dataPoli = Poli::find($poliId);
        $navActive = $this->navActive;

        return view('poli.edit', compact('dataPoli', 'navActive'));
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
            $poliId = $request->poliId;
            $dataPoli = Poli::find($poliId);
            $dataPoli->nama = $request->nama;
            $dataPoli->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Poli berhasil di update'],
        );
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
