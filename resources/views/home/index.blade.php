@extends('layout')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Thống kê</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Danh sách nhân viên nghỉ theo phòng ban</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="chartMemberDepartment" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 657px;" width="985" height="375" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Danh sách nhân viên nghỉ phép theo tháng</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <form class="" action="{{route('home')}}">
                            <select name="time" class=" mb-3" style="width:200px;height:39px;border:1px solid #c9c9c9;border-radius:3px">
                                <option value="">Chọn năm</option>
                                @if(isset($year))
                                    @foreach($year as $val)
                                    <option @if($time == $val) selected @endif value="{{ $val }}"> {{ $val }} </option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="chartMonth" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 657px;" width="985" height="375" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection