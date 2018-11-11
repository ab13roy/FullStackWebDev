@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.css') }}">
<style>
    .select_div_tack .small-box {
       background-color: green !important;
    }
</style>
@section('content')

    <section class="content-header">
        <h1 class="pull-left">Pool Shuffle</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')


        <div class="row">
            @if(sizeof($track_detail)>0)
                <div class="track_div">
                    <?php $i=1;
                     $is_admin = \Illuminate\Support\Facades\Auth::guard('admin')->user()->is_admin;
                    ?>
                @foreach($track_detail as $track)
                <div class="col-lg-3 col-xs-6 @if($i==1) select_div_tack @endif"   @if($is_admin == 2) onclick="selectTrackDiv({{$track->track_id}})" @else onclick="selectTrackDiv({{$track->id}})" @endif >
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            @if($is_admin == 2)
                            {{$track->getTrackDetail->title}} ({{$track->getTrackDetail->description}})
                            @else
                                {{$track->title}} ({{$track->description}})
                            @endif
                        </div>

                        <br>

                        <div class="inner">
                            @if($is_admin == 2)
                             <h3><span id="count_{{$track->track_id}}">{{$student_count = \App\StudentTrack::where('track_id',$track->track_id)->count()}}</span></h3>
                            @else
                                <h3><span id="count_{{$track->id}}">{{$student_count = \App\StudentTrack::where('track_id',$track->id)->count()}}</span></h3>
                            @endif

                            <p>Students</p>
                        </div>
                        @if($is_admin == 2)
                        <a href="{{url('admin/track-students-list/'.$track->track_id)}}" class="small-box-footer">Added Student List <i class="fa fa-arrow-circle-right"></i></a>
                            @else
                            <a href="{{url('admin/track-students-list/'.$track->id)}}" class="small-box-footer">Added Student List <i class="fa fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>

                    <?php $i++; ?>

                @endforeach
                </div>
                @else
                <p style="text-align: center">Track Detail are not assign</p>
                @endif

        </div>
        <div class="clearfix"></div>
        <br>
        <br>
        <div class="box box-primary">
            <div class="box-body">


                    <div class="box-header">
                        <h3 class="box-title">Pool Shuffle</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row" style="padding-left: 20px;padding-right: 20px;">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Unique Identity</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $s)
                                    <tr id="row_{{$s->id}}">
                                        <td>{{$s->unique_identity}}</td>
                                        <td>{{$s->first_name}}</td>
                                        <td>{{$s->last_name}}</td>
                                        <td>{{$s->phone}}</td>
                                        <td>{{$s->email}}</td>
                                        <td>{{$s->gender}}</td>

                                        <td> <button type="button" onclick="add_track_student({{$s->id}})" class="btn btn-success btn-circle btn-lg">
                                                <i class="fa fa-plus">
                                                </i>
                                            </button></td>

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    <!-- /.box-body -->
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->is_admin == 2){
          @if(sizeof($track_detail)>0)
             <input type="hidden" name="track_id" id="track_id" value="{{$track_detail[0]->track_id}}">
          @else
            <input type="hidden" name="track_id" id="track_id" value="0">
            @endif
        @else
          <input type="hidden" name="track_id" id="track_id" value="{{$track_detail[0]->id}}">
        @endif
        <div class="text-center">

        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable();
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
        function selectTrackDiv(track_id) {
            $('#track_id').val(track_id);
        }
        $(document).ready(function () {
            $('.track_div div').on('click', function () {
                $('.track_div div').removeClass('select_div_tack');
                $(this).addClass('select_div_tack');
            });
        });

        function add_track_student(student_id) {
            var track_id = $('#track_id').val();

            if(track_id == 0){
                swal({
                    title: '',
                    text: "Tracking detail are not found",
                    type: 'warning'

                }, function () {
                    return true;
                });
            }else {
                var url_link = "{{ URL::to('admin/add-track-student') }}";
                swal({
                        title: "",
                        text: "Are you sure that you want to add this student to track?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes!",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {


                        if (isConfirm) {


                            $.post(url_link, {student_id: student_id, track_id: track_id}, function (data) {
                                var obj = jQuery.parseJSON(data);
                                if (obj.status == 0) {
                                    swal({
                                        title: '',
                                        text: obj.msg,
                                        type: 'error'
                                    });
                                } else {
                                    $('#row_' + student_id).remove();
                                    $("#count_" + track_id).html(obj.data);
                                    swal({
                                        title: '',
                                        text: obj.msg,
                                        type: 'success'

                                    }, function () {
                                        return true;
                                    });
                                }

                            });


                        }
                    });
            }
        }
    </script>
@endsection

