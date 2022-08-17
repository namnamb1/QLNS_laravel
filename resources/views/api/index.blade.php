@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="box-body">
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
                        Số điện thoại
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($data['data'] as $val)
                <tr>
                    <td>
                        {{ $val['id'] }}
                    </td>
                    <td>
                        {{ $val['name'] }}
                    </td>
                    <td>
                        {{ $val['phone'] }}
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @foreach($data['links'] as $val) 
    <!-- {{$val['first']}} -->
    @endforeach
</div>
<div class="card-tools">
    <ul class="pagination pagination-sm text-center">
    </ul>
</div>
@endsection