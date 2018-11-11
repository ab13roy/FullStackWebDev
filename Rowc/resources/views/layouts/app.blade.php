<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{Config::get('constant.PROJECT_NAME')}}</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.webp') }}" type="image/ico" sizes="16x16">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">


    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>


      <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/nice-scroll.js') }}"></script>
    @yield('css')
    <style>
        #saving_loader {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;
            background: url({{ asset('/assets/images/loder.gif')}}) no-repeat center center rgba(0, 0, 0, 0.25)
        }
    </style>
</head>

<body class="skin-blue sidebar-mini">
<div id="saving_loader" style="display:none"></div>
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>{{Config::get('constant.PROJECT_NAME')}}</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->

                                @if(auth()->guard('admin'))
                                    @if(auth()->guard('admin')->user()->profile != "")
                                    <img src="{{ asset('uploads/admin/'.auth()->guard('admin')->user()->profile) }}"
                                         class="user-image" alt="User Image"/>
                                    @else
                                        <img src="{{ asset('assets/images/profile.jpg') }}"
                                             class="user-image" alt="User Image"/>
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/profile.jpg') }}"
                                         class="user-image" alt="User Image"/>
                                @endif
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! auth()->guard('admin')->user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    @if(auth()->guard('admin'))
                                        @if(auth()->guard('admin')->user()->profile != "")
                                        <img src="{{ asset('uploads/admin/'.auth()->guard('admin')->user()->profile) }}"
                                             class="img-circle" alt="User Image"/>
                                        @else
                                            <img src="{{ asset('assets/images/profile.jpg') }}"
                                                 class="img-circle" alt="User Image"/>
                                        @endif
                                        <p>
                                            {!! auth()->guard('admin')->user()->name !!}
                                            <small>{!! auth()->guard('admin')->user()->email !!}</small>
                                        </p>
                                    @else
                                        <img src="{{ asset('assets/images/profile.jpg') }}"
                                             class="img-circle" alt="User Image"/>
                                    @endif

                                </li>
                                <li class="user-body">
                                    <div class="col-xs-2 text-center">

                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="{{ url('admin/change-password') }}" class="btn btn-primary" style="color: white !important;background-color: #3c8dbc;">Change Password</a>
                                    </div>
                                    <div class="col-xs-4 text-center">

                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('admin/profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2018 <a href="">{{Config::get('constant.PROJECT_NAME')}}</a>.</strong> All rights reserved.
        </footer>

    </div>

    <!-- jQuery 3.1.1 -->

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $('.navbar .sidebar-toggle').click(function(){
            $('body').toggleClass('sidebar-collapse');
        });

        $('.select2').select2()

    </script>
    @yield('scripts')
</body>
</html>