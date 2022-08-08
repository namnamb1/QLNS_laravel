<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $list = new Department();
        $keyword = $request->keyword;
        if ($keyword) {
            $list = $list->where('department_name', 'like', "%" . $keyword . "%");
        }
        $list = $list->orderBy('id', 'desc')->paginate(10);

        return view('department.index', compact('list','keyword'));
    }

    public function create()
    {
        $list = Department::orderBy('id', 'desc')->paginate(10);
        return view('department.add', compact('list'));
    }

    public function store(DepartmentRequest $request)
    {
        Department::create([
            'department_name' => $request->department_name
        ]);

        return redirect()->back()->with(['message' => 'Thêm phòng ban thành công']);
    }

    public function edit($id)
    {
        $data = Department::findOrFail($id);
        $list = Department::orderBy('id', 'desc')->paginate(10);
        return view('department.edit', compact('data', 'list'));
    }

    public function update(DepartmentRequest $request, $id)
    {

        $data = Department::find($id);
        $data->update([
            'department_name' => $request->department_name,
        ]);

        return redirect('/list-department')->with(['message' => 'Cập nhật phòng ban thành công']);
    }

    public function delete($id)
    {
        Department::findOrFail($id)->delete();
        return redirect()->back()->with(['message' => 'Xóa phòng ban thành công']);
    }
}
