<?php $this->load->view('admin/_/header'); ?>


<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <!-- <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6> -->
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- <a href="https://wa.me/62$m->no_hp" class="btn btn-danger btn-icon"><i class="fa fa-reply"></i> Kembali</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($passwd as $p) { }
?>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo $title; ?></h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <p class="mb-0">
                                    Gunakan 4 karakter atau lebih dengan kata yang mudah anda ingat.
                                </p>
                            </div>
                        </div>
                        <hr />
                        <form method="POST" action="<?php echo base_url('member/act/update_passwd') ?>">
                            <div class="form-row">
                                <script>
                                    var check = function() {
                                        if (document.getElementById('password').value ==
                                            document.getElementById('confirm_password').value) {
                                            document.getElementById('message').style.color = 'green';
                                            document.getElementById('message').innerHTML = 'OK!';
                                            document.getElementById("submit").disabled = false;
                                        } else {
                                            document.getElementById('message').style.color = 'red';
                                            document.getElementById('message').innerHTML = 'Password tidak cocok.';
                                            document.getElementById("submit").disabled = true;
                                        }
                                    }
                                </script>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group has-success">
                                        <label class="form-control-label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control is-valid" id="password" onkeyup='check();' required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group has-success">
                                        <label class="form-control-label" for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control is-valid" id="confirm_password" onkeyup='check();' required>
                                        <div class="valid-feedback">
                                            <span id='message'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" id="submit" type="submit" disabled>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12">
                <div class="copyright text-center text-lg-center text-muted">
                    &copy; <?php echo date('Y');?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php $this->load->view('admin/_/footer'); ?>