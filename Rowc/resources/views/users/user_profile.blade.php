@extends('users.master')

@section('content')
   <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Update As Parent Profile
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
                    <form role="form" method="POST" action="{{ url('parent/update-parent-data') }}" id="parentRegistration" data-toggle="validator">
                        {!! csrf_field() !!}
                        <input type="hidden" id="user_id" name="user_id" value="{{$user_detail->id}}">
                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Student Identity Number</label>
                                    <input class="form-control" id="student_identity" value="{{$user_detail->student_identity}}" name="student_identity" required disabled="disabled">
                                    <div class="help-block with-errors" ></div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{$user_detail->email}}" name="email" required placeholder="email@email.com" disabled="disabled" >
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" id="fName" name="fName" value="{{$user_detail->first_name}}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" id="lName" name="lName" value="{{$user_detail->last_name}}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input  id="phone" value="{{$user_detail->phone}}"
                                            class="form-control"
                                            type="tel"
                                            name="phone"
                                            placeholder="(845)555-1212"
                                            data-minlength="10"
                                            data-error="Hey, does not a valid Phone Number">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender"  name="gender" class="form-control">
                                        <option value="Male" @if ($user_detail->gender == 'Male') selected="selected" @endif>Male</option>
                                        <option value="Female" @if ($user_detail->gender == 'Female') selected="selected" @endif>Female</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
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
