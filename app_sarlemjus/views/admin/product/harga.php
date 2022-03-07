<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_add_price', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo "$title $produk->nama_produk"; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_harga_produk" class="btn btn-sm btn-neutral" title="Tambah Harga"><i class="fa fa-plus"></i> Tambah Harga</a>
                    <a href="<?php echo base_url('admin/product/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
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
                                <th width="40%">Level Member</th>
                                <th width="30%">Harga</th>
                                <th width="29%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($harga_produk as $hp) {
                                $no++;

                                echo "<tr>
                                <td><span class='lead mb-0'>$no</span></td>
                                <td>$hp->nama_level</td>
                                <td><span class='lead text-danger mb-0'>Rp " . number_format($hp->harga) . "</span></td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <a href='#' onclick=\"edit_harga_produk('$hp->id_member_level')\" class='btn btn-sm btn-success' data-toggle='tooltip' data-original-title='Edit harga'><i class='fas fa-user-edit'></i> Edit</a>
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


<div class="modal fade" id="modal_harga_produk" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="header-body">
                    <h4 class="modal-title">Tambah Harga</h4>
                </div>
            </div>

            <form action="<?php echo base_url('admin/add/produk_harga'); ?>" method="POST">
                <input name="id_produk" type="hidden" value="<?php echo $produk->id_produk; ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-control-label" for="id_member_level">Level Member</label>
                                <select name="id_member_level" id="id_member_level" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_member_level="1" tabindex="-1" aria-hidden="true" required>
                                    <!-- <option value="">Pilih Level Member</option> -->
                                    <?php
                                    $no = 0;
                                    foreach ($member_level as $ml) {
                                        $no++;
                                        echo "<option data-select2-id_member_level='$no' value='$ml->id_member_level'>$ml->nama_level</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga produk untuk level ini" required>
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

<div class="modal fade" id="modal_edit_harga_produk" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="header-body">
                    <h4 class="modal-title"></h4>
                </div>
            </div>

            <form action="<?php echo base_url('admin/act_edit_produk_harga'); ?>" method="POST">
                <input name="id_produk" type="hidden" value="<?php echo $produk->id_produk; ?>">
                <input name="id_member_level_post" type="hidden">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-control-label" for="id_member_level_edt">Level Member</label>
                                <select disabled name="id_member_level_edt" id="id_member_level_edt" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_member_level_edt="1" tabindex="-1" aria-hidden="true" required>
                                    <!-- <option value="">Pilih Level Member</option> -->
                                    <?php
                                    $no = 0;
                                    foreach ($member_level_edt as $ml) {
                                        $no++;
                                        echo "<option data-select2-id_member_level_edt='$no' value='$ml->id_member_level'>$ml->nama_level</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="harga_edt">Harga</label>
                                <input type="number" name="harga_edt" class="form-control" id="harga_edt" placeholder="Harga produk untuk level ini" required>
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
    function edit_harga_produk(iml) {
        //Ajax Load data from ajax
        let idp = <?php echo $produk->id_produk; ?>;
        $.ajax({
            url: "<?php echo base_url('admin/get_produk_harga') ?>/" + idp + "/" + iml,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_member_level_edt"]').val(data.id_member_level);
                $('[name="id_member_level_post"]').val(data.id_member_level);
                $('[name="harga_edt"]').val(data.harga);

                $('#modal_edit_harga_produk').modal('show');
                $('.modal-title').text('Edit Harga <?php echo $produk->nama_produk ?>');
                $('#id_member_level_edt').select2().trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>