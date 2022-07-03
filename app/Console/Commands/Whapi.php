<?php

namespace App\Console\Commands;

use App\Models\Pasien;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Whapi extends Command
{
    protected $signature = 'whapi:sendMessage';
    protected $description = 'Test send message via whapi';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dataSend = [];
        $dataPasien = Pasien::where('status_prolanis', 1)->get();
        foreach ($dataPasien as $pasien) {
            $getLastKunjungan = $pasien->last_kunjungan_prolanis;
            $now = time(); // or your date as well
            $lastKunjungan = strtotime($getLastKunjungan);
            $datediff = $now - $lastKunjungan;

            $diff = round($datediff / (60 * 60 * 24));
            if ($pasien->count_send_reminder <=3) {
                if ($diff >= 30) {
                    $response = Http::post('http://localhost:8000/send-message', [
                        'number' => $pasien->no_hp,
                        'message' => 'Selamat pagi Bapak / Ibu ' . $pasien->nama . ' anda terdaftar di program prolanis Puskesmas Rampal Celaket Kota Malang, tanggal kunjungan terakhir anda adalah : ' . $pasien->last_kunjungan . ' mohon segera kontrol'
                    ]);
                    $dataPasien = Pasien::find($pasien->id);
                    $dataPasien->count_send_reminder = $pasien->count_send_reminder + 1;
                    $dataPasien->save();
                }
            }
        }

        $this->info('Successfully sent daily quote to everyone.');
    }
}
