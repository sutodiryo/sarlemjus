<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('ref_member', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_add_promo" class="btn btn-sm btn-neutral" title="Tambah Promo Baru"><i class="fa fa-plus"></i> Promo Baru</a>
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
                                <th width="15%">Kode Promo</th>
                                <th width="20%">Nama Promo</th>
                                <th width="15%">Tipe</th>
                                <th width="15%" class="text-center">Nilai</th>
                                <th width="30%">Keterangan</th>
                                <th width="4%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($promo as $p) {
                                $no++;

                                echo "<tr>
                                        <td>$no</td>
                                        <td>$p->kode_promo</td>
                                        <td>$p->nama_promo</td>";

                                echo "<td>";
                                if ($p->tipe == 0) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-info'></i><span class='status'>Potongan Harga</span></a>";
                                } else if ($p->tipe == 1) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-blue'></i><span class='status'>Cash Back</span></a>";
                                }

                                echo "</td>
                                        <td class='text-right'><span class='lead text-danger mb-0'>Rp " . number_format($p->nilai, 0, '.', '.') . "</span></td>
                                        <td><textarea class='form-control' readonly  style=\"font-size:10px;\">$p->keterangan</textarea></td>
                                        <td class='text-center'>
                                            <a href='" . base_url('admin/edit/promo_level/') . "$p->id_promo' class='table-action' data-toggle='tooltip' data-original-title='Edit Akses level member'>
                                            <i class='fa fa-user-edit'></i>
                                            </a>
                                            <a href='javascript:void(0)' onclick=\"edit_promo('$p->id_promo')\" class='table-action' data-toggle='tooltip' data-original-title='Edit Promo'>
                                            <i class='fa fa-edit'></i>
                                            </a>
                                            <a href='" . base_url('admin/del/promo/') . "$p->id_promo/' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Promo'>
                                            <i class='fas fa-trash'></i>
                                            </a>
                                        </td>
                                    </tr>";
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


<div class="modal fade" id="modal_add_promo" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Promo Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/add/promo/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="kode_promo">Kode Promo</label>
                                <input type="text" name="kode_promo" class="form-control" id="kode_promo" placeholder="Kode Promo" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_Promo">Nama Promo</label>
                                <input type="text" name="nama_promo" class="form-control" id="nama_promo" placeholder="Nama Promo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="nilai">Nilai Promo (Rp)</label>
                                <input type="number" name="nilai" class="form-control" id="nilai" placeholder="Nilai Promo (Rupiah)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="tipe">Tipe</label>
                                <select class="form-control" name="tipe" id="tipe">
                                    <option value="0">Potongan</option>
                                    <option value="1">Cash Back</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required placeholder="Keterangan terkait Promo"></textarea>
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

<div class="modal fade" id="modal_edit_promo" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/act/update_promo/0'); ?>" method="POST">
                <input type="hidden" name="id_promo">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_promo_edt">Nama Promo</label>
                                <input type="text" name="nama_promo_edt" class="form-control" id="nama_promo_edt" placeholder="Nama Promo" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="kode_promo_edt">Kode Promo</label>
                                <input type="text" name="kode_promo_edt" class="form-control" id="kode_promo_edt" placeholder="Kode Promo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="nilai_edt">Nilai Promo (Rp)</label>
                                <input type="number" name="nilai_edt" class="form-control" id="nilai_edt" placeholder="Nilai Promo (Rupiah)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="tipe_edt">Tipe</label>
                                <select class="form-control" name="tipe_edt" id="tipe_edt">
                                    <option value="0">Potongan</option>
                                    <option value="1">Cash Back</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="keterangan_edt">Keterangan</label>
                                <textarea name="keterangan_edt" class="form-control" id="keterangan_edt" rows="3" required placeholder="Keterangan terkait Promo"></textarea>
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

<script type="text/javascript">
    function edit_promo(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('admin/get/promo') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_promo"]').val(data.id_promo);
                $('[name="kode_promo_edt"]').val(data.kode_promo);
                $('[name="nama_promo_edt"]').val(data.nama_promo);
                $('[name="nilai_edt"]').val(data.nilai);
                $('[name="tipe_edt"]').val(data.tipe);
                $('[name="keterangan_edt"]').val(data.keterangan);

                $('#modal_edit_promo').modal('show');
                $('.modal-title').text('Edit Promo');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>