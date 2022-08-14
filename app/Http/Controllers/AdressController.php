<?php

namespace App\Http\Controllers;

use App\Cities;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;

class AdressController extends Controller
{
    public function getDistricts(Request $request)
    {
        $cityId = $request->cityId;
        $address = new Helper();
        $data = Cities::find($cityId)->districts()->orderby('name')->get();
        $districts = $address->districts($data, $cityId);

        return response()->json([
            "code" => 200,
            'data' => $districts,
            "message" => "success"
        ], 200);
    }
}
