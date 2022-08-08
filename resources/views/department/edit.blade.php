@extends('layout')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm phòng ban</h3>
            </div>
            <form method="POST" action="{{ route('department.update', $data->id) }}">
                {{ method('put') }}
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên phòng ban </label>
                        <input type="text" name="department_name" class="form-control" value="{{ $data->department_name }}">
                        @error('department_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Sửa phòng ban</button>
                    <button type="" class="btn btn-default float-right">Hủy bỏ</button>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách phòng ban</h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {{ $list->appends(request()->query())->links() }}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Tên Phòng Ban</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->department_name }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" data-toggle="dropdown" aria-expanded="false">Lựa chọn</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item" href="{{ route('department.edit', $val->id) }}">Sửa phòng ban</a>
                                        <a class="dropdown-item" href="#">Xóa phòng ban</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection