@include('users/header')
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div hidden class="alert error_msg alert-danger">
                Oops There is invalid email address, Try again.
            </div>
            <div hidden class="alert success_msg alert-success">
                Reset password has been sent to your registered Email ID
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Forgot Password</h3>
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
                    <form role="form" id="resetForm"  method="POST" action="{{ url('post-forgot-password') }}" data-toggle="validator">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Email Address" name="email" type="email"  id="email" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Forgot Password</button>
                            <br>
                            <a href="{{url('/login')}}" style="float: right;">Login</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('users/footer')
