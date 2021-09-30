<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pasien;
use App\Models\rmcanuse;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $dataWilayah = Wilayah::all();
        $dataKategori = Kategori::all();
        return view('setting.nomor', compact('dataWilayah', 'dataKategori'));
    }

    public function nomorCek(Request $request)
    {
        $nomorAwal = $request->nomorAwal;
        $nomorAkhir = $request->nomorAkhir;
        $kategori = $request->kategori;
        $wilayah = $request->wilayah;

        $result = Pasien::where('no_urut', '>=', $nomorAwal)
            ->where('no_urut', '<=', $nomorAkhir)
            ->where('kategori', $kategori)
            ->where('wilayah', $wilayah)
            ->orderBy('no_urut', 'asc')
            ->get();

        $data['total'] = count($result);
        return json_encode($data);
    }

    public function cekInsertData($noUrut, $wilayah, $kategori)
    {
        $total = null;
        $result = rmcanuse::where('no_urut', $noUrut)
            ->where('kategori', $kategori)
            ->where('wilayah', $wilayah)
            ->where('status', '>', 0)
            ->orderBy('no_urut', 'asc')
            ->first();
        if ($result) {
            $total = strlen($result->no_rm);
        }
        return $total;
    }

    public function reusedRM(Request $request)
    {
        $nomorAwal = $request->nomorAwal;
        $nomorAkhir = $request->nomorAkhir;
        $kategori = $request->kategori;
        $wilayah = $request->wilayah;

        $result = Pasien::where('no_urut', '>=', $nomorAwal)
            ->where('no_urut', '<=', $nomorAkhir)
            ->where('kategori', $kategori)
            ->where('wilayah', $wilayah)
            ->orderBy('no_urut', 'asc')
            ->get();

        foreach ($result as $data) {
            $noUrut = $data->no_urut;
            $dataUsed[] = $noUrut;
        }

        for ($i=(int) $nomorAwal; $i < $nomorAkhir ; $i++) {
            if (!in_array($i, $dataUsed)) {
                $cekInsertData = self::cekInsertData($i, $kategori, $wilayah);
                if ($cekInsertData === null) {
                    $result = new rmcanuse();
                    $result['no_urut'] = $i;
                    $result['wilayah'] = (int) $wilayah;
                    $result['kategori'] = $kategori;
                    $result['status'] = 1;
                    $query = $result->save();
                }
            }
        }

        return json_encode('success');
    }
}
