<?php $this->load->view('admin/_/header'); ?>

<!-- Pas mau keluar page ini harus muncul alert, ketika di klik yes hapus flashdata -->

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Form Elements</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Components</a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Elements</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <?php echo $this->session->flashdata('report'); ?>
                    <div class="card-header">
                        <h5>Data Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart('admin/member/add/new', 'id="save"'); ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('email', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone">Nomor HP (WA)</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Nomor Handphone" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('phone', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Jenis Kelamin</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderl" name="gender" value="L" class="custom-control-input">
                                    <label class="custom-control-label" for="genderl">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderp" name="gender" value="P" class="custom-control-input">
                                    <label class="custom-control-label" for="genderp">Perempuan</label>
                                </div>
                                <?php echo form_error('gender', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Foto</label>
                                <div>
                                    <input type="file" class="validation-file" name="img">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="work">Pekerjaan</label>
                                <input type="text" class="form-control" name="work" id="work">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nik">Nomor Induk Kependudukan (NIK/No KTP)</label>
                                <input type="number" class="form-control" id="nik" name="nik" value="<?php echo set_value('name'); ?>">
                                <?php echo form_error('nik', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nik_name">Nama Sesuai KTP</label>
                                <input type="text" class="form-control" name="nik_name" id="nik_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="npwp">Nomor NPWP (Opsional)</label>
                                <input type="text" class="form-control" id="npwp" name="npwp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="npwp_name">Nama NPWP (Opsional)</label>
                                <input type="text" class="form-control" id="npwp_name" name="npwp_name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="province">Provinsi</label>
                                <select class="js-example-basic-single form-control" id="province" name="province">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="district">Kabupaten/Kota</label>
                                <select class="js-example-basic-single form-control" disabled id="district" name="district">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="subdistrict">Kecamatan</label>
                                <select class="js-example-basic-single form-control" disabled id="subdistrict" name="subdistrict">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="village">Desa/Kelurahan</label>
                                <select class="js-example-basic-single form-control" disabled id="village" name="village">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="postal_code">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Alamat Lengkap <small class="text-danger">(Lengkapi alamat, karena akan digunakan untuk pengiriman paket)</small></label>
                                <!-- <input type="text" class="form-control" disabled id="address" placeholder="Alamat Lengkap" name="address"> -->
                                <textarea class="form-control" disabled id="address" rows="3" name="address"></textarea>
                            </div>
                        </div>

                        <h5 class="mt-2">Data Membership</h5>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Member Upline (opsional)</label>
                                <select class="js-example-basic-single form-control" name="upline">
                                    <?php foreach ($upline as $up) {
                                        echo "<option value='$up->id'>$up->name ($up->phone)</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="level">Level</label>
                                <select class="js-example-basic-single form-control" id="level" name="level" value="<?php echo set_value('name'); ?>">
                                    <?php foreach ($level as $lv) {
                                        echo "<option value='$lv->id'>$lv->name</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Bank</label>
                                <select class="js-example-basic-single form-control" name="bank">
                                    <?php foreach ($bank as $b) {
                                        echo "<option value='$b->id'>$b->name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_account">Nomor Rekening</label>
                                <input type="number" class="form-control" id="bank_account" name="bank_account">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_account_name">Nama Rekening</label>
                                <input type="text" class="form-control" id="bank_account_name" name="bank_account_name">
                            </div>
                        </div>

                        <div class="form-row">

                        </div>
                        <button type="submit" class="btn  btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<?php $this->load->view('admin/_/footer'); ?>



<script type="text/javascript">
    $.ajax({
        type: "GET",
        dataType: "html",
        url: "<?php echo base_url('api/location/get_province/') ?>",
        success: function(data) {
            $("select#province").html(data);
        }
    });

    $('#province').change(function() {
        var id_province = $('#province').val();

        $('#district').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#district').load('<?php echo base_url('api/location/get_district/') ?>/' + id_province, function(responseTxt, statusTxt, xhr) {
            if (statusTxt === "success")
                $('.loading').remove();
            document.getElementById('district').disabled = false;
        });
        return false;
    });

    $('#district').change(function() {
        var id_district = $('#district').val();

        $('#subdistrict').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#subdistrict').load('<?php echo base_url('api/location/get_subdistrict/') ?>/' + id_district, function(responseTxt, statusTxt, xhr) {
            if (statusTxt === "success")
                $('.loading').remove();
            document.getElementById('subdistrict').disabled = false;
        });
        return false;
    });

    $('#subdistrict').change(function() {
        var subdistrict_name = $("#subdistrict option:selected").text();
        $("#subdistrict_name").val(subdistrict_name);

        $('#village').load('<?php echo base_url('api/location/get_village/') ?>' + subdistrict_name, function(responseTxt, statusTxt, xhr) {
            if (statusTxt === "success")
                $('.loading').remove();
            document.getElementById('village').disabled = false;
        });
        return false;
    });

    $('#village').change(function() {
        var province_name = $("#province option:selected").text();
        var district_name = $("#district option:selected").text();
        var subdistrict_name = $("#subdistrict option:selected").text();
        var village_name = $("#village option:selected").text();

        $("#address").val('...., ' + village_name + ', Kecamatan ' + subdistrict_name + ', ' + district_name + ', ' + province_name);
        document.getElementById('address').disabled = false;
        return false;
    });
</script>