@extends('users.master')

@section('content')
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Upload Document
                </div>
                <div class="panel-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" id="errorMessage">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('parent/post-upload-document') }}" id="parentDocument" data-toggle="validator">
                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="gender">Document Type</label>
                                    <select id="document_type"  name="document_type" class="form-control" required>
                                        <option value="Medical Forms">Medical Forms</option>
                                        <option value="Health Insurance">Health Insurance</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">Document File</label>
                                    <input type="file" class="form-control" id="document_file"  name="document_file" required >
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>



                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Upload Document</button>
                        </div>
                        <div class="col-md-4"></div>

                    </form>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
@endsection
