<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ObatController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-obat';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('obat.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Obat::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route("edit_obat", $row->id);
                    $actionBtn = '<a href='.$urlEdit.' class="btn btn-sm btn-primary m-r-10">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="btn btn-sm btn-danger table-action-delete" data-obat-id="'.$row->id.'" data-obta-nama="'.$row->nama.'">Hapus</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $navActive = $this->navActive;
        return view('obat.create', compact('navActive'));
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
        $navActive = $this->navActive;

        return view('obat.edit', compact('dataObat', 'navActive'));
    }

    public function update(Request $request)
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
            $obatId = $request->obatId;
            $dataObat = Obat::find($obatId);
            $dataObat->nama = $request->nama;
            $dataObat->keterangan = $request->keterangan;
            $dataObat->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Obat berhasil di update'],
        );
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
