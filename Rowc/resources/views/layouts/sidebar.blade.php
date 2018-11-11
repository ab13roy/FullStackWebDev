<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->

        <div class="user-panel">
            <div class="pull-left image">
                @if(auth()->guard('admin'))
                    @if(auth()->guard('admin')->user()->profile != "")
                       <img src="{{ asset('uploads/admin/'.auth()->guard('admin')->user()->profile) }}" class="img-circle" alt="User Image">
                    @else
                        <img src="{{ asset('assets/images/profile.jpg') }}"
                             class="img-circle" alt="User Image"/>
                    @endif
                @else
                    <img src="{{ asset('assets/images/profile.jpg') }}"
                         class="img-circle" alt="User Image"/>
                @endif

            </div>
            <div class="pull-left info">
                <p style="padding-top: 13px;">{{Config::get('constant.PROJECT_NAME')}}</p>
                <!-- Status -->
                <!--   <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- search form (Optional) -->

        <!-- Sidebar Menu -->

        <ul class="sidebar-menu">
            <li class="header"></li>
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>