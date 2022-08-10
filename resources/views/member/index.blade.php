@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách nhân viên</h3>
        <div class="card-tools">
            <form class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm nhân viên" value="{{ $keyword }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0" style="display: block;">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        ID
                    </th>
                    <th style="width: 20%">
                        Họ và Tên
                    </th>
                    <th style="width: 20%">
                        Hình ảnh
                    </th>
                    <th>
                        Thuộc phòng ban
                    </th>
                    <th>
                        Ngày hết hạn hợp đồng
                    </th>
                    <th style="width: 8%" class="text-center">
                        Trạng thái
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $val)
                <tr>
                    <td>
                        {{ $val->id }}
                    </td>
                    <td>
                        <a>
                            {{ $val->full_name }}
                        </a>
                    </td>
                    <td>
                        <div class="list-inline-item post-image-thumb thumb-cover">
                            <img alt="Avatar" class="table-avatar" src="{{asset('storage/' . $val->avatar)}}">
                        </div>
                    </td>
                    <td class="project_progress">
                        {{ $val->department->department_name}}
                    </td>
                    <td>
                        {{ $val->document->end_date }}
                    </td>
                    <td class="project-state">
                        @if( $val->status == 0 )
                        <span class="badge badge-success">Đang làm việc</span>
                        @else
                        <span class="badge badge-danger">Đã nghỉ</span>
                        @endif
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{route('member.show',$val->id)}}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ route('member.edit', $val->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <form class="btn btn-sm" action="{{ route('member.delete',$val->id) }}" method="post">
                            @csrf
                            @method('Delete')
                            <input type="submit" class="btn-danger" value="Delete" onclick="return confirm('Xóa nhóm')" />
                            </i>
                        </form>
                        <!-- <a class="btn btn-danger btn-sm" href="#">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card-tools">
    <ul class="pagination pagination-sm text-center">
        {{ $list->appends(request()->query())->links() }}
    </ul>
</div>
@endsection