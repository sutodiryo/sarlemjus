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
                            <li class="breadcrumb-item"><a>Pengumuman</a></li>
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
                                <a data-toggle="modal" href="#modal_add_notice" class="btn btn-info btn-sm btn-round has-ripple"><i class="feather icon-plus"></i> Tambah Pengumuman</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table_notice" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="25%">Judul</th>
                                        <th width="30%">Isi Pengumuman</th>
                                        <th width="25%">Sasaran</th>
                                        <th width="15%" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0;
                                    foreach ($notice as $n) {
                                        $i++;
                                        echo "<tr>
                                        <td class='text-center'>$i</td>
                                        <td>$n->title</td>
                                        <td><textarea class='form-control' readonly style='font-size:80%;'>$n->content</textarea></td>
                                        <td>";

                                        if ($n->tot_target > 0) {
                                            $q =  $this->db->query("SELECT (SELECT name FROM member_level WHERE id=notice_target.id_member_level) AS level FROM notice_target WHERE id_notice='$n->id'")->result();
                                            foreach ($q as $l) {
                                                echo "<span class='badge badge-info'>$l->level</span> ";
                                            }
                                        } else{
                                            echo "<span class='badge badge-dark'>Belum ada sasaran</span> ";
                                        }

                                        echo "<br>$n->date_start - $n->date_end</td>
                                        <td class='text-center'>";

                                        if ($n->tot_target < 1) {
                                            echo "<a href='javascript:void(0)' onclick=\"add_notice_target('$n->id')\" class='btn btn-icon btn-outline-info has-ripple' title='Tambah target $n->title'><i class='feather feather icon-user-check'></i></a>";
                                        }

                                        echo "<a href='javascript:void(0)' onclick=\"edit_notice('$n->id')\" class='btn btn-icon btn-outline-success has-ripple'><i class='feather icon-edit'></i></a>
                                            <a href='" . base_url('admin/master/del/notice/') . "$n->id' onclick=\"return confirm('Anda yakin ingin menghapus pengumuman ini?')\" class='btn btn-icon btn-outline-danger has-ripple'><i class='feather icon-trash-2'></i></a>
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
    function edit_notice(id_notice) {
        $.ajax({
            url: "<?php echo base_url('api/get/notice/') ?>" + id_notice,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="content"]').val(data.content);
                $('[name="date_start"]').val(data.date_start);
                $('[name="date_end"]').val(data.date_end);

                $('#modal_edit_notice').modal('show');
                $('.modal-title').text('Edit Pengumuman');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }

    function add_notice_target(id_notice) {
        $.ajax({
            url: "<?php echo base_url('api/get/notice/') ?>" + id_notice,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);

                $('#modal_add_notice_target').modal('show');
                $('.modal-title').text('Set Target Pengumuman');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>

<div class="modal fade" id="modal_add_notice" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengumuman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/add/notice/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="title">Judul Pengumuman</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Judul Pengumuman" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="content">Isi Pengumuman</label>
                                <textarea name="content" class="form-control" id="content" rows="3" required placeholder="Isi Pengumuman"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_start">Mulai</label>
                                <input type="date" name="date_start" class="form-control" id="date_start">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_end">Akhir</label>
                                <input type="date" name="date_end" class="form-control" id="date_end">
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

<div class="modal fade" id="modal_edit_notice" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/act/update_notice/0'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="title">Judul Pengumuman</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Judul Pengumuman" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="content">Isi Pengumuman</label>
                                <textarea name="content" class="form-control" id="content" rows="3" required placeholder="Isi Pengumuman"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_start">Mulai</label>
                                <input type="date" name="date_start" class="form-control" id="date_start">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date_end">Akhir</label>
                                <input type="date" name="date_end" class="form-control" id="date_end">
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

<div class="modal fade" id="modal_add_notice_target" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/master/act/add_notice_target/0'); ?>" method="POST">
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