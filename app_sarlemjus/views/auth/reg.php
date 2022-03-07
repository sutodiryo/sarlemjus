<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo LOGIN_DESC ?>">
    <meta name="author" content="natdev.web.id">
    <title><?php echo $title ?></title>
    <link href="<?php echo FRONT_ASSETS ?>img/najah_favicon.png" rel="icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/argon.css?v=1.1.0" type="text/css">
</head>

<body class="bg-default">
    <div class="main-content">
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mbx-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6">
                            <br>
                            <br>
                            <h1 class="text-white"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8">
                    <div class="card bg-secondary border-0">

                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center">
                                <h1>Form Pendaftaran Najah Network</h1>
                            </div>
                            <br>

                            <form action="<?php echo base_url('reg/' . $id_upline); ?>" method="POST" role="form">

                                <?php
                                if (!empty($id_upline)) {
                                    echo "<input type='hidden' name='id_upline' value='" . $id_upline . "'>";
                                } else {
                                    echo "<input type='hidden' name='id_upline' value='0'>";
                                }
                                ?>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input name="nama" class="form-control" placeholder="Nama Lengkap" type="text" value="<?php echo set_value('nama'); ?>" required>
                                        <br>
                                        <?php echo form_error('nama', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input name="no_hp" class="form-control" placeholder="Nomor Handphone" type="number" value="<?php echo set_value('no_hp'); ?>" required>
                                        <br>
                                        <?php echo form_error('no_hp', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" type="text">
                                        <br>
                                        <?php echo form_error('email', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-control-label" for="exampleFormControlSelect4">Level Mitra :</label>
                                        <?php

                                        foreach ($level as $l) {
                                            echo "  <div class='custom-control custom-control-alternative custom-radio mb-3'>
                                                        <input name='level' ";

                                            if (set_value('level') == $l->id_member_level) echo "checked='checked'";

                                            echo " value='$l->id_member_level' " . $this->form_validation->set_radio('level', $l->id_member_level) . " class='custom-control-input' id='level_$l->id_member_level' type='radio' required>
                                                        <label class='custom-control-label' for='level_$l->id_member_level'>$l->nama_level<br><font color='blue'>$l->keterangan</font></label>
                                                    </div>
                                                    <br>";
                                        }
                                        ?>
                                        <?php echo form_error('level', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input name="password" id="password" class="form-control" placeholder="Password" type="password" value="<?php echo set_value('password'); ?>" onkeyup='check();' required>
                                        <br>
                                        <?php echo form_error('password', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input name="confirm_password" id="confirm_password" class="form-control" placeholder="Ulangi Password" type="password" value="<?php echo set_value('confirm_password'); ?>" required onkeyup='check();' required>
                                        <br>
                                        <?php echo form_error('confirm_password', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                    <label>
                                        <span id='message'></span>
                                    </label>
                                </div>

                                <!-- <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div> -->

                                <!--
                                <div class="row my-4">
                                    <div class="col-12">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                            <label class="custom-control-label" for="customCheckRegister">
                                                <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                -->

                                <div class="text-center">
                                    <button id="Submit" type="submit" class="btn btn-primary mt-4" disabled>Create account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var check = function() {
            if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'OK!';
                document.getElementById("Submit").disabled = false;
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password tidak cocok.';
                document.getElementById("Submit").disabled = true;
            }
        }

        // function checkPasswordMatch() {
        //     var password = $("#pwd1").val();
        //     var confirmPassword = $("#pwd2").val();

        //     if (password != confirmPassword)
        //         $("#divCheckPasswordMatch").html("<span class='text-red'>Password tidak sesuai!</span>");

        //     else
        //         $("#divCheckPasswordMatch").html("<span class='text-green'>Password sesuai</span>");

        // }


        // $(document).ready(function() {
        //     $("#txtConfirmPassword").keyup(checkPasswordMatch);

        //     const submit = document.getElementById('Submit');
        //     submit.disabled = (password === confirmPassword);
        // });

        // (function() {
        //     $('form > input').keyup(function() {

        //         var empty = false;
        //         $('form > input').each(function() {
        //             if ($(this).val() == '') {
        //                 empty = true;
        //             }
        //         });

        //         if (empty) {
        //             $('#register').attr('disabled', 'disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        //         } else {
        //             $('#register').removeAttr('disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        //         }
        //     });
        // })()
    </script>

    <script src="<?php echo ASSETS ?>vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/js-cookie/js.cookie.js"></script>
    <script src="<?php echo ASSETS ?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="<?php echo ASSETS ?>js/argon.js?v=1.1.0"></script>
    <script src="<?php echo ASSETS ?>js/demo.min.js"></script>
</body>

</html>