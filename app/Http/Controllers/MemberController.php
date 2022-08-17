<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Department;
use App\Districts;
use App\Document;
use App\Group;
use App\GroupMember;
use App\Http\Helpers\Helper;
use App\Http\Requests\MemberRequest;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $list = new Member();

        $helper = new Helper();
        $dataCity = Cities::orderby('name')->get();
        $dataDistrict = Districts::orderby('name')->get();
        $cities = $helper->cities($dataCity);

        $keyword = $request->keyword;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status = $request->status;
        $city = $request->calc_shipping_provinces;
        $district = $request->calc_shipping_district;

        $list = $list->join('documents', 'members.id', '=', 'documents.member_id');

        if ($keyword) {
            $list = $list->where('email', 'like', "%" . Crypt::encryptString($keyword) . "%");
        }

        if ($start_date) {
            $start_date = date('Y-m-d', strtotime($start_date));
            $list = $list->where('documents.start_date', '>=', $start_date);
        }

        if ($end_date) {
            $end_date = date('Y-m-d', strtotime($end_date));
            $list = $list->where('documents.end_date', '<=', $end_date);
        }

        if ($end_date) {
            $end_date = date('Y-m-d', strtotime($end_date));
            $list = $list->where('documents.end_date', '<=', $end_date);
        }

        if ($status) {
            $list = $list->where('members.status', '=', $status);
        }

        if ($city) {
            $list = $list->where('tinh', '=', $city);
        }

        if ($district) {
            $list = $list->where('huyen', '=', $district);
            $district = Districts::where('id', '=', $district)->first();
        }

        $list = $list->orderBy('members.id', 'desc')->paginate(20);

        return view('member.index', compact('list', 'keyword', 'start_date', 'end_date', 'cities', 'dataCity', 'city', 'dataDistrict', 'district'));
    }

    public function create(Request $request)
    {
        $departments = Department::all();
        $groups = Group::all();

        $adress = new Helper();
        $dataDistrict = Districts::orderby('name')->get();
        $dataCity = Cities::orderby('name')->get();
        $cities = $adress->cities($dataCity);


        return view('member.add', compact('departments', 'groups', 'cities', 'dataCity'));
    }

    public function store(MemberRequest $request)
    {
        $district = $request->calc_shipping_district;
        if ($district) {
            $district = Districts::where('id', '=', $district)->first();
        }

        $member = Member::create([
            'full_name' => $request->full_name,
            'email' => encrypt($request->email),
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
            'role' => $request->role,
            'phone' => encrypt($request->phone),
            'status' => 1,
            'department_id' => $request->department_id,
        ]);

        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $member->avatar = str_replace('public', '', $imagePath);
        }
        $member->save();

        $document = Document::create([
            'member_id' => $member->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'can_cuoc' => encrypt($request->can_cuoc),
        ]);

        if ($request->hasFile('papers')) {
            $newFileName = uniqid() . '-' . $request->papers->getClientOriginalName();
            $cvPath = $request->papers->storeAs('public/images/', $newFileName);
            $document->papers = str_replace('public', '', $cvPath);
        }
        if ($request->hasFile('contract')) {
            $newFileName = uniqid() . '-' . $request->contract->getClientOriginalName();
            $cvPath = $request->contract->storeAs('public/images/', $newFileName);
            $document->contract = str_replace('public', '', $cvPath);
        }
        if ($request->hasFile('cv_member')) {
            $newFileName = uniqid() . '-' . $request->cv_member->getClientOriginalName();
            $cvPath = $request->cv_member->storeAs('public/images/', $newFileName);
            $document->cv_member = str_replace('public', '', $cvPath);
        }
        $document->save();
        Member::find($member->id)->group()->attach($request->group);

        return redirect('list-member', compact('district'))->with(['message' => 'Thêm nhân viên thành công']);
    }

    public function edit($id)
    {
        $data = Member::findOrFail($id);
        $departments = Department::all();
        $groups = Group::all();
        $adress = new Helper();
        $dataCity = Cities::orderby('name')->get();
        $dataDistrict = Districts::orderby('name')->get();
        $cities = $adress->cities($dataCity);

        return view('member.edit', compact('data', 'departments', 'groups', 'cities', 'dataCity', 'dataDistrict'));
    }

    public function update(MemberRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->update([
            'full_name' => $request->full_name,
            'email' => encrypt($request->email),
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
            'role' => $request->role,
            'status' => $request->status,
            'department_id' => $request->department_id,
            'phone' => encrypt($request->phone),
        ]);

        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $member->avatar = str_replace('public', '', $imagePath);
        }
        $member->save();

        $document = Document::where('member_id', $id)->first();
        $document->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'can_cuoc' => encrypt($request->can_cuoc),
        ]);
        if ($request->hasFile('papers')) {
            $newFileName = uniqid() . '-' . $request->papers->getClientOriginalName();
            $cvPath = $request->papers->storeAs('public/images/', $newFileName);
            $document->papers = str_replace('public', '', $cvPath);
        }
        if ($request->hasFile('contract')) {
            $newFileName = uniqid() . '-' . $request->contract->getClientOriginalName();
            $cvPath = $request->contract->storeAs('public/images/', $newFileName);
            $document->contract = str_replace('public', '', $cvPath);
        }
        if ($request->hasFile('cv_member')) {
            $newFileName = uniqid() . '-' . $request->cv_member->getClientOriginalName();
            $cvPath = $request->cv_member->storeAs('public/images/', $newFileName);
            $document->cv_member = str_replace('public', '', $cvPath);
        }
        $document->save();

        Member::find($member->id)->group()->sync($request->group);

        return redirect('list-member')->with(['message' => 'Cập nhật nhân viên thành công']);
    }

    public function delete($id)
    {
        Member::findOrFail($id)->hasGroup()->delete();
        Member::findOrFail($id)->document()->delete();
        Member::findOrFail($id)->request()->delete();
        Member::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'Xóa nhân viên thành công']);
    }

    public function show($id)
    {
        $data = Member::findOrFail($id);

        return view('member.show', compact('data'));
    }

    public function resetKeyword()
    {
        return redirect('list-member');
    }
}
