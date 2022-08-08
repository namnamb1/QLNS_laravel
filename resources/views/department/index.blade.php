@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách phòng ban</h3>
        <div class="card-tools">
            <form class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="keyword" class="form-control float-right" placeholder="Tìm kiếm phòng ban" value="{{ $keyword }}">
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
                    <th style="width: 50%" class="text-center">
                        Tên phòng ban
                    </th>
                    <th style="width: 20%" class="text-center">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $list as $val)
                <tr>
                    <td>
                        {{ $val->id }}
                    </td>
                    <td class="text-center">
                        {{ $val->department_name }}
                    </td>
                    <td class="project-actions text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('department.edit', $val->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <form class="btn btn-sm" action="{{ route('department.delete',$val->id) }}" method="post">
                            @csrf
                            @method('Delete')
                            <input type="submit" class="btn-danger" value="Delete" onclick="return confirm('Xóa phòng ban')" />
                            </i>
                        </form>
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