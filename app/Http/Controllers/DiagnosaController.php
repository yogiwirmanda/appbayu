<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DiagnosaController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-diagnosa';
    }

    public function index()
    {
        $navActive = $this->navActive;

        return view('diagnosa.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Diagnosa::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route("edit_diagnosa", $row->id);
                    $actionBtn = '<a href='.$urlEdit.' class="btn btn-sm btn-primary m-r-10">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="btn btn-sm btn-danger table-action-delete" data-diagnosa-id="'.$row->id.'" data-diagnosa-nama="'.$row->kode_icd.'">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('diagnosa.create', compact('navActive'));
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
