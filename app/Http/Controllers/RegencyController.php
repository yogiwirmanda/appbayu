<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function getDataProvince($provinceId = null)
    {
        $dataProvince = [];
        if ($provinceId == null) {
            $dataProvince = Province::all();
        } else {
            $dataProvince = Province::find($provinceId);
        }
        echo json_encode($dataProvince);
    }

    public function getDataCity(Request $request)
    {
        $provinceId = $request->provinceId;
        $dataCity = [];
        $dataCity = Regency::where('province_id', $provinceId)->get();
        echo json_encode($dataCity);
    }

    public function getDataDistrict(Request $request)
    {
        $cityId = $request->cityId;
        $dataDistrict = [];
        $dataDistrict = District::where('regency_id', $cityId)->get();
        echo json_encode($dataDistrict);
    }

    public function getDataVillages(Request $request)
    {
        $districtId = $request->districtId;
        $dataDistrict = [];
        $dataDistrict = Village::where('district_id', $districtId)->get();
        echo json_encode($dataDistrict);
    }
}
