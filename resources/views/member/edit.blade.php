@extends('layout')
@section('content')
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
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ $data->email }}">
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
                                <label>Tỉnh</label>
                                <select class="form-control" name="calc_shipping_provinces">
                                    <option value="">Tỉnh / Thành phố</option>
                                    <option value="" @if($data->tinh) @endif>Tỉnh / Thành phố</option>
                                </select>
                                @error('calc_shipping_provinces')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Huyện</label>
                                <select class="form-control" name="calc_shipping_district">
                                    <option value="">Quận / Huyện</option>
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
                                <label>Chọn trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="0" @if($data->status == 0) selected @endif>Đang làm việc</option>
                                    <option value="1" @if($data->status == 1) selected @endif>Đã nghỉ</option>
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
                    <label for="">Hợp đồng </label>
                    <textarea class="text" id="text" type="text" class="form-control" name="contract">{{ $data->document->contract }}</textarea>
                    @error('contract')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giấy tờ nhân viên </label>
                    <textarea type="text" class="form-control" name="papers">{{ $data->document->papers }} </textarea>
                    @error('papers')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">CV nhân viên</label>
                    <div class="input-group">
                        <input type="file" name="cv_member">
                    </div>
                    @error('cv_member')
                    <span class="font-italic text-danger ">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Số căn cước</label>
                    <div class="input-group">
                        <input type="number" name="can_cuoc" class="form-control" value="{{$data->document->can_cuoc}}">
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



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
<script>
    if (address_2 = localStorage.getItem('address_2_saved')) {
        $('select[name="calc_shipping_district"] option').each(function() {
            if ($(this).text() == address_2) {
                $(this).attr('selected', '')
            }
        })
        $('input.billing_address_2').attr('value', address_2)
    }
    if (district = localStorage.getItem('district')) {
        $('select[name="calc_shipping_district"]').html(district)
        $('select[name="calc_shipping_district"]').on('change', function() {
            var target = $(this).children('option:selected')
            target.attr('selected', '')
            $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
            address_2 = target.text()
            $('input.billing_address_2').attr('value', address_2)
            district = $('select[name="calc_shipping_district"]').html()
            localStorage.setItem('district', district)
            localStorage.setItem('address_2_saved', address_2)
        })
    }
    $('select[name="calc_shipping_provinces"]').each(function() {
        var $this = $(this),
            stc = ''
        c.forEach(function(i, e) {
            e += +1
            stc += '<option value=' + e + '>' + i + '</option>'
            $this.html('<option value="">Tỉnh / Thành phố</option>' + stc)
            if (address_1 = localStorage.getItem('address_1_saved')) {
                $('select[name="calc_shipping_provinces"] option').each(function() {
                    if ($(this).text() == address_1) {
                        $(this).attr('selected', '')
                    }
                })
                $('input.billing_address_1').attr('value', address_1)
            }
            $this.on('change', function(i) {
                i = $this.children('option:selected').index() - 1
                var str = '',
                    r = $this.val()
                if (r != '') {
                    arr[i].forEach(function(el) {
                        str += '<option value="' + el + '">' + el + '</option>'
                        $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>' + str)
                    })
                    var address_1 = $this.children('option:selected').text()
                    var district = $('select[name="calc_shipping_district"]').html()
                    localStorage.setItem('address_1_saved', address_1)
                    localStorage.setItem('district', district)
                    $('select[name="calc_shipping_district"]').on('change', function() {
                        var target = $(this).children('option:selected')
                        target.attr('selected', '')
                        $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
                        var address_2 = target.text()
                        $('input.billing_address_2').attr('value', address_2)
                        district = $('select[name="calc_shipping_district"]').html()
                        localStorage.setItem('district', district)
                        localStorage.setItem('address_2_saved', address_2)
                    })
                } else {
                    $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>')
                    district = $('select[name="calc_shipping_district"]').html()
                    localStorage.setItem('district', district)
                    localStorage.removeItem('address_1_saved', address_1)
                }
            })
        })
    })
</script>

@endsection