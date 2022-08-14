@extends('layout')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thêm nhân viên</h3>
            </div>
            <form action="{{ route('member.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" value="">
                        @error('password')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-load-image mb-3">
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh đại diện</label>
                            <div class="input-group">
                                <input type="file" id="image" class="img-load-input" name="avatar" value="">
                                @error('avatar')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="image-member thumb-cover">
                                <img id="images" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{old('full_name')}}">
                        @error('full_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{old('address')}}">
                        @error('address')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Tỉnh</label>
                
                                <select name="calc_shipping_provinces" id="city" class="form-control" data-url="{{ route('ajax.address.districts') }}">
                                    <option value="">Chọn tỉnh/Thành phố</option>
                                    @foreach ($dataCity as $val)
                                        <option  @if(old('calc_shipping_provinces')==$val->id) selected @endif value="{{$val->id}}">{{$val->name}}</option>
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
                                <select name="calc_shipping_district" id="district" class="form-control">
                                    <option value="">Chọn quận/huyện</option>
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
                                    <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="brith_date" value="{{ old('brith_date') }}">
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
                                    <option value="1" @if(old('gender')==1) selected @endif>Nam</option>
                                    <option value="2" @if(old('gender')==2) selected @endif>Nữ</option>
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
                                    <option value="{{ $val->id }}" @if(old('department_id')==$val->id) selected @endif> {{ $val->department_name }} </option>
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
                                <label>Chọn quyền</label>
                                <select class="form-control" name="role">
                                    <option value="0">User</option>
                                    <option value="1" @if(old('role')==1) selected @endif>Admin</option>
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
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{ $val->id }}" value="{{ $val->id }}" name="group[]" @if(is_array(old('group')) && in_array($val->id, old('group'))) checked @endif>
                                    <label class="custom-control-label" for="customSwitch{{ $val->id }}">{{ $val->group_name }}</label>
                                </div>
                                @endforeach
                                @error('group')
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
                        <input type="number" name="can_cuoc" class="form-control" value="{{old('can_cuoc')}}">
                    </div>
                    @error('can_cuoc')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ngày bắt đầu:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="start_date" value="{{ old('start_date') }}">
                            </div>
                            @error('start_date')
                            <span class="font-italic text-danger ">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ngày kết thúc:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="end_date" value="{{ old('end_date') }}">
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
                <button type="submit" class="btn btn-info">Thêm nhân viên</button>
                <button type="" class="btn btn-default float-right">Thoát</button>
            </div>
            </form>

        </div>
    </div>
</div>





@endsection