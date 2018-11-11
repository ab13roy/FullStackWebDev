@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.css') }}">
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Track Student List of #{{$track_detail->title}} </h1>
        <h1 class="pull-right"> <a onclick="window.history.back();" class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="javascript:void(0)">Back</a></h1>

    </section>
    <div class="content">


        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header">
                    <h3 class="box-title">Track Student List</h3>
                </div>

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
                                <th>Total Attend Hour</th>
                                @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->is_admin == 2)
                                <th>Attendance</th>
                                 @endif
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student_list as $s)
                                <tr id="row_{{$s->student_id}}">
                                    <td>{{$s->getStudentDetail->unique_identity}}</td>
                                    <td>{{$s->getStudentDetail->first_name}}</td>
                                    <td>{{$s->getStudentDetail->last_name}}</td>
                                    <td>{{$s->getStudentDetail->phone}}</td>
                                    <td>{{$s->getStudentDetail->email}}</td>
                                    <td>{{$s->getStudentDetail->gender}}</td>
                                    <td>{{$s->present_student_count.' * 6 ='.$s->present_student_sum}}</td>
                                    @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->is_admin == 2)
                                    <td>
                                        @if($s->attendence == 1)
                                            <button type="button" class="btn btn-success">
                                                <i class="fa fa-check">
                                                </i>
                                            </button>
                                        @else
                                            <button type="button" onclick="student_attendence({{$s->student_id}},{{$track_id}})" class="btn btn-warning">
                                               Present
                                            </button>
                                        @endif
                                    </td>
                                   @endif

                                    <td> <button type="button" onclick="delete_student({{$s->id}})" class="btn btn-danger ">
                                            <i class="fa fa-trash">
                                            </i>
                                        </button>
                                        <a href="{{url('admin/get-student-history/'.$s->student_id)}}" class="btn btn-primary">View History </a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
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

        function student_attendence(student_id,track_id) {
            var url_link = "{{ URL::to('admin/add-student-attendance') }}";
            swal({
                    title: "",
                    text: "Are you sure that you want to attendance this track student?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                },
                function(isConfirm){



                    if (isConfirm) {


                        $.post(url_link, { student_id: student_id,track_id:track_id},function(data) {
                            var obj = jQuery.parseJSON(data);
                            if(obj.status == 0){
                                swal({
                                    title: '',
                                    text: obj.msg,
                                    type: 'error'
                                });
                            }else{
//                                $('#row_'+student_track_id).remove();
                                swal({
                                    title: '',
                                    text: obj.msg,
                                    type: 'success'

                                }, function () {
                                    location.reload();
                                    return true;
                                });
                            }

                        });


                    }
                });
        }

        function delete_student(student_track_id) {

            var url_link = "{{ URL::to('admin/delete-track-student') }}";
            swal({
                    title: "",
                    text: "Are you sure that you want to delete this track student?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                },
                function(isConfirm){



                    if (isConfirm) {


                        $.post(url_link, { student_track_id: student_track_id},function(data) {
                            var obj = jQuery.parseJSON(data);
                            if(obj.status == 0){
                                swal({
                                    title: '',
                                    text: obj.msg,
                                    type: 'error'
                                });
                            }else{
//                                $('#row_'+student_track_id).remove();
                                swal({
                                    title: '',
                                    text: obj.msg,
                                    type: 'success'

                                }, function () {
                                    location.reload();
                                    return true;
                                });
                            }

                        });


                    }
                });
        }
    </script>
@endsection

