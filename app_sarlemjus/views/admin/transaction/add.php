<?php $this->load->view('admin/_/header'); ?>

<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>

                <div class="col-lg-4 col-5 text-right">
                    <a href="<?php echo base_url('admin/transaction/all') ?>" class="btn btn-sm btn-danger" title="Kembali"><i class="fa fa-reply"></i> Kembali</a>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Jakarta');

            $d     = date("Y-m-d H:i:s");
            $now   = new DateTime($d);
            $max   = $now->modify('0 day');

            if (empty($date)) {
                $date  = $max;
            } else{
                $date  = new DateTime($date);
            }
            ?>

            <div class="row">
                <div class="col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url('admin/' . $idp . '/cart'); ?>" method="POST">
                                <input name="id_promo" value="0" type="hidden">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-12 col-form-label form-control-label">Mitra</label>
                                            <div class="col-md-12">
                                                <select name="id_member" id="member" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-member="3" tabindex="-3" aria-hidden="true" required>
                                                    <?php
                                                    $no = 0;
                                                    foreach ($sel_member as $sm) {
                                                        $no++;
                                                        echo "<option data-select2-member='$no' value='$sm->id_member'>$sm->nama - $sm->no_hp</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group row">
                                            <label for="example-date-input" class="col-md-12 col-form-label form-control-label">Tanggal Transaksi</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="date" name="date" max="<?php echo $max->format('Y-m-d'); ?>" onchange="this.form.submit()" value="<?php echo $date->format('Y-m-d'); ?>" id="example-date-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <p>_</p>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-block">OK</button>
                                            </div>
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

<?php if (!empty($date) && !empty($id_member)) { ?>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card border-0">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Produk</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="">
                            <thead class="thead-light">
                                <tr>
                                    <th width="40%">Nama Produk</th>
                                    <th width="20%">Harga</th>
                                    <th width="40%"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $no = 0;
                                    foreach ($product as $p) {
                                        $no++;
                                        echo "<tr>
                                        <td class='table-user'>
                                            <img src='" . ASSETS . "produk/$p->img_1' class='avatar rounded-circle mr-3'>
                                            <b>" . substr($p->nama_produk, 0, 20) . "</b>
                                        </td>
                                        <td>
                                            <span>Rp " . number_format($p->harga, 0, ',', '.') . "</span>
                                            <br>";

                                        if ($p->stock <= 100) {
                                            echo "<span class='text-red'>" . number_format($p->stock - $p->stock_, 0, '.', '.') . " $p->satuan</span>";
                                        } else if ($p->stock > 100 && $p->stock <= 200) {
                                            echo "<span class='text-yellow'>" . number_format($p->stock - $p->stock_, 0, '.', '.') . " $p->satuan</span>";
                                        } else if ($p->stock > 200) {
                                            echo "<span class='text-green'>" . number_format($p->stock - $p->stock_, 0, '.', '.') . " $p->satuan</span>";
                                        }

                                        echo "  </td>
                                        <td class='text-center'>
                                            <div class='input-group mb-3'>
                                                <input type='number' name='quantity' id='qty_$p->id_produk' value='1' min='1' max='$p->stock' class='quantity form-control form-control-sm'>
                                                <div class='input-group-append'>
                                                <button class='add_cart btn btn-sm btn-success' type='button' data-produkid='$p->id_produk' data-produknama='$p->nama_produk' data-produkharga='$p->harga'><i class='fa fa-cart-plus'></i></button>
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


            <div class="modal fade" id="modal_add_promo" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Promo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <form action="<?php echo base_url('admin/' . $idp . '/cart'); ?>" method="POST">

                            <input type="text" name="id_member" class="form-control" value="<?php echo $id_member ?>" required>
                            <input type="text" name="cart" class="form-control" value="<?php print_r($this->cart->contents())  ?>" required>
                            <input type="text" name="date" class="form-control" value="<?php echo $date->format('Y-m-d'); ?>" required>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="promo">Promo</label>
                                            <!-- <select name="id_promo" id="promo" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-promo="3" tabindex="-3" aria-hidden="true" required>
                                                <option value="0" disabled>Pilih Promo</option>
                                                <?php
                                                    $no = 0;
                                                    foreach ($sel_promo as $sp) {
                                                        $no++;
                                                        echo "<option data-select2-promo='$no' value='$sp->id_promo'>$sp->nama_promo - Rp " . number_format($sp->nilai, 0, ',', '.') . "</option>";
                                                    }
                                                    ?>
                                            </select> -->
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

            <div class="col-xl-6 col-md-6">
                <div class="card border-0">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Keranjang Belanja</h3>
                            </div>
                            <!--
                                <div class="col text-right">
                                    <a href="#!" class="btn btn-sm btn-primary">Simpan <i class="fa fa-arrow-right"></i></a>
                                </div>
                            -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive py-4">


                            <form id="save" action="<?php echo base_url('admin/add/transaction') ?>" method="POST">
                                <input type="hidden" name="id_member" value="<?php echo $id_member ?>" required>
                                <input type="hidden" name="date" value="<?php echo $date->format('Y-m-d h:i:s'); ?>" required>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30%">Produk</th>
                                            <th width="20%">Harga</th>
                                            <th width="20%">Quantity</th>
                                            <th width="20%">Subtotal</th>
                                            <th width="10%">#</th>
                                        </tr>
                                    </thead>

                                    <tbody id="detail_cart">
                                        <!-- <?php var_dump($this->cart->contents()) ?> -->
                                    </tbody>

                                </table>
                            </form>
                        </div>
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
<?php } ?>
<?php $this->load->view('admin/_/footer'); ?>

<script type="text/javascript">
    // $(window).bind('beforeunload', function() {
    //     <?php $this->cart->destroy(); ?>
    // }); //1 Menit
    let ongkir      = 0;
    let id_promo    = 0;

    function cartshow() {
        let id_promo    = $('#promo').val();
        let ongkir      = $('#ongkir').val();
        $('#detail_cart').load("<?php echo base_url('admin/cart_load/'); ?>" + id_promo + "/" + ongkir);
    }

    function reset_cart() {
        let id_promo    = 0;
        let ongkir      = $('#ongkir').val();
        $('#detail_cart').load("<?php echo base_url('admin/cart_load/'); ?>" + id_promo + "/" + ongkir);
    }

    $(document).ready(function() {
        $('#member').val(<?php echo $id_member ?>);
        $('#member').select2().trigger('change');

        $('.add_cart').click(function() {
            let id = $(this).data("produkid");
            let name = $(this).data("produknama");
            let price = $(this).data("produkharga");
            let qty = $('#qty_' + id).val();
            $.ajax({
                url: "<?php echo base_url('admin/cart_add/') ?>" + id_promo + "/" + ongkir,
                method: "POST",
                data: {
                    id_produk: id,
                    quantity: qty,
                    harga_produk: price,
                    nama_produk: name
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                    // alert(qty);
                }
            });
        });

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url('admin/cart_load/'); ?>" + id_promo + "/" + ongkir);

        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function() {
            let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo base_url('admin/cart_del/'); ?>" + id_promo + "/" + ongkir,
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });

    function updateQty(rowid, id_produk) {
      var row = rowid;
      var qty = $('#qty' + row).val();
      var id_produk = id_produk;
      $.ajax({
        url: "<?php echo base_url('admin/update_qty_cart'); ?>",
        method: "POST",
        data: {
          "rowid": row,
          "qty": qty,
          "id_produk": id_produk
        },
        success: function(data) {
          $('#detail_cart').html(data);
          cartshow();
        //   getList();
        }
      });
    }
</script>