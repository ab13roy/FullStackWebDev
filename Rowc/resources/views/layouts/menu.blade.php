@if(Auth::guard('admin')->user()->is_admin != 2)
    <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{!! route('admin.dashboard') !!}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
    </li>
    <li class="{{ Request::is('admin/subAdmins*') ? 'active' : '' }}">
        <a href="{!! route('subAdmins.index') !!}"><i class="fa fa-user-circle-o"></i><span>Sub Admins</span></a>
    </li>
<li class="{{ Request::is('admin/sections*') ? 'active' : '' }}">
    <a href="{!! route('sections.index') !!}"><i class="fa fa-calendar fa-fw"></i><span>Sections</span></a>
</li>

<li class="{{ Request::is('admin/tracks*') ? 'active' : '' }}">
    <a href="{!! route('tracks.index') !!}"><i class="fa fa-road fa-fw"></i><span>Tracks</span></a>
</li>

<li class="{{ Request::is('admin/coaches*') ? 'active' : '' }}">
    <a href="{!! route('coaches.index') !!}"><i class="fa fa-users fa-fw"></i><span>Coaches</span></a>
</li>

<li class="{{ Request::is('admin/students*') ? 'active' : '' }}">
    <a href="{!! route('students.index') !!}"><i class="fa fa-graduation-cap fa-fw"></i><span>Students</span></a>
</li>


<li class="{{ Request::is('admin/parentDetails*') ? 'active' : '' }}">
    <a href="{!! route('parentDetails.index') !!}"><i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Parent List</span></a>
</li>
    <li class="{{ Request::is('admin/pool-shuffle') || Request::is('admin/track-students-list*') ? 'active' : '' }}">
        <a href="{{url('admin/pool-shuffle')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Pool Shuffle </span></a>
    </li>
@else
    <li class="{{ Request::is('admin/pool-shuffle') || Request::is('admin/track-students-list*') ? 'active' : '' }}">
        <a href="{{url('admin/pool-shuffle')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Pool Shuffle </span></a>
    </li>
@endif
@if(Auth::guard('admin')->user()->is_admin == 2)
    <li class="{{ Request::is('admin/coachDocuments*') ? 'active' : '' }}">
        <a href="{!! route('coachDocuments.index') !!}"><i class="fa fa-upload"></i><span>Upload Document List</span></a>
    </li>
@endif
<li class="{{ Request::is('admin/commonDocuments*') ? 'active' : '' }}">
    @if(Auth::guard('admin')->user()->is_admin != 2)
       <a href="{!! route('commonDocuments.index') !!}"><i class="fa fa-upload" aria-hidden="true"></i><span>Upload Common Documents</span></a>
     @else
        <a href="{!! route('commonDocuments.index') !!}"><i class="fa fa-list" aria-hidden="true"></i><span> Administrator Document</span></a>
    @endif
</li>


