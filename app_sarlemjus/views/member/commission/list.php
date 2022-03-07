<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('ref_member', current_url()); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal_add_transaction" class="btn btn-sm btn-warning" title="Transaksi Baru"><i class="ni ni-basket"></i> Jual</a>
                    <a data-toggle="modal" href="#modal_add_transaction" class="btn btn-sm btn-primary" title="Transaksi Baru"><i class="ni ni-bag-17"></i> Beli</a>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-6 col-md-6">
                    <a href="<?php echo base_url('admin/member/all') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo 0; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-6 col-md-6">
                    <a href="<?php echo base_url('admin/member/all') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo 0; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fa fa-users"></i>
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
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">Nama</th>
                                <th width="20%">Kontak</th>
                                <th width="39%">Alamat</th>
                                <th width="20%">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($commission as $c) {
                                $no++;

                                $tgl_pesan  = new DateTime($c->tgl_pesan);

                                echo "<tr onclick=\"location.href='" . base_url('member/detail_transaction/') . "" . $c->id_transaksi . "'\">
                                <td>$no</td>
                                <td><a href='" . base_url('admin/member_detail/') . "$c->id_transaksi'>$c->member</a></td>
                                <td><a href='https://wa.me/62$c->no_hp' class='btn btn-sm btn-slack btn-icon'><i class='fab fa-whatsapp'></i> $c->no_hp</a></td>";

                                echo "  <td>
                                            <ul class='navbar-nav align-items-left ml-auto ml-md-0'>
                                                <li class='nav-item dropdown'>
                                                    <a href='#'title='Klik untuk melihat alamat detail' data-toggle='dropdown'><span class='btn-inner--icon'>$c->no_hp</span></a>
                                                    <div class='dropdown-menu dropdown-menu-right'>
                                                        <textarea cols='30' rows='3' readonly>$c->produk</textarea>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>";

                                echo "<td>";
                                if ($c->status == 0) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>Priority</span></a>";
                                } else if ($c->status == 1) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-orange'></i><span class='status'>Executive</span></a>";
                                } else if ($c->status == 2) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-yellow'></i><span class='status'>Business</span></a>";
                                }

                                echo "</td>";

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

<?php $this->load->view('admin/_/footer'); ?>


<div class="modal fade" id="modal_add_transaction" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('admin/act/update_member/0'); ?>" method="POST">
                <input type="hidden" name="id_member">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-control-label" for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama lengkap sesuai KTP" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label" for="level">Level</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="0">Priority</option>
                                    <option value="1">Executive</option>
                                    <option value="2">Business</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php date_default_timezone_set('Asia/Jakarta'); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id_upline">Upline</label>
                                <select name="id_upline" id="id_upline" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_upline="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="0">Tidak ada</option>
                                    <?php
                                    $no = 0;
                                    foreach ($sel_member as $sm) {
                                        $no++;
                                        echo "<option data-select2-id_upline='$no' value='$sm->id_member'>$sm->nama - $sm->no_hp</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="no_hp">No HP (WA)</label>
                                <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="No HP aktif" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="kota">Kota</label>
                                <select name="kota" id="kota" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_admin="1" tabindex="-1" aria-hidden="true" required>
                                    <?php
                                    $no = 0;
                                    foreach ($lokasi as $lk) {
                                        $no++;
                                        echo "<option data-select2-id_location='$no' value='$lk->location_name'>$lk->location_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="alamat">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" id="alamat" rows="3" required placeholder="Alamat lengkap"></textarea>
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