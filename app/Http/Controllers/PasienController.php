<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Kategori;
use App\Models\Pasien;
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

class PasienController extends Controller
{
    public function __construct()
    {
        $this->navActive = 'master-pasien';
    }

    public function index()
    {
        $dataPasien = DB::table('pasiens')
                ->join('districts', 'pasiens.district', '=', 'districts.id')
                ->select('pasiens.*', 'districts.name AS namaWilayah')
                ->orderBy('created_at', 'DESC')
                ->get();
        $navActive = $this->navActive;

        return view('pasien.index', compact('dataPasien', 'navActive'));
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

            $kodeKategori = self::checkKategoriPasien($request->umur);
            $noRm = $request->noRm;
            if (strlen($noRm) == 0 && strlen($pendatang == null)) {
                $checkUsedRM = self::checkUsedRm($wilayah, $kodeKategori);
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

            $kodeWilayah = $wilayah;
            if ($pendatang != null) {
                $kodeWilayah = 7;
            }

            $dataStore = [];
            $dataStore['no_rm'] = $noRm;
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
            $dataStore['kewarganegaraan'] = $request->warganegara;
            $dataStore['gol_darah'] = $request->gol_darah;
            $dataStore['status_kawin'] = $request->status_kawin;
            $dataStore['village'] = $request->villages;

            $modelPasien = Pasien::create($dataStore);
        }

        return response()->json(
            ['error'=> $error, 'messages'=>'Pasien berhasil di tambahkan'],
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

            if (strlen($nomorRMManual) == 0){
                $noRm = $request->noRm;
                if (strlen($noRm) == 0 && strlen($pendatang == null)) {
                    $checkUsedRM = self::checkUsedRm($wilayah, $kodeKategori);
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
            $dataStore['no_ktp'] = $request->no_ktp;
            $dataStore['tgl_lahir'] = $request->tgl_lahir;
            $dataStore['tempat_lahir'] = $request->tempat_lahir;
            $dataStore['jk'] = $request->jk;
            $dataStore['alamat'] = $request->alamat;
            $dataStore['agama'] = $request->agama;
            $dataStore['wilayah'] = $kodeWilayah;
            $dataStore['no_hp'] = (strlen($request->no_hp) > 0) ? $request->no_hp : '' ;
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
        $dataCity = Regency::where('province_id', $pasiens->province)->get();
        $dataDistrict = District::where('regency_id', $pasiens->regency)->get();
        $dataVillages = Village::where('district_id', $pasiens->district)->get();
        $navActive = $this->navActive;

        return view('pasien.edit', compact('pasiens', 'id', 'dataProvince', 'dataCity', 'dataDistrict', 'dataVillages', 'navActive'));
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
            $lastRm = $explodeRm[1]+1;
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
            case '3573030008':
                $wilayah = 1;
                break;
            case '3573030009':
                $wilayah = 2;
                break;
            case '3573030010':
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
        $result = $result->groupBy('kepala_keluarga')->get();

        echo json_encode($result);
    }

    public function checkUsedRm($wilayah, $kategori)
    {
        $result = null;
        $query = rmcanuse::where('wilayah', $wilayah)
            ->where('kategori', $kategori)
            ->where('status', '>', 0)
            ->first();
        if ($query) {
            $result = $query->no_urut;
            $updated = rmcanuse::find($query->id);
            $updated->status = 0;
            $updated->update();
        }
        return $result;
    }

    public function lastRmPendatang()
    {
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', 7)
            ->orderBy('created_at', 'DESC')
            ->first();

        $getYearPasien = Date('Y', strtotime($dataPasien->created_at));
        $yearNow = Date('Y');
        $noUrut = $dataPasien->no_urut + 1;
        if ($yearNow != $getYearPasien) {
            $noUrut = 1;
        }
        return $noUrut;
    }

    public function generateRMPendatang($nama, $kategori)
    {
        $dataPasien = DB::table('pasiens')
            ->where('wilayah', '=', 7)
            ->orderBy('created_at', 'DESC')
            ->first();

        $getYearPasien = Date('Y', strtotime($dataPasien->created_at));
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
}
