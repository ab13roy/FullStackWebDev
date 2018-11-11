@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.css') }}">
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Student History  </h1>
        <h1 class="pull-right"> <b>Total Hour Spent : {{$total_sum}}</b>  &nbsp;&nbsp;&nbsp; <a onclick="window.history.back();" class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="javascript:void(0)">Back</a></h1>

    </section>
    <div class="content">


        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header">
                    <h3 class="box-title">Student History</h3>
                </div>

                <div class="box-body">
                    <div class="row" style="padding-left: 20px;padding-right: 20px;">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Track Name</th>
                                <th>Total Hour</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendance as $s)
                                <tr>
                                    <td>{{$s->getTrackDetail->title}}</td>
                                    <td>{{$s->present_student_sum}}</td>
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

    </script>
@endsection

