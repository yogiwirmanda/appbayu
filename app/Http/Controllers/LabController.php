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
    $hasil = $request->input('hasil');

    $ceklab = Ceklab::find($ceklabId);

    if (!$ceklab) {
        return response()->json(['message' => 'Ceklab not found'], 404);
    }

    $ceklab->hasil = $hasil;
    $ceklab->save();

    return response()->json([
        'message' => 'Data saved successfully.',
    ]);
}

}
