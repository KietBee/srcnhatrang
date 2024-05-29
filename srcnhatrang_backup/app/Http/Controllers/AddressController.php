<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class AddressController extends Controller
{
    public function getProvince()
    {
        $provinces = Province::all();
        return $provinces;
    }

    public function getDistricts($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();
        return response()->json($districts);
    }

    public function getWards($district_id)
    {
        $wards = Ward::where('district_id', $district_id)->get();
        return response()->json($wards);
    }
}
