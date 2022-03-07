<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo LOGIN_TITLE ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?php echo LOGIN_DESC ?>" />
    <meta name="keywords" content="<?php echo LOGIN_DESC ?>">
    <meta name="author" content="<?php echo LOGIN_DESC ?>" />
    
    <link href="<?php echo FAVICON ?>" rel="icon">

    <link rel="stylesheet" href="<?php echo ASSETS ?>css/style.css">

</head>

<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto">
                <img src="<?php echo ASSETS ?>images/logo-mini.png" alt="" class="img-fluid">
                <h1 class="text-white my-4">Welcome Back!</h1>
                <h4 class="text-white font-weight-normal">Signin to your account and get explore the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4>
            </div>
        </div>
        <div class="auth-side-form">
            <div class=" auth-content">
                <img src="<?php echo ASSETS ?>images/logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                <h3 class="mb-4 f-w-400">Log In</h3>

                <?php echo $this->session->flashdata('report'); ?>

                <form role="form" method="POST" action="<?php echo base_url('do_login'); ?>">
                    <div class="form-group mb-3">
                        <label class="floating-label" for="username">No Handphone/Email</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="">
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="">
                    </div>
                    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Ingat informasi log in saya</label>
                    </div>
                    <button class="btn btn-block btn-primary mb-4">Sign In</button>
                    <!-- <div class="text-center">
                        <div class="saprator my-4"><span>OR</span></div>
                        <button class="btn text-white bg-facebook mb-2 mr-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn text-white bg-googleplus mb-2 mr-2 wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-google-plus-g"></i></button>
                        <button class="btn text-white bg-twitter mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-twitter"></i></button>
                        <p class="mb-2 mt-4 text-muted">Forgot password? <a href="auth-reset-password-img-side.html" class="f-w-400">Reset</a></p>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup-img-side.html" class="f-w-400">Signup</a></p>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/ripple.js"></script>
<script src="<?php echo ASSETS ?>js/pcoded.min.js"></script>

</body>

</html>