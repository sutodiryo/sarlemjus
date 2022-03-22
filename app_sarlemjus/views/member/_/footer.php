<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/ripple.js"></script>
<script src="<?php echo ASSETS ?>js/pcoded.min.js"></script>
<!-- <script src="<?php echo ASSETS ?>js/menu-setting.min.js"></script> -->

<!-- <script src="<?php echo ASSETS ?>js/plugins/apexcharts.min.js"></script> -->

<?php if ($page['id'] == "dashboard") { ?>

    <script src="<?php echo ASSETS ?>js/plugins/apexcharts.min.js"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            setTimeout(function() {
                floatchart()
            }, 700);
        });

        function floatchart() {
            $(function() {
                var options = {
                    chart: {
                        type: 'area',
                        height: 70,
                        sparkline: {
                            enabled: true
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ["#4680ff"],
                    fill: {
                        type: 'solid',
                        opacity: 0.3,
                    },
                    markers: {
                        size: 2,
                        opacity: 0.9,
                        colors: "#4680ff",
                        strokeColor: "#4680ff",
                        strokeWidth: 2,
                        hover: {
                            size: 4,
                        }
                    },
                    stroke: {
                        curve: 'straight',
                        width: 3,
                    },
                    series: [{
                        name: 'series1',
                        data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 9]
                    }],
                    tooltip: {
                        fixed: {
                            enabled: false
                        },
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function(seriesName) {
                                    return 'Monthly Profit :'
                                }
                            }
                        },
                        marker: {
                            show: false
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#monthlyprofit-1"), options);
                chart.render();
            });
        }
    </script>

    <script src="<?php echo ASSETS ?>js/pages/dashboard-sale.js"></script>
<?php } elseif ($page['id'] == "transaction") { ?>

    <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#table_trans').DataTable({
            "aaSorting": []
        });
    </script>
<?php } elseif ($page['id'] == "store") { ?>

    <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
    <script>
        // DataTable start
        $('#table-store').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
        // DataTable end
    </script>
<?php } elseif ($page['id'] == "profile") { ?>

    <!-- select2 Js -->
    <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
    <!-- form-select-custom Js -->
    <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>

<?php } ?>



<div class="modal fade bd-example-modal-lg" id="modal_cart" tabindex="-1" role="document" aria-labelledby="modal_cartTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="myLargeModalLabel">Large Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div> -->
        <!-- </div> -->

        <!-- <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> -->
        <!-- <div class="modal-content">
        <div class="modal-body"> -->

        <div class="modal-content">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card" id="cart">
                        <div class="card-header text-center">
                            <h4>Keranjang Belanja</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="40%">Produk</th>
                                            <th width="20%">Harga</th>
                                            <th width="10%">Jumlah Barang</th>
                                            <th width="25%" class="text-right">Subtotal</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="detail_cart">

                                    </tbody>

                                    <tr id="btn_checkout">

                                    </tr>

                                    <form method="POST" action="<?php echo base_url('member/store/act_add_transaction/') ?>" id="act_checkout_form">
                                        <input type="hidden" name="shipping_costs" id="shipping_costs_checkout">
                                        <input type="hidden" name="courier_name" id="courier_name">
                                    </form>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- </div>
      </div> -->
    </div>
</div>

