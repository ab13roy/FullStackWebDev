@include('users/header')
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div hidden class="alert alert-danger">
                Oops There is something wrong with your Credentials, Try again.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Parent Sign In</h3>
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
                    <form role="form" id="loginForm" method="POST" action="{{ url('post-login-data') }}" data-toggle="validator">
                        {!! csrf_field() !!}
                        <fieldset>

                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Email Address" value="{{old('email')}}" name="email"  type="email" autofocus required id="email">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter Password" value="{{old('password')}}" name="password" type="password"  required id="password">
                                <div class="help-block with-errors"></div>
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            <br>
                            <a href="{{url('/forgot-password')}}" style="float: right;">Forgot Password</a>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('users/footer')
