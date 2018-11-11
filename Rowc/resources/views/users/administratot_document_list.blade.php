@extends('users.master')

@section('content')
    <br>
    <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                   Administrator Document
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table  id="coaches" width="100%" class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Document Title</th>
                                <th>Document Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(sizeof($administrator_documents)>0)
                              @foreach($administrator_documents as $d)
                                  <tr>
                                      <td>{{$d->id}}</td>
                                      <td>{{$d->title}}</td>
                                      <td> <a target="_blank" href="{{ asset('uploads/document/common/'.$d->common_file) }}" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i>
                                               Download Document</a></td>
                                  </tr>

                               @endforeach
                            @endif





                            </tbody>
                        </table>
                    </div>
                    <span style="color: red">
                        Note : Download document then fill document detail and upload our website in Upload Document Tab.
                    </span>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->

        <!-- /.panel -->
    </div>
@endsection
<script>
    $(document).ready(function() {
        var table = $('#coaches').DataTable({
            responsive: true,
            dom: 'Bflrtip'
        });
    });
</script>