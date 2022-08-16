@extends('layout')
@section('content')
<?php
try {
    $data->email = decrypt($data->email);
    $data->phone = decrypt($data->phone);
    $data->document->can_cuoc = decrypt($data->document->can_cuoc);
} catch (Illuminate\Contracts\Encryption\DecryptException $e) {
    $data->email;
    $data->phone;
    $data->document->can_cuoc;
}
?>
<section class="content-header">
    <div class="container-fluid">
        <a class="btn-danger btn float-right" href="{{ route('member.edit',$data->id)}}"> Sửa nhân viên</a>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thông tin nhân viên</h1>
            </div>
        </div>

    </div>
</section>
<section class="content">
    <div class="container-fluid">
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

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Hợp đồng</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Xem CV</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Giấy tờ</a></li>

                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <div class="post">
                                    <div class="user-block">
                                        <span class="username">
                                            <a href="">Hợp đồng</a>
                                        </span>
                                        <strong>
                                            <span class="float-left b">Từ {{ date('d-m-Y',strtotime($data->document->start_date)) }} Đến ngày {{ date('d-m-Y',strtotime($data->document->end_date)) }}</span>
                                        </strong>
                                    </div>
                                    <div class="tab-pane">
                                        @if($data->document->contract)
                                        <iframe width="100%" height="800px" src="{{asset('storage/' . $data->document->contract)}}"></iframe>
                                        @else
                                        <span class="btn bg-danger">Chưa thêm hợp đồng nhân viên</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline">
                                @if($data->document->cv_member)
                                <iframe width="100%" height="800px" src="{{asset('storage/' . $data->document->cv_member)}}"></iframe>
                                @else
                                <span class="btn bg-danger">Chưa thêm cv nhân viên</span>
                                @endif
                            </div>
                            <div class="tab-pane" id="settings">
                                @if($data->document->papers)
                                <iframe width="100%" height="800px" src="{{asset('storage/' . $data->document->papers)}}"></iframe>
                                @else
                                <span class="btn bg-danger">Chưa thêm giấy tờ nhân viên</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection