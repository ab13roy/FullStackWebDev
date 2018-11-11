@include('users/header')
<div id="wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-users fa-fw">Parent</i>
                <i class="pull-right">
                    <a href="{{ url('/login') }}">
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                        </button>
                    </a>
                </i>
            </h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Register As Parent
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
                    <form role="form" method="POST" action="{{ url('post-parent-data') }}" id="parentRegistration" data-toggle="validator">
                        {!! csrf_field() !!}
                        <div class="row">

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Student Identity Number</label>
                                    <input class="form-control" id="student_identity" value="{{old('student_identity')}}" name="student_identity" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" required placeholder="email@email.com">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="uPass">Password</label>
                                    <input class="form-control" id="uPass" name="uPass" value="{{old('uPass')}}" type="password" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="rePass">Repeat password</label>
                                    <input data-match="#uPass" class="form-control" id="rePass" value="{{old('rePass')}}" name="rePass" type="password"
                                           data-match-error="Whoops, these don't match" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" id="fName" name="fName" value="{{old('fName')}}" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" id="lName" name="lName" value="{{old('lName')}}" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input  id="phone" value="{{old('phone')}}"
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
                                        <option value="Male" @if (old('gender') == 'Male') selected="selected" @endif>Male</option>
                                        <option value="Female" @if (old('gender') == 'Female') selected="selected" @endif>Female</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <div class="col-md-3"><button type="reset" class="btn btn-warning btn-block">Reset</button></div>
                        <div class="col-md-3"></div>
                    </form>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@include('users/footer')