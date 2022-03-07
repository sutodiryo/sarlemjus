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
                    <a data-toggle="modal" href="#modal_add_kurir" class="btn btn-sm btn-neutral" title="Tambah Kurir Baru"><i class="fa fa-plus"></i> Kurir Baru</a>
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
                                <th width="29%">Nama Kurir</th>
                                <th width="60%">Keterangan</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($kurir as $k) {
                                $no++;

                                echo "<tr>
                                        <td>$no</td>
                                        <td>$k->nama_kurir</td>
                                        <td><textarea class='form-control' readonly  style=\"font-size:10px;\">$k->keterangan</textarea></td>
                                        <td class='text-center'>
                                            <a href='javascript:void(0)' onclick=\"edit_kurir('$k->id_kurir')\" class='table-action' data-toggle='tooltip' data-original-title='Edit Kurir'>
                                            <i class='fa fa-edit'></i>
                                            </a>
                                            <a href='" . base_url('admin/del/courier/') . "$k->id_kurir/' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Kurir'>
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
                    &copy; <?php echo date('Y');?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>


<div class="modal fade" id="modal_add_kurir" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Kurir Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/add/courier/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_kurir">Nama Kurir</label>
                                <input type="text" name="nama_kurir" class="form-control" id="nama_kurir" placeholder="Nama Kurir" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="keterangan">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required placeholder="Keterangan terkait Kurir"></textarea>
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

<div class="modal fade" id="modal_edit_kurir" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/act/update_courier/0'); ?>" method="POST">
                <input type="hidden" name="id_kurir">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_kurir_edt">Nama Kurir</label>
                                <input type="text" name="nama_kurir_edt" class="form-control" id="nama_kurir_edt" placeholder="Nama Kurir" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="keterangan_edt">Keterangan</label>
                                <textarea name="keterangan_edt" class="form-control" id="keterangan_edt" rows="3" required placeholder="Keterangan terkait Kurir"></textarea>
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
    function edit_kurir(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('admin/get/kurir') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_kurir"]').val(data.id_kurir);
                $('[name="nama_kurir_edt"]').val(data.nama_kurir);
                $('[name="keterangan_edt"]').val(data.keterangan);

                $('#modal_edit_kurir').modal('show');
                $('.modal-title').text('Edit Kurir');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>