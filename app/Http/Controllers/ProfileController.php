<?php

namespace App\Http\Controllers;

use App\Member;
use App\Request as AppRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $data = Member::where('id', $id)->first();

        return view('member.profile', compact('data'));
    }

    public  function store(Request $request)
    {
        AppRequest::create([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
        ]);
    }
}
