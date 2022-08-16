<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $list = new Group();
        $keyword = $request->keyword;
        if ($keyword) {
            $list = $list->where('group_name', 'like', "%" . $keyword . "%");
        }
        $list = $list->orderBy('id', 'desc')->paginate(10);

        return view('group.index', compact('list', 'keyword'));
    }

    public function create()
    {
        $list = Group::orderBy('id', 'desc')->paginate(10);
        return view('group.add', compact('list'));
    }

    public function store(GroupRequest $request)
    {
        Group::create([
            'group_name' => encrypt($request->group_name),
        ]);

        return redirect()->back()->with(['message' => 'Thêm nhóm thành công']);
    }

    public function edit($id)
    {
        $data = Group::findOrFail($id);
        $list = Group::orderBy('id', 'desc')->paginate(10);
        return view('group.edit', compact('data', 'list'));
    }

    public function update(GroupRequest $request, $id)
    {
        $data = Group::find($id);
        $data->update([
            'group_name' => $request->group_name,
        ]);

        return redirect('/list-group')->with(['message' => 'Cập nhật nhóm thành công']);
    }

    public function delete($id)
    {
        Group::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'Xóa nhóm thành công']);
    }
}
