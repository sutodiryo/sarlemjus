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
                    <a data-toggle="modal" href="#modal_add_team" class="btn btn-sm btn-default" title="Tambah Member Baru"><i class="fa fa-user-plus"></i> Daftarkan Team Baru</a>
                    <input style="position:absolute; left:-9999px" type="text" id="aff_link" value="<?php echo "" . base_url('reg/') . "" . $this->session->userdata('log_id') . ""; ?>">
                    <button onclick="link_aff()" class="btn btn-sm btn-neutral" title="Copy link pendaftaran team baru"><i class="fa fa-share-alt"></i> Undang Team</button>
                </div>
            </div>



            <!--
                Yang Belum :
                                Total Team
                                Total Pembelian Team Rp
                                Total Komisi Rp 
                                Total PV
            -->


            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Team</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $stat->team; ?> Orang</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-default text-white rounded-circle shadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Pembelian Team</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php if (!empty($stat->oms)) {
                                                                                $oms = $stat->oms;
                                                                            } else {
                                                                                $oms = 0;
                                                                            }
                                                                            echo "Rp " . number_format($oms, 0, ',', '.') . ""; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Komisi</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php if (!empty($stat->com)) {
                                                                                $com = $stat->com;
                                                                            } else {
                                                                                $com = 0;
                                                                            }
                                                                            echo "Rp " . number_format($com, 0, ',', '.') . ""; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Poin Team</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php if (!empty($stat->pv)) {
                                                                                $pv = $stat->pv;
                                                                            } else {
                                                                                $pv = 0;
                                                                            }
                                                                            echo $pv; ?> PV</span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <th width="20%">Nama</th>
                                <th width="4%">Level</th>
                                <th width="10%">Keaktifan</th>
                                <th width="10%" class="no-sort">Kontak</th>
                                <th width="15%">Omset</th>
                                <th width="15%">Komisi</th>
                                <th width="10%">Poin</th>
                                <th width="10%">Gabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($member as $m) {
                                $no++;

                                if ($m->beli >= $m->minim) {
                                    $tr = "info";
                                    $st = "A";
                                } elseif ($m->beli > 0 && $m->beli < $m->minim) {
                                    $tr = "success";
                                    $st = "B";
                                } elseif ($m->beli2 > 0) {
                                    $tr = "warning";
                                    $st = "C";
                                } else {
                                    $tr = "danger";
                                    $st = "D";
                                }

                                echo "<tr class='table-$tr'>
                                <td>$no</td>
                                <td><a href='#$m->id_member'>" . substr($m->nama, 0, 30) . "</a></td>";

                                if ($m->level == 0) {
                                    $col = "danger";
                                } else if ($m->level == 1) {
                                    $col = "warning";
                                } else if ($m->level == 2) {
                                    $col = "yellow";
                                } else if ($m->level == 3) {
                                    $col = "info";
                                } else if ($m->level == 4) {
                                    $col = "success";
                                } else {
                                    $col = "default";
                                }

                                echo "<td><a class='badge badge-dot mr-4'><i class='bg-$col'></i><span class='status'>$m->lv</span></a></td>
                                <td class='text-center'><b>$st</b></td>
                                <td><a href='https://wa.me/62$m->no_hp' class='btn btn-sm btn-slack btn-icon'><i class='fab fa-whatsapp'></i> 0$m->no_hp</a></td>
                                <td>Rp " . number_format($m->oms, 0, ',', '.') . "</td>
                                <td>Rp " . number_format($m->com, 0, ',', '.') . "</td>
                                <td>" . number_format($m->pv, 0, ',', '.') . " PV</td>
                                <td class='text-center'><b>$m->tgl_reg</b></td>
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


<div class="modal fade" id="modal_add_team" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Daftarkan Team Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('member/act/add_team'); ?>" method="POST">
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
                                <label class="form-control-label" for="level_add">Level</label>
                                <select class="form-control" id="level_add" name="level">
                                    <?php
                                    foreach ($level as $lv) {
                                        echo "<option value='$lv->id_member_level'>$lv->nama_level</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php date_default_timezone_set('Asia/Jakarta'); ?>

                    <div class="row">
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
                                <label class="form-control-label" for="id_location_add">Kota/Kabupaten</label>
                                <select name="id_location" id="id_location_add" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_location_add="1" tabindex="-1" aria-hidden="true" required>
                                    <?php
                                    $no = 0;
                                    foreach ($lokasi as $lk) {
                                        $no++;
                                        echo "<option data-select2-id_location_add='$no' value='$lk->id_location'>$lk->location_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="alamat">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" id="alamat" rows="3" required placeholder="Alamat lengkap"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="kode_bank">Bank</label>
                                <select name="kode_bank" id="kode_bank" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-kode_bank="1" tabindex="-1" aria-hidden="true" required>
                                    <option>Pilih Bank ...........</option>
                                    <?php
                                    $no = 0;
                                    foreach ($bank as $b) {
                                        $no++;
                                        echo "<option data-select2-kode_bank='$no' value='$b->kode_bank'>$b->nama_bank</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="no_rekening">Nomor Rekening</label>
                                <input type="number" name="no_rekening" id="no_rekeninge" class="form-control" placeholder="Nomor Rekening">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_rekening">Nama Pemilik Rekening</label>
                                <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Pemilik Rekening">
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
    function link_aff() {
        var copyText = document.getElementById("aff_link");
        copyText.select();
        document.execCommand("copy");
        alert("Link pendaftaran sudah tercopy : " + copyText.value);
    }
</script>