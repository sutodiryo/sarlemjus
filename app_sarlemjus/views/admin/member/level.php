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
                            <li class="breadcrumb-item"><a>Member</a></li>
                            <!-- <li class="breadcrumb-item"><a href="<?php echo base_url('admin/member/all') ?>">Member</a></li> -->
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
                                <a data-toggle="modal" href="#modal_add_member_level" class="btn btn-info btn-sm btn-round has-ripple"><i class="feather icon-plus"></i> Tambah Level</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table_member" class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="35%">Nama</th>
                                        <th width="15%">Diskon</th>
                                        <!-- <th width="10%">member_level</th> -->
                                        <th width="25%">Minimal Pembelian</th>
                                        <th width="20%" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0;
                                    foreach ($level as $l) {
                                        $i++;
                                        echo "<tr>
                                        <td>$i</td>
                                        <td>$l->name</td>
                                        <td>" . number_format($l->discount, 0, ',', '.') . "%</td>
                                        <td>";

                                        if ($l->min_trans > 0) {
                                            echo "$l->min_trans Dus";
                                        } else {
                                            echo "Ecer";
                                        }

                                        echo "</td>
                                        <td class='text-center'>
                                            <a href='javascript:void(0)' onclick=\"edit_member_level('$l->id')\" class='btn btn-info btn-sm'><i class='feather icon-edit'></i>&nbsp;Edit </a>
                                            <a href='#' onclick=\"return confirm('Anda yakin ingin menghapus level ini?')\"  class='btn btn-danger btn-sm'><i class='feather icon-trash-2'></i>&nbsp;Delete </a>
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
    function edit_member_level(id_member_level) {
        $.ajax({
            url: "<?php echo base_url('api/get/member_level/') ?>" + id_member_level,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.name);
                $('[name="value"]').val(data.value);
                $('[name="min_trans"]').val(data.min_trans);
                $('[name="discount"]').val(data.discount);
                $('[name="note"]').val(data.note);

                $('#modal_edit_member_level').modal('show');
                $('.modal-title').text('Edit Level Member');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });
    }
</script>

<div class="modal fade" id="modal_add_member_level" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah member_level</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/member/add/level/'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama Level</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Level Member" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="min_trans">Minimal Pembelian (Dus, 0 untuk ecer)</label>
                                <input type="number" name="min_trans" class="form-control" id="min_trans" placeholder="Minimal Pembelian (Dus, 0 untuk ecer)" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="discount	">Diskon Pembelian (%)</label>
                                <input type="number" name="discount" class="form-control" id="discount	" placeholder="Diskon Pembelian (%)" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="note">Catatan</label>
                                <textarea name="note" id="note" class="form-control"></textarea>
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

<div class="modal fade" id="modal_edit_member_level" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/member/act/update_member_level/0'); ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama Level</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Level Member" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="min_trans">Minimal Pembelian (Dus, 0 untuk ecer)</label>
                                <input type="number" name="min_trans" class="form-control" id="min_trans" placeholder="Minimal Pembelian (Dus, 0 untuk ecer)" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="discount	">Diskon Pembelian (%)</label>
                                <input type="number" name="discount" class="form-control" id="discount	" placeholder="Diskon Pembelian (%)" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="note">Catatan</label>
                                <textarea name="note" id="note" class="form-control"></textarea>
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