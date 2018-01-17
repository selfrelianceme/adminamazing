<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Vlad Kit">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('adminamazing.favicon_path')) }}">
    <title>{{ config('app.name', 'Admin Amazing Dev') }} | Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('vendor/adminamazing/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('vendor/adminamazing/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/html5-editor/bootstrap-wysihtml5.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/nestable/nestable.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/adminamazing/assets/plugins/css-chart/css-chart.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminamazing/assets/plugins/gridstack/gridstack.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('vendor/adminamazing/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('vendor/adminamazing/css/colors/green.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="fix-header fix-sidebar card-no-border">
    <script>var message = '';</script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header text-center">
                    <a class="navbar-brand" href="/{{ config('adminamazing.path') }}">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <i class="wi wi-sunset text-white"></i>
                            <span class="text-white">{{ config('app.name', 'Admin Amazing Dev') }}</span>
                            <!-- Light Logo icon -->
                        </b>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <!-- -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item hidden-sm-down">
                            <form action="{{route('AdminUsers')}}" method="GET" class="app-search" enctype="multipart/form-data">
                                <input type="text" name="searchKey" class="form-control" placeholder="Поиск пользователя...">
                                <button class="btn-link srh-btn"><i class="ti-search"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        {!!$menu!!}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">@yield('pageTitle')</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a target="_blank" href="/">Сайт</a></li>
                            <li class="breadcrumb-item active">@yield('pageTitle')</li>
                        </ol>
                    </div>
                    @push('display')
                    {{ \Carbon\Carbon::now()->format(config('adminamazing.timeFormat')) }}
                    @endpush
                    <div class="col-md-6 col-4 align-self-center">
                        <div class="pull-right">
                            @stack('display')
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                @include('flash::message')
                @yield('content')
                <div class="modal fade" id="deleteModal" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="POST" class="form-horizontal" id="deleteForm">
                                <div class="modal-header"></div>
                                <div class="modal-body" id="deleteText"></div>
                                <div class="modal-footer">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-block">Удалить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                
                <!-- Row -->
                <!-- Row -->
                
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2017 Admin Amazing for {{ config('app.name', 'Admin Amazing Dev') }}
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('vendor/adminamazing/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('vendor/adminamazing/assets/plugins/bootstrap/js/tether.min.js') }}"></script>
    <script src="{{ asset('vendor/adminamazing/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/adminamazing/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('vendor/adminamazing/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('vendor/adminamazing/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('vendor/adminamazing/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('vendor/adminamazing/js/custom.min.js') }}"></script>
    <!--Wysihtml -->
    <script src="{{ asset('vendor/adminamazing/assets/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
    <script src="{{ asset('vendor/adminamazing/assets/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('vendor/adminamazing/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

    @push('scripts')
        <script>
            $('.delete_toggle').on('click', function(e){
                var temp = route;
                route = route+'/'+$(this).attr('data-id');
                $('#deleteText').text(message);
                $('#deleteForm').attr('action', route);
                route = temp;
            });
        </script>
    @endpush

    @stack('scripts')
</body>

</html>

<!-- Localized -->