<script type="text/javascript">
    // let id_promo = 0;

    $('#id_kurir').val('1');

    function cartshow(idp) {
        // let id_promo = idp;
        let id_kurir = $('#id_kurir').val();
        $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");
        $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");
    }

    $('#id_kurir').on('change', function() {
        let id_kurir = $('#id_kurir').val();
        $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");
        $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");
    });

    $(document).ready(function() {

        $('.add_cart').click(function() {
            // alert('aaa');
            let id = $(this).data("produkid");
            let qty = $('#qty_' + id).val();
            var stok = $(this).data("produkstok");
            if (qty > stok) {
                alert('Jumlah produk yang anda pilih melebihi stok tersedia (' + stok + ')');
            } else {
                $.ajax({
                    url: "<?php echo base_url('member/store/cart_add/') ?>",
                    method: "POST",
                    data: {
                        id_produk: id,
                        quantity: qty
                    },
                    success: function(data) {
                        $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");

                        $('#detail_cart').html(data);
                    }
                });
            }
        });

        // Load shopping cart
        $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");
        $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");

        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function() {
            let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo base_url('member/store/cart_del/'); ?>",
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
            url: "<?php echo base_url('member/store/update_qty_cart'); ?>",
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

    function set_kurir() {
        // e.preventDefault();
        var courier = $('#kurir').val();
        // var courier = 2;
        // alert(courier);
        var des = $('#id_subdistrict').val();

        // alert(des);
        $.ajax({
            url: "<?php echo base_url('member/store/get_weight/echo'); ?>",
            method: "GET",
            success: function(data) {
                var weight = data;
                // alert (weight);
                if (weight === '0' || weight === '') {
                    alert('Keranjang belanja anda masih kosong');
                } else if (courier === '') {
                    alert('Anda belum memilih kurir');
                } else if (des == 0) {
                    $('html, body').animate({
                        scrollTop: $(".container").offset().top
                    }, 2000);
                    // swal("", "Lengkapi alamat pengiriman terlebih dahulu", "error");
                    alert('Lengkapi alamat pengiriman terlebih dahulu');
                } else {
                    // alert(weight);
                    getOrigin(courier);
                }
            }
        });

    }

    function number_idr(v) {
        var value = v.toLocaleString(undefined, {
            minimumFractionDigits: 0
        });
        return value;
    }

    function getOrigin(courier) {
        $('.loading').remove();
        var str = "'";
        // var $op = $("#datakurir");
        var i, j, x = "";
        var add = 0;
        //biaya tambahan, misal tambahan berat kemasan dll
        $('#datakurir').after('<th class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw color0"></i>Loading ...</th>');
        $.getJSON("<?php echo base_url('member/store/get_cost/') ?>" + courier, function(data) {
            // alert(data);
            if (data.rajaongkir.status.code != "200") {
                alert(data.rajaongkir.status.description);
                // swal("", "" + data.rajaongkir.status.description + "", "error");
            } else if (data.rajaongkir.results[0].costs == '') {
                alert(data.rajaongkir.results[0].name + ', Tidak mendukung pengiriman ini');
                // swal("", "" + data.rajaongkir.results[0].name + ", Tidak mendukung pengiriman ini", "error");
            } else {
                $.each(data.rajaongkir.results, function(i, field) {
                    for (i in field.costs) {
                        for (j in field.costs[i].cost) {
                            x += ('<div class="form-check">\
                                    <label class="form-check-label">\
                                    <input type="radio" class="form-check-input" name="shiping" id="shiping" onclick="set_ongkir(' + str + (parseInt(field.costs[i].cost[j].value) + parseInt(add)) + str + ')" value="' + field.name + ' - ' + field.costs[i].service + '" required>\
                                        ' + field.name + ' - ' + field.costs[i].service + '\
                                        (' + field.costs[i].cost[j].etd + ' hari) - Rp.' + number_idr((field.costs[i].cost[j].value)) + '\
                                    </label>\
                                </div>\
                                <br>');
                            $("#datakurir").html(x);
                        }
                    }
                });
            }
            $('.loading').remove();
            total_tagihan();
        });
    }

    function add_new_address() {
        // alert('aaaa');
        var x = "";

        x += ('<div class="form-check">aaaaaaaaaaa\
                                    <label class="form-check-label">\
                                    <input type="radio" class="form-check-input" name="shiping" id="shiping" onclick="set_ongkir()" value="" required>\
                                        ( hari) - Rp.0\
                                    </label>\
                                </div>\
                                <br>');
        $("#add_new_address_form").html(x);
    }

    function set_ongkir(idr) {
        $('#loadingpage').show();
        $("#loadingpage").addClass("loadingfull");
        $('#shipping_costs').val(idr);
        // var idr = number_idr(parseInt(idr));
        var idr = 'Rp. ' + idr + '';
        $('#jumlahongkir').html(idr);
        var shiping = $("input[type='radio'][name='shiping']:checked").val();
        var set_shipingdesc = $('#shipingdesc').val(shiping);
        // count_summary();
        total_tagihan();
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        total_tagihan();
    });

    function total_tagihan() {
        var subtotal = $('#nilai_subtotal').val();
        var shipping_costs = $('#shipping_costs').val();
        var discount_value = $('#discount_value').val();
        var x = "";
        // console.log(shipping_costs);
        if (Number.isNaN(shipping_costs) || shipping_costs == "" || shipping_costs === null) {
            var total_tagihan = ((parseInt(subtotal) - parseInt(discount_value)));

            x += ('<td colspan="5"><button form="save" class="btn btn-success btn-lg btn-block disabled" readonly onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
        } else {
            var total_tagihan = ((parseInt(subtotal) + parseInt(shipping_costs)) - parseInt(discount_value));
            if (typeof shipping_costs == 'undefined') {
                x += ('<td colspan="5"><button form="save" class="btn btn-success btn-lg btn-block disabled" readonly onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
            } else {
                x += ('<td colspan="5"><button id="pay-button" onclick="act_checkout()" form="save" class="btn btn-success btn-lg btn-block">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
            }
        }

        $('#shipping_costs_text').html('Rp.' + number_idr((parseInt(shipping_costs))) + '');
        $('#total_tagihan').html('Rp.' + number_idr((total_tagihan)) + '');
        $("#btn_checkout").html(x);
        // console.log(discount_value);
    }


    function act_checkout() {
        var shipping_costs = $('#shipping_costs').val();

        var courier = document.getElementById("shiping");
        var courier_name = $('input[name="shiping"]:checked').parent().text();

        document.getElementById('shipping_costs_text').value = shipping_costs;
        document.getElementById('shipping_costs_checkout').value = shipping_costs;
        document.getElementById('courier_name').value = courier_name;

        // var nama_penerima = $('#shipping_selected_name').val();
        // var no_hp_penerima = $('#shipping_selected_no_hp').val();
        // var id_province = $('#id_province').val();
        // var id_district = $('#id_district').val();
        // var id_subdistrict = $('#id_subdistrict').val();
        // var province_name = $('#province_name').val();
        // var district_name = $('#district_name').val();
        // var subdistrict_name = $('#subdistrict_name').val();
        // var postal_code = $('#postal_code').val();
        // var full_address = $('#full_address').val();

        // alert("Biaya Pengiriman : " + shipping_costs + " Nama kurir : " + courier_name);
        // window.location.href = '<?php echo base_url('member/store/act_add_transaction/') ?>' + shipping_costs + '/' + courier_name + '';
        document.getElementById("act_checkout_form").submit();
    }
</script>
</body>

</html>