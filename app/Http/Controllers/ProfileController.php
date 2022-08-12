<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Member;
use App\Request as AppRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $data = new AppRequest();
        $keyword = $request->keyword;
        $data = $data->join('members', 'members.id', '=', 'requests.member_id')->where('rq_status','0');
        if ($keyword) {
            $data = $data->where('members.full_name', 'like', "%" . $keyword . "%");
        }
        $data = $data->paginate(10);
        return view('request.list', compact('data', 'keyword'));
    }


    public function create()
    {
        $id = Auth::id();
        $data = Member::where('id', $id)->first();

        return view('member.profile', compact('data'));
    }

    public  function store(ProfileRequest $request)
    {
        $requestEdit = AppRequest::where('member_id', Auth::id())->where('rq_status', '0')->exists();
        // dd($request);
        if ($requestEdit) {
            return redirect()->back()->with(['message' => 'Bạn đang có 1 yêu cầu. Vui lòng đợi admin duyệt!']);
        } else {
            $member = AppRequest::create([
                'member_id' => Auth::id(),
                'rq_full_name' => $request->full_name,
                'rq_gender' => $request->gender,
                'rq_tinh' => $request->calc_shipping_provinces,
                'rq_huyen' => $request->calc_shipping_district,
                'rq_address' => $request->address,
                'rq_brith_date' => $request->brith_date,
                'rq_status' => 0,
            ]);

            if ($request->hasFile('avatar')) {
                $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
                $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
                $member->rq_avatar = str_replace('public', '', $imagePath);
            }
            $member->save();
        }

        return redirect()->back()->with(['message' => 'Gửi yêu cầu thành công. Vui lòng đợi admin duyệt!']);
    }

    public function update(ProfileRequest $request, $id)
    {
        $requestMember = AppRequest::findOrFail($id);
        $requestMember->update([
            'rq_full_name' => $request->full_name,
            'rq_gender' => $request->gender,
            'rq_tinh' => $request->calc_shipping_provinces,
            'rq_huyen' => $request->calc_shipping_district,
            'rq_address' => $request->address,
            'rq_brith_date' => $request->brith_date,
            'rq_status' => 1,
        ]);

        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $requestMember->rq_avatar = str_replace('public', '', $imagePath);
        }
        $requestMember->save();

        $memberID = $requestMember->member_id;
        $fullName = $requestMember->rq_full_name;
        $gender = $requestMember->rq_gender;
        $tinh = $requestMember->rq_tinh;
        $huyen = $requestMember->rq_huyen;
        $address = $requestMember->rq_address;
        $brithDate = $requestMember->rq_brith_date;
        $avatar = $requestMember->rq_avatar;

        $member = Member::where('members.id', '=', $memberID)->first();

        if ($requestMember->rq_status === 1) {
            $member->full_name = $fullName;
            $member->gender = $gender;
            $member->tinh = $tinh;
            $member->huyen = $huyen;
            $member->address = $address;
            $member->brith_date = $brithDate;
            $member->avatar = $avatar;
            $member->save();
        
            return redirect('list-request')->with(['message' => 'Thông tin nhân viên đã được cập nhật thành công!']);

        } else {

            return view('request.list')->with(['message' => 'Đã từ chối yêu cầu sửa!']);
        }
    }

    public function show($id)
    {
        $data = AppRequest::findOrFail($id);

        return view('request.show', compact('data'));
    }

    public function delete($id)
    {
        AppRequest::findOrFail($id)->delete();
        return redirect('list-request')->with(['message' => 'Từ chối yêu cầu thành công']);
    }

    public function getReset()
    {
        return view('resetPassword');
    }

    public function changePassWord(PasswordRequest $request)
    {
        $member = Member::findOrFail(Auth::id());
        $member->password = Hash::make($request->new_password);
        $member->save();

        return redirect('logout')->with(['message' => 'Đổi mật khẩu thành công!']);
    }

}
