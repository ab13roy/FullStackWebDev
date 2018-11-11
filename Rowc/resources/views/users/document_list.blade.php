@extends('users.master')

@section('content')
    <br>
    <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Document List
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table  id="coaches" width="100%" class="table table-striped table-bordered table-hover">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Document Type</th>
                                <th>Document Link</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(sizeof($student_documents)>0)
                              @foreach($student_documents as $d)
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