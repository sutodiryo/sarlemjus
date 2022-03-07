<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('ref_detail_transaksi', current_url()); ?>

<style>
	@media print {
		body * {
			visibility: hidden;
		}

		#section-to-print,
		#section-to-print * {
			visibility: visible;
		}

		#section-to-print {
			position: absolute;
			left: 0;
			top: 0;
		}
	}
</style>

<script>
	<?php if ($this->session->flashdata('cetak') == 1) {

		echo "window.print()";
	} ?>
</script>

<!-- Header -->
<div class="header pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<?php
					$idt 	= $trans->id_transaksi;
					$id		= "00" . $trans->id_member . "00" . $idt . "";
					$tipe 	= $trans->tipe;
					$status = $trans->status;
					$ongkir = $trans->ongkir;

					if ($tipe == 0) {
						if ($status == 0) {
							if ($ongkir < 1) {
								echo "<button data-toggle='modal' href='#modal_add_ongkir' class='btn btn-sm btn-warning' title='Tambah Ongkir'><i class='fa fa-truck'></i> Tambah Ongkir</button>";
							} else {
								echo "<a href='" . base_url('admin/set/transaksi/1/') . "$idt'  onclick=\"return confirm('Pastikan member telah melunasi pembayaran transaksi ini...!')\" class='btn btn-sm btn-success' title='Set Lunas'><i class='fa fa-check-circle'></i> Set Lunas</a>";
							}
						} else if ($status == 1) {
							// echo "<button onclick=\"return confirm('Batalkan status pembayaran...?')\" class='btn btn-sm btn-warning' title='Set Belum Lunas'><i class='fa fa-check-circle'></i> Set Belum Lunas</button>";
							echo "<button data-toggle='modal' href='#modal_add_resi' class='btn btn-sm btn-success' title='Set Dikirim'><i class='fa fa-check-circle'></i> Set Dikirim</button>";
						} else if ($status == 2) {
							echo "<a href='https://api.whatsapp.com/send?phone=62$trans->no_hp&text=Paket%20anda%20sudah%20kami%20kirim%20dengan%20$trans->kurir%20nomor%20resi%20%3A%0A%0A%0A$trans->resi%0A%0A%0ATerima%20Kasih' target='_blank' class='btn btn-sm btn-success' title='Kirim Resi ke Mitra lewat Whatsapp'><i class='fab fa-whatsapp'></i> WA Resi</a>";
						} else if ($status == 3) {
							// echo "<a class='badge badge-dot mr-4'><i class='bg-info'></i><span class='status'>Selesai</span></a>";
						} else if ($status == 4) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>Transaksi Pertama</span></a>";
						} else if ($status == 5) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>Dibatalkan</span></a>";
						}
					} elseif ($tipe == 1) {

						if ($status == 0) {
							echo "<a data-toggle='modal' href='#modal_bukti_transfer' class='btn btn-sm btn-info' title='Cetak'><i class='fa fa-print'></i> Lihat Bukti Transfer</a>";
							echo "<a href='" . base_url('admin/set/sales/3/') . "$idt'  onclick=\"return confirm('Pastikan bukti transfer untuk transaksi ini asli...!')\" class='btn btn-sm btn-success' title='Konfirmasi Pembelian'><i class='fa fa-check-circle'></i> Konfirmasi</a>";
						} else if ($status == 1) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-yellow'></i><span class='status'>Sudah Dikonfirmasi</span></a>";
						} else if ($status == 2) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-green'></i><span class='status'>Dikirim</span></a>";
						} else if ($status == 3) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-info'></i><span class='status'>Selesai</span></a>";
						} else if ($status == 4) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>Selesai</span></a>";
						} else if ($status == 5) {
							echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>Dibatalkan</span></a>";
						}
					}

					echo "<button title='Update Transaksi' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
							<div class='dropdown-menu dropdown-menu-right'>";
					if ($tipe == 0) {
						if ($status == 0) { } elseif ($status == 1) {
							echo "<a href='" . base_url('admin/set/transaksi/4/') . "$idt' onclick=\"return confirm('Anda yakin ingin mengubah status transaksi ini?')\" class='dropdown-item text-default'><i class='fa fa-check-circle'></i><span>Set Transaksi Pertama</span></a>";
						} elseif ($status == 4) {
							echo "<a href='" . base_url('admin/set/transaksi/1/') . "$idt' onclick=\"return confirm('Anda yakin ingin mengubah status transaksi ini?')\" class='dropdown-item text-info'><i class='fa fa-redo-alt'></i><span>Set Repeat Order</span></a>";
						}
					}
					echo "		<a onclick='window.print()' class='dropdown-item text-info' title='Cetak Invoice ini'><i class='fa fa-print'></i>Cetak</a>
								<div class='dropdown-divider'></div>
								<a href='" . base_url('admin/del/transaksi/') . "$idt' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='dropdown-item text-red'><i class='fa fa-trash-alt'></i><span>Hapus</span></a>
							</div>
						";
					?>

					<a href="<?php echo base_url('admin/transaction/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
	<div class="row">
		<div class="col-xl-12 order-xl-2" id="section-to-print">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-12">
							<?php
							echo "<h1 class='mb-0 text-center'>INVOICE $id</h1><hr>";
							?>
						</div>
						<div class="col-7">
							<?php
							echo "	<table>
										<tr>
											<td width='30%'>Perusahaan</td>
											<td width='70%'><p class='mb-0'> : NAJAH NETWORK</p></td>
										</tr>
										<tr>
											<td width='30%'>Member</td>
											<td width='70%'><p class='mb-0'> : $trans->member</p></td>
										</tr>
										<tr>
											<td width='30%'>No HP</td>
											<td width='70%'><p class='mb-0'> : 0$trans->no_hp</p></td>
										</tr>
									</table>";
							?>
						</div>
						<div class="col-5 text-left">
							<!-- <a href="#!" class="btn btn-sm btn-primary">Settings</a> -->
							<?php
							$date = new DateTime($trans->tgl_pesan);
							echo "	<table>
										<tr>
											<td width='40%'>No Transaksi</td>
											<td width='60%'><p class='mb-0'> : $id</p></td>
										</tr>
										<tr>
											<td width='40%'>Tanggal Transaksi</td>
											<td width='60%'><p class='mb-0'> : " . $date->format('d/M/Y') . "</p></td>
										</tr>
										<tr>
											<td width='40%'>Tipe</td>
											<td width='60%'>";

							if ($tipe == 0) {
								echo "<p class='mb-0'> : Beli</p>";
							} else if ($tipe == 1) {
								echo "<p class='mb-0'> : Jual</p>";
							}
							echo "</td>
										</tr>
										<tr>
											<td width='30%'>Status</td>
											<td width='70%'> : ";

							if ($tipe == 0) { //BELI
								if ($status == 0) {
									echo "<span class='status text-orange'>Belum Bayar</span>";
								} else if ($status == 1) {
									echo "<span class='status text-yellow'>Dikemas</span>";
								} else if ($status == 2) {
									echo "<span class='status text-green'>Dikirim</span>";
								} else if ($status == 3) {
									echo "<span class='status text-info'>Diterima</span>";
								} else if ($status == 4) {
									echo "<span class='status text-default'>Transaksi Pertama</span>";
								} else if ($status == 5) {
									echo "<span class='status text-red'>Dibatalkan</span>";
								}
							} elseif ($tipe == 1) { //JUAL
								if ($status == 0) {
									echo "<span class='status text-orange'>Belum Dikonfirmasi</span>";
								} else if ($status == 3) {
									echo "<span class='status text-green'>Sudah Dikonfirmasi</span>";
								} else if ($status == 5) {
									echo "<span class='status text-red'>Dibatalkan</span>";
								}
							}

							echo "</td>
										</tr>
									</table>";
							?>
						</div>
					</div>
				</div>

				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th width="29%">Produk</th>
								<th width="10%">PV</th>
								<th width="15%">Qty</th>
								<th width="20%" style="text-align:right;">Harga</th>
								<th width="25%" style="text-align:right;">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($trans_p as $p) {
								$no++;
								echo "<tr>
								<td>$no</td>
								<td>$p->produk</td>
								<td>" . number_format($p->pv, 0, '.', '.') . "</td>
								<td>" . number_format($p->quantity, 0, '.', '.') . "</td>
								<td style='text-align:right;'>" . number_format($p->price, 0, '.', '.') . "";

								if ($status == 0) {
									$q = $this->db->query("SELECT SUM(quantity) AS retur FROM transaksi_produk WHERE id_member='$trans->id_member' AND id_produk='$p->id_produk' AND status=0")->row();
								} elseif ($status == 1) {
									$q = $this->db->query("SELECT SUM(quantity) AS retur FROM transaksi_produk WHERE id_member='$trans->id_member' AND id_produk='$p->id_produk' AND status=1 AND id_transaksi='$idt'")->row();
								}
								// $retur = array();
								if ($tipe == 0) {
									if ($status != 4) {
										if ($q->retur != NULL) {
											$retur[$no] = $q->retur * $p->price;
											echo "<br><font color='orange'>Retur : $q->retur X " . number_format($p->price, 0, '.', '.') . "</font>";
										}
									}
								}
								// var_dump($q);
								echo "</td>
								<td style='text-align:right;'>" . number_format($p->price * $p->quantity, 0, '.', '.') . "";

								if ($tipe == 0) {
									if ($status != 4) {
										if ($q->retur != NULL) {
											echo "<br><font color='orange'>- " . number_format($p->price * $q->retur, 0, '.', '.') . "</font>";
										}
									}
								}

								echo "</td>
								</tr>";
							}
							if (isset($retur)) {

								$total_retur = array_sum($retur);
							} else {
								$total_retur = 0;
							}

							echo "<tr>
											<th colspan='5' style='text-align:right;'>Total :</th>
											<th style='text-align:right;'>" . 'Rp ' . number_format($trans->total - $total_retur, 0, '.', '.') . "</th>
										</tr>	
										<tr>
											<th colspan='5' style='text-align:right;'><font color='green'>" . $trans->nama_promo . " :</font></th>
											<th style='text-align:right;'><font color='green'>" . '- Rp ' . number_format($trans->nilai_promo, 0, '.', '.') . "</font></th>
										</tr>
										<tr>
											<th colspan='5' style='text-align:right;'><font color='black'>Ongkir :</font></th>
											<th style='text-align:right;'><font color='black'>" . '+ Rp ' . number_format($ongkir, 0, '.', '.') . "</font></th>
										</tr>
										<tr>
											<th colspan='5' style='text-align:right;'><font color='red'>Tagihan :</font></th>
											<th style='text-align:right;'><font color='red'>" . 'Rp ' . number_format(($trans->total + $ongkir) - $total_retur - $trans->nilai_promo, 0, '.', '.') . "</font></th>
										</tr>";
							?>
						</tbody>

					</table>

				</div>
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

<div class="modal fade" id="modal_add_ongkir" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Tambah Ongkir Transaksi (<?php echo $id ?>)</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<form action="<?php echo base_url('admin/act/update_ongkir/' . $idt); ?>" method="POST">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-control-label" for="ongkir">Biaya Ongkir (Rp)</label>
								<input type="number" name="ongkir" class="form-control" id="ongkir" placeholder="Total Biaya Ongkir" required>
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

<div class="modal fade" id="modal_add_resi" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Tambah Resi Transaksi (<?php echo $id ?>)</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<form action="<?php echo base_url('admin/act/update_resi/' . $idt); ?>" method="POST">
				<div class="modal-body">
					<input type="hidden" namme="no_hp" value="<?php echo $trans->no_hp ?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-control-label" for="id_kurir">Ekspedisi</label>
								<select name="id_kurir" id="id_kurir" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_kurir="3" tabindex="-3" aria-hidden="true" required>
									<?php
									$no = 0;
									foreach ($sel_kurir as $sk) {
										$no++;
										echo "<option data-select2-id_kurir='$no' value='$sk->id_kurir'>$sk->nama_kurir</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="form-control-label" for="resi">Resi</label>
								<input type="text" name="resi" class="form-control" id="resi" placeholder="Resi Pengiriman Paket" required>
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

<div class="modal fade" id="modal_bukti_transfer" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">Bukti Transfer Transaksi (<?php echo $id ?>)</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<!-- <input type="hidden" namme="no_hp" value="<?php echo $trans->no_hp ?>"> -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<!-- <label class="form-control-label" for="id_kurir">Ekspedisi</label> -->
							<center>
								<img src="<?php echo "" . base_url('public/upload/bukti_transfer/') . "$trans->bukti_transfer"; ?>"></center>
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<a <?php echo "href='" . base_url('admin/set/sales/3/') . "$idt'  onclick=\"return confirm('Pastikan bukti transfer untuk transaksi ini asli...!')\""; ?> class="btn btn-success"><i class="fa fa-check-circle"></i> Konfirmasi</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/_/footer'); ?>