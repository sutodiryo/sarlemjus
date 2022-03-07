<?php $this->load->view('admin/_/header'); ?>

<!-- Header -->
<div class="header pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0"><?php echo "$title" . " $produk->nama_produk" ?></h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?php echo base_url('admin/product/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->session->set_userdata('ref_edit_product', current_url()); ?>

<div class="container-fluid mt--6">

	<?php echo form_open_multipart('admin/act/update_product/' . $produk->id_produk . '', 'id="save"'); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="card-wrapper">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="nama_produk">Nama Produk</label>
									<input type="text" class="form-control" name="nama_produk" value="<?php echo $produk->nama_produk ?>" id="nama_produk" onkeyup="get_slug()" placeholder="Nama Produk" required>
								</div>
								<div class="form-group">
									<label class="form-control-label" for="slug">Slug</label>
									<input type="text" class="form-control" name="slug" value="<?php echo $produk->slug ?>" id="slug" placeholder="Slug" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="nama_produk">Foto Produk 1x1</small></label>
									<img class="card-img-top" src="<?php echo base_url('public/back/produk/' . $produk->img_1) ?>" alt="Image placeholder">
								</div>
								<div class="form-group">
									<label class="form-control-label" for="img_1">Ganti Foto <small>(Rekomendasi : 1280x1280px)</small></label>
									<input type="file" name="img_1" class="form-control" id="img_1" title="Ganti Foto" disabled>
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
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="satuan">Satuan</label>
									<input type="text" class="form-control" name="satuan" value="<?php echo $produk->satuan ?>" id="satuan" placeholder="Satuan Produk, misal : Botol, Sachet, Pcs, Pack, Box dll" required>
								</div>
								<div class="form-group">
									<label class="form-control-label" for="berat">Berat Satuan (gr)</label>
									<input type="number" min="0" class="form-control" name="berat" value="<?php echo $produk->berat ?>" id="berat" placeholder="Berat (dalam gram)" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-label" for="harga">Harga Konsumen</label>
									<input type="number" min="0" class="form-control" name="harga" value="<?php echo $produk->harga ?>" id="harga" placeholder="Harga Konsumen" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-control-label" for="nilai">Nilai PV</label>
									<input type="number" min="0" step="any" class="form-control" name="nilai" value="<?php echo $produk->nilai ?>" id="nilai" placeholder="Nilai PV" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-control-label" for="keterangan">Keterangan</label>
									<textarea class="form-control" name="keterangan" id="keterangan" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 114px;"><?php echo $produk->keterangan ?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<button class="btn btn-icon btn-primary" type="submit">Update <i class="ni ni-check-bold"></i></button>
							</div>
						</div>
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