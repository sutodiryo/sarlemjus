<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_add_stock', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo "$title $produk->nama_produk"; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_stock_produk" class="btn btn-sm btn-neutral" title="Tambah Stok"><i class="fa fa-plus"></i> Tambah Stok</a>
                    <a href="<?php echo base_url('admin/product/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
                </div>
            </div>


            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <a href="<?php echo base_url('admin/member/all') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Stok</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $stat->tot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?php echo base_url('admin/member/executive') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stok Opname</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $stat->tot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?php echo base_url('admin/member/business') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stok +</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $stat->tot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="<?php echo base_url('admin/member/priority') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Stok -</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $stat->tot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-archive-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">Admin</th>
                                <th width="15%">Update Stok</th>
                                <th width="15%">Waktu Update</th>
                                <th width="39%">Catatn</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($stock_produk as $sp) {
                                $no++;

                                echo "<tr>
                                <td><span class='lead mb-0'>$no</span></td>
                                <td><span class='lead mb-0'>$sp->admin</span></td>
                                <td><span class='lead text-danger mb-0'>" . number_format($sp->stock_update, 0, '.', '.') . " $sp->satuan</span></td>
                                <td><span class='lead mb-0'>$sp->update_time</span></td>
                                <td><textarea class='form-control' rows='2' readonly>$sp->note</textarea></td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <a href='" . base_url('admin/del/produk_stok/') . "$sp->id_produk_stok' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\"  class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Update'><i class='fas fa-trash'></i></a>
                                        </td>";

                                echo "</tr>";
                            } ?>

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
                    &copy; <?php echo date('Y');?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade" id="modal_stock_produk" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="header-body">
                    <h4 class="modal-title">Tambah Stok</h4>
                </div>
            </div>

            <form action="<?php echo base_url('admin/add/produk_stock'); ?>" method="POST">
                <input name="id_produk" type="hidden" value="<?php echo $produk->id_produk; ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="stock_u">Update Stok</label>
                                <input name="stock_update" type="number" class="form-control" id="stock_u" placeholder="Jumlah penambahan stok" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-control-label" for="note">Catatan</label>
                                <textarea name="note" class="form-control" id="note" rows="3" placeholder="Catatan/keterangan terkait update"></textarea>
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

<?php $this->load->view('admin/_/footer'); ?>