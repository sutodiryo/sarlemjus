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
                    <button onclick="window.history.back();" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</button>
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
                                <th width="20%">Stok</th>
                                <th width="10%">Nilai Produk</th>
                                <th width="29%" class="text-center">Link</th>
                                <th width="10%" class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($produk as $p) {
                                $no++;

                                date_default_timezone_set('UTC');
                                $waktu_input  = new DateTime($p->waktu_input);
                                $stok_now = (($p->stock_plus_buy + $p->stock_plus_buy_member) - ($p->stock_min_sell_member + $p->stock_min_broken));

                                echo "<tr>
                                    <td>$no</td>
                                    <td><img src='" . ASSETS . "produk/$p->img_1' class='avatar rounded-circle mr-3'>" . substr($p->nama_produk, 0, 20) . "</td>";

                                echo "<td>
                                    <div class='col'><span class='' style='color:blue;'>" . number_format($stok_now, 0, ',', '.') . " $p->satuan</span>
                                                            <br><small style='color:red;'>Rusak : " . number_format($p->stock_broken, 0, ',', '.') . " $p->satuan</small>
                                                            <br><small style='color:green;'>Diganti : " . number_format($p->stock_plus_broken, 0, ',', '.') . " $p->satuan</small>
                                                        </div>

                                    </td>";

                                echo "<td><span class='text-danger mb-0'>$p->nilai PV</span></td>";

                                //AKSI
                                echo "  <td class='text-center'>
                                                <div class='input-group mb-3'>
                                                    <input type='text' class='form-control form-control-sm' id='Produk_$p->id_produk' value='" . base_url('lp/') . "$p->slug/" . $this->session->userdata('log_id') . "' readonly>
                                                    <div class='input-group-append'>
                                                    <button class='btn btn-sm btn-outline-primary' type='button' id='button-addon2' onclick=\"copy('$p->id_produk')\">Share</button>
                                                    </div>
                                                </div>
                                        </td>
                                            <td class='text-center'>
                                            <button href='javascript:void(0)' onclick=\"update_stock('$p->id_produk')\"  class='btn btn-sm btn-warning' title='Update Stok Barang Rusak' ";
                                                if ($stok_now < 1) {
                                                    echo "disabled";
                                                }
                                                echo "><i class='fa fa-times'></i> Rusak
                                                </button>
                                            </td>";

                                echo "
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


<div class="modal fade" id="modal_update_stock" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="<?php echo base_url('member/act/add_broken_stock'); ?>" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id_produk" class="form-control" id="id_produk" required>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nama_produk">Produk</label>
                                <input type="text" name="nama_produk" class="form-control" id="nama_produk" readonly required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="quantity">Total Kerusakan</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Jumlah Produk Rusak">
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
    function copy(i) {
        var copyText = document.getElementById('Produk_' + i);
        copyText.select();
        document.execCommand("copy");
        alert("Link landingpage sudah tercopy: " + copyText.value);
    }

    function update_stock(id) {
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('member/get_produk') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_produk"]').val(data.id_produk);
                $('[name="nama_produk"]').val(data.nama_produk);

                $('#modal_update_stock').modal('show');
                $('.modal-title').text('Update Kerusakan Produk');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax server');
            }
        });

    }
</script>