<?php

namespace App\Http\Controllers;

use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces(){
        $provinces = Province::all();
        return response()->json($provinces);
    }
    // Lấy dữ liệu sử dụng Relationship (vd: Tỉnh -> quận)
    public function getDistricts(Request $request, Province $province){
        $districts = $province->districts;
        return response()->json( $districts);
    }
    // Lấy dữ liệu sử dụng Relationship (VD: Quận -> Xã)
    public function getWards(Request $request, District $district){
        $wards = $district->wards;
        return response()->json($wards);
    }
}
