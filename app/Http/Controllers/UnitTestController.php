<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
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
        $dataPasien = Pasien::where('id', $idPasien)->first();
        $response = Http::post('http://localhost:3000/api/sendMessage', [
            'apiKey' => '28fd5a102cf00cacb299a66d1fe866b3',
            'phone' => $dataPasien->no_hp,
            'message' => 'Selamat pagi Bapak / Ibu ' . $dataPasien->nama . ' anda terdaftar di program prolanis Puskesmas Rampal Celaket Kota Malang, tanggal kunjungan terakhir anda adalah : ' . $dataPasien->last_kunjungan . ' mohon segera kontrol',
            'file_name' => 'prcv3solid.png',
            'as_document' => 0,
        ]);
    }

    public function getProlanis()
    {
        $dataSend = [];
        $dataPasien = Pasien::where('status_prolanis', 1)->get();
        foreach ($dataPasien as $pasien) {
            $getLastKunjungan = $pasien->last_kunjungan_prolanis;
            $now = time(); // or your date as well
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
}
