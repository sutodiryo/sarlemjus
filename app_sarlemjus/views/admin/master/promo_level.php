<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_add_promo_level', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo "$title $promo->nama_promo"; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_promo_level" class="btn btn-sm btn-neutral" title="Tambah Harga"><i class="fa fa-plus"></i> Tambah Level</a>
                    <a href="<?php echo base_url('admin/master/promo') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
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
                                <th width="30%">Level Member</th>
                                <th width="30%">Berlaku</th>
                                <th width="20%">Status</th>
                                <th width="19%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($promo_level as $pl) {
                                $no++;

                                echo "<tr>
                                <td>$no</td>
                                <td>$pl->nama_level</td>
                                <td>" . date_format(date_create($pl->date_start), "d F Y") . " - " . date_format(date_create($pl->date_end), "d F Y") . "</td>
                                <td>";
                                
                                if ($pl->status == 0) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Tidak Aktf</span></a>";
                                } else {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Aktif</span></a>";
                                }
                                
                                
                                
                                echo "</td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <a href='#!' class='table-action' data-toggle='tooltip' data-original-title='Edit harga'><i class='fas fa-user-edit'></i></a>
                                            <a href='#!' class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus harga'><i class='fas fa-trash'></i></a>
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


<div class="modal fade" id="modal_promo_level" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="header-body">
                    <h4 class="modal-title">Tambah Promo Ke Level</h4>
                </div>
            </div>

            <form action="<?php echo base_url('admin/add/promo_level'); ?>" method="POST">
                <input name="id_promo" type="hidden" value="<?php echo $promo->id_promo; ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_start">Mulai Berlaku</label>
                                <input type="date" name="date_start" class="form-control" id="date_start" required>
                                <!-- <input type="datetime-local" name="date_start" class="form-control" id="date_start" required> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_end">Terakhir Berlaku</label>
                                <input type="date" name="date_end" class="form-control" id="date_end" required>
                                <!-- <input type="datetime-local" name="date_end" class="form-control" id="date_end" required> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
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