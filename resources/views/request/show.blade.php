@extends('layout')
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- Input addon -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thông tin sau khi sửa</h3>
            </div>
            <form action="{{ route('profile.update',$data->id_rq) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh đại diện</label>
                        <div class="input-group">
                            <input id="image" type="file" name="avatar" value="">
                            @if($data->rq_avatar)
                            <div class="image-member thumb-cover">
                                <img src="{{asset('storage/' . $data->rq_avatar)}}" alt="User profile picture">
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
                        <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{ $data->rq_full_name }}">
                        @error('full_name')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{ $data->rq_address }}">
                        @error('address')
                        <span class="font-italic text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Tỉnh</label>
                                <select class="form-control" name="calc_shipping_provinces" id="city">
                                
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
                                    <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric" name="brith_date" value="{{$data->rq_brith_date }}">
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
                                    <option value="1" @if($data->rq_gender == 1) selected @endif>Nam</option>
                                    <option value="2" @if($data->rq_gender == 2) selected @endif>Nữ</option>
                                </select>
                                @error('gender')
                                <span class="font-italic text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-info">Chấp nhận </button>
            </form>
            <form class="btn btn-danger float-right"  style="height: 40px;" action="{{ route('profile.delete', $data->id_rq) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger"  style="height: 40px; margin-top:-7px">Từ chối</button>
            </form>
        </div>
    </div>
</div>






</div>


@endsection