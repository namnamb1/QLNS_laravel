@extends('layout')
@section('content')
<?php
try {
    $data->email = decrypt($data->email);
    $data->phone = decrypt($data->phone);
    $data->document->can_cuoc = decrypt($data->document->can_cuoc);
} catch(Illuminate\Contracts\Encryption\DecryptException $e) {
    $data->email;
    $data->phone;
    $data->document->can_cuoc;
}
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Sửa nhân viên</h3>
            </div>
            <form action="{{ route('member.update',$data->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email',($data->email)) }}">
                        @error('email')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
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
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{ old('full_name',$data->full_name) }}">
                        @error('full_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{ old('address',$data->address) }}">
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
                                    <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="brith_date" value="{{old('brith_date',$data->brith_date) }}">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phòng ban</label>
                                <select class="form-control" name="department_id">
                                    <option value="">Chọn phòng ban</option>
                                    @foreach($departments as $val)
                                    <option value="{{ $val->id }}" @if($data->department_id == $val->id) selected @endif> {{ $val->department_name }} </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Chọn role</label>
                                <select class="form-control" name="role">
                                    <option value="0" @if($data->role == 0) selected @endif>User</option>
                                    <option value="1" @if($data->role == 1) selected @endif>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Chọn Nhóm</label>
                                @foreach($groups as $val)
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{ $val->id }}" value="{{ $val->id }}" name="group[]" @foreach($data->group as $checked) @if($checked->id == $val->id) checked @endif @endforeach>
                                    <label class="custom-control-label" for="customSwitch{{ $val->id }}">{{ $val->group_name }}</label>
                                </div>
                                @endforeach
                                @error('group')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control"  name="phone" value="{{ old('phone',$data->phone) }}">
                                @error('phone')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="1" @if($data->status == 1) selected @endif>Đang làm việc</option>
                                    <option value="2" @if($data->status == 2) selected @endif>Đã nghỉ</option>
                                </select>
                                @error('status')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Hồ sơ nhân viên</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Hợp đồng nhân viên</label>
                    <input type="file" class="form-control-file" name="contract">
                    @error('contract')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giấy tờ nhân viên</label>
                    <input type="file" class="form-control-file" name="papers">
                    @error('papers')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">CV nhân viên</label>
                    <div class="input-group">
                        <input class="form-control-file" type="file" name="cv_member">
                    </div>
                    @error('cv_member')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Số căn cước</label>
                    <div class="input-group">
                        <input type="number" name="can_cuoc" class="form-control" value="{{ old('can_cuoc',$data->document->can_cuoc) }}">
                        @error('can_cuoc')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Ngày bắt đầu:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="start_date" value="{{$data->document->start_date}}">
                            </div>
                            @error('start_date')
                            <span class="font-italic text-danger ">{{ $message }}</span>
                            @enderror
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ngày kết thúc:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="end_date" value="{{$data->document->end_date}}">
                            </div>
                            @error('end_date')
                            <span class="font-italic text-danger ">{{ $message }}</span>
                            @enderror
                            <!-- /.input group -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Sửa nhân viên</button>
                <a href="{{ route('member.list') }}" class="btn btn-default float-right">Thoát</a>
            </div>
            </form>

        </div>
    </div>
</div>


@endsection