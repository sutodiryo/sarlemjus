<?php $this->load->view('admin/_/header'); ?>

<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php
                                                        date_default_timezone_set('Asia/Jakarta');
                                                        if (empty($date)) {
                                                            $bulan = date("F Y");
                                                        } else {
                                                            $bulan = date_format(date_create($date), "F Y");
                                                        }

                                                        echo "$title <small>($bulan)</small>"; ?>
                    </h6>
                </div>
                <div class="col-lg-4 col-5 text-right">
                    <?php
                    echo "<a href='" . base_url('admin/commission/withdrawal/') . "' class='btn btn-sm btn-default' title='Pencairan Bonus Member'><i class='fa fa-credit-card'></i> Pencairan Bonus</a>";
                    ?>

                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-3">Filter Bulan</h3>
                            <form role="form" class="form-light" action="<?php echo base_url('admin/commission/all'); ?>" method="POST">
                                <div class="row">
                                    <div class="col-xl-12 col-md-6">
                                        <div class="form-group">
                                            <input name="status" type="hidden" value="<?php
                                                                                    if (!isset($status)) {
                                                                                        echo 0;
                                                                                    } else {
                                                                                        echo $status;
                                                                                    }
                                                                                    ?>">
                                            <input name="date" class="form-control" onchange="this.form.submit()" type="month" value="<?php
                                                                                                                                        if (empty($date)) {
                                                                                                                                            $date = date("Y-m");
                                                                                                                                        }

                                                                                                                                        echo $date;
                                                                                                                                        ?>" id="example-month-input">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                <th width="19%">Nama Member</th>
                                <th width="25%">Total Komisi Get Member</th>
                                <th width="25%">Total Komisi Team</th>
                                <th width="15%">Total PV Pribadi</th>
                                <th width="15%">Total PV Team</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($commission as $c) {
                                $no++;
                                $color = $c->color;
                                echo "  <tr>
                                            <td><span class='lead text-$color'>$no</span></td>
                                            <td><span class='lead text-$color'>" . substr($c->nama, 0, 30) . "</span></td>
                                            <td><a href='" . base_url('admin/commission_detail/gm/') . "$c->id_member' class='lead text-$color'>Rp " . number_format($c->tcg, 0, ',', '.') . "</a></td>
                                            <td><a href='" . base_url('admin/commission_detail/team/') . "$c->id_member' class='lead text-$color'>Rp " . number_format($c->tct, 0, ',', '.') . "</a></td>
                                            <td><a href='" . base_url('admin/commission_detail/pv_m/') . "$c->id_member' class='lead text-$color'>" . number_format($c->pvm, 0, ',', '.') . "</a></td>
                                            <td><a href='" . base_url('admin/commission_detail/pv_team/') . "$c->id_member' class='lead text-$color'>" . number_format($c->pvt_bp+$c->pvt_bm, 0, ',', '.') . "</a></td>
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


<?php $this->load->view('admin/_/footer'); ?>