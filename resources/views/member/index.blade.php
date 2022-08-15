@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="box-body">
            <form class="row" action="">
                <div class="col-sm-2">
                    <label for="">Tên nhân viên:</label>
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm nhân viên" value="{{ $keyword }}">
                </div>
                <div class="col-sm-2">
                    <label for="">Ngày vào:</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Chọn ngày bắt đầu" autocomplete="off" value="{{ $start_date }}">
                </div>
                <div class="col-sm-2">
                    <label for="">Ngày kết thúc:</label>
                    <input type="date" class="form-control" name="end_date" placeholder="Chọn ngày kết thúc" autocomplete="off" value="{{ $end_date }}">
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Tỉnh/Thành phố</label>
                        <select name="calc_shipping_provinces" id="city" class="form-control" data-url="{{ route('ajax.address.districts') }}">
                        <option value="">Chọn tỉnh/Thành phố</option>
                           
                            @foreach ($dataCity as $val)
                                <option @if($val->id == $city) selected @endif value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                        @error('calc_shipping_provinces')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                <div class="form-group">
                        <label>Huyện</label>
                        <select class="form-control" name="calc_shipping_district" id="district">
                            <option value="">Quận / Huyện</option>
                            @if($district)
                            <option value="{{$district}}" selected>{{$district->name}}</option>
                            @endif
                        </select>
                        @error('calc_shipping_district')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                            <label>Chọn trạng thái</label>
                            <select class="form-control" name="status" >
                                <option value="0">Chọn trạng thái</option>
                                <option value="1">Đang làm việc</option>
                                <option value="2">Đã nghỉ việc</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="float-right" style="width: 100%;">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info ">Tìm kiếm</button>
                        <a href="{{ route('member.reset') }}" class="btn btn-warning"> Hủy bỏ</a>
                    </div>
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
                        {{ $val->member_id ?? $val->id }}
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
                        {{ $val->end_date }}
                    </td>
                    <td class="project-state">
                        @if( $val->status == 1 )
                        <span class="badge badge-success">Đang làm việc</span>
                        @else
                        <span class="badge badge-danger">Đã nghỉ</span>
                        @endif
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{route('member.show',$val->member_id ?? $val->id)}}">
                            <i class="fas fa-eye">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="{{ route('member.edit', $val->member_id ?? $val->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <form class="btn btn-sm" action="{{ route('member.delete', $val->member_id ?? $val->id) }}" method="post">
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