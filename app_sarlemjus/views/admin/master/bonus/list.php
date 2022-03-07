<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?php echo $title; ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Master</a></li>
                            <li class="breadcrumb-item"><a>Bonus</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <?php echo $this->session->flashdata('report'); ?>

                    <div class="card-body">
                        <div class="row align-items-center m-l-1 mb-3">
                            <div class="col-sm-6">
                                <button class="btn btn-secondary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_tambah_member"><i class="feather icon-filter"></i> Filter</button>
                            </div>
                            <div class="col-sm-6 text-right ">
                                <a data-toggle="modal" href="#modal_add_bonus" class="btn btn-info btn-sm btn-round has-ripple"><i class="feather icon-plus"></i> Tambah Bonus</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table_bonus" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="50%">Bonus</th>
                                        <th width="30%">Poin Minimal</th>
                                        <th width="15%" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0;
                                    foreach ($bonus as $b) {
                                        $i++;
                                        echo "<tr>
                                        <td class='text-center'><h4>$i</h4></td>
                                        <td><h4>$b->name</h4></td>
                                        <td><h4><span class='badge badge-secondary'>$b->poin</span></h4></td>
                                        <td class='text-center'>
                                            <a href='javascript:void(0)' onclick=\"edit_bonus('$b->id')\" class='btn btn-icon btn-outline-success has-ripple'><i class='feather icon-edit'></i></a>
                                            <a href='" . base_url('admin/master/del/bonus/') . "$b->id' onclick=\"return confirm('Anda yakin ingin menghapus pengumuman ini?')\" class='btn btn-icon btn-outline-danger has-ripple'><i class='feather icon-trash-2'></i></a>
                                        </td>
                                    </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_/footer'); ?>

<script type="text/javascript">
    function edit_bonus(id_bonus) {
        $.ajax({
            url: "<?php echo base_url('api/get/bonus/') ?>" + id_bonus,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.name);
                $('[name="poin"]').val(data.poin);

                $('#modal_edit_bonus').modal('show');
                $('.modal-title').text('Edit Bonus');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>

<div class="modal fade" id="modal_add_bonus" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Bonus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/add/bonus/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama Bonus</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Bonus" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="poin">Poin Minimal</label>
                                <input type="number" name="poin" class="form-control" id="poin" placeholder="Poin Minimal" required>
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

<div class="modal fade" id="modal_edit_bonus" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/act/update_bonus/0'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama Bonus</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Bonus" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="poin">Poin Minimal</label>
                                <input type="number" name="poin" class="form-control" id="poin" placeholder="Poin Minimal" required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_bonus_target" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/act/add_bonus_target/0'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="title" class="form-control" id="title" disabled>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php foreach ($member_level as $ml) {
                                    echo "<div class='form-check'>
                                    <input name='member_level[]' class='form-check-input' type='checkbox' value='$ml->id' id='ml_$ml->id'>
                                    <label class='form-check-label' for='ml_$ml->id''>$ml->name</label>
                                </div>";
                                } ?>
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