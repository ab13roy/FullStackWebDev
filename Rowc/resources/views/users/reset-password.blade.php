<!DOCTYPE html>
<html>
<head>
    <title>{{Config::get('constant.PROJECT_NAME')}}</title>
    @include('users/head')
</head>
<body>
<?php
$category_detail = \App\Helpers::getCategory();
$general_home_page_image = \App\Helpers::generalSetting('homepage_url');
?>
<!-- ************* Header-Section ********************-->
<div class="header-wrapper">
    @include('users/header')
    <div class="hero-banner">
        <div class="top-header-alt">
            <ul class="top-header-item">
                @if($general_home_page_image !="")
                    <li class="item" style="background-image: url({{ asset('uploads/home_page/'.$general_home_page_image) }})"></li>
                @else
                    <li class="item" style="background-image: url({{ asset('assets/images/index-top-banner.jpg') }})"></li>
                @endif
            </ul>
        </div>
        <!--        <div class="grad-overlay-alt"></div>-->
    </div>
</div>
<!-- ************* Header-Section close********************-->

<!-- ************* content-Section ********************-->
<div class="content-wrapper">

    <div class="wrap detail-change-content">
        <div class="container">
            <div class="chnge-form">
                <div id="reset_error" class="alert alert-danger" style="display:none;"><ul></ul></div>
                <div id="reset_msg" class="alert alert-success" style="display:none;"></div>
                <form class="form-horizontal floating-form" id="reset-password" method="POST" action="">

                    <div class="edit-form basic">
                        <h4 class="red-title">Reset Password</h4>
                        @if($valid == 1)
                        <div class="form-group">

                            <div class="field">
                                <input type="hidden" name="user_id" id="user_id" value="{{$user_detail->id}}">
                                <div class="field-half">
                                    <input type="password" class="form-control" id="reset_password" name="reset_password" required>
                                    <label class="float-label">New Password</label>
                                </div>
                                <div class="field-half">
                                    <input type="password" class="form-control" id="reset_conf_password" name="reset_conf_password" required>
                                    <label class="float-label" >Confirm Password</label>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="button">
                                {{--<input class="btn btn-secondary" type="submit" value="Reset" style="cursor: pointer;">--}}
                                <button type="submit" class="btn btn-secondary" style="cursor: pointer;">Reset <span style="display: none;" class="reset_loader"><i class="fa fa-spin fa-refresh"></i></span></button>
                            </div>
                        </div>
                        @elseif($valid == 2)
                            <h5 style="text-align: center">Your verification link has expired</h5>
                        @else
                            <h5 style="text-align: center">Your verification link is invalid</h5>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- ************* content-Section close********************-->

<!-- ************* footer-Section ********************-->
<div class="footer-wrapper">
    @include('users/footer')
</div>

<!-- ************* Footer-Section ********************-->
</body>
</html>