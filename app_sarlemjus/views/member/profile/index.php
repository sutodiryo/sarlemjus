<?php $this->load->view('member/_/header'); ?>

<div class="pcoded-main-container">
	<div class="pcoded-content">
		<div class="user-profile user-card mb-4">
			<div class="card-header border-0 p-0 pb-0">
				<div class="cover-img-block">
					<!-- <img src="<?php echo ASSETS ?>images/profile/cover.jpg" alt="" class="img-fluid"> -->
					<div class="overlay"></div>
					<div class="change-cover">
						<div class="dropdown">
							<a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon feather icon-camera"></i></a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
								<a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
								<a class="dropdown-item" href="#"><i class="feather icon-film mr-2"></i> upload video</a>
								<a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body py-0">
				<div class="user-about-block m-0">
					<div class="row">
						<div class="col-md-4 text-center mt-n5">
							<div class="change-profile text-center">
								<div class="dropdown w-auto d-inline-block">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<div class="profile-dp">
											<div class="position-relative d-inline-block">
												<img class="img-radius img-fluid wid-100 hei-100" src="<?php echo "" . base_url() . "public/upload/member/$member->img"; ?>" alt="<?= $member->name ?>" style="object-fit: cover;">
											</div>
											<div class="overlay">
												<span>change</span>
											</div>
										</div>
										<div class="certificated-badge">
											<i class="fas fa-certificate text-c-blue bg-icon"></i>
											<i class="fas fa-check front-icon text-white"></i>
										</div>
									</a>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>upload new</a>
										<a class="dropdown-item" href="#"><i class="feather icon-image mr-2"></i>from photos</a>
										<a class="dropdown-item" href="#"><i class="feather icon-shield mr-2"></i>Protact</a>
										<a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>remove</a>
									</div>
								</div>
							</div>
							<h5 class="mb-1"><?= $member->name ?></h5>
							<p class="mb-2 text-muted"><?= $member->level_name ?></p>
						</div>
						<div class="col-md-8 mt-md-4">
							<div class="row">
								<div class="col-md-6">
									<a href="#" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i><?= $member->email ?></a>
									<!-- <a href="mailto:<?= $member->email ?>" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i><?= $member->email ?></a> -->
									<div class="clearfix"></div>
									<a href="#" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="fab fa-whatsapp mr-2 f-18"></i>+62 <?= $member->phone ?></a>
									<!-- <a href="https://wa.me/62<?= $member->phone ?>" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone mr-2 f-18"></i>+62 <?= $member->phone ?></a> -->
								</div>
								<div class="col-md-6">
									<div class="media">
										<i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
										<div class="media-body">
											<?php if (!empty($member->village)) { ?>
												<p class="mb-0 text-muted"><?php echo "$member->postal_code $member->district_name"; ?></p>
												<p class="mb-0 text-muted"><?= $member->address ?></p>
											<?php
											} else { ?>
												<p class="mb-0 text-muted">Anda belum mengatur alamat.</p>
												<p class="mb-0 text-muted"><a href="#alamat">Lengkapi sekarang...</a></p>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link text-reset active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="feather icon-user mr-2"></i>Profil</a>
								</li>
							</ul> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 order-md-6">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<h5 class="mb-0">Data Pribadi</h5>
								<button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
									<i class="feather icon-edit"></i>
								</button>
							</div>
							<div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Nama Lengkap</label>
										<div class="col-sm-9">
											<?= $member->name ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
										<div class="col-sm-9">
											<?php
											if ($member->gender == "L") {
												echo "Laki-laki";
											} elseif ($member->gender == "P") {
												echo "Perempuan";
											} else {
												echo "-";
											}
											?>
										</div>
									</div>
									<!-- <div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
										<div class="col-sm-9">
											16-12-1994
										</div>
									</div> -->
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Level Member</label>
										<div class="col-sm-9">
											<?= empty($member->level) ? "-" : "$member->level " ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
										<div class="col-sm-9">
											<p class="mb-0 text-muted"><?php echo "$member->village_name, $member->subdistrict_name, $member->district_name,$member->province_name"; ?></p>
											<p class="mb-0 text-muted"><?= $member->address ?></p>
											<p class="mb-0 text-muted"><?= $member->postal_code ?></p>
										</div>
									</div>
								</form>
							</div>
							<div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Full Name" value="<?= $member->name ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
										<div class="col-sm-9">

											<?php
											if ($member->gender == "L") {
												echo "<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender1' name='gender' class='custom-control-input' checked>
												<label class='custom-control-label' for='gender1'>Laki-laki</label>
											</div>
											<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender2' name='gender' class='custom-control-input'>
												<label class='custom-control-label' for='gender2'>Perempuan</label>
											</div>";
											} elseif ($member->gender == "L") {
												echo "<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender1' name='gender' class='custom-control-input'>
												<label class='custom-control-label' for='gender1'>Laki-laki</label>
											</div>
											<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender2' name='gender' class='custom-control-input' checked>
												<label class='custom-control-label' for='gender2'>Perempuan</label>
											</div>";
											} else {
												echo "<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender1' name='gender' class='custom-control-input'>
												<label class='custom-control-label' for='gender1'>Laki-laki</label>
											</div>
											<div class='custom-control custom-radio custom-control-inline'>
												<input type='radio' id='gender2' name='gender' class='custom-control-input'>
												<label class='custom-control-label' for='gender2'>Perempuan</label>
											</div>";
											}
											?>

										</div>
									</div>
									<!-- <div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Tanggal Lahir</label>
										<div class="col-sm-9">
											<input type="date" class="form-control" value="1994-12-16">
										</div>
									</div> -->
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Level Member</label>
										<div class="col-sm-9">
											<select class="form-control" id="exampleFormControlSelect1">
												<option>Select Marital Status</option>
												<option>Married</option>
												<option selected>Unmarried</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Alamat</label>
										<div class="col-sm-9">
											<textarea class="form-control"><?php echo "$member->village_name,$member->subdistrict_name,$member->district_name,$member->province_name
$member->address
$member->postal_code"; ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<h5 class="mb-0">Kontak</h5>
								<button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-dont-edit" aria-expanded="false" aria-controls="pro-dont-edit-1 pro-dont-edit-2">
									<i class="feather icon-edit"></i>
								</button>
							</div>
							<div class="card-body border-top pro-dont-edit collapse show" id="pro-dont-edit-1">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
										<div class="col-sm-9">
											+1 9999-999-999
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
										<div class="col-sm-9">
											Demo@domain.com
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
										<div class="col-sm-9">
											@phonixcoded
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
										<div class="col-sm-9">
											@phonixcoded demo
										</div>
									</div>
								</form>
							</div>
							<div class="card-body border-top pro-dont-edit collapse " id="pro-dont-edit-2">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Full Name" value="+1 9999-999-999">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded demo">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<h5 class="mb-0">Akun Bank & NPWP</h5>
								<button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-wrk-edit" aria-expanded="false" aria-controls="pro-wrk-edit-1 pro-wrk-edit-2">
									<i class="feather icon-edit"></i>
								</button>
							</div>
							<div class="card-body border-top pro-wrk-edit collapse show" id="pro-wrk-edit-1">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
										<div class="col-sm-9">
											Designer
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Skills</label>
										<div class="col-sm-9">
											C#, Javascript, Scss
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
										<div class="col-sm-9">
											Phoenixcoded
										</div>
									</div>
								</form>
							</div>
							<div class="card-body border-top pro-wrk-edit collapse" id="pro-wrk-edit-2">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Full Name" value="Designer">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
										<div class="col-sm-9">
											<div class="custom-control custom-checkbox form-check d-inline-block mr-2">
												<input type="checkbox" class="custom-control-input" id="pro-wrk-chk-1" checked>
												<label class="custom-control-label" for="pro-wrk-chk-1">C#</label>
											</div>
											<div class="custom-control custom-checkbox form-check d-inline-block mr-2">
												<input type="checkbox" class="custom-control-input" id="pro-wrk-chk-2" checked>
												<label class="custom-control-label" for="pro-wrk-chk-2">Javascript</label>
											</div>
											<div class="custom-control custom-checkbox form-check d-inline-block mr-2">
												<input type="checkbox" class="custom-control-input" id="pro-wrk-chk-3" checked>
												<label class="custom-control-label" for="pro-wrk-chk-3">Scss</label>
											</div>
											<div class="custom-control custom-checkbox form-check d-inline-block mr-2">
												<input type="checkbox" class="custom-control-input" id="pro-wrk-chk-4">
												<label class="custom-control-label" for="pro-wrk-chk-4">Html</label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>


						<div class="card  select-card" id="alamat">
							<div class="card-body d-flex align-items-center justify-content-between">
								<h5 class="mb-0">Alamat Pengiriman</h5>
								<button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-address-edit" aria-expanded="false" aria-controls="pro-address-edit-1 pro-address-edit-2">
									<i class="feather icon-edit"></i>
								</button>
							</div>
							<div class="card-body border-top pro-address-edit collapse show" id="pro-address-edit-1">
								<form>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Provinsi</label>
										<div class="col-sm-9">
											<?= $member->province_name ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Kota/Kabupaten</label>
										<div class="col-sm-9">
											<?= $member->district_name ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Kecamatan</label>
										<div class="col-sm-9">
											<?= $member->subdistrict_name ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Desa/Kelurahan</label>
										<div class="col-sm-9">
											<?= $member->village_name ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Alamat Lengkap</label>
										<div class="col-sm-9">

											<?php if (!empty($member->village)) { ?>
												<p class="mb-0 text-muted"><?= "$member->village_name, $member->subdistrict_name, $member->district_name,$member->province_name"; ?></p>
												<p class="mb-0 text-muted"><?= $member->address ?></p>
												<p class="mb-0 text-muted"><?= $member->postal_code ?></p>
											<?php
											} else { ?>
												<p class="mb-0 text-muted">Anda belum mengatur alamat.</p>
												<p class="mb-0 text-muted"><a href="#alamat">Lengkapi Alamat</a></p>
											<?php } ?>

										</div>
									</div>
								</form>
							</div>

							<div class="card-body border-top pro-address-edit collapse" id="pro-address-edit-2">
								<form action="#" method="POST">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Provinsi</label>
										<div class="col-sm-9">

											<select class="js-example-basic-single form-control" id="province">
												<option selected value="#">Pilih Provinsi</option>
												<?php
												foreach ($province as $pro) {
													echo "<option value='$pro->id'>$pro->name</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Kota/Kabupaten</label>
										<div class="col-sm-9">
											<select class="js-example-basic-single form-control" id="district">
												<option selected value="#">Pilih Kota/Kabupaten</option>
												<?php
												foreach ($province as $pro) {
													echo "<option value='$pro->id'>$pro->name</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Kecamatan</label>
										<div class="col-sm-9">
											<select class="js-example-basic-single form-control">
												<option selected value="#">Pilih Kecamatan</option>
												<?php
												foreach ($province as $pro) {
													echo "<option value='$pro->id'>$pro->name</option>";
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Desa/Kelurahan</label>
										<div class="col-sm-9">
											<select class="js-example-basic-single form-control">
												<option selected value="#">Pilih Desa/Kelurahan</option>
												<?php
												foreach ($province as $pro) {
													echo "<option value='$pro->id'>$pro->name</option>";
												}
												?>
											</select>
										</div>
									</div>


									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bolder">Alamat Lengkap</label>
										<div class="col-sm-9">

											<?php if (!empty($member->village)) { ?>
												<p class="mb-0 text-muted"><?= "$member->village_name, $member->subdistrict_name, $member->district_name,$member->province_name"; ?></p>
												<!-- <p class="mb-0 text-muted"><?= $member->address ?></p> -->
												<p class="mb-0 text-muted"><?= $member->postal_code ?></p>
											<?php
											} else { ?>
												<p class="mb-0 text-muted">-</p>
											<?php } ?>

										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>

							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- <div class="col-md-4 order-md-1">
				<div class="card new-cust-card">
					<div class="card-header">
						<h5>Downline</h5>
						<div class="card-header-right">
							<div class="btn-group card-option">
								<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="feather icon-more-horizontal"></i>
								</button>
								<ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
									<li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
									<li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
									<li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
									<li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="cust-scroll" style="height:415px;position:relative;">
						<div class="card-body p-b-0">
							<?php foreach ($downline as $d) {
								echo "<div class='align-middle m-b-25'>
								<img src='" . base_url() . "public/upload/member/$d->img' alt='$d->name' class='img-radius align-top m-r-15'>
								<div class='d-inline-block'>
									<a href='#!'>
										<h6>$d->name</h6>
									</a>
									<p class='m-b-0'>$d->level_name</p>";
								if ($d->status == 1) {
									echo "<span class='status active'></span>";
								}


								echo "
								</div>
							</div>";
							}
							?>

						</div>
					</div>
				</div>
			</div> -->
		</div>
		<!-- profile body end -->
	</div>
</div>

<?php $this->load->view('member/_/footer'); ?>


<script type="text/javascript">
    $(document).ready(function() {
        // $('[name="kode_bank"]').val("<?php echo $profile->kode_bank ?>");
        // $('#kode_bank').select2().trigger('change');
        // $('[name="id_location"]').val(<?php echo $profile->id_location ?>);
        // $('#id_location').select2().trigger('change');

        $('#province').select2({
            placeholder: 'Pilih Provinsi',
            language: "id"
        });

        $('#district').select2({
            placeholder: 'Pilih kota/kabupaten',
            language: "id"
        });

        $('#subdistrict').select2({
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

        $('#province').change(function() {
            var idp = $('#province').val();

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
    //             $('[name="id_member_shipping"]').val(data.id_member_shipping);
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