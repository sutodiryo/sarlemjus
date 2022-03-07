<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Pendaftaran Distributor Vitacov</title>

<link href="<?php echo FAVICON ?>" rel="icon">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="Lawan Corona Dengan Mikroba">

<meta name="msapplication-tap-highlight" content="no">
<link href="<?php echo base_url() ?>assets/admin/main.07a59de7b920cd76b874.css" rel="stylesheet">
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-premium-dark">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5 class="modal-title">
                                        <h4 class="mt-2 text-center">

                                            <?php
                                            $nama    = $this->input->post('nama');
                                            $no_hp   = $this->input->post('no_hp2');
                                            $level   = $this->input->post('level');

                                            if ($level == 2) {
                                                $l = "DISTRIBUTOR";
                                            } elseif ($level == 1) {
                                                $l = "AGEN";
                                            } elseif ($level == 0) {
                                                $l = "RESELLER";
                                            }

                                            ?>
                                            <div>Selamat Datang & Bergabung dalam grup biotecindonesia.</div>
                                            <!-- <span>Selanjutnya hubungi <span class="text-success">mentor</span> anda dengan klik tombol hijau di bawah ini.</span> -->
                                        </h4>
                                    </h5>
                                    <!-- <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="position-relative form-group"><input name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group"><input name="text" id="exampleName" placeholder="Name here..." type="text" class="form-control"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group"><input name="password" id="examplePassword" placeholder="Password here..." type="password" class="form-control"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="position-relative form-group"><input name="passwordrep" id="examplePasswordRep" placeholder="Repeat Password here..." type="password" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="mt-3 position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Accept our <a href="javascript:void(0);">Terms
                                                and Conditions</a>.</label></div>
                                    <div class="divider row"></div>
                                    <h6 class="mb-0">Already have an account? <a href="javascript:void(0);" class="text-primary">Sign in</a> | <a href="javascript:void(0);" class="text-primary">Recover Password</a></h6> -->
                                </div>

                                <div class="modal-footer d-block text-center">
                                    <a href="https://api.whatsapp.com/send?phone=62<?php echo $no_hp ?>&text=Assalamualaikum%2C%20saya%20<?php echo $nama ?>%20telah%20mendaftar%20sebagai%20<?php echo $l ?>%20vitacov%20melalui%20link%20anda.%0AMohon%20arahan%20selanjutnya." class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-success btn-lg">Selanjutnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © Vitacov 2020</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/scripts/main.07a59de7b920cd76b874.js"></script>
</body>

</html>