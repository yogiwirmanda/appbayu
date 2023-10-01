<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PekerjaanController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-pekerjaan';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('pekerjaan.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Pekerjaan::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('edit_pekerjaan', $row->id);
                    $actionBtn = '<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu">';
                    $actionBtn .= '<a href="'.$urlEdit.'" class="dropdown-item table-action">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="dropdown-item table-action table-action-delete" data-pekerjaan-id='.$row->id.' data-pekerjaan-nama='.$row->pekerjaan.'>Hapus</a>';
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

        return view('pekerjaan.create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Pekerjaan::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Dokter berhasil di tambahkan'],
        );
    }

    public function edit($pekerjaanId)
    {
        $dataPekerjaan = Pekerjaan::find($pekerjaanId);
        $navActive = $this->navActive;

        return view('pekerjaan.edit', compact('dataPekerjaan', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $pekerjaanId = $request->id_pekerjaan;
            $dataPekerjaan = Pekerjaan::find($pekerjaanId);
            $dataPekerjaan->pekerjaan = $request->pekerjaan;
            $dataPekerjaan->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Dokter berhasil di update'],
        );
    }

    public function delete($pekerjaanId)
    {
        $errCode = 0;
        $dataPekerjaan = Pekerjaan::find($pekerjaanId);
        $dataPekerjaan->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataPekerjaan;

        return json_encode($data);
    }
}
