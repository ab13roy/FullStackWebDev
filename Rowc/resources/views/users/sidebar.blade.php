<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/parent/dashboard/')}}">
            <img alt="Brand" src="{{asset('assets/images/rwc_logo.jpg')}}" style="height: 28px">
        </a>
        <a class="navbar-brand" href="{{ url('/parent/dashboard/')}}">RWC - Parent</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(auth()->guard('business'))
                {{auth()->guard('business')->user()->first_name}} <i class="fa fa-caret-down"></i>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ url('/parent/get-profile/')}}"><i class="fa fa-user fa-fw"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ url('/parent/parent_logout/')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="{{url('/parent/upload-document')}}"><i class="fa fa-file fa-fw"></i>
                        <span class="masked">
                        Upload Document
                    </span>
                    </a>
                </li>

                <li>
                    <a href="{{url('/parent/document-list')}}"><i class="fa fa-list fa-fw"></i>
                        <span class="masked">
                       My Uploaded Document
                    </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/parent/administrator-list')}}"><i class="fa fa-list fa-fw"></i>
                        <span class="masked">
                       Administrator Document
                    </span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
<!-- /.navbar-static-side -->
</nav>