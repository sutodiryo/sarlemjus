<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo LOGIN_DESC ?>">
    <meta name="author" content="natdev.web.id">
    <title><?php echo $title ?></title>
    
    <link href="<?php echo FAVICON ?>" rel="icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/argon.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
</head>

<body class="bg-default">
    <div class="main-content">
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mbx-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6">
                            <br>
                            <br>
                            <h1 class="text-white"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="card bg-secondary border-0">

                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center">
                                <h1>Pembelian Member<br><small><font color="red">*Total pembelian harus sama/melebihi SMP (<?php echo "Rp " . number_format($smp->smp, 0, '.', '.') . ""; ?>)</font></small></h1>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">

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
                                            <table class="table table-flush" id="datatable-purchase">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="40%">Nama Produk</th>
                                                        <th width="30%">Harga</th>
                                                        <th width="30%"></th>
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
                                            <b>$p->nama_produk</b>
                                        </td>
                                        <td>
                                            <span>Rp " . number_format($p->harga, 0, ',', '.') . "</span>
                                            <br>";

                                                        $stock = $p->stok - $p->stok_;

                                                        if ($stock < 1) {
                                                            $disabled = "disabled";
                                                        } else {
                                                            $disabled = "";
                                                        }

                                                        if ($stock <= 100) {
                                                            echo "<span class='text-red'>" . number_format($stock, 0, '.', '.') . " $p->satuan</span>";
                                                        } else if ($stock > 100 && $stock <= 200) {
                                                            echo "<span class='text-yellow'>" . number_format($stock, 0, '.', '.') . " $p->satuan</span>";
                                                        } else if ($stock > 200) {
                                                            echo "<span class='text-green'>" . number_format($stock, 0, '.', '.') . " $p->satuan</span>";
                                                        }

                                                        echo "  </td>
                                        <td class='text-center'>
                                            <div class='input-group mb-3'>
                                                <input type='number' name='quantity' id='qty_$p->id_produk' value='1' min='1' max='$stock' class='quantity form-control form-control-sm' $disabled>
                                                <div class='input-group-append'>
                                                <button class='add_cart btn btn-sm btn-success' type='button' data-produkstok='$stock' data-produkid='$p->id_produk' data-produknama='$p->nama_produk' data-produkharga='$p->harga' data-berat='$p->berat' $disabled><i class='fa fa-cart-plus'></i></button>
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
                                <div class="col-xl-6 col-md-6">

                                    <div class="card border-0">
                                        <div class="card-header border-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h3 class="mb-0">Keranjang Belanja</h3>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="table-responsive py-4">


                                                <form id="save" action="<?php echo base_url('transaction/act_add_purchase') ?>" method="POST">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Produk</th>
                                                                <th>Harga</th>
                                                                <th>Qty</th>
                                                                <th>Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <input type="hidden" value="<?php echo $id_member ?>" name="id_member">
                                                        <tbody id="detail_cart">

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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo ASSETS ?>vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/js-cookie/js.cookie.js"></script>
    <script src="<?php echo ASSETS ?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>


    <script src="<?php echo ASSETS ?>vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo ASSETS ?>vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <script src="<?php echo ASSETS ?>js/argon.js?v=1.1.0"></script>
    <script src="<?php echo ASSETS ?>js/demo.min.js"></script>


    <script type="text/javascript">
        'use strict';

        var DatatableBasic = (function() {
            var $dtBasic = $('#datatable-purchase');

            function init($this) {

                var options = {
                    keys: !0,
                    select: {
                        style: "multi"
                    },
                    pageLength: 5,
                    language: {
                        paginate: {
                            previous: "<i class='fas fa-angle-left'>",
                            next: "<i class='fas fa-angle-right'>"
                        }
                    },
                };
                var table = $this.on('init.dt', function() {
                    $('div.dataTables_length select').removeClass('custom-select custom-select-sm');

                }).DataTable(options);
            }
            if ($dtBasic.length) {
                init($dtBasic);
            }
        })();

        let id_member = <?php echo $id_member ?>;
        // let id_kurir = $('#id_kurir').val();
        let id_kurir = 0;

        $('#id_kurir').val('2');

        function cartshow(idp) {
            let id_member = idp;
            let id_kurir = $('#id_kurir').val();
            $('#detail_cart').load("<?php echo base_url('transaction/cart_load/'); ?>" + id_member + "/" + id_kurir);
        }

        $('#id_kurir').on('change', function() {

            let id_kurir = $('#id_kurir').val();
            $('#detail_cart').load("<?php echo base_url('transaction/cart_load/'); ?>" + id_member + "/" + id_kurir);
        });

        $(document).ready(function() {

            $('.add_cart').click(function() {
                let id = $(this).data("produkid");
                let name = $(this).data("produknama");
                let price = $(this).data("produkharga");
                let weight = $(this).data("berat");
                let qty = $('#qty_' + id).val();
                var stok = $(this).data("produkstok");
                if (qty > stok) {
                    alert('Jumlah produk yang anda pilih melebihi stok tersedia (' + stok + ')');
                } else {
                    $.ajax({
                        url: "<?php echo base_url('transaction/cart_add/') ?>" + id_member + "/" + id_kurir,
                        method: "POST",
                        data: {
                            id_produk: id,
                            quantity: qty,
                            harga_produk: price,
                            berat_produk: weight,
                            nama_produk: name
                        },
                        success: function(data) {
                            $('#detail_cart').html(data);
                        }
                    });
                }
            });

            // Load shopping cart
            $('#detail_cart').load("<?php echo base_url('transaction/cart_load/'); ?>" + id_member + "/" + id_kurir);

            //Hapus Item Cart
            $(document).on('click', '.hapus_cart', function() {
                let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
                $.ajax({
                    url: "<?php echo base_url('transaction/cart_del/'); ?>" + id_member + "/" + id_kurir,
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
    </script>


</body>

</html>