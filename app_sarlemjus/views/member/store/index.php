<?php $this->load->view('member/_/header'); ?>

<div class="pcoded-main-container">
  <div class="pcoded-content">

    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo $page['header'] ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('member/') . $page['a']['link'] ?>" title="<?php echo $page['a']['title'] ?>"><i class="<?php echo $page['a']['icon'] ?>"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo $page['b']['link'] ?>"><?php echo $page['b']['title'] ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="row">

      <div class="col-lg-12">
        <div class="row">

          <?php foreach ($product as $p) { ?>

            <div class="col-md-6 col-xl-4">
              <div class="card mb-3">
                <img class="img-fluid card-img-top" src="<?= "" . base_url('public/upload/product/') . "$p->image" ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?= $p->name ?></h5>
                  <p class="card-text"><?= " . idr($p->selling_price) . " ?></p>
                  <!-- <p class="card-text"><?= substr($c->article, 0, 200) ?> . . .</p> -->
                  <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                  <!-- <a class="btn btn-primary btn-sm has-ripple" href="<?= base_url('member/course/detail/') . $c->slug ?>">Read More<span class="ripple ripple-animate"></span></a> -->
                </div>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="row align-items-center m-l-0">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6 text-right">
                <a class="btn btn-info btn-sm btn-round has-ripple" href="#cart"><i class="feather icon-shopping-cart"></i> Keranjang Belanja</a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table-store" class="table mb-0">
                <thead class="thead-light">
                  <tr>
                    <th width="35%">Produk</th>
                    <th width="20%">Harga</th>
                    <th width="15%">Diskon</th>
                    <th width="10%">Stok</th>
                    <th width="10%">Jumlah</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($product as $p) {

                    $stock = $p->stock_plus - $p->stock_min;

                    echo "<tr>
                            <td class='align-middle'>
                              <img src='" . base_url('public/upload/product/') . "$p->image' alt='contact-img' title='contact-img' class='rounded mr-3' height='48' />
                              <p class='m-0 d-inline-block align-middle font-16'>
                              <a href='#!' class='text-body'>$p->name</a>
                            </td>
                            <td class='align-middle'>" . idr($p->selling_price) . "</td>
                            <td class='align-middle'>
                              0%
                            </td>
                            <td class='align-middle'>
                              <span class='badge badge-success'>$stock</span>
                            </td>
                            <td>
                              <input type='number' name='quantity' id='qty_$p->id' value='1' min='1' max='$stock' class='quantity form-control form-control-sm'>
                            </td>
                            <td class='table-action'>
                              <button class='add_cart btn btn-icon btn-info' data-produkid='$p->id' ><i class='fas fa-cart-plus'></i></button>
                            </td>
                          </tr>";
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>


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
</div>

<?php $this->load->view('member/_/footer'); ?>


<script type="text/javascript">
  let id_promo = 0;

  $('#id_kurir').val('2');

  function cartshow(idp) {
    let id_promo = idp;
    let id_kurir = $('#id_kurir').val();
    $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");
  }

  $('#id_kurir').on('change', function() {
    let id_kurir = $('#id_kurir').val();
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
            $('#detail_cart').html(data);
          }
        });
      }
    });

    // Load shopping cart
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