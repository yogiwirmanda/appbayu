<?php
namespace App\Http\Controllers\Export;

use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PasienExport implements FromView
{
    public function checkAge($borndate){
        $tglLahir = date_create($borndate);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $dataReturn['thn'] = $dateDiff->y;
        $dataReturn['bln'] = $dateDiff->m;
        $dataReturn['hr'] = $dateDiff->d;
        return $dataReturn;
    }
    public function getData($tgl)
    {

        $data = Pasien::whereDate('created_at', $tgl)->get();
        $dataReturn = [];
        foreach ($data as $key => $value) {
            $dataTemp = [];
            $dataAge = [];
            $dataTemp = $value->toArray();
            $dataAge = self::checkAge($value->tgl_lahir);
            $dataReturn[] = array_merge($dataTemp, $dataAge);
        }

        return $dataReturn;
    }

    public function view($tgl = ''): View
    {
        $pasien = self::getData($tgl);
        return view('pasien.export', ['dataPasien' => $pasien]);
    }
}
