<?php $this->load->view('admin/_/header'); ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>
                <div class="col-lg-4 col-5 text-right">
                    <a href="<?php echo base_url('member/product_stock') ?>" class="btn btn-sm btn-info" title="Stok Produk"><i class="fa fa-archive"></i> Stok</a>
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
                                <th width="30%">Nama Produk</th>
                                <th width="20%">Harga</th>
                                <th width="10%">Nilai Produk</th>
                                <th width="39%" class="text-center">Link</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($produk as $p) {
                                $no++;

                                date_default_timezone_set('UTC');
                                $waktu_input  = new DateTime($p->waktu_input);

                                echo "<tr>
                                <td><span class='lead mb-0'>$no</span></td>
                                <td><img src='" . ASSETS . "produk/$p->img_1' class='avatar rounded-circle mr-3'><span class='lead mb-0'>$p->nama_produk</span></td>
                                <td><span class='lead mb-0'>Rp " . number_format($p->harga, 0, ',', '.') . "</span></td>";

                                echo "<td><span class='lead text-danger mb-0'>$p->nilai PV</span></td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                            <div class='input-group mb-3'>
                                                <input type='text' class='form-control' id='Produk_$p->id_produk' value='" . base_url('lp/') . "$p->slug/" . $this->session->userdata('log_id') . "' readonly>
                                                <div class='input-group-append'>
                                                <button class='btn btn-outline-primary' type='button' id='button-addon2' onclick=\"copy('$p->id_produk')\">Copy Link</button>
                                                </div>
                                            </div>
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

<script type="text/javascript">
    function copy(i) {
        var copyText = document.getElementById('Produk_' + i);
        copyText.select();
        document.execCommand("copy");
        alert("Link landingpage sudah tercopy: " + copyText.value);
    }
</script>

<?php $this->load->view('admin/_/footer'); ?>