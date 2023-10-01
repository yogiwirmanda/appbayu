<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RujukanController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-rujukan';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('poli-rujukan.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Rujukan::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('edit_poli_rujukan', $row->id);
                    $actionBtn = '<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu">';
                    $actionBtn .= '<a href="'.$urlEdit.'" class="dropdown-item table-action">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="dropdown-item table-action table-action-delete" data-rujukan-id='.$row->id.' data-rujukan-nama='.$row->rujukan.'>Hapus</a>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $navActive = $this->navActive;

        return view('poli-rujukan.create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'rujukan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Rujukan::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Poli Rujukan berhasil di tambahkan'],
        );
    }

    public function edit($poliRujukanId)
    {
        $dataPoliRujukan = Rujukan::find($poliRujukanId);
        $navActive = $this->navActive;

        return view('poli-rujukan.edit', compact('dataPoliRujukan', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'rujukan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $poliRujukanId = $request->id_poli_rujukan;
            $dataPoliRujukan = Rujukan::find($poliRujukanId);
            $dataPoliRujukan->rujukan = $request->rujukan;
            $dataPoliRujukan->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Poli Rujukan berhasil di update'],
        );
    }

    public function delete($poliRujukanId)
    {
        $errCode = 0;
        $dataPoliRujukan = Rujukan::find($poliRujukanId);
        $dataPoliRujukan->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataPoliRujukan;

        return json_encode($data);
    }
}
