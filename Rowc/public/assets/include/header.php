<header>
    <div class="nav nav-links">
        <div class="mobile-menu-button-section">
                <button class="c-hamburger c-hamburger--htx mob-menu-click"><span>toggle menu</span></button>
        </div>
        <div class="menu-section">
            <div class="top-menu">
                <div class="container">
                    <ul class="inlined">
                        <li><a href="#">Dining</a></li>
                        <li><a href="#">NIGHTLIFE</a></li>
                        <li><a href="#">Adventure</a></li>
                        <li><a href="#">Art</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li class="gap"><a href="#"></a></li>
                        <li><a href="#">Music</a></li>
                        <li><a href="#">Casual</a></li>
                        <li><a href="#">Celebrations</a></li>
                        <li><a href="#">GAMING</a></li>
                        <li><a href="#">Education</a></li>
                    </ul>
                </div>
            </div>
            <div class="bottom-menu">
                <div class="container">
                    <ul class="inlined">
                        <li class="left" ><a href="#"><img src="assets/images/ic-info.png" alt=""> About Us</a></li>
                        <li class="left" style="display: none;"><a><img src="assets/images/ic-info.png" alt="">Toronto</a></li>
                        <div class="elipsed">
                            <div class="logo">
                                <img src="assets/images/logo.png" alt="">
                            </div>
                        </div>
                        <li class="right"><a data-toggle="modal"  href="#" data-target="#loginModal" onclick="showLoginForm();"><img src="assets/images/ic-login.png" alt=""> Login</a></li>
                        <li class="right have-child" style="display: none;">
                            <a><img src="assets/images/ic-login.png" alt="">Peter Schulz</a>
                            <ul class="sub-menu">
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Notifications</a></li>
                                <li><a href="#">Reviews</a></li>
                                <li><a href="#">Account</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Trigger the modal with a button -->

<!-- Modal -->
<div class="modal fade popup" id="loginModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="box login-box">
                    <h2 class="title">LOGIN</h2>
                    <form class="form-horizontal floating-form">
                        <div class="form-group">
                            <div class="field">
                                <input type="email" class="form-control" id="l-eml" name="email" required>
                                <label class="float-label" for="l-eml">Email Id</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="password" id="l-psw" class="form-control" name="password" required>
                                <label class="float-label" for="l-psw">Confirm Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="bottom-tbl">
                                <div class="bottom-cell">
                                    <span class="link"><a href="#" onclick="showForgetForm();">Forgot Password?</a></span>
                                </div>
                                <div class="bottom-cell button">
                                    <a href="#" class="btn btn-yellow">LOGIN</a>
                                </div>
                            </div>
                        </div>
                        <div class="social-buttons">
                            <a href="#" class="icon-btn btn-fb sb-height"><img src="assets/images/ic-facebook.png"><span>SIGN IN WITH FACEBOOK</span></a>
                            <span class="or-sec sb-height">OR</span>
                            <a href="#" class="icon-btn btn-gp sb-height"><img src="assets/images/ic-google.png"><span>SIGN IN WITH FACEBOOK</span></a>
                        </div>
                        <div class="footer-line">NOT A MEMBER YET? <a href="#" onclick="showRegisterForm();">REGISTER NOW</a></div>
                    </form>
                </div>
                <div class="box register-box">
                    <h2 class="title">Register</h2>
                    <form class="form-horizontal floating-form">
                        <div class="form-group">
                            <div class="field">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="" required>
                                <label class="float-label" for="fname">Full Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="email" class="form-control" name="remail" id="remail" required>
                                <label class="float-label" for="remail">Email Id</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="text" class="form-control" name="phone" id="phone" required>
                                <label class="float-label" for="phone">Phone Number</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="password" class="form-control" name="password" id="rpass" required>
                            <label class="float-label" for="rpass">Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="field">
                                <input type="password" class="form-control" name="confirm-password" id="confirm" required>
                                <label class="float-label" for="confirm">Confirm Password</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="bottom-tbl">
                                <div class="bottom-cell">
                                    <span class="link">ALREADY A MEMBER?&nbsp;<a href="#" onclick="showLoginForm();" class="reg-link">LOGIN</a></span>
                                </div>
                                <div class="bottom-cell button">
                                    <a href="#" class="btn btn-secondary">Register</a>
                                </div>
                            </div>
                        </div>
                        <div class="social-buttons">
                            <a href="#" class="icon-btn btn-fb sb-height"><img src="assets/images/ic-facebook.png"><span>SIGN IN WITH FACEBOOK</span></a>
                            <span class="or-sec sb-height">OR</span>
                            <a href="#" class="icon-btn btn-gp sb-height"><img src="assets/images/ic-google.png"><span>SIGN IN WITH FACEBOOK</span></a>
                        </div>
                    </form>
                </div>
                <div class="box forget-box">
                    <h2 class="title">Forgot Your Password?</h2>
                    <span class="small-note"> We will send you an email to reset password. </span>
                    <form class="form-horizontal floating-form">
                        <div class="form-group">
                            <div class="field">
                                <input type="email" class="form-control" name="frgt-email" id="frgt-email" required>
                                <label class="float-label" for="frgt-email">Email Id</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="bottom-tbl">
                                <div class="bottom-cell">
                                    <span class="link">ALREADY A MEMBER?&nbsp;<a href="#" onclick="showLoginForm();" class="reg-link">LOGIN</a></span>
                                </div>
                                <div class="bottom-cell button">
                                    <a href="#" class="btn btn-primary">SEND</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>