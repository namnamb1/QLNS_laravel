@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách các yêu cầu</h3>
        <div class="card-tools">
            <form class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm yêu cầu" value="{{ $keyword }}">
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
                    <th style="width: 15%">
                        ID nhân viên
                    </th>
                    <th style="width: 20%">
                        Họ và Tên
                    </th>
                    <th style="width: 20%">
                        Hình ảnh
                    </th>
                    <th style="width: 20%" class="text-center">
                        Trạng thái
                    </th>
                    <th style="width: 30%" class="float-right">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $val)
                <tr>
                    <td>
                        {{ $val->member_id }}
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
                    <td class="project-state">
                        @if( $val->status == 1 )
                        <span class="badge badge-success">Đang làm việc</span>
                        @else
                        <span class="badge badge-danger">Đã nghỉ</span>
                        @endif
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{route('profile.show', $val->id_rq)}}">
                            <i class="fas fa-eye">
                            </i>
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card-tools">
    <ul class="pagination pagination-sm text-center">
        {{ $data->appends(request()->query())->links() }}
    </ul>
</div>
@endsection