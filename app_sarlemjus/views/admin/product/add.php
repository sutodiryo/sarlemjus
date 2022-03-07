<?php $this->load->view('admin/_/header'); ?>

<!-- Header -->
<div class="header pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo base_url('admin/product/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid mt--6">

	<?php echo form_open_multipart('admin/add/product', 'id="save"'); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="card-wrapper">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="nama_produk">Nama Produk</label>
									<input type="text" class="form-control" name="nama_produk" id="nama_produk" onkeyup="get_slug()" placeholder="Nama Produk" required>
								</div>
								<div class="form-group">
									<label class="form-control-label" for="slug">Slug</label>
									<input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="nama_produk">Foto Produk 1x1 <small>(Reomendasi : 1280x1280px)</small></label>
									<!-- <input type="file" class="custom-file-input" name="img_1" id="projectCoverUploads"> -->
									<!-- <label class="custom-file-label" for="img_1">Choose file</label> -->
									<input type="file" name="img_1" class="form-control" id="img_1">
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card-wrapper">
				<div class="card">
					<!--
						<div class="card-header">
							<h3 class="mb-0">Dropdowns</h3>
						</div>
					-->
					<div class="card-body">
						<div class="row">

							<!--
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-control-label" for="nama_produk">Kategori</label>
										<select class="form-control" data-toggle="select">
											<option>Alerts</option>
											<option>Badges</option>
											<option>Buttons</option>
											<option>Cards</option>
											<option>Forms</option>
											<option>Modals</option>
										</select>
									</div>
								</div>
							-->

							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="satuan">Satuan</label>
									<input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan Produk, misal : Botol, Sachet, Pcs, Pack, Box dll" required>
								</div>
								<div class="form-group">
									<label class="form-control-label" for="berat">Berat Satuan (gr)</label>
									<input type="number" min="0" class="form-control" name="berat" id="berat" placeholder="Berat (dalam gram)" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-label" for="harga">Harga Konsumen</label>
									<input type="number" min="0" class="form-control" name="harga" id="harga" placeholder="Harga Konsumen" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-label" for="nilai">Nilai PV</label>
									<input type="number" min="0" step="any" class="form-control" name="nilai" id="nilai" placeholder="Nilai PV" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="keterangan">Keterangan</label>
									<textarea class="form-control" name="keterangan" id="keterangan" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 114px;"></textarea>
								</div>
							</div>
							<!--
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-control-label" for="exampleDatepicker">Datepicker</label>
										<input class="form-control datepicker" placeholder="Select date" type="text" value="06/20/2018">
									</div>
								</div>
							-->
							<div class="col-md-12">
								<button class="btn btn-icon btn-primary" type="submit">Simpan <i class="ni ni-check-bold"></i></button>
							</div>
						</div>
						<!--
							<div class="row input-daterange datepicker align-items-center">
								<div class="col">
									<div class="form-group">
										<label class="form-control-label">Start date</label>
										<input class="form-control" placeholder="Start date" type="text" value="06/18/2018">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="form-control-label">End date</label>
										<input class="form-control" placeholder="End date" type="text" value="06/22/2018">
									</div>
								</div>
							</div>
						-->
					</div>
				</div>

			</div>
		</div>
	</div>
	</form>

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

<?php $this->load->view('admin/_/footer'); ?>


<script>
	function get_slug() {

		let nama_produk = document.getElementById('nama_produk').value;

		$.ajax({
			url: "<?php echo base_url('admin/get_slug/') ?>",
			method: "POST",
			data: {
				slug: nama_produk
			},
			success: function(data) {

				$('#slug').val(data);
			}
		});
	}
</script>