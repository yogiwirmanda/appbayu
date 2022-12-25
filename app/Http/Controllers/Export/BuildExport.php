<?php
namespace App\Http\Controllers\Export;

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BuildExport implements FromView
{
    public function getDataFromAgeByDay($startDate, $endDate, $monthKunjungan, $jenisKasus)
    {
        $data = Kunjungan::select(DB::raw('SUM(CASE WHEN p.jk = "L" then 1 ELSE 0 END) as male, SUM(CASE WHEN p.jk = "P" then 1 ELSE 0 END) as female, count(p.id) as total'))
            ->whereDate('p.tgl_lahir', '>=', $startDate)
            ->whereDate('p.tgl_lahir', '<=', $endDate)
            ->whereMonth('kunjungans.created_at', $monthKunjungan)
            ->where('kunjungans.jenis_kasus', $jenisKasus)
            ->join('pasiens as p', 'kunjungans.id_pasien', 'p.id')
            ->groupBy('p.id')
            ->first();

        return $data;
    }

    private function getDataFromModel($result, $key, $defaultValue = [])
    {
        $resultValue = $defaultValue;
        if ($result != null) {
            $resultValue = (int) $result->{$key};
        }
        return $resultValue;
    }

    public function view(): View
    {
        $dataDiagnosaActive = Diagnosa::select('diagnosas.diagnosa as nama_diagnosa', 'diagnosas.kode_icd as kode_icd', 'kunjungans.*')->join('kunjungans', 'kunjungans.diagnosa_main', 'diagnosas.id')->get();
        $dataBuild = [];
        $endDate7 = Date('Y-m-d');
        $startDate7 = Date('Y-m-d', strtotime(' - 7 days'));
        $endDate28 = Date('Y-m-d', strtotime(' - 28 days'));
        $startDate28 = Date('Y-m-d', strtotime(' - 8 days'));
        $startDateBelow1Year = Date('Y-m-d', strtotime(' - 29 days'));
        $endDateBelow1Year = Date('Y-m-d', strtotime(' - 1 year'));
        $monthKunjungan = Date('m');
        $days7AgeOld = self::getDataFromAgeByDay($startDate7, $endDate7, $monthKunjungan, 0);
        $days7AgeNew = self::getDataFromAgeByDay($startDate7, $endDate7, $monthKunjungan, 1);
        $days28AgeOld = self::getDataFromAgeByDay($startDate28, $endDate28, $monthKunjungan, 0);
        $days28AgeNew = self::getDataFromAgeByDay($startDate28, $endDate28, $monthKunjungan, 1);
        $below1YearAgeOld = self::getDataFromAgeByDay($startDateBelow1Year, $endDateBelow1Year, $monthKunjungan, 0);
        $below1YearAgeNew = self::getDataFromAgeByDay($startDateBelow1Year, $endDateBelow1Year, $monthKunjungan, 1);
        foreach ($dataDiagnosaActive as $diagnosa) {
            $dataTemp = [];
            $dataTemp['kode_icd'] = $diagnosa->kode_icd;
            $dataTemp['diagnosa'] = $diagnosa->nama_diagnosa;
            $dataTemp['7DaysNewMale'] = self::getDataFromModel($days7AgeNew, 'male', 0);
            $dataTemp['7DaysNewFemale'] = self::getDataFromModel($days7AgeNew, 'female', 0);
            $dataTemp['7DaysOldMale'] = self::getDataFromModel($days7AgeOld, 'male', 0);
            $dataTemp['7DaysOldFemale'] = self::getDataFromModel($days7AgeOld, 'female', 0);
            $dataTemp['28DaysNewdMale'] = self::getDataFromModel($days28AgeNew, 'male', 0);
            $dataTemp['28DaysNewFemale'] = self::getDataFromModel($days28AgeNew, 'female', 0);
            $dataTemp['28DaysOldMale'] = self::getDataFromModel($days28AgeOld, 'male', 0);
            $dataTemp['28DaysOldFemale'] = self::getDataFromModel($days28AgeOld, 'female', 0);
            $dataTemp['below1YearOldMale'] = self::getDataFromModel($below1YearAgeOld, 'male', 0);
            $dataTemp['below1YearOldFemale'] = self::getDataFromModel($below1YearAgeNew, 'female', 0);
            $dataBuild[] = $dataTemp;
        }

        return view('laporan.lb1.table', ['lb1' => $dataBuild]);
    }
}
