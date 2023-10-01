<?php

namespace App\Http\Controllers;

use App\Models\Rumahsakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RumahsakitController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-rumahsakit';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('rumahsakit.index', compact('navActive'));
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Rumahsakit::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $urlEdit = route('edit_rumahsakit', $row->id);
                    $actionBtn = '<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu">';
                    $actionBtn .= '<a href="'.$urlEdit.'" class="dropdown-item table-action">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="dropdown-item table-action table-action-delete" data-rumahsakit-id='.$row->id.' data-rumahsakit-nama='.$row->rumahsakit.'>Hapus</a>';
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

        return view('rumahsakit.create', compact('navActive'));
    }

    public function store(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'rumahsakit' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            Rumahsakit::create($request->all());
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Rumahsakit berhasil di tambahkan'],
        );
    }

    public function edit($rumahsakitId)
    {
        $dataRumahsakit = Rumahsakit::find($rumahsakitId);
        $navActive = $this->navActive;

        return view('rumahsakit.edit', compact('dataRumahsakit', 'navActive'));
    }

    public function update(Request $request)
    {
        $error = 0;
        $validator = Validator::make($request->all(), [
            'rumahsakit' => 'required',
        ]);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $rumahsakitId = $request->id_rumahsakit;
            $dataRumahsakit = Rumahsakit::find($rumahsakitId);
            $dataRumahsakit->rumahsakit = $request->rumahsakit;
            $dataRumahsakit->save();
        }

        return response()->json(
            ['error'=>$error, 'messages'=>'Rumahsakit berhasil di update'],
        );
    }

    public function delete($rumahsakitId)
    {
        $errCode = 0;
        $dataRumahsakit = Rumahsakit::find($rumahsakitId);
        $dataRumahsakit->delete();

        $data['errCode'] = $errCode;
        $data['data'] = $dataRumahsakit;

        return json_encode($data);
    }
}
