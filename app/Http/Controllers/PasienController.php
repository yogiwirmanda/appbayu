<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Export\PasienExport;
use App\Models\District;
use App\Models\Kategori;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\PasienAdmin;
use App\Models\Poli;
use App\Models\Province;
use App\Models\Regency;
use App\Models\rmcanuse;
use App\Models\Village;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Excel;
use TemplateProcessor;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-pasien';
    }

    public function index()
    {
        $navActive = $this->navActive;
        return view('pasien.index', compact('navActive'));
    }

    public function riwayat($pasienId = null)
    {
        $pasien = Pasien::find($pasienId);
        $navActive = $this->navActive;
        return view('prolanis.riwayat', compact('navActive', 'pasienId', 'pasien'));
    }

    public function addName($idPasien) {
        $modelPasien = Pasien::find($idPasien);
        $addName = '';

        if ($modelPasien->jk == 'L' && $modelPasien->status_kawin == 'kawin'){
            $addName = 'Tn. ';
        }

        if ($modelPasien->jk == 'L' && $modelPasien->status_kawin == 'belum'){
            $addName = 'Sdr. ';
        }

        if ($modelPasien->jk == 'P' && $modelPasien->status_kawin == 'kawin'){
            $addName = 'Ny. ';
        }

        if ($modelPasien->jk == 'P' && $modelPasien->status_kawin == 'belum'){
            $addName = 'Nn. ';
        }

        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;

        if ($umur <= 12){
            $addName = 'An. ';
        }

        if ($modelPasien->jk == 'L' && $umur >= 30){
            $addName = 'Tn. ';
        }

        if ($modelPasien->jk == 'P' && $umur >= 30){
            $addName = 'Ny. ';
        }

        return $addName;
    }

    public function dtAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::select('pasiens.*')
                ->where('status_retensi', 0);

            if (strlen($request->name) > 0){
                $data = $data->where('nama', 'like', '%' . $request->name . '%')
                    ->orWhere('no_rm', 'like', '%' . $request->name . '%')
                    ->orWhere('alamat', 'like', '%' . $request->name . '%');
            }

            if (strlen($request->tgl) > 0){
                $data = $data->whereDate('created_at', $request->tgl);
            }

            $data = $data->orderBy('created_at', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    $html = '<a href="/pasiens/detail/'. $row->id.'">'.self::addName($row->id) . $row->nama.'</a>';
                    if ($row->status_prolanis == 1) {
                        $html .= '<span class="badge badge-danger">Prolanis</span>';
                    }
                    if ($row->status_prb == 1) {
                        $html .= '<span class="badge badge-info">Prb</span>';
                    }
                    return $html;
                })
                ->addColumn('umur', function ($row) {
                    $tglLahir = date_create($row->tgl_lahir);
                    $dateNow = date_create(Date('Y-m-d'));
                    $dateDiff = date_diff($tglLahir, $dateNow);
                    return $dateDiff->y . ' Tahun '. $dateDiff->m. ' Bulan '. $dateDiff->d . ' Hari';
                })
                ->addColumn('action', function ($row) {
                    $urlKunjungan = route('kunjungan_pasien_create', $row->id);
                    $urlEdit = route("edit_pasien", $row->id);
                    $actionBtn = '<a href='.$urlKunjungan.' class="btn btn-sm btn-success m-r-10">Kunjungan</a>';
                    $actionBtn .= '<button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu">';
                    $actionBtn .= '<a href='.$urlEdit.' class="dropdown-item" data-toggle="tooltip" data-original-title="Edit pasien">Edit</a>';
                    $actionBtn .= '<a href="javascript:;" class="dropdown-item table-action-delete" data-pasien-id="'.$row->id.'" data-pasien-nama="'.$row->nama.'">Hapus</a>';
                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'nama'])
                ->make(true);
        }
    }

    public function create()
    {
        $dataProvince = Province::all();
        $dataWilayah = Wilayah::all();
        $navActive = $this->navActive;

        return view('pasien.create', compact('dataWilayah', 'dataProvince', 'navActive'));
    }

    public function createAdmin()
    {
        $dataProvince = Province::all();
        $dataWilayah = Wilayah::all();
        $navActive = $this->navActive;

        return view('pasien.create-admin', compact('dataWilayah', 'dataProvince', 'navActive'));
    }


    public function store(Request $request)
    {
        $error = 0;
        $options = [];
        $optionsAdd = [];

        $options = [
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'alamat' => 'required'
        ];

        $caraBayar = $request->cara_bayar;

        if ($caraBayar == 'BPJS') {
            $optionsAdd = ['no_bpjs' => 'required'];
        }
        $optionsValidate = array_merge($options, $optionsAdd);

        $validator = Validator::make($request->all(), $optionsValidate);

        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $wilayah = self::generateWilayah($request->villages);
            $kategori = 'U';
            $pendatang = $request->pendatang;

            if ($request->umur >= 60) {
                $kategori = 'L';
            }

            $kodeKategori = self::checkKategoriPasien($request->umur);

            if ($request->id_selected == null){
                if ($request->suratSehat != 1) {
                    $kodeKategori = self::checkKategoriPasien($request->umur);
                    $chekPasienRmLast = Pasien::where('wilayah', $wilayah)->orderBy('no_urut', 'DESC')->first();
                    $lastRm = $chekPasienRmLast->no_urut;
                    $noRm = $request->noRm;
                    if (strlen($noRm) == 0 && strlen($pendatang == null)) {
                        $getPasienKK = Pasien::where('no_rm', $noRm)->get()->count();
                        $explodeNoRm = \explode('-', $noRm);
                        $newLastRm = $lastRm + 1;
                        $kodeKeluarga = $getPasienKK;
                        if ($getPasienKK == 0){
                            $kodeKeluarga = 1;
                        }
                        $noRm = '0'.$wilayah.'-'.$newLastRm.'-'.$kodeKeluarga.' '.$kategori;
                        $headRm = '0'.$wilayah.'-'.$newLastRm;
                    }
                } else {
                    $lastRm = self::lastRmSuratSehat();
                    $noRm = 'SS-' . $lastRm;
                    $kodeKategori = 3;
                    $headRm = $lastRm;
                }

            } else {
                $getSelectedPasien = Pasien::find($request->id_selected);
                $headRm = $getSelectedPasien->head_rm;

                $getPasienKK = Pasien::where('head_rm', $headRm)->get()->count();
                $explodeNoRm = \explode('-', $headRm);
                $newLastRm = $getPasienKK + 1;
                $lastRm = $newLastRm;
                $noRm = $explodeNoRm[0].'-'.$explodeNoRm[1].'-'.$newLastRm.' '.$kategori;
            }


            if ($pendatang != null) {
                $noRm = self::generateRMPendatang($request->nama, $kategori);
                $lastRm = self::lastRmPendatang();
                $headRm = $noRm;
            }

            $kodeWilayah = $wilayah;
            if ($pendatang != null) {
                $kodeWilayah = 7;
            }

            $dataStore = [];
            $dataStore['no_rm'] = strlen($request->noRm) > 0 ? $request->noRm : $noRm;
            $dataStore['no_urut'] = $lastRm;
            $dataStore['nama'] = $request->nama;
            $dataStore['no_ktp'] = $request->no_ktp;
            $dataStore['tgl_lahir'] = $request->tgl_lahir;
            $dataStore['tempat_lahir'] = $request->tempat_lahir;
            $dataStore['jk'] = $request->jk;
            $dataStore['alamat'] = $request->alamat;
            $dataStore['agama'] = $request->agama;
            $dataStore['wilayah'] = $kodeWilayah;
            $dataStore['no_hp'] = $request->no_hp;
            $dataStore['kategori'] = $kodeKategori ;
            $dataStore['kepala_keluarga'] = $request->kepala_keluarga;
            $dataStore['cara_bayar'] = $request->cara_bayar;
            $dataStore['no_bpjs'] = $request->no_bpjs;
            $dataStore['pekerjaan'] = $request->pekerjaan;
            $dataStore['alamat_dom'] = $request->alamat_dom;
            $dataStore['rt'] = $request->rt;
            $dataStore['rw'] = $request->rw;
            $dataStore['province'] = $request->province;
            $dataStore['regency'] = $request->city;
            $dataStore['district'] = $request->district;
            // $dataStore['kewarganegaraan'] = $request->warganegara;
            // $dataStore['gol_darah'] = $request->gol_darah;
            $dataStore['jenis_pasien'] = strlen($request->noRm) > 0 ? 1 : 0;
            $dataStore['village'] = $request->villages;
            $dataStore['head_rm'] = strlen($request->noRm) > 0 ? $request->noRm : $headRm;

            $modelPasien = Pasien::create($dataStore);
        }

        return response()->json(
            ['error'=> $error, 'messages'=>'Pasien berhasil di tambahkan', 'dataId' => $modelPasien->id],
        );
    }

    public function storeAdmin(Request $request)
    {
        $error = 0;
        $options = [];
        $optionsAdd = [];

        $options = [
            'nama' => 'required',
            'kepala_keluarga' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'villages' => 'required',
        ];

        $caraBayar = $request->cara_bayar;

        if ($caraBayar == 'BPJS') {
            $optionsAdd = ['no_bpjs' => 'required'];
        }
        $optionsValidate = array_merge($options, $optionsAdd);

        $validator = Validator::make($request->all(), $optionsValidate);


        if ($validator->fails()) {
            $error = 1;
            return response()->json(
                ['error'=>$error, 'field'=>$validator->errors()->keys()]
            );
        } else {
            $wilayah = self::generateWilayah($request->villages);
            $kategori = 'U';
            $lastRm = '';
            $pendatang = $request->pendatang;

            if ($request->umur >= 60) {
                $kategori = 'L';
            }

            $nomorRMManual = $request->nomorrm;
            $kodeKategori = self::checkKategoriPasien($request->umur);

            if (strlen($nomorRMManual) == 0) {
                $noRm = $request->noRm;
                if (strlen($noRm) == 0 && strlen($pendatang == null)) {
                    $checkUsedRM = self::checkUsedRm($wilayah, $kodeKategori, true);
                    if ($checkUsedRM == null) {
                        $noRm = self::checkNoRM($wilayah, $kategori, $kodeKategori);
                        $lastRm = self::getLastNumber($wilayah, $kodeKategori);
                    } else {
                        $noRm = self::generateRmUsed($checkUsedRM, $wilayah, $kategori);
                        $lastRm = $checkUsedRM;
                    }
                } else {
                    $noRm = self::generateRMPendatang($request->nama, $kategori);
                    $lastRm = self::lastRmPendatang();
                }
            } else {
                $noRm = $nomorRMManual;
            }


            $kodeWilayah = $wilayah;
            if ($pendatang != null) {
                $kodeWilayah = 7;
            }

            $dataStore = [];
            $dataStore['no_rm'] = $noRm;
            $dataStore['no_urut'] = $lastRm;
            $dataStore['nama'] = $request->nama;
            $dataStore['no_ktp'] = strlen($request->no_ktp) > 0 ? $request->no_ktp : '';
            $dataStore['tgl_lahir'] = $request->tgl_lahir;
            $dataStore['tempat_lahir'] = strlen($request->tempat_lahir) > 0 ? $request->tempat_lahir : '';
            $dataStore['jk'] = $request->jk;
            $dataStore['alamat'] = $request->alamat;
            $dataStore['agama'] = $request->agama;
            $dataStore['wilayah'] = $kodeWilayah;
            $dataStore['no_hp'] = (strlen($request->no_hp) > 0) ? $request->no_hp : '' ;
            $dataStore['kategori'] = $kodeKategori ;
            $dataStore['kepala_keluarga'] = $request->kepala_keluarga;
            $dataStore['cara_bayar'] = $request->cara_bayar;
            $dataStore['no_bpjs'] = $request->no_bpjs;
            $dataStore['pekerjaan'] = strlen($request->pekerjaan) > 0 ? $request->pekerjaan : '';
            $dataStore['alamat_dom'] = $request->alamat_dom;
            $dataStore['rt'] = $request->rt;
            $dataStore['rw'] = $request->rw;
            $dataStore['province'] = $request->province;
            $dataStore['regency'] = $request->city;
            $dataStore['district'] = $request->district;
            $dataStore['kewarganegaraan'] = $request->warganegara;
            $dataStore['gol_darah'] = $request->gol_darah;
            $dataStore['status_kawin'] = $request->status_kawin;
            $dataStore['village'] = $request->villages;
            $dataStore['status_retensi'] = $request->retensi;
            $dataStore['status_prb'] = $request->prb;
            $dataStore['status_prolanis'] = $request->prolanis;
            $dataStore['keterangan_prolanis'] = $request->status_prolanis;
            $dataStore['last_kunjungan'] = $request->kunjungan_terakhir;

            $modelPasien = PasienAdmin::create($dataStore);
        }

        return response()->json(
            ['error'=> $error, 'messages'=>'Pasien berhasil di tambahkan'],
        );
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $pasiens = Pasien::find($id);
        $dataProvince = Province::all();
        $dataCity = [];
        $dataDistrict = [];
        $dataVillages = [];
        if ($pasiens->province){
            $dataCity = Regency::where('province_id', $pasiens->province)->get();
        }
        if ($pasiens->regency){
            $dataDistrict = District::where('regency_id', $pasiens->regency)->get();
        }
        if ($pasiens->district){
            $dataVillages = Village::where('district_id', $pasiens->district)->get();
        }
        $navActive = $this->navActive;

        return view('pasien.edit', compact('pasiens', 'id', 'dataProvince', 'dataCity', 'dataDistrict', 'dataVillages', 'navActive'));
    }

    public function choose($id)
    {
        $pasien = Antrean::find($id);
        $dataProvince = Province::all();
        $dataWilayah = Wilayah::all();
        $navActive = $this->navActive;
        $dataProvince = Province::all();
        $dataCity = Regency::where('province_id', $pasien->provinsi)->get();
        $dataDistrict = District::where('regency_id', $pasien->kota)->get();
        $dataVillages = Village::where('district_id', $pasien->kecamatan)->get();

        return view('pasien.choose', compact('dataWilayah', 'dataProvince', 'dataCity', 'dataDistrict', 'dataVillages', 'navActive', 'pasien'));
    }


    public function update(Request $request)
    {
        $error = 0;
        $errMessage = '';
        $wilayah = self::generateWilayah($request->villages);
        $kategori = 'U';
        if ($request->umur >= 60) {
            $kategori = 'L';
        }

        $pasiens = Pasien::find($request->idPasien);
        $pasiens->nama = $request->nama;
        $pasiens->no_rm = $request->norm;
        $pasiens->no_ktp = $request->no_ktp;
        $pasiens->tgl_lahir = $request->tgl_lahir;
        $pasiens->tempat_lahir = $request->tempat_lahir;
        $pasiens->jk = $request->jk;
        $pasiens->alamat = $request->alamat;
        $pasiens->agama = $request->agama;
        $pasiens->wilayah = $request->wilayah;
        $pasiens->no_hp = $request->no_hp;
        $pasiens->kepala_keluarga = $request->kepala_keluarga;
        $pasiens->cara_bayar = $request->cara_bayar;
        $pasiens->no_bpjs = $request->no_bpjs;
        $pasiens->pekerjaan = $request->pekerjaan;
        $pasiens->alamat_dom = $request->alamat_dom;
        $pasiens->rt = $request->rt;
        $pasiens->rw = $request->rw;
        $pasiens->province = $request->province;
        $pasiens->regency = $request->city;
        $pasiens->district = $request->district;
        $pasiens->kewarganegaraan = $request->warganegara;
        $pasiens->gol_darah = $request->gol_darah;
        $pasiens->status_kawin = $request->status_kawin;
        $pasiens->village = $request->villages;
        $pasiens->wilayah = $wilayah;
        $pasiens->save();

        return response()->json(
            ['error'=> $error, 'messages'=>'Pasien berhasil di perbarui'],
        );
    }


    public function destroy($id)
    {
        $errCode = 0;
        try {
            $pasien = Pasien::find($id);
            $pasien->delete();
        } catch (Exception $ex) {
            $errCode++;
        }

        $data['errCode'] = $errCode;
        $data['data'] = $pasien;

        return json_encode($data);
    }

    public function kunjungan($idPasien = '')
    {
        $nav = $this->nav;
        $title = "Kunjungan Pasien";
        $dataPasien = Pasien::find($idPasien);
        $dataPoli = Poli::all();
        $navActive = 'transaksi-kunjungan';

        return view('pasien.kunjungan', compact('title', 'dataPasien', 'dataPoli', 'idPasien', 'navActive'));
    }

    public function kunjunganSave(Request $request)
    {
        $kunjungans = new Kunjungan([
            'id_pasien' => $request->get('id_pasien'),
            'no_rm' => $request->get('no_rm'),
            'id_poli' => $request->get('poli'),
            'tanggal' => $request->get('tanggal'),
            'bayar' => $request->get('caraBayar'),
            'no_bpjs' => $request->get('noBpjs'),
        ]);
        $kunjungans->save();

        return redirect('/pasiens');
    }

    public function getLastNumber($wilayah, $kategori)
    {
        $lastRm = 1;
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', $wilayah)
            ->where('kategori', '=', $kategori)
            ->orderBy('created_at', 'DESC')
            ->first();
        if ($dataPasien) {
            $getRm = $dataPasien->no_rm;
            $explodeRm = explode('-', $getRm);
            $lastRm = (string) $explodeRm[1]+1;
        }
        return $lastRm;
    }

    public function checkKategoriPasien($age)
    {
        $kategori = 1;
        if ((int) $age > 60) {
            $kategori = 2;
        }
        return $kategori;
    }

    public function checkNoRM($wilayah, $getKategori, $kodeKategori)
    {
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', $wilayah)
            ->where('kategori', '=', $kodeKategori)
            ->orderBy('created_at', 'DESC')
            ->first();
        $newRM = self::generateRm($dataPasien, $wilayah, $getKategori);
        return $newRM;
    }

    public function generateRmUsed($lastRm, $wilayah, $kategori)
    {
        $newRm = '';
        $getWilayah = Wilayah::find($wilayah);
        $newRm .= $getWilayah->kode.'-';
        $newRm .= str_pad($lastRm, 4, "0", STR_PAD_LEFT).'-';
        $newRm .= date('y');
        $newRm .= ' '.$kategori;
        return $newRm;
    }
    public function generateRm($dataPasien, $wilayah, $kategori)
    {
        if ($dataPasien) {
            $getRm = $dataPasien->no_rm;
            $explodeRm = explode('-', $getRm);
            $lastRm = (int) $explodeRm[1] + 1;
            $newRm = '';
            $getWilayah = Wilayah::find($wilayah);
            $newRm .= $getWilayah->kode.'-';
            $newRm .= str_pad($lastRm, 4, "0", STR_PAD_LEFT).'-';
            $newRm .= date('y');
            $newRm .= ' '.$kategori;
        } else {
            $newRm = '';
            $getWilayah = Wilayah::find($wilayah);
            $newRm .= $getWilayah->kode.'-';
            $newRm .= '0001-';
            $newRm .= date('y');
            $newRm .= ' '.$kategori;
        }
        return $newRm;
    }

    public function checkKategori(Request $request)
    {
        $getKategori = $request->get('kategori');
        $dataKategori = DB::table('kategoris')
                        ->where('kode', '=', $getKategori)
                        ->first();
        return $dataKategori->id;
    }

    public function checkWilayah(Request $request)
    {
        $getWilayah = $request->get('wilayah');
        $dataWilayah = DB::table('wilayahs')
            ->where('kode', '=', $getWilayah)
            ->first();
        return $dataWilayah->id;
    }

    public function checkStatusPasien(Request $request)
    {
        $noRm = $request->get('noRm');
        $dataPasien = DB::table('pasiens')
            ->select('kepala_keluarga')
            ->groupBy('kepala_keluarga')
            ->where('no_rm', '=', $noRm)
            ->get();
        $text = '';
        $text .= '<select name="kepalaKeluarga" id="kepalaKeluarga" class="form-control">';
        $text .= '<option value="" selected>Pilih Kepala Keluarga</option>';
        foreach ($dataPasien as $pasien) {
            $text .= "<option value='$pasien->kepala_keluarga'>$pasien->kepala_keluarga</option>";
        }
        $text .= '</select>';
        return $text;
    }

    public function getFromKepalaKeluarga(Request $request)
    {
        $memberId = $request->get('memberId');
        $result = Pasien::find($memberId);

        return json_encode($result);
    }

    public function getDetailPasien(Request $request)
    {
        $getId = $request->get('id');
        $detailPasien = Pasien::find($getId);
        return json_encode($detailPasien);
    }

    public function generateWilayah($villageId)
    {
        switch ($villageId) {
            case '3573021001':
                $wilayah = 1;
                break;
            case '3573021002':
                $wilayah = 2;
                break;
            case '3573021003':
                $wilayah = 3;
                break;
            default:
                $wilayah = 6;
                break;
        }

        return $wilayah;
    }

    public function cariData(Request $request)
    {
        $noRM = $request->noRm;
        $namaKK = $request->namaKK;
        $namaPasien = $request->namaPasien;

        if ($noRM == null) {
            $noRM = '';
        }

        $result = Pasien::where('no_rm', $noRM);

        if (strlen($namaKK) > 0) {
            $result = $result->orWhere('kepala_keluarga', 'like', '%'.$namaKK.'%');
        }

        if (strlen($namaPasien) > 0) {
            $result = $result->orWhere('nama', 'like', '%'.$namaPasien.'%');
        }
        $result = $result->get();

        echo json_encode($result);
    }

    public function checkUsedRm($wilayah, $kategori, $withUpdate = false)
    {
        $result = null;
        $query = rmcanuse::where('wilayah', $wilayah)
            ->where('kategori', $kategori)
            ->where('status', '>', 0)
            ->first();

        if ($query) {
            $result = $query->no_urut;
            if ($withUpdate){
                $updated = rmcanuse::find($query->id);
                $updated->status = 0;
                $updated->update();
            }
        }

        return $result;
    }

    public function lastRmPendatang()
    {
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', 7)
            ->orderBy('created_at', 'DESC')
            ->first();

        $getYearPasien = Date('Y');
        $noUrut = 1;
        if ($dataPasien) {
            $getYearPasien = Date('Y', strtotime($dataPasien->created_at));
            $noUrut = $dataPasien->no_urut + 1;
        }

        $yearNow = Date('Y');
        if ($yearNow != $getYearPasien) {
            $noUrut = 1;
        }
        return $noUrut;
    }

    public function lastRmSuratSehat()
    {
        $dataPasien = DB::table('pasiens')
            ->where('kategori', '=', 3)
            ->orderBy('created_at', 'DESC')
            ->first();

        $noUrut = 1;
        if ($dataPasien) {
            $noUrut = $dataPasien->no_urut + 1;
        }

        return $noUrut;
    }

    public function generateRMPendatang($nama, $kategori)
    {
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', 7)
            ->orderBy('created_at', 'DESC')
            ->first();

        $getYearPasien = Date('Y');
        if ($dataPasien) {
            $getYearPasien = Date('Y', strtotime($dataPasien->created_at));
        }

        $yearNow = Date('Y');
        $firstLetter = substr($nama, 0, 1);

        if ($dataPasien && ($yearNow == $getYearPasien)) {
            $getRm = $dataPasien->no_rm;
            $lastRm = $dataPasien->no_urut + 1;
            $newRm = '';
            $newRm .= '00-';
            $newRm .= strtoupper($firstLetter) . str_pad($lastRm, 3, "0", STR_PAD_LEFT).'-';
            $newRm .= date('y');
            $newRm .= ' '.$kategori;
        } else {
            $newRm = '';
            $newRm .= '00-';
            $newRm .= strtoupper($firstLetter).'001-';
            $newRm .= date('y');
            $newRm .= ' '.$kategori;
        }
        return $newRm;
    }

    public function prolanis()
    {
        $dataPasien = Pasien::where('status_prolanis', 1)->get();
        $navActive = 'transaksi-prolanis';

        return view('prolanis.index', compact('dataPasien', 'navActive'));
    }

    public function dtAjaxProlanis(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->type;
            $data = Pasien::where('status_prolanis', 1);
            if (strlen($type) > 0 && $type != 'ALL') {
                $data = $data->where('keterangan_prolanis', $type);
            }
            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    return '<a href="/prolanis/riwayat/' . $row->id . '">' . $row->nama . '</a>';
                })
                ->addColumn('umur', function ($row) {
                    $tglLahir = date_create($row->tgl_lahir);
                    $dateNow = date_create(Date('Y-m-d'));
                    $dateDiff = date_diff($tglLahir, $dateNow);
                    return $dateDiff->y;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:;" class="btn btn-primary btn-sm btn-send-whatsapp" data-pasien-id="'.$row->id.'">Kirim WA</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'nama'])
                ->make(true);
        }
    }

    public function dtAjaxProlanisRiwayat(Request $request)
    {
        if ($request->ajax()) {
            $pasienId = $request->pasienId;
            $data = Kunjungan::select('pasiens.nama', 'diagnosas.kode_icd', 'diagnosas.diagnosa as diagnosa_nama', 'kunjungans.*')
                ->join('pasiens', 'pasiens.id', 'kunjungans.id_pasien')
                ->join('diagnosas', 'diagnosas.id', 'kunjungans.diagnosa_main')
                ->where('kunjungans.id_pasien', $pasienId)
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl_kunjungan', function ($row) {
                    return Date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('diagnosa_show', function ($row) {
                    return $row->kode_icd . ' ' . $row->diagnosa_nama;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:;" class="btn btn-primary btn-sm btn-send-whatsapp" data-pasien-id="'.$row->id.'">Kirim WA</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function prolanisFilter($param = '')
    {
        $dataPasien = Pasien::where('status_prolanis', 1)
            ->where('keterangan_prolanis', $param)
            ->get();
        $navActive = 'transaksi-prolanis';

        return view('prolanis.index', compact('dataPasien', 'navActive'));
    }

    public function prolanisCreate()
    {
        $navActive = 'transaksi-prolanis';

        return view('prolanis.create', compact('navActive'));
    }

    public function checkProlanis(Request $request)
    {
        $queryPasien = Pasien::where('no_rm', $request->noRM)->first();
        return json_encode($queryPasien);
    }

    public function saveProlanis(Request $request)
    {
        if ($request->id_pasien == null) {
            return response()->json(
                ['error'=> 1, 'messages'=>'Pasien tidak di temukan'],
            );
        } else {
            $queryPasien = Pasien::find($request->id_pasien);
            $queryPasien->status_prolanis = 1;
            $queryPasien->keterangan_prolanis = $request->status_prolanis;
            $queryPasien->save();

            return response()->json(
                ['error'=> 0, 'messages'=>'Pasien berhasil di tambahkan'],
            );
        }
    }

    public function formPasien()
    {
        return view('pasien.form');
    }

    public function detailPasien($idPasien = '')
    {
        $modelPasien = Pasien::find($idPasien);

        $data = [];
        $data['pasien'] = $modelPasien;
        return view('pasien.detail', $data);
    }

    public function dtAjaxKunjungan($idPasien = '')
    {
        $modelKunjungan = Kunjungan::select('kunjungans.tanggal', 'polis.nama', 'diagnosas.diagnosa', 'klpcms.rs_rujukan')
            ->leftJoin('polis', 'polis.id', 'kunjungans.id_poli')
            ->leftJoin('diagnosas', 'diagnosas.id', 'kunjungans.diagnosa_main')
            ->leftJoin('klpcms', 'klpcms.id_kunjungan', 'kunjungans.id')
            ->where('kunjungans.id_pasien', $idPasien)
            ->get();

        return DataTables::of($modelKunjungan)
            ->addIndexColumn()
            ->make(true);
    }

    public function downloadCI($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/CPPT.docx');


        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('tgl_lahir', Date('d-m-Y', \strtotime($modelPasien->tgl_lahir)));
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('telepon', $modelPasien->no_hp);
        $templateProcessor->setValue('no_rm', $modelPasien->no_rm);
        $templateProcessor->setValue('nik', $modelPasien->no_ktp);
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        $templateProcessor->setValue('cara_bayar', $modelPasien->cara_bayar);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs ? $modelPasien->no_bpjs : '');
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('kel', $modelPasien->district ? District::find($modelPasien->district)->name . ' ' : '-');
        $templateProcessor->setValue('pekerjaan', $modelPasien->pekerjaan);
        $templateProcessor->setValue('agama', $modelPasien->agama);
        $templateProcessor->setValue('rt', $modelPasien->rt ? $modelPasien->rt . ' ' : '-');
        $templateProcessor->setValue('rw', $modelPasien->rw ? $modelPasien->rw . ' ' : '-');
        $templateProcessor->setValue('tanggal_ttd', Date('d F Y'));
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _CPPT.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadCI2($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/CPPT2.docx');
        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('tgl_lahir', Date('d-m-Y', \strtotime($modelPasien->tgl_lahir)));
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('telepon', $modelPasien->no_hp);
        $templateProcessor->setValue('no_rm', $modelPasien->no_rm);
        $templateProcessor->setValue('cara_bayar', $modelPasien->cara_bayar);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs ? $modelPasien->no_bpjs : '');
        $templateProcessor->setValue('nik', $modelPasien->no_ktp);
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('kel', $modelPasien->district ? District::find($modelPasien->district)->name . ' ' : '-');
        $templateProcessor->setValue('agama', $modelPasien->agama);
        $templateProcessor->setValue('rt', $modelPasien->rt ? $modelPasien->rt . ' ' : '-');
        $templateProcessor->setValue('rw', $modelPasien->rw ? $modelPasien->rw . ' ' : '-');
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _CPPT2.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadGigiMulut($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/PGM.docx');
        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('tgl_lahir', Date('d-m-Y', \strtotime($modelPasien->tgl_lahir)));
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('telepon', $modelPasien->no_hp);
        $templateProcessor->setValue('no_rm', $modelPasien->no_rm);
        $templateProcessor->setValue('nik', $modelPasien->nik);
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        $templateProcessor->setValue('cara_bayar', $modelPasien->cara_bayar);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs ? $modelPasien->no_bpjs : '');
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('kel', $modelPasien->district ? District::find($modelPasien->district)->name . ' ' : '-');
        $templateProcessor->setValue('agama', $modelPasien->agama);
        $templateProcessor->setValue('pekerjaan', $modelPasien->pekerjaan);
        $templateProcessor->setValue('rt', $modelPasien->rt ? $modelPasien->rt . ' ' : '-');
        $templateProcessor->setValue('rw', $modelPasien->rw ? $modelPasien->rw . ' ' : '-');
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _PGM.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadCet($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/CATATAN EDUKASI TERINTEGRASI.docx');

        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('tgl_lahir', Date('d-m-Y', \strtotime($modelPasien->tgl_lahir)));
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('no_rm', $modelPasien->no_rm);
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('kel', $modelPasien->district ? District::find($modelPasien->district)->name . ' ' : '-');
        $templateProcessor->setValue('agama', $modelPasien->agama);
        $templateProcessor->setValue('pekerjaan', $modelPasien->pekerjaan);
        $templateProcessor->setValue('rt', $modelPasien->rt ? $modelPasien->rt . ' ' : '-');
        $templateProcessor->setValue('rw', $modelPasien->rw ? $modelPasien->rw . ' ' : '-');
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _CET.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadProlanis($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/prolanis.docx');

        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('keterangan_prolanis', $modelPasien->keterangan_prolanis);
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _Berkas Rujukan Prolanis.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadGc($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/gc.docx');

        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('tgl_sekarang', Date('d-m-Y'));
        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _GC.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function downloadPak($idPasien = null)
    {
        $modelPasien = Pasien::find($idPasien);
        $tglLahir = date_create($modelPasien->tgl_lahir);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $umur = $dateDiff->y;

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc/new/pak.docx');
        $templateProcessor->setValue('nama_pasien', self::addName($idPasien) . $modelPasien->nama);
        $templateProcessor->setValue('no_bpjs', $modelPasien->no_bpjs);
        $templateProcessor->setValue('tgl_lahir', Date('d-m-Y', \strtotime($modelPasien->tgl_lahir)));
        $templateProcessor->setValue('alamat', $modelPasien->alamat);
        $templateProcessor->setValue('telepon', $modelPasien->no_hp);
        $templateProcessor->setValue('no_rm', $modelPasien->no_rm);
        $templateProcessor->setValue('nik', $modelPasien->no_ktp);
        $templateProcessor->setValue('umur', $umur . ' Tahun');
        $templateProcessor->setValue('jk', $modelPasien->jk == 'L' ? 'Laki-Laki' : 'Perempuan');
        $templateProcessor->setValue('kel', $modelPasien->district ? District::find($modelPasien->district)->name . ' ' : '-');
        $templateProcessor->setValue('pekerjaan', $modelPasien->pekerjaan);
        $templateProcessor->setValue('agama', $modelPasien->agama);
        $templateProcessor->setValue('cara_bayar', $modelPasien->cara_bayar);
        $templateProcessor->setValue('rt', $modelPasien->rt ? $modelPasien->rt . ' ' : '-');
        $templateProcessor->setValue('rw', $modelPasien->rw ? $modelPasien->rw . ' ' : '-');
        $templateProcessor->setValue('tanggal_ttd', Date('d F Y'));


        header("Content-Disposition: attachment; filename=" . $modelPasien->nama . " _PAK.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function tesPrint($idPasien)
    {
        $modelPasien = Pasien::find($idPasien);
        return view('tes.cetak', \compact('modelPasien'));
    }

    public function export($date = '') {
        $tgl = Date('Y-m-d');
        if (strlen($date) > 0){
            $tgl = $date;
        }
        return Excel::download(new PasienExport($tgl), 'pasien-'.$tgl.'.xlsx');
    }

    public function getDataFromNIK($nik) {
        // 3573012010960004
        $kecamatan = substr($nik, 0, 6);
        $kota = substr($nik, 0, 4);
        $provinsi = substr($nik, 0, 2);
        $tglLahir = substr($nik, 6, 2);
        $tahunLahir = substr($nik, 10, 2);
        $bulanLahir = substr($nik, 8, 2);
        $generateTahun = ((int) $tahunLahir > 23 && (int) $tahunLahir < 100) ? '19'.$tahunLahir : '20'.$tahunLahir;
        $jenisKelamin = ((int) $tglLahir >= 40) ? 'P' : 'L';
        $dataReturn = [];
        $newTglLahir = ((int) $tglLahir >= 40) ? strval((int) $tglLahir - 40) : strval($tglLahir);
        $dataReturn['kec'] = $kecamatan;
        $dataReturn['kota'] = $kota;
        $dataReturn['provinsi'] = $provinsi;
        $dataReturn['tglLahir'] = $newTglLahir;
        $dataReturn['bulan'] = $bulanLahir;
        $dataReturn['tglLahir'] = Date('Y-m-d', strtotime($generateTahun.'-'.$bulanLahir.'-'.$newTglLahir));
        $dataReturn['jk'] = $jenisKelamin;
        return json_encode($dataReturn);
    }

    public function checkAvailRM(Request $request){
        $norm = $request->norm;
        $idPasien = $request->idPasien;
        $dataPasienAwal = Pasien::find($idPasien);
        $dataPasien = Pasien::where('no_rm', $norm)->first();
        $result = false;
        if ($dataPasien && $norm != $dataPasienAwal->no_rm){
            $result = true;
        }

        return json_encode($result);
    }

    function getRMCanUse($kodeWilayah, $lastRm, $kategori) {
        $listRmCanUse = [];
        for ($i=1; $i < $lastRm; $i++) {
            $pasien = Pasien::where('wilayah', $kodeWilayah)->where('no_urut', $i)->where('kategori', $kategori)->first();
            if (!$pasien){
                $showKategori = $kategori == 1 ? 'U' : 'L';
                $listRmCanUse[] = '0' . $kodeWilayah . '-' . str_pad($i, 4, "0", STR_PAD_LEFT) . '-1 ' . $showKategori;
            }

            if (count($listRmCanUse) == 10){
                break;
            }
        }

        return $listRmCanUse;
    }

    public function checkAvailableRMByWilayah($wilayah) {
        $fixWilayah = self::generateWilayah($wilayah);
        $pasien = Pasien::where('wilayah', $fixWilayah)->latest()->first();
        $getLastRm = $pasien->no_rm;
        $getLastRmNumber = explode('-', $getLastRm);
        $lastNumberRm = $getLastRmNumber[1];
        $dataReturn = [];
        $dataReturn['umum'] = self::getRMCanUse($fixWilayah, (int) $lastNumberRm, 1);
        $dataReturn['lansia'] = self::getRMCanUse($fixWilayah, (int) $lastNumberRm, 2);
        return $dataReturn;
    }
}
