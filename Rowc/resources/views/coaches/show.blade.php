@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.css') }}">
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Document List </h1>
        <h1 class="pull-right"> <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('coaches.index') !!}">Back</a></h1>

    </section>
    <div class="content">

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">


                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row" style="padding-left: 20px;padding-right: 20px;">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Document Type</th>
                                <th>Document Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(sizeof($document_list)>0)
                                @foreach($document_list as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->document_type}}</td>
                                        <td> <a target="_blank" href="{{ asset('uploads/document/'.$d->document_file) }}" class="btn btn-primary" >View Document</a></td>
                                    </tr>

                                @endforeach
                            @endif
                            </tbody>

                        </table>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

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

    </script>
@endsection
