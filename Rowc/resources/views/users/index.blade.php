@include('users/header')
<div class="container">



    <div class="jumbotron" style="margin-top: 5%">
        <img src="{{asset('assets/images/rwc_logo.PNG')}}" alt="rwc logo" class="img-responsive center-block">

        <div class="text-center">
            <p style="margin-top: .5em">This portal is meant for coaches and admin staff from RWC.</p>

            <p><a href="{{ url('/login') }}" class="btn btn-primary btn-lg" role="button">Sign In</a></p></div>
    </div>

    <div class="text-center">
        <p style="margin-top: .5em">Do you need to register as a Parent?</p><a href="{{ url('/register') }}">Click Here</a>

    </div>
</div>
@include('users/footer')
