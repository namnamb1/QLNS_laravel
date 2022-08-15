@extends('layout')
@section('content')

<div class="row">
<div class="col-md-3">
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/' . $data->avatar)}}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ $data->full_name }}</h3>
            <p class="text-muted text-center">{{ $data->department->department_name }}</p>
            <strong><i class="fas fa-book mr-1"></i> Email</strong>
            <p class="text-muted">
                {{ $data->email }}
            </p>
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i>Ngày sinh</strong>
            <p class="text-muted">{{ $data->brith_date }}</p>
            <hr>
            <strong><i class="fas fa-book mr-1"></i> Giới tính</strong>
            <p class="text-muted">
                @if($data->gender == 1)
                Nam
                @else
                Nữ
                @endif
            </p>
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa chỉ</strong>
            <p class="text-muted">{{ $data->address }}</p>
            <hr>
            <strong><i class="fas fa-pencil-alt mr-1"></i>Trạng thái</strong>
            <p class="text-muted">
                @if($data->status == 1)
                <span class="badge badge-success">Đang làm việc</span>
                @else
                <span class="badge badge-danger">Đã nghỉ</span>
                @endif
            </p>
            <hr>
            <strong><i class="far fa-file-alt mr-1"></i> Nhóm</strong>
            <p class="text-muted">
                @foreach($data->group as $val)
                <span class="badge btn-primary">{{ $val->group_name}}</span>
                @endforeach
            </p>
        </div>
    </div>
</div>
    <!-- left column -->
    <div class="col-md-9">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Yêu cầu sửa lại thông tin</h3>
            </div>
            <form action="{{ route('profile.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh đại diện</label>
                        <div class="input-group">
                            <input id="image" type="file" name="avatar" value="">
                            @if($data->avatar)
                            <div class="image-member thumb-cover">
                                <img src="{{asset('storage/' . $data->avatar)}}" alt="User profile picture">
                            </div>
                            @else
                            <div class="image-member thumb-cover">
                                <img id="images" alt="">
                            </div>
                            @endif
                        </div>
                        @error('avatar')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{ $data->full_name }}">
                        @error('full_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{ $data->address }}">
                        @error('address')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Tỉnh/Thành phố</label>
                                <select name="calc_shipping_provinces" id="city" class="form-control" data-url="{{ route('ajax.address.districts') }}" required="required">
                                    <option value="">Chọn tỉnh/Thành phố</option>
                                    @foreach ($dataCity as $val)
                                    <option {{$data->tinh == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                                @error('calc_shipping_provinces')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Huyện</label>
                                <select class="form-control" name="calc_shipping_district" id="district">
                                    <option value="">Quận / Huyện</option>
                                    <option value="{{$data->huyen}}" selected>{{$data->districts->name ?? ''}}</option>
                                </select>
                                @error('calc_shipping_district')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Ngày sinh:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="brith_date" value="{{$data->brith_date }}">
                                </div>
                                @error('brith_date')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select class="form-control" name="gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" @if($data->gender == 1) selected @endif>Nam</option>
                                    <option value="2" @if($data->gender == 2) selected @endif>Nữ</option>
                                </select>
                                @error('gender')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Gửi yêu cầu</button>
                        <a href="{{ route('member.list') }}" class="btn btn-default float-right">Thoát</a>
                    </div>
            </form>
        </div>
    </div>

</div>


@endsection