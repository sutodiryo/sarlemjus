<?php $this->load->view('admin/_/header'); ?>


<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-12">
                    <!-- <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-4 order-xl-1">
            <div class="card card-profile">
                <img src="<?php echo ASSETS ?>img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="<?php echo ASSETS ?>img/theme/profil.jpg" class="rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-success mr-4"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="btn btn-sm btn-info float-right"><i class="fa fa-paper-plane"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="text-center">
                        <h5 class="h2">
                            <?php echo $profile->nama; ?>
                        </h5>
                        <div class="h4 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i><?php echo $profile->kota; ?>
                        </div>
                        <div class="h5 font-weight-300">
                            <i class="ni education_hat mr-2"></i><?php echo $profile->alamat; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Alamat Pengiriman </h3>
                        </div>
                        <div class="col-4 text-right">
                            <a data-toggle="modal" href="#modal_add_shipping_address" title="Tambah Alamat Pengiriman Baru" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush list my--3">

                        <?php
                        foreach ($member_shipping as $ms) {
                            echo "
                                <li class='list-group-item px-0'>
                                    <div class='row align-items-center'>

                                        <div class='col-10'>
                                            <h4 class='mb-0'>$ms->nama_penerima";
                            if ($ms->status == 1) {
                                echo " <font color='red'><small>[Utama]</small></font>";
                            }
                            echo "</h4>
                                        </div>
                                        <div class='col-2 text-right'>";
                                            // <button onclick=\"edit_shipping_address('$ms->id')\"  title='Edit Alamat Pengiriman ini' class='btn btn-sm btn-icon-only btn-success'><i class='fa fa-pencil-alt'></i></button>
                                            echo "<a href='" . base_url('member/del_shipping_address/') . "$ms->id/' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus Alamat Pengiriman ini' class='btn btn-sm btn-icon-only btn-danger'><i class='fa fa-trash-alt'></i></a>
                                        </div>

                                        <div class='col'>
                                            <h5>$ms->no_hp_penerima</h5>
                                            <h5>$ms->full_address - $ms->postal_code</h5>
                                        </div>
                                    </div>
                                </li>
                        ";
                        } ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-2">
            <div class="row">
                <div class="col-lg-6">
                    <a href="<?php echo base_url() ?>member/team">
                        <div class="card bg-gradient-info border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Team</h5>
                                        <span class="h2 font-weight-bold mb-0 text-white"><?php echo $profile->team; ?> Orang</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="<?php echo base_url() ?>member/transaction">
                        <div class="card bg-gradient-danger border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Transaksi</h5>
                                        <span class="h2 font-weight-bold mb-0 text-white"><?php echo $profile->transaksi; ?> Kali</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card">

                <form action="<?php echo base_url('member/act/update_profile') ?>" method="POST">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit profile </h3>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">Nama Lengkap</label>
                                        <input type="text" id="input-name" name="nama" value="<?php echo $profile->nama; ?>" class="form-control" placeholder="Nama lengkap amda" required>
                                        <!-- <br> -->
                                        <?php echo form_error('nama', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Username</label>
                                        <input type="text" id="input-username" name="username" value="<?php echo $profile->username; ?>" class="form-control" placeholder="Set Username">
                                        <!-- <br> -->
                                        <?php echo form_error('username', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-no_hp">Nomor Handphone (WA)</label>
                                        <input type="text" id="input-no_hp" name="no_hp" value="<?php echo $profile->no_hp; ?>" class="form-control" placeholder="Nomor HP anda" required>
                                        <!-- <br> -->
                                        <?php echo form_error('no_hp', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" id="input-email" name="email" value="<?php echo $profile->email; ?>" class="form-control" placeholder="Email anda" required>
                                        <!-- <br> -->
                                        <?php echo form_error('email', '<small class="text-danger pl-4">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="id_location">ID Kota/Kabupaten</label>
                                        <select name="id_location" id="id_location" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_location="1" tabindex="-1" aria-hidden="true" required>
                                            <option>Pilih Kota/Kabupaten anda ..........</option>
                                            <?php
                                            $no = 0;
                                            foreach ($lokasi as $lk) {
                                                $no++;
                                                echo "<option data-select2-id_location='$no' value='$lk->id_location'>$lk->location_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Alamat Lengkap</label>
                                        <textarea rows="4" class="form-control" placeholder="Alamat Lengkap anda" name="alamat"><?php echo $profile->alamat; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="pekerjaan">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="<?php echo $profile->pekerjaan; ?>" placeholder="Pekerjaan Anda">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="kode_bank">Bank</label>
                                        <select name="kode_bank" id="kode_bank" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-kode_bank="<?php echo $profile->kode_bank ?>" tabindex="-1" aria-hidden="true" required>
                                            <option>Pilih Bank Anda ...........</option>
                                            <?php
                                            $no = 0;
                                            foreach ($bank as $b) {
                                                $no++;
                                                echo "<option data-select2-kode_bank='$no' value='$b->kode_bank'>$b->nama_bank</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="no_rekening">Nomor Rekening</label>
                                        <input type="number" name="no_rekening" id="no_rekeninge" class="form-control" value="<?php echo $profile->no_rekening; ?>" placeholder="Nomor Rekening Anda">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nama_rekening">Nama Pemilik Rekening</label>
                                        <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" value="<?php echo $profile->nama_rekening; ?>" placeholder="Nama Pemilik Rekening">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12">
                <div class="copyright text-center text-lg-center text-muted">
                    &copy; <?php echo date('Y'); ?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="modal fade" id="modal_add_shipping_address" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Alamat Pengiriman Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('member/act/add_shipping_address/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_penerima">Nama Penerima*</label>
                                <input type="text" name="nama_penerima" class="form-control" id="nama_penerima" placeholder="Nama Penerima Paket" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="no_hp_penerima">Nomor HP/WA Penerima*</label>
                                <input type="number" name="no_hp_penerima" class="form-control" id="no_hp_penerima" placeholder="No HP/WA Penerima" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id_province">Provinsi*</label>
                                <select name="id_province" id="id_province" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_province="<?php echo $profile->kode_bank ?>" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="id_district">Kota/Kabupaten*</label>
                                <select name="id_district" id="id_district" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_district="<?php echo $profile->kode_bank ?>" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="id_subdistrict">Kecamatan*</label>
                                <select name="id_subdistrict" id="id_subdistrict" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_subdistrict="<?php echo $profile->kode_bank ?>" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="postal_code">Kode Pos</label>
                                <input type="hidden" name="province_name" class="form-control" id="province_name" readonly required>
                                <input type="hidden" name="district_name" class="form-control" id="district_name" readonly required>
                                <input type="hidden" name="subdistrict_name" class="form-control" id="subdistrict_name" readonly required>
                                <input type="number" name="postal_code" class="form-control" id="postal_code" placeholder="Kode Pos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="full_address">Alamat Lengkap* <small style="color:red;">(Wajib dilengkapi)</small></label>
                                <textarea name="full_address" class="form-control" id="full_address" rows="3" required placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal_edit_shipping_address" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('member/act/update_shipping_address/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_penerima_edt">Nama Penerima*</label>
                                <input type="text" name="nama_penerima_edt" class="form-control" id="nama_penerima_edt" placeholder="Nama Penerima Paket" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="no_hp_penerima_edt">Nomor HP/WA Penerima*</label>
                                <input type="number" name="no_hp_penerima_edt" class="form-control" id="no_hp_penerima_edt" placeholder="No HP/WA Penerima" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id_province_edt">Provinsi*</label>
                                <select name="id_province_edt" id="id_province_edt" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_province_edt="1" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="id_district_edt">Kota/Kabupaten*</label>
                                <select name="id_district_edt" id="id_district_edt" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_district_edt="1" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="id_subdistrict_edt">Kecamatan*</label>
                                <select name="id_subdistrict_edt" id="id_subdistrict_edt" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_subdistrict_edt="1" tabindex="-1" aria-hidden="true" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="postal_code_edt">Kode Pos</label>
                                <input type="hidden" name="province_name_edt" class="form-control" id="province_name_edt" readonly required>
                                <input type="hidden" name="district_name_edt" class="form-control" id="district_name_edt" readonly required>
                                <input type="hidden" name="subdistrict_name_edt" class="form-control" id="subdistrict_name_edt" readonly required>
                                <input type="number" name="postal_code_edt" class="form-control" id="postal_code_edt" placeholder="Kode Pos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="full_address_edt">Alamat Lengkap* <small style="color:red;">(Wajib dilengkapi)</small></label>
                                <textarea name="full_address_edt" class="form-control" id="full_address_edt" rows="3" required placeholder="Alamat Lengkap"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<?php $this->load->view('admin/_/footer'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('[name="kode_bank"]').val("<?php echo $profile->kode_bank ?>");
        $('#kode_bank').select2().trigger('change');
        $('[name="id_location"]').val(<?php echo $profile->id_location ?>);
        $('#id_location').select2().trigger('change');

        $('#id_province').select2({
            placeholder: 'Pilih Provinsi',
            language: "id"
        });

        $('#id_district').select2({
            placeholder: 'Pilih kota/kabupaten',
            language: "id"
        });

        $('#id_subdistrict').select2({
            placeholder: 'Pilih Kecamatan',
            language: "id"
        });

        $.ajax({
            type: "GET",
            dataType: "html",
            url: "<?php echo base_url('member/get/province/0') ?>",
            success: function(msg) {
                $("select#id_province").html(msg);
            }
        });

        $('#id_province').change(function() {
            var idp = $('#id_province').val();

            var province_name = $("#id_province option:selected").text();
            $("#province_name").val(province_name);

            $('#id_district').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $('#id_district').load('<?php echo base_url('member/get/district/') ?>/' + idp, function(responseTxt, statusTxt, xhr) {
                if (statusTxt === "success")
                    $('.loading').remove();
            });
            return false;
        });

        $('#id_district').change(function() {
            var idd = $('#id_district').val();

            var district_name = $("#id_district option:selected").text();
            $("#district_name").val(district_name);

            $('#id_subdistrict').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $('#id_subdistrict').load('<?php echo base_url('member/get/subdistrict/') ?>/' + idd, function(responseTxt, statusTxt, xhr) {
                if (statusTxt === "success")
                    $('.loading').remove();
            });
            return false;
        });

        $('#id_subdistrict').change(function() {
            var province_name = $("#province_name").val();
            var district_name = $("#district_name").val();
            var subdistrict_name = $("#id_subdistrict option:selected").text();
            $("#subdistrict_name").val(subdistrict_name);
            $("#full_address").val('RT RW/Jalan No Rumah, Desa/Kelurahan, ' + subdistrict_name + ', ' + district_name + ', ' + province_name);
            return false;
        });


        //EDT
        // $('#id_province_edt').select2({
        //     placeholder: 'Pilih Provinsi',
        //     language: "id"
        // });

        // $('#id_district_edt').select2({
        //     placeholder: 'Pilih kota/kabupaten',
        //     language: "id"
        // });

        // $('#id_subdistrict_edt').select2({
        //     placeholder: 'Pilih Kecamatan',
        //     language: "id"
        // });

        // $.ajax({
        //     type: "GET",
        //     dataType: "html",
        //     url: "<?php echo base_url('member/get/province/0') ?>",
        //     success: function(msg) {
        //         $("select#id_province_edt").html(msg);

        //         var idp = $('#id_province_edt').val();
        //         $('#id_district_edt').load('<?php echo base_url('member/get/district/') ?>/' + idp, function(responseTxt, statusTxt, xhr) {
        //         if (statusTxt === "success")
        //             $('.loading').remove();
        //     });
        //     }
        // });

        // $('#id_province_edt').change(function() {
        //     var idp = $('#id_province_edt').val();

        //     var province_name_edt = $("#id_province_edt option:selected").text();
        //     $("#province_name_edt").val(province_name_edt);

        //     $('#id_district_edt').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        //     $('#id_district_edt').load('<?php echo base_url('member/get/district/') ?>/' + idp, function(responseTxt, statusTxt, xhr) {
        //         if (statusTxt === "success")
        //             $('.loading').remove();
        //     });
        //     return false;
        // });

        // $('#id_district_edt').change(function() {
        //     var idd = $('#id_district_edt').val();

        //     var district_name_edt = $("#id_district_edt option:selected").text();
        //     $("#district_name_edt").val(district_name_edt);

        //     $('#id_subdistrict_edt').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        //     $('#id_subdistrict_edt').load('<?php echo base_url('member/get/subdistrict/') ?>/' + idd, function(responseTxt, statusTxt, xhr) {
        //         if (statusTxt === "success")
        //             $('.loading').remove();
        //     });
        //     return false;
        // });

        // $('#id_subdistrict_edt').change(function() {
        //     var province_name_edt = $("#province_name_edt").val();
        //     var district_name_edt = $("#district_name_edt").val();
        //     var subdistrict_name_edt = $("#id_subdistrict_edt option:selected").text();
        //     $("#subdistrict_name_edt").val(subdistrict_name_edt);
        //     $("#full_address_edt").val('RT RW/Jalan No Rumah, Desa/Kelurahan, ' + subdistrict_name_edt + ', ' + district_name_edt + ', ' + province_name_edt);
        //     return false;
        // });

    });

    // function edit_shipping_address(id) {
    //     //Ajax Load data from ajax
    //     $.ajax({
    //         url: "<?php echo base_url('member/get/shipping_address') ?>/" + id,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function(data) {
    //             $('[name="id"]').val(data.id);
    //             $('[name="nama_penerima_edt"]').val(data.nama_penerima);
    //             $('[name="no_hp_penerima_edt"]').val(data.no_hp_penerima);
    //             $('[name="id_province_edt"]').val(data.id_province);
    //             $('[name="id_district_edt"]').val(data.id_district);
    //             $('[name="id_subdistrict_edt"]').val(data.id_subdistrict);
    //             $('[name="province_name_edt"]').val(data.province_name);
    //             $('[name="district_name_edt"]').val(data.district_name);
    //             $('[name="subdistrict_name_edt"]').val(data.subdistrict_name);
    //             $('[name="postal_code_edt"]').val(data.postal_code);
    //             $('[name="full_address_edt"]').val(data.full_address);
    //             $('[name="status"]').val(data.status);

    //             $('#modal_edit_shipping_address').modal('show');
    //             $('.modal-title').text('Edit Alamat Pengiriman');

    //             $('#id_province_edt').select2().trigger('change');
    //             $('#id_district_edt').select2().trigger('change');
    //             $('#id_subdistrict_edt').select2().trigger('change');
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert('Error get data from ajax server');
    //         }
    //     });
    // }
</script>