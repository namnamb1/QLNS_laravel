<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
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
        $data->fill([
            'department_name' => $request->department_name,
        ]);

        return redirect('/list-department')->with(['message' => 'Cập nhật phòng ban thành công']);
    }

    public function delete(Request $request)
    {
    }
}
