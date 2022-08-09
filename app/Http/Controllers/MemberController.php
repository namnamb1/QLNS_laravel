<?php

namespace App\Http\Controllers;

use App\Department;
use App\Document;
use App\Group;
use App\GroupMember;
use App\Http\Requests\MemberRequest;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.in  dex');
    }

    public function create()
    {
        $departments = Department::all();
        $groups = Group::all();
        return view('member.add', compact('departments', 'groups'));
    }

    public function store(MemberRequest $request)
    {
        // dd($request->all());
        $member = Member::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'tinh' => $request->calc_shipping_provinces,
            'huyen' => $request->calc_shipping_district,
            'address' => $request->address,
            'brith_date' => $request->brith_date,
            'role' => $request->role,
            'status' => 0,
            'department_id' => $request->department_id,
        ]);

        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $imagePath = $request->avatar->storeAs('public/images/', $newFileName);
            $member->avatar = str_replace('public', '', $imagePath);
        }
        $member->save();

        $docment = Document::create([
            'member_id' => $member->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_date' => $request->start_date,
            'can_cuoc' => $request->can_cuoc,
            'papers' => $request->start_date,
            '
            '
        ]);

        Member::find($member->id)->group()->attach($request->group);
        return redirect('list-member')->with(['message' => 'Thêm nhân viên thành công']);
    }

    public function edit()
    {
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
