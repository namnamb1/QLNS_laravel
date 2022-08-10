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
    public function index(Request $request)
    {
        $list = new Member();

        $keyword = $request->keyword;
        if ($keyword) {
            $list = $list->where('full_name', 'like', "%" . $keyword . "%");
        }

        $list = $list->orderBy('id', 'desc')->paginate(10);

        return view('member.index', compact('list', 'keyword'));
    }

    public function create()
    {
        $departments = Department::all();
        $groups = Group::all();
        return view('member.add', compact('departments', 'groups'));
    }

    public function store(MemberRequest $request)
    {

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

        $document = Document::create([
            'member_id' => $member->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'can_cuoc' => $request->can_cuoc,
            'papers' => $request->papers,
            'contract' => $request->contract,
        ]);
        if ($request->hasFile('cv_member')) {
            $newFileName = uniqid() . '-' . $request->cv_member->getClientOriginalName();
            $cvPath = $request->cv_member->storeAs('public/images/', $newFileName);
            $document->cv_member = str_replace('public', '', $cvPath);
        }
        $document->save();
        Member::find($member->id)->group()->attach($request->group);

        return redirect('list-member')->with(['message' => 'Thêm nhân viên thành công']);
    }

    public function edit($id)
    {
        $data = Member::findOrFail($id);
        $departments = Department::all();
        $groups = Group::all();
        return view('member.edit', compact('data', 'departments', 'groups'));
    }

    public function update(MemberRequest $request, $id)
    {
            $member = Member::findOrFail($id);
            $member->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'tinh' => $request->calc_shipping_provinces,
                'huyen' => $request->calc_shipping_district,
                'address' => $request->address,
                'brith_date' => $request->brith_date,
                'role' => $request->role,
                'status' => $request->status,
                'department_id' => $request->department_id,
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
                'can_cuoc' => $request->can_cuoc,
                'papers' => $request->papers,
                'contract' => $request->contract,
            ]);
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
        Member::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'Xóa nhân viên thành công']);
    }

    public function show($id)
    {
        $data = Member::findOrFail($id);

        return view('member.show', compact('data'));
    }
}
