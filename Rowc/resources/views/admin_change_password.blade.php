@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Change Password
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @if(session()->has('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="box box-primary">

            <div class="box-body">
                <!--<b>GENERAL SETTINGS</b>-->
                <form role="form"  action="{{ url('admin/update-password') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">

                        <div class="box-body">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Old Password* :</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="old_password" name="old_password" value="{{old('old_password')}}" placeholder="Enter Old Password" type="password" >
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">New Password* :</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="new_password" name="new_password" value="{{old('new_password')}}" placeholder="Enter New Password" type="password" >
                                    </div>
                                </div>
                                <br/> <br/>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Confirm Password* :</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="retype_password" name="retype_password" value="{{old('retype_password')}}" placeholder="Re-Enter Password" type="password" >
                                    </div>
                                </div>
                                <br/> <br/>

                                <input type="hidden" value="{{$user_detail->id}}" name="id">
                                <br/> <br/>

                            </div>

                        <div class="box-footer">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="submit" class="btn btn-primary" value="Change Password">
                                <a href="{!! route('admin.dashboard') !!}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
<script>
    setTimeout(function() {
        $('#successMessage').fadeOut('fast');
        console.log("hii");
    }, 2000); // <-- time in milliseconds
</script>


@endsection
