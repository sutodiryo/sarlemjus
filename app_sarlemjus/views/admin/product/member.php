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
                                <th width="20%">Nama</th>
                                <th width="15%">Level</th>
                                <th width="54%">Stok</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($member as $m) {
                                $no++;

                                echo "<tr>
                                <td>$no</td>
                                <td>
                                    <a>" . substr($m->nama, 0, 30) . "</a>
                                </td>
                                
                                <td>";
                                if ($m->level == 0) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>$m->nama_level</span></a>";
                                } else if ($m->level == 1) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-orange'></i><span class='status'>$m->nama_level</span></a>";
                                } else if ($m->level == 2) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-yellow'></i><span class='status'>$m->nama_level</span></a>";
                                } else {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>$m->nama_level</span></a>";
                                }
                                echo "</td>
                                        <th>
                                            <table style=\"padding:0px;\" class='table table-flush table-hover'>
                                                <tbody style=\"padding:0px;\" >";

                                $q = $this->db->query(" SELECT  nama_produk,satuan,
                                                                (SELECT SUM(quantity) FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE id_member='$m->id_member' AND tipe=0)) AS stok,
                                                                (SELECT SUM(quantity) FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE id_member='$m->id_member' AND tipe=1)) AS stok_
                                                        FROM produk")->result();

                                foreach ($q as $prod) {
                                    echo "  <tr style=\"padding:0px;\">
                                                <td style=\"padding:1px;\" width='50%'>$prod->nama_produk</td>
                                                <td style=\"padding:1px; text-align:right;\" width='30%'>" . number_format(($prod->stok - $prod->stok_), 0, ',', '.') . "</td>
                                                <td style=\"padding:1px;\" width='20%'> $prod->satuan</td>
                                            </tr>";
                                }

                                echo "          </tbody>
                                            </table>
                                        </th>
                                        <td class='text-center'>
                                            <a href='" . base_url('admin/member_detail/') . "$m->id_member' target='_blank' title='Lihat Detail' class='btn btn-icon btn-sm btn-info'><span class='btn-inner--icon'><i class='fa fa-eye'></i></span></a>
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

<?php
foreach ($member as $mm) {
    ?>
    <div class="modal fade" id="modal_downline_<?php echo $mm->id_member ?>" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><small>Daftar Mitra</small> <?php echo $mm->nama ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="10%">N0</th>
                                <th width="50%">Nama</th>
                                <th width="30%">Level</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $q = $this->db->query(" SELECT  id_member,nama,no_hp,
                                                                (SELECT nama_level FROM member_level WHERE id_member_level=member.level) as lvl
                                                        FROM member WHERE id_upline='$mm->id_member' ORDER BY nama ASC")->result();
                                $no = 0;
                                foreach ($q as $q) {
                                    $no++;
                                    echo "  <tr>
                                                <td>$no</td>
                                                <td class='table-user'>
                                                    <b>" . substr($q->nama, 0, 30) . "</b>
                                                    <br>(0$q->no_hp)
                                                </td>
                                                <td>
                                                    <span class='text-muted'>$q->lvl</span>
                                                </td>
                                                <td class='table-actions'>
                                                    <a href='" . base_url('admin/#') . "' onclick=\"return confirm('Anda yakin ingin menghapus data ini dari mitra $q->nama?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus mitra'>
                                                        <i class='fas fa-user-times'></i>
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
<?php } ?>

<?php $this->load->view('admin/_/footer'); ?>
