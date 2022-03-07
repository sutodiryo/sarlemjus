<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_add_stock', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title  ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_wd" class="btn btn-sm btn-default" title="Tambah Stok"><i class="fa fa-plus"></i> Tambah Pencairan Bonus</a>
                    <a href="<?php echo base_url('admin/commission/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
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
                                <th width="20%">Member</th>
                                <th width="14%">Amount</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tanggal</th>
                                <th width="30%">Catatan</th>
                                <th width="10%" class="text-center">Tipe</th>
                                <th width="5%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($wd as $wd) {
                                $no++;

                                echo "<tr>
                                <td>$no</span></td>
                                <td>" . substr($wd->member, 0, 15) . "</td>
                                <td>";

                                if ($wd->tipe == 0) {
                                    echo "<span class='text-danger mb-0'>Rp " . number_format($wd->amount, 0, '.', '.') . "</span>";
                                } elseif ($wd->tipe == 1) {
                                    echo "<span class='text-danger mb-0'>$wd->bonus</span>";
                                }

                                echo "</td>
                                <td>";

                                if ($wd->status == 0) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>Diajukan</span></a>";
                                } elseif ($wd->status == 1) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-green'></i><span class='status'>Disetujui</span></a>";
                                } elseif ($wd->status == 2) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>Ditolak</span></a>";
                                }

                                echo "</td>
                                <td><small>$wd->date_update</small></td>
                                <td><textarea class='form-control' rows='1' readonly>$wd->note</textarea></td>
                                <td>";

                                if ($wd->tipe == 0) {
                                    echo "<span class='btn btn-sm btn-info'>Komisi</span>";
                                } elseif ($wd->tipe == 1) {
                                    echo "<span class='btn btn-sm btn-primary'>Bonus</span>";
                                }

                                echo "</td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <a href='" . base_url('admin/del/produk_stok/') . "$wd->id_commission_wd' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\"  class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Update'><i class='fas fa-trash'></i></a>
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
                    &copy; <?php echo date('Y'); ?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade" id="modal_wd" style="display: none;">
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