<?php
namespace App\Http\Controllers\Export;

use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProlanisExport implements FromView
{

    protected $tgl;

    function __construct($tgl) {
        $this->tgl = $tgl;
    }

    public function checkAge($borndate){
        $tglLahir = date_create($borndate);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $dataReturn['thn'] = $dateDiff->y;
        $dataReturn['bln'] = $dateDiff->m;
        $dataReturn['hr'] = $dateDiff->d;
        return $dataReturn;
    }
    public function getData()
    {
        $data = Pasien::select('pasiens.no_rm','pasiens.nama', 'pasiens.no_hp', 'pasiens.alamat', 'pasiens.rt', 'pasiens.rw', 'pasiens.tgl_lahir',
            'pasiens.keterangan_prolanis', 'pasiens.no_bpjs', 'villages.name as kelurahan')->where('status_prolanis', 1)
        ->join('villages', 'villages.id', 'pasiens.village')->get();
        $dataReturn = [];
        foreach ($data as $key => $value) {
            switch ($value->jenis_kasus) {
                case 0:
                    $jenisKasus = 'L';
                    break;
                case 1:
                    $jenisKasus = 'B';
                    break;
                case 2:
                    $jenisKasus = 'KKL';
                    break;

                default:
                    $jenisKasus = 'Lama';
                    break;
            }
            $dataTemp = [];
            $dataAge = [];
            $dataTemp = $value->toArray();
            $dataAge = self::checkAge($value->tgl_lahir);
            $dataReturn[] = array_merge($dataTemp, $dataAge);
        }

        return $dataReturn;
    }

    public function view(): View
    {
        $pasien = self::getData();
        return view('prolanis.export', ['dataPasien' => $pasien]);
    }
}
