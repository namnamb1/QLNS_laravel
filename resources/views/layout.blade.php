<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .thumb-cover img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }

        .post-image-thumb {
            display: block;
            color: #333;
            height: 50px;
            width: 50px;
            overflow: hidden;
        }

        .image-member {
            display: block;
            width: 200px;
            height: 200px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <a class="image" href="{{ route('profile.add') }}">
                        <img src="{{asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </a>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{ route('home') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Trang chủ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('member.add') }}" class="nav-link active">
                                <i class="fas fa-users"></i>
                                <p>
                                    Nhân viên
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('member.add') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm nhân viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('member.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách nhân viên</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Phòng ban
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('department.add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm phòng ban</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('department.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách phòng ban</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Nhóm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('group.add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Nhóm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('group.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách Nhóm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="" class="nav-link active">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Yêu cầu sửa tài khoản
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.add') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tạo yêu cầu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách các yêu cầu</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('password.index') }}" class="nav-link active">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Đổi mật khẩu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="{{ route('logout') }}" class="nav-link active">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Đăng xuất
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if( session('message') != null)
            <li class="alert alert-success">{{ session('message') }}</li>
            @endif
            <div class="content-header">
                <div class="container-fluid">
                    @section('content')
                    @show
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

            </section>
            <!-- /.content -->
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var color = [];
        for (i = 0; i <= 19; i++) {
            color[i] = `rgb(${[1,2,3].map(x=>Math.random()*256|0)})`;
        }
        const dataDoughnut = <?= json_encode($member ?? []) ?>;

        const name = Object.keys(dataDoughnut).map((key) => String(key));
        const count = Object.keys(dataDoughnut).map((key) => dataDoughnut[key]);

        const datas = {
            labels: name,
            datasets: [{
                label: 'My First Dataset',
                data: count,
                backgroundColor: color,
                hoverOffset: 4
            }]
        };
        const configs = {
            type: 'doughnut',
            data: datas,
        };

        const myCharts = new Chart(
            document.getElementById('chartMemberDepartment'),
            configs
        );
    </script>

    <script>
        var months = [];
        for (var i = 0; i < 12; i++) {
            var d = new Date((i + 1) + '/1');
            months.push(d.toLocaleDateString(undefined, {
                month: 'short'
            }));
        }

        const data = {
            labels: months,
            datasets: [{
                label: 'Số nhân viên nghỉ phép',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data:  <?= json_encode($data ?? []) ?>,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('chartMonth'),
            config
        );
    </script>

    <script>
        $(document).on('change', '#city', function() {
            let urlRequest = $(this).data("url");
            let mythis = $(this);
            let value = $(this).val();
            let defaultCity = "<option value=''>Chọn thành phố</option>";
            let defaultDistrict = "<option value=''>Chọn quận huyện</option>";
            if (!value) {
                $('#district').html(defaultDistrict);
            } else {
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    data: {
                        'cityId': value
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            let html = defaultDistrict + data.data;
                            $('#district').html(html);
                        }
                    }
                });
            }
        })
    </script>

    <script>
        $('#image').on('change', function(e) {
            var reader = new FileReader();
            var output = document.getElementById('images');
            reader.onload = function() {
                output.src = reader.result;
            };
            if (e.target.files[0] == undefined) {
                output.src = "";
            } else {
                reader.readAsDataURL(e.target.files[0]);
            }
        })
    </script>

</body>

</html>