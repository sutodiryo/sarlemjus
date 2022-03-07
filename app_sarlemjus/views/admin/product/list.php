<?php $this->load->view('admin/_/header'); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo base_url('admin/product/member') ?>" class="btn btn-sm btn-info" title="Tambah Produk Baru"><i class="fa fa-archive"></i> Stok Member</a>
                    <a href="<?php echo base_url('admin/product/add') ?>" class="btn btn-sm btn-neutral" title="Tambah Produk Baru"><i class="fa fa-plus"></i> Produk Baru</a>
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
                                <th width="39%">Nama Produk</th>
                                <th width="20%">Harga Pasaran</th>
                                <th width="15%">Stok</th>
                                <th width="15%">Nilai Produk</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($product as $p) {
                                $no++;

                                date_default_timezone_set('UTC');
                                $waktu_input  = new DateTime($p->waktu_input);
                                // <img src='" . ASSETS . "produk/$p->img_1' class='avatar rounded-circle mr-3'>
                                echo "<tr>
                                        <td><span>$no</span></td>
                                        <td class='table-user'>
                                            <b>$p->nama_produk</b>
                                        </td>
                                        <td><span class='lead mb-0'>Rp " . number_format($p->harga, 0, ',', '.') . "</span></td>";

                                echo "<td>";
                                if ($p->stock <= 100) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>" . number_format($p->stock-$p->stock_, 0, '.', '.') . " $p->satuan</span></a>";
                                } else if ($p->stock > 100 && $p->stock <= 200) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-yellow'></i><span class='status'>" . number_format($p->stock-$p->stock_, 0, '.', '.') . " $p->satuan</span></a>";
                                } else if ($p->stock > 200) {
                                    echo "<a class='badge badge-dot mr-4'><i class='bg-green'></i><span class='status'>" . number_format($p->stock-$p->stock_, 0, '.', '.') . " $p->satuan</span></a>";
                                }

                                // echo "<td>";
                                // if ($p->status == 0) {
                                //     echo "<a class='badge badge-dot mr-4'><i class='bg-red'></i><span class='status'>Tidak Aktif</span></a>";
                                // } else if ($p->status == 1) {
                                //     echo "<a class='badge badge-dot mr-4'><i class='bg-green'></i><span class='status'>Aktif</span></a>";
                                // }

                                echo "</td>
                                <td><span class='lead text-danger mb-0'>$p->nilai PV</span></td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <ul class='navbar-nav align-items-center ml-auto ml-md-0'>
                                                <li class='nav-item dropdown'>
                                                    <button title='Update Status' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a href='" . base_url('admin/edit/produk_harga/') . "$p->id_produk' class='dropdown-item'><i class='ni ni-credit-card'></i><span> Set Harga</span></a>
                                                            <a href='" . base_url('admin/edit/produk_stock/') . "$p->id_produk' class='dropdown-item'><i class='ni ni-archive-2'></i><span> Update Stock</span></a>
                                                            <a href='" . base_url('admin/edit/produk_link/') . "$p->id_produk' class='dropdown-item'><i class='ni ni-planet'></i><span> Set Link Landingpage</span></a>
                                                            <div class='dropdown-divider'></div>
                                                            <a href='" . base_url('admin/edit/produk/') . "$p->id_produk' class='dropdown-item'><i class='fa fa-edit'></i><span>Edit</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
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
                    &copy; <?php echo date('Y');?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php $this->load->view('admin/_/footer'); ?>