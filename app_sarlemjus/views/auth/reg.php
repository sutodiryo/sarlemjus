<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Form Pendaftaran Mitra Sarlemjus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?php echo LOGIN_DESC ?>" />
    <meta name="keywords" content="<?php echo LOGIN_DESC ?>">
    <meta name="author" content="<?php echo LOGIN_DESC ?>" />

    <link href="<?php echo FAVICON ?>" rel="icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/style.css">
</head>

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto">
                <img src="<?php echo ASSETS ?>images/logo-mini.png" alt="" class="img-fluid">
                <!-- <img src="<?php echo ASSETS ?>images/auth/auth-logo.png" alt="" class="img-fluid"> -->
                <h1 class="text-white my-4">Welcome you!</h1>
                <!-- <h4 class="text-white font-weight-normal">Signup to your account and made member of the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4> -->
            </div>
        </div>
        <div class="auth-side-form">
            <form action="<?= base_url('reg/'); ?>" method="POST" role="form">

                <div class=" auth-content">
                    <img src="<?php echo ASSETS ?>images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                    <h4 class="mb-3 f-w-400">Form Pendaftaran</h4>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="nama"  value="<?php echo set_value('nama'); ?>" required>
                        <?php echo form_error('nama', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="phone">No Handphone/WA</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" required>
                        <?php echo form_error('phone', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="email" value="<?php echo set_value('email'); ?>" required>
                        <?php echo form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="password" value="<?php echo set_value('password'); ?>" required>
                        <?php echo form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!--
                    <div class="custom-control custom-checkbox  text-left mb-4 mt-2">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Send me the <a href="#!"> Newsletter</a> weekly.</label>
                    </div>
                    -->

                    <button class="btn btn-primary btn-block mb-4">Daftar</button>
                    <div class="text-center">
                        <div class="saprator my-4"><span>OR</span></div>
                        <!--
                        <button class="btn text-white bg-facebook mb-2 mr-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn text-white bg-googleplus mb-2 mr-2 wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-google-plus-g"></i></button>
                        <button class="btn text-white bg-twitter mb-2  wid-40 px-0 hei-40 rounded-circle"><i class="fab fa-twitter"></i></button>
                        -->
                        <p class="mt-4">Already have an account? <a href="<?= base_url('login') ?>" class="f-w-400">Log In</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- [ signin-img ] end -->

<!-- Required Js -->
<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/ripple.js"></script>
<script src="<?php echo ASSETS ?>js/pcoded.min.js"></script>

</body>

</html>