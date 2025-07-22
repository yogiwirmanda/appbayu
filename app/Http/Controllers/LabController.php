<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ceklab;

class LabController extends Controller
{

    public function __construct()
    {
        $this->navActive = 'lab';
    }

    public function index()
    {
      return view('lab.upload');
    }

public function extractLabResults(Request $request)
{
    $ceklabId = $request->input('ceklab_id');
    $pemeriksaan = $request->input('pemeriksaan');
    $hasil = $request->input('hasil');
    $nilai = $request->input('nilai');

    $rows = [];

    for ($i = 0; $i < count($pemeriksaan); $i++) {
        $rows[] = [
            'pemeriksaan' => $pemeriksaan[$i],
            'hasil'       => $hasil[$i],
            'nilai'       => $nilai[$i] ?? null,
        ];
    }
    $ceklab = Ceklab::find($ceklabId);

    if (!$ceklab) {
        return response()->json(['message' => 'Ceklab not found'], 404);
    }

    $ceklab->hasil = json_encode($rows, JSON_UNESCAPED_UNICODE);
    $ceklab->save();

    return response()->json([
        'message' => 'Data saved successfully.',
        'received_rows' => $rows,
    ]);
}

}
