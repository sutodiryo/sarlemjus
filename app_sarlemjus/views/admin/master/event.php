<?php $this->load->view('admin/_/header'); ?>

<!-- <?php $this->session->set_userdata('ref_event', current_url()); ?> -->

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_add_event" class="btn btn-sm btn-neutral" title="Tambah Event Baru"><i class="fa fa-plus"></i> Event Baru</a>
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
                                <th width="20%">Event</th>
                                <th width="20%">Waktu</th>
                                <th width="20%">Lokasi</th>
                                <th width="20%">Keterangan</th>
                                <th width="9%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($event as $e) {
                                $no++;

                                if ($e->tipe == 0) {
                                    $t = "Home Sharing";
                                } else if ($e->tipe == 1) {
                                    $t = "Bisnis Preview";
                                }

                                if ($e->status == 0) {
                                    $col = "yellow";
                                    $st = "Belum Dimulai";
                                } else if ($e->status == 1) {
                                    $col = "success";
                                    $st = "Sedang Berlangsung";
                                } else if ($e->status == 2) {
                                    $col = "info";
                                    $st = "Selesai";
                                } else if ($e->status == 3) {
                                    $col = "danger";
                                    $st = "Batal";
                                }


                                echo "<tr>
                                        <td>$no</td>
                                        <td><b>$e->event_name</b>
                                        <br>
                                        <u style='font-size:10px;'>$t</u>
                                        <br>
                                        <a class='badge badge-dot mr-4'><i class='bg-$col'></i><small class='status'>$st</small></a>
                                        </td>
                                        <td>
                                        Mulai : " . date_format(date_create($e->date_start), "d F Y") . "
                                        <br>
                                        Selesai : " . date_format(date_create($e->date_end), "d F Y") . "
                                        </td>
                                        <td><textarea class='form-control' readonly  style=\"font-size:10px;\">$e->city
$e->address</textarea></td>
                                        <td><textarea class='form-control' readonly  style=\"font-size:10px;\">$e->note</textarea></td>
                                        <td class='text-center'>
                                            <a href='javascript:void(0)' onclick=\"edit_event('$e->id_event_schedule')\" class='table-action' data-toggle='tooltip' data-original-title='Edit event'>
                                            <i class='fa fa-edit'></i>
                                            </a>
                                            <a href='" . base_url('admin/del/event/') . "$e->id_event_schedule/' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus event'>
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


<div class="modal fade" id="modal_add_event" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Event Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/add/event/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="event_name">Nama Event</label>
                                <input type="text" name="event_name" class="form-control" id="event_name" placeholder="Nama Event" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_start">Tanggal Mulai</label>
                                <input type="date" name="date_start" class="form-control" id="date_start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_end">Tanggal Akhir</label>
                                <input type="date" name="date_end" class="form-control" id="date_end" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id_location_add">Kota/Kabupaten</label>
                                <select name="id_location" id="id_location_add" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_location_add="1" tabindex="-1" aria-hidden="true" required>
                                    <?php
                                    $no = 0;
                                    foreach ($location as $lc) {
                                        $no++;
                                        echo "<option data-select2-id_location_add='$no' value='$lc->id_location'>$lc->location_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="alamat">Alamat Lengkap</label>
                                <textarea name="address" class="form-control" id="alamat" rows="2" required placeholder="Alamat lengkap"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-control-label" for="tipe">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="0">Home Sharing</option>
                                    <option value="1">Bisnis Preview</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="keterangan">Keterangan</label>
                                <textarea name="note" class="form-control" id="keterangan" rows="2" required placeholder="Keterangan terkait event"></textarea>
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

<div class="modal fade" id="modal_edit_event" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/act/update_event/0'); ?>" method="POST">
                <input type="hidden" name="id_event_schedule">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="event_name_edt">Nama event</label>
                                <input type="text" name="event_name_edt" class="form-control" id="event_name_edt" placeholder="Nama Event" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_start_edt">Tanggal Mulai</label>
                                <input type="date" name="date_start_edt" class="form-control" id="date_start_edt" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_end_edt">Tanggal Akhir</label>
                                <input type="date" name="date_end_edt" class="form-control" id="date_end_edt" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id_location_edt">Kota/Kabupaten</label>
                                <select name="id_location_edt" id="id_location_edt" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_location_edt="1" tabindex="-1" aria-hidden="true" required>
                                    <?php
                                    $no = 0;
                                    foreach ($location as $lc) {
                                        $no++;
                                        echo "<option data-select2-id_location_edt='$no' value='$lc->id_location'>$lc->location_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="alamat">Alamat Lengkap</label>
                                <textarea name="address_edt" class="form-control" id="alamat" rows="2" required placeholder="Alamat lengkap"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="note_edt">Keterangan</label>
                                <textarea name="note_edt" class="form-control" id="note_edt" rows="3" required placeholder="Keterangan terkait Event"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="tipe_edt">Tipe</label>
                                <select name="tipe_edt" id="tipe_edt" class="form-control">
                                    <option value="0">Home Sharing</option>
                                    <option value="1">Bisnis Preview</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="status_edt">Status</label>
                                <select name="status_edt" id="status_edt" class="form-control">
                                    <option value="0">Belum Dimulai</option>
                                    <option value="1">Sedang Berlangsung</option>
                                    <option value="2">Selesai</option>
                                    <option value="3">Batal</option>
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

<script type="text/javascript">
    function edit_event(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('admin/get/event_schedule') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_event_schedule"]').val(data.id_event_schedule);
                $('[name="event_name_edt"]').val(data.event_name);
                $('[name="id_location_edt"]').val(data.id_location);
                $('[name="date_start_edt"]').val(data.date_start);
                $('[name="date_end_edt"]').val(data.date_end);
                $('[name="address_edt"]').val(data.address);
                $('[name="note_edt"]').val(data.note);
                $('[name="tipe_edt"]').val(data.tipe);
                $('[name="status_edt"]').val(data.status);

                $('#modal_edit_event').modal('show');
                $('.modal-title').text('Edit Event');
                $('#id_location_edt').select2().trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>