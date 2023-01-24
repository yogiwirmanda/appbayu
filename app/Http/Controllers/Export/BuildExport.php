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
        $startDateFrom1Year = Date('Y-m-d', strtotime(' - 1 year'));
        $endDateFrom4Year = Date('Y-m-d', strtotime(' - 4 year'));
        $startDateFrom5Year = Date('Y-m-d', strtotime(' - 5 year'));
        $endDateFrom9Year = Date('Y-m-d', strtotime(' - 9 year'));
        $startDateFrom10Year = Date('Y-m-d', strtotime(' - 10 year'));
        $endDateFrom14Year = Date('Y-m-d', strtotime(' - 14 year'));
        $startDateFrom15Year = Date('Y-m-d', strtotime(' - 15 year'));
        $endDateFrom19Year = Date('Y-m-d', strtotime(' - 19 year'));
        $startDateFrom20Year = Date('Y-m-d', strtotime(' - 20 year'));
        $endDateFrom44Year = Date('Y-m-d', strtotime(' - 44 year'));
        $startDateFrom45Year = Date('Y-m-d', strtotime(' - 45 year'));
        $endDateFrom54Year = Date('Y-m-d', strtotime(' - 54 year'));
        $startDateFrom55Year = Date('Y-m-d', strtotime(' - 55 year'));
        $endDateFrom59Year = Date('Y-m-d', strtotime(' - 59 year'));
        $startDateFrom60Year = Date('Y-m-d', strtotime(' - 60 year'));
        $endDateFrom69Year = Date('Y-m-d', strtotime(' - 69 year'));
        $startDateFrom60Year = Date('Y-m-d', strtotime(' - 60 year'));
        $endDateFrom69Year = Date('Y-m-d', strtotime(' - 69 year'));
        $startDateFrom70Year = Date('Y-m-d', strtotime(' - 70 year'));
        $endDateFrom150Year = Date('Y-m-d', strtotime(' - 150 year'));
        $monthKunjungan = Date('m');
        $days7AgeOld = self::getDataFromAgeByDay($startDate7, $endDate7, $monthKunjungan, 0);
        $days7AgeNew = self::getDataFromAgeByDay($startDate7, $endDate7, $monthKunjungan, 1);
        $days28AgeOld = self::getDataFromAgeByDay($startDate28, $endDate28, $monthKunjungan, 0);
        $days28AgeNew = self::getDataFromAgeByDay($startDate28, $endDate28, $monthKunjungan, 1);
        $below1YearAgeOld = self::getDataFromAgeByDay($startDateBelow1Year, $endDateBelow1Year, $monthKunjungan, 0);
        $below1YearAgeNew = self::getDataFromAgeByDay($startDateBelow1Year, $endDateBelow1Year, $monthKunjungan, 1);
        $startFrom1to4YearOld = self::getDataFromAgeByDay($startDateFrom1Year, $endDateFrom4Year, $monthKunjungan, 0);
        $startFrom1to4YearNew = self::getDataFromAgeByDay($startDateFrom1Year, $endDateFrom4Year, $monthKunjungan, 1);
        $startFrom5to9YearOld = self::getDataFromAgeByDay($startDateFrom5Year, $endDateFrom9Year, $monthKunjungan, 0);
        $startFrom5to9YearNew = self::getDataFromAgeByDay($startDateFrom5Year, $endDateFrom9Year, $monthKunjungan, 1);
        $startFrom10to14YearOld = self::getDataFromAgeByDay($startDateFrom10Year, $endDateFrom14Year, $monthKunjungan, 0);
        $startFrom10to14YearNew = self::getDataFromAgeByDay($startDateFrom10Year, $endDateFrom14Year, $monthKunjungan, 1);
        $startFrom15to19YearOld = self::getDataFromAgeByDay($startDateFrom15Year, $endDateFrom19Year, $monthKunjungan, 0);
        $startFrom15to19YearNew = self::getDataFromAgeByDay($startDateFrom15Year, $endDateFrom19Year, $monthKunjungan, 1);
        $startFrom20to44YearOld = self::getDataFromAgeByDay($startDateFrom20Year, $endDateFrom44Year, $monthKunjungan, 0);
        $startFrom20to44YearNew = self::getDataFromAgeByDay($startDateFrom20Year, $endDateFrom44Year, $monthKunjungan, 1);
        $startFrom45to54YearOld = self::getDataFromAgeByDay($startDateFrom45Year, $endDateFrom54Year, $monthKunjungan, 0);
        $startFrom45to54YearNew = self::getDataFromAgeByDay($startDateFrom45Year, $endDateFrom54Year, $monthKunjungan, 1);
        $startFrom55to59YearOld = self::getDataFromAgeByDay($startDateFrom55Year, $endDateFrom59Year, $monthKunjungan, 0);
        $startFrom55to59YearNew = self::getDataFromAgeByDay($startDateFrom55Year, $endDateFrom59Year, $monthKunjungan, 1);
        $startFrom60to69YearOld = self::getDataFromAgeByDay($startDateFrom60Year, $endDateFrom69Year, $monthKunjungan, 0);
        $startFrom60to69YearNew = self::getDataFromAgeByDay($startDateFrom60Year, $endDateFrom69Year, $monthKunjungan, 1);
        $startFrom70to150YearOld = self::getDataFromAgeByDay($startDateFrom70Year, $endDateFrom150Year, $monthKunjungan, 0);
        $startFrom70to150YearNew = self::getDataFromAgeByDay($startDateFrom70Year, $endDateFrom150Year, $monthKunjungan, 1);
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
            $dataTemp['below1YearOldFemale'] = self::getDataFromModel($below1YearAgeOld, 'female', 0);
            $dataTemp['below1YearNewMale'] = self::getDataFromModel($below1YearAgeNew, 'male', 0);
            $dataTemp['below1YearNewFemale'] = self::getDataFromModel($below1YearAgeNew, 'female', 0);
            $dataTemp['startFrom1to4YearOldMale'] = self::getDataFromModel($startFrom1to4YearOld, 'male', 0);
            $dataTemp['startFrom1to4YearOldFemale'] = self::getDataFromModel($startFrom1to4YearOld, 'female', 0);
            $dataTemp['startFrom1to4YearNewMale'] = self::getDataFromModel($startFrom1to4YearNew, 'male', 0);
            $dataTemp['startFrom1to4YearNewFemale'] = self::getDataFromModel($startFrom1to4YearNew, 'female', 0);
            $dataTemp['startFrom5to9YearOldMale'] = self::getDataFromModel($startFrom5to9YearOld, 'male', 0);
            $dataTemp['startFrom5to9YearOldFemale'] = self::getDataFromModel($startFrom5to9YearOld, 'female', 0);
            $dataTemp['startFrom5to9YearNewMale'] = self::getDataFromModel($startFrom5to9YearNew, 'male', 0);
            $dataTemp['startFrom5to9YearNewFemale'] = self::getDataFromModel($startFrom5to9YearNew, 'female', 0);
            $dataTemp['startFrom10to14YearOldMale'] = self::getDataFromModel($startFrom10to14YearOld, 'male', 0);
            $dataTemp['startFrom10to14YearOldFemale'] = self::getDataFromModel($startFrom10to14YearOld, 'female', 0);
            $dataTemp['startFrom10to14YearNewMale'] = self::getDataFromModel($startFrom10to14YearNew, 'male', 0);
            $dataTemp['startFrom10to14YearNewFemale'] = self::getDataFromModel($startFrom10to14YearNew, 'female', 0);
            $dataTemp['startFrom15to19YearOldMale'] = self::getDataFromModel($startFrom15to19YearOld, 'male', 0);
            $dataTemp['startFrom15to19YearOldFemale'] = self::getDataFromModel($startFrom15to19YearOld, 'female', 0);
            $dataTemp['startFrom15to19YearNewMale'] = self::getDataFromModel($startFrom15to19YearNew, 'male', 0);
            $dataTemp['startFrom15to19YearNewFemale'] = self::getDataFromModel($startFrom15to19YearNew, 'female', 0);
            $dataTemp['startFrom20to44YearOldMale'] = self::getDataFromModel($startFrom20to44YearOld, 'male', 0);
            $dataTemp['startFrom20to44YearOldFemale'] = self::getDataFromModel($startFrom20to44YearOld, 'female', 0);
            $dataTemp['startFrom20to44YearNewMale'] = self::getDataFromModel($startFrom20to44YearNew, 'male', 0);
            $dataTemp['startFrom20to44YearNewFemale'] = self::getDataFromModel($startFrom20to44YearNew, 'female', 0);
            $dataTemp['startFrom45to54YearOldMale'] = self::getDataFromModel($startFrom45to54YearOld, 'male', 0);
            $dataTemp['startFrom45to54YearOldFemale'] = self::getDataFromModel($startFrom45to54YearOld, 'female', 0);
            $dataTemp['startFrom45to54YearNewMale'] = self::getDataFromModel($startFrom45to54YearNew, 'male', 0);
            $dataTemp['startFrom45to54YearNewFemale'] = self::getDataFromModel($startFrom45to54YearNew, 'female', 0);
            $dataTemp['startFrom55to59YearOldMale'] = self::getDataFromModel($startFrom55to59YearOld, 'male', 0);
            $dataTemp['startFrom55to59YearOldFemale'] = self::getDataFromModel($startFrom55to59YearOld, 'female', 0);
            $dataTemp['startFrom55to59YearNewMale'] = self::getDataFromModel($startFrom55to59YearNew, 'male', 0);
            $dataTemp['startFrom55to59YearNewFemale'] = self::getDataFromModel($startFrom55to59YearNew, 'female', 0);
            $dataTemp['startFrom60to69YearOldMale'] = self::getDataFromModel($startFrom60to69YearOld, 'male', 0);
            $dataTemp['startFrom60to69YearOldFemale'] = self::getDataFromModel($startFrom60to69YearOld, 'female', 0);
            $dataTemp['startFrom60to69YearNewMale'] = self::getDataFromModel($startFrom60to69YearNew, 'male', 0);
            $dataTemp['startFrom60to69YearNewFemale'] = self::getDataFromModel($startFrom60to69YearNew, 'female', 0);
            $dataTemp['startFrom70to150YearOldMale'] = self::getDataFromModel($startFrom70to150YearOld, 'male', 0);
            $dataTemp['startFrom70to150YearOldFemale'] = self::getDataFromModel($startFrom70to150YearOld, 'female', 0);
            $dataTemp['startFrom70to150YearNewMale'] = self::getDataFromModel($startFrom70to150YearNew, 'male', 0);
            $dataTemp['startFrom70to150YearNewFemale'] = self::getDataFromModel($startFrom70to150YearNew, 'female', 0);
            $dataBuild[] = $dataTemp;
        }

        return view('laporan.lb1.table', ['lb1' => $dataBuild]);
    }
}
