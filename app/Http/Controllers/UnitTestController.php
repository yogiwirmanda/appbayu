<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Reformat;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UnitTestController extends Controller
{
    public function testSendMessage()
    {
        $response = Http::post('http://localhost:3000/api/sendMessage', [
            'apiKey' => '28fd5a102cf00cacb299a66d1fe866b3',
            'phone' => '081217018168',
            'message' => 'coba lagi kirim lewat api we',
        ]);
        dd($response);
    }

    public function send($idPasien)
    {
        $pasien = Pasien::where('id', $idPasien)->first();
        $token = 'LsBBV34pipt7T1JCrVjV';

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', [
            'target' => $pasien->no_hp,
            'message' => 'Selamat pagi Bapak / Ibu ' . $pasien->nama . ' anda terdaftar di program prolanis Puskesmas Rampal Celaket Kota Malang, tanggal kunjungan terakhir anda adalah : ' . $pasien->last_kunjungan . ' mohon segera kontrol'
        ]);
    }

    public function getProlanis()
    {
        $dataSend = [];
        $dataPasien = Pasien::where('status_prolanis', 1)->get();
        foreach ($dataPasien as $pasien) {
            $getLastKunjungan = $pasien->last_kunjungan_prolanis;
            $now = time();
            $lastKunjungan = strtotime($getLastKunjungan);
            $datediff = $now - $lastKunjungan;

            $diff = round($datediff / (60 * 60 * 24));
            if ($diff >= 30) {
                dd($diff);
                $dataTemp['phone'] = $pasien->no_hp;
                $dataSend[] = $dataTemp;
            }
        }
        dd($dataTemp);
    }

    public function reformat()
    {
        $model = Reformat::all();
        foreach ($model as $data) {
            $modelPasien = Pasien::find($data->id);
            if (strlen($data->tgl) > 0) {
                $modelPasien->tgl_lahir = $data->tgl;
            } else {
                $modelPasien->tgl_lahir = Date('Y-m-d');
            }
            $modelPasien->created_at = Date('Y-m-d');
            $modelPasien->updated_at = Date('Y-m-d');
            $modelPasien->save();
        }
    }

    public function getWilayah($code)
    {
        $modelWilayah = Wilayah::where('kode', $code)->first();
        if ($modelWilayah){
            return $modelWilayah->id;
        } else {
            return 10;
        }
    }

    public function reformatDistrict()
    {
        $modelPasien = Pasien::all();
        foreach ($modelPasien as $key => $value) {
            $norm = $value->no_rm;
            $explodeRm = \explode('-', $norm);
            $rawCode = $explodeRm[0];
            $getModelPasien = Pasien::find($value->id);
            $getModelPasien->wilayah = self::getWilayah($rawCode);
            $getModelPasien->update();
        }

    }

    public function reformatHeadRM()
    {
        $modelPasien = Pasien::all();
        foreach ($modelPasien as $key => $value) {
            $norm = $value->no_rm;
            $explodeRm = \explode('-', $norm);
            $rawCode = $explodeRm[0].'-'.$explodeRm[1];
            $getModelPasien = Pasien::find($value->id);
            $getModelPasien->head_rm = $rawCode;
            $getModelPasien->update();
        }
    }

    public function reformatNoUrut()
    {
        $modelPasien = Pasien::all();
        foreach ($modelPasien as $key => $value) {
            $norm = $value->no_rm;
            $explodeRm = \explode('-', $norm);
            if (count($explodeRm) > 1){
                $rawCode = $explodeRm[1];
                $getModelPasien = Pasien::find($value->id);
                $getModelPasien->no_urut = (int) $rawCode;
                $getModelPasien->update();
            }
        }
    }

    public function runCompleteData()
    {
        $modelPasien = Pasien::where('id', '>', 8350)->get();
        foreach ($modelPasien as $key => $value) {
            $nik = $value->no_ktp != null ? 1 : 0;
            $norm = $value->no_rm != null ? 1 : 0;
            $nama = $value->nama != null ? 1 : 0;
            $kepala_keluarga = $value->kepala_keluarga != null ? 1 : 0;
            $tgl_lahir = $value->tgl_lahir != null ? 1 : 0;
            $alamat = $value->alamat != null ? 1 : 0;
            $no_hp = $value->no_hp != null ? 1 : 0;
            $total = $nik + $norm + $nama + $kepala_keluarga + $tgl_lahir + $alamat + $no_hp;
            $modelUpdate = Pasien::find($value->id);
            if ($total == 7){
                $modelUpdate->is_data_complete = 1;
                $modelUpdate->save();
            }
        }
    }
}
