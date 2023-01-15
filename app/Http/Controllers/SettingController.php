<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pasien;
use App\Models\rmcanuse;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'setting-nomor';
    }

    public function index()
    {
        $dataWilayah = Wilayah::all();
        $dataKategori = Kategori::all();
        $navActive = $this->navActive;

        return view('setting.nomor', compact('dataWilayah', 'dataKategori', 'navActive'));
    }

    public function nomorCek(Request $request)
    {
        $nomorAwal = $request->nomorAwal;
        $nomorAkhir = $request->nomorAkhir;
        $kategori = $request->kategori;
        $wilayah = $request->wilayah;

        dd($request);

        $result = Pasien::where('no_urut', '>', $nomorAwal)
            ->where('no_urut', '<', $nomorAkhir)
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

    public function kk()
    {
        $navActive = $this->navActive;

        return view('setting.kk', compact('navActive'));
    }

    public function dtAjaxSetKK(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::select('pasiens.*')
                ->where('status_retensi', 0)
                ->where('kepala_keluarga', '')
                ->orderBy('created_at', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('umur', function ($row) {
                    $tglLahir = date_create($row->tgl_lahir);
                    $dateNow = date_create(Date('Y-m-d'));
                    $dateDiff = date_diff($tglLahir, $dateNow);
                    return $dateDiff->y;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:;" class="btn btn-primary table-action-setkk" data-pasien-id="'.$row->id.'" data-pasien-nama="'.$row->nama.'">Set Kepala Keluarga</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function saveKK(Request $request)
    {
        $error = 0;
        $errMessage = '';

        $pasiens = Pasien::find($request->id_pasien);
        $pasiens->kepala_keluarga = $request->kepala_keluarga;
        $pasiens->save();

        return response()->json(
            ['error'=> $error, 'messages'=>'Pasien berhasil di perbarui'],
        );
    }
}
