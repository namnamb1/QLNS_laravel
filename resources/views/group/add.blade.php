@extends('layout')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm nhóm</h3>
            </div>
            <form method="POST" action="{{ route('group.post') }}">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nhóm </label>
                        <input type="text" name="group_name" class="form-control" value="{{ old('group_name') }}">
                        @error('group_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Thêm nhóm</button>
                    <a href="{{ route('group.list') }}" class="btn btn-default float-right">Hủy bỏ</a>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách nhóm</h3>

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
                            <th>Tên Nhóm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->group_name }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning" data-toggle="dropdown" aria-expanded="false">Lựa chọn</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="btn btn-success" style="width:100%" href="{{ route('group.edit', $val->id) }}">Sửa nhóm</a>
                                        <form class="btn btn-primary" style="width:100%;margin-top:5px" action="{{ route('group.delete',$val->id) }}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <input type="submit" class="btn-primary" style="width:100%;border:none;" value="Xóa nhóm" onclick="return confirm('Xóa nhóm')" />
                                            </i>
                                        </form>
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