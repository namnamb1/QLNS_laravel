<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Member;
use App\Request as AppRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $city = Cities::with('districts')->get();
        $id = Auth::id();
        $data = Member::where('id', $id)->first();

        return view('member.profile', compact('data','city'));
    }

    public  function store(Request $request)
    {
        $member = AppRequest::create([
            'member_id' => Auth::id(),
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
            'status' => 0,
        ]);
        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $member->avatar = str_replace('public', '', $imagePath);
        }
        $member->save();

        return redirect()->back()->with(['message' => 'Gửi yêu cầu thành công. Vui lòng đợi admin duyệt!']);
    }

    public function update(Request $request, $id){
        $member = AppRequest::findOrFail($id);
        $member->update([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
            'status' => $request->status,
        ]);

        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $member->avatar = str_replace('public', '', $imagePath);
        }
        $member->save();
    }

    public function approve(){

    }
}
