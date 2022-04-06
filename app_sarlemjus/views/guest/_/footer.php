<footer class="footer pt-100" style="background-color: #FFF8F1;">
  <div class="container">
    <div class="row">
      <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="footer-widget mb-60 wow fadeInLeft text-center" data-wow-delay=".2s">
          <a href="<?= base_url() ?>" class="logo mb-10"><img src="<?php echo FRONT_ASSETS ?>img/logo-1.png" alt="logo"></a>
          <p class="mb-10">South Jakarta, Indonesia.</p>
          <div class="footer-social-links">
            <ul class="">
              <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
              <!-- <li><a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a></li>
              <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li> -->
              <li><a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-6">
        <div class="footer-widget mb-60 wow fadeInUp" data-wow-delay=".4s">
          <h4>Quick Link</h4>
          <ul class="footer-links">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><a href="<?= base_url('about') ?>">About Us</a></li>
            <li><a href="<?= base_url('lp') ?>">Blog</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="<?= base_url('login') ?>">Login/Register</a></li>
            <li><a href="#">Terms & Condition</a></li>
          </ul>
        </div>
      </div>
      <div class="col-xl-4 col-lg-3 col-md-6">
        <div class="footer-widget mb-60 wow fadeInRight" data-wow-delay=".8s">
          <h4>Contact</h4>
          <ul class="footer-links">
            <li><a href="https://api.whatsapp.com/send/?phone=6281321351753"><i class="lni lni-whatsapp"></i> CS 1 : 081321351753</a></li>
            <li><a href="https://api.whatsapp.com/send/?phone=6282123602448"><i class="lni lni-whatsapp"></i> CS 2 : 082123602448</a></li>
            <li><a href="mailto:sarlemjusplus@gmail.com"><i class="lni lni-envelope"></i> sarlemjusplus@gmail.com</a></li>
            <li><a href="#"><i class="lni lni-map-marker"></i> Perumahan Griya Ciledug<br>Jl Anggrek 2 Blok K No.1, Ciledug<br>Tangerang, Banten 15151</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="copyright-area">
      <div class="row align-items-center">
        <div class="col-md-12 text-center">
          <span class="wow fadeInUp" data-wow-delay=".3s">©<?php echo date('Y'); ?> Sarlemjus - All Rights Reserved.</span>
        </div>
      </div>
    </div>
  </div>
</footer>

<a href="#" class="scroll-top">
  <i class="lni lni-arrow-up"></i>
</a>

<div class="modal fade bd-example-modal-lg" id="modal_cart" role="dialog" aria-labelledby="modal_cartTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Keranjang Belanja</h4>
        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cart">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th width="5%"></th>
                <th width="40%">Produk</th>
                <th width="20%">Harga</th>
                <th width="10%">Jumlah Barang</th>
                <th width="25%" class="text-right">Subtotal</th>
              </tr>
            </thead>
            <tbody id="detail_cart"></tbody>
            <form method="POST" action="<?= ($this->session->userdata('log_valid') == FALSE) ? base_url('guest/act_add_transaction/') : base_url('member/store/act_add_transaction/'); ?>" id="act_checkout_form">
              <input type="hidden" name="full_name" id="full_name">
              <input type="hidden" name="phone" id="phone">
              <input type="hidden" name="home_detail" id="home_detail">
              <input type="hidden" name="village_name" id="village_name">
              <input type="hidden" name="subdistrict_name" id="subdistrict_name">
              <input type="hidden" name="subdistrict_id" id="subdistrict_id">
              <input type="hidden" name="district_name" id="district_name">
              <input type="hidden" name="district_id" id="district_id">
              <input type="hidden" name="province_name" id="province_name">
              <input type="hidden" name="province_id" id="province_id">
              <input type="hidden" name="shipping_costs" id="shipping_costs_checkout">
              <input type="hidden" name="courier_name" id="courier_name">
            </form>
            <tr id="courier_div"></tr>
            <tr id="btn_checkout">
              <button class="btn btn-success" onclick="loader()">aaaa</button>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo FRONT_ASSETS ?>js/bootstrap.bundle-5.0.0-beta1.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/contact-form.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/count-up.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/tiny-slider.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/isotope.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/glightbox.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/wow.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/imagesloaded.min.js"></script>
<script src="<?php echo FRONT_ASSETS ?>js/main.js"></script>

<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>

<script type="text/javascript">
  //============== isotope masonry js with imagesloaded
  imagesLoaded('#container', function() {
    var elem = document.querySelector('.grid');
    var iso = new Isotope(elem, {
      // options
      itemSelector: '.grid-item',
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: '.grid-item'
      }
    });

    let filterButtons = document.querySelectorAll('.portfolio-btn-wrapper button');
    filterButtons.forEach(e =>
      e.addEventListener('click', () => {

        let filterValue = event.target.getAttribute('data-filter');
        iso.arrange({
          filter: filterValue
        });
      })
    );
  });

  function loader() {
    $('body').append('<div class="preloader"><div class="loader"><div class="spinner"><div class="spinner-container"><div class="spinner-rotator"><div class="spinner-left"><div class="spinner-circle"></div></div><div class="spinner-right"><div class="spinner-circle"></div></div></div></div></div></div></div>');
    $(window).on('load', function() {
      setTimeout(removeLoader, 500);
    });

    function removeLoader() {
      $("#loadingDiv").fadeOut(500, function() {
        // fadeOut complete. Remove the loading div
        $("#loadingDiv").remove(); //makes page more lightweight 
      });
    }
  }

  // LOCATION
  function add_new_address() {

    $.ajax({
      type: "GET",
      dataType: "html",
      url: "<?php echo base_url('api/location/get_province') ?>",
      success: function(msg) {
        $("#new_province").html(msg);
      }
    });

    var x = "";
    x += ('<div class="col-md-12 class="text-center">\
                                <h5 class="mt-2">Alamat Pengiriman</h5>\
                                <hr>\
                                <form method="POST" action="<?= base_url() ?>">\
                                    <div class="form-group row">\
                                        <label for="colFormLabel" class="col-sm-3 col-form-label"><small>Nama Penerima</small></label>\
                                        <div class="col-sm-9">\
                                            <input type="text" class="form-control col-sm-12" placeholder="Nama Lengkap" id="new_name" onkeyup="new_phone()">\
                                        </div>\
                                    </div>\
                                    <div class="form-group row" id="phone_div">\
                                    </div>\
                                    <div class="form-group row" id="province_div">\
                                    </div>\
                                    <div class="form-group row" id="district_div">\
                                    </div>\
                                    <div class="form-group row" id="subdistrict_div">\
                                    </div>\
                                    <div class="form-group row" id="village_div">\
                                    </div>\
                                    <div class="form-group row" id="home_div">\
                                    </div>\
                                    <div class="form-group row" id="fulladdress_div" required>\
                                    </div>\
                                </form>\
                            </div>');
    // <button type="submit" onclick="SubmitAddress()" class="btn btn-primary has-ripple">Submit<span class="ripple ripple-animate"></span></button>\

    $("#add_new_address_form").html(x);
  }

  function new_phone() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Nomor WA</small></label>\
                                        <div class="col-sm-9">\
                                            <input type="number" class="form-control" placeholder="Nomor Handphone" name="phone" id="new_phone" onkeyup="new_province()">\
                                        </div>');
    $("#phone_div").html(x);
  }

  function new_province() {
    $.ajax({
      type: "GET",
      dataType: "html",
      url: "<?php echo base_url('api/location/get_province') ?>",
      success: function(msg) {
        $("select#new_province").html(msg);
      }
    });
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Provinsi</small></label>\
                                        <div class="col-sm-9">\
                                            <select class="form-control col-sm-12" name="id_province" id="new_province" onchange="new_district()">\
                                            </select>\
                                        </div>');
    $("#province_div").html(x);

    return false;
  }

  function new_district() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Kota/Kabupaten</small></label>\
                                        <div class="col-sm-9">\
                                            <select class="form-control col-sm-12" name="id_district" id="new_district" onchange="new_subdistrict()">\
                                            </select>\
                                        </div>');
    $("#district_div").html(x);

    var province_id = $('#new_province').val();

    $('#new_district').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
    $('#new_district').load('<?php echo base_url('api/location/get_district/') ?>/' + province_id, function(responseTxt, statusTxt, xhr) {
      if (statusTxt === "success")
        $('.loading').remove();
    });

    return false;
  }

  function new_subdistrict() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Kecamatan</small></label>\
                                        <div class="col-sm-9">\
                                            <select class="form-control col-sm-12" name="subdistrict_id" id="new_subdistrict" onchange="new_village()">\
                                            </select>\
                                        </div>');
    $("#subdistrict_div").html(x);
    var district_id = $('#new_district').val();

    $('#new_subdistrict').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
    $('#new_subdistrict').load('<?php echo base_url('api/location/get_subdistrict/') ?>/' + district_id, function(responseTxt, statusTxt, xhr) {
      if (statusTxt === "success")
        $('.loading').remove();
    });

    return false;
  }

  function new_village() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Desa/Kelurahan</small></label>\
                                        <div class="col-sm-9">\
                                            <input type="text" class="form-control" placeholder="Desa/Kelurahan" name="village_name" id="new_village" onkeyup="new_home_detail()">\
                                        </div>');
    $("#village_div").html(x);
  }

  function new_home_detail() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small></small></label>\
                                        <div class="col-sm-9">\
                                            <input type="text" class="form-control" placeholder="Jalan, No rumah/RT RW" name="home_detail" id="new_home_detail" onkeyup="add_location_text()">\
                                        </div>');
    $("#home_div").html(x);
  }

  function add_location_text() {
    var x = "";
    x += ('<label for="colFormLabel" class="col-sm-3 col-form-label"><small>Alamat Lengkap</small></label>\
                                        <div class="col-sm-9">\
                                            <textarea class="form-control" name="full_address" id="new_full_address" rows="3" readonly></textarea>\
                                        </div>');
    $("#fulladdress_div").html(x);

    var new_name = $("#new_name").val();
    var new_phone = $("#new_phone").val();
    var province_name = $("#new_province option:selected").text();
    var district_name = $("#new_district option:selected").text();
    var subdistrict_name = $("#new_subdistrict option:selected").text();
    var village_name = $("#new_village").val();
    var home_detail = $("#new_home_detail").val();

    $("#new_full_address").val('' + home_detail + ', ' + village_name + ', ' + subdistrict_name + ', ' + district_name + ', ' + province_name);

    var province_id = $('#new_province').val();
    var district_id = $('#new_district').val();
    var subdistrict_id = $('#new_subdistrict').val();

    $("#full_name").val(new_name);
    $("#phone").val(new_phone);
    $("#province_name").val(province_name);
    $("#province_id").val(province_id);
    $("#district_name").val(district_name);
    $("#district_id").val(district_id);
    $("#subdistrict_name").val(subdistrict_name);
    $("#subdistrict_id").val(subdistrict_id);
    $("#village_name").val(village_name);
    $("#home_detail").val(home_detail);
    courier_show();
  }

  function SubmitAddress() {

    // Check if fields are empty 
    if (home_detail == "a" || village_name == "") {
      alert("Please fill all fields");
    }
    // AJAX code to submit form
    else {
      $.ajax({
        type: "POST",
        url: "<?= base_url('api/shipping/add_shipping_address') ?>",
        data: {
          "province_id": $('#province_id').val(),
          "district_id": $('#district_id').val(),
          "subdistrict_id": $('#subdistrict_id').val(),
          "province_name": $("#province_name").val(),
          "district_name": $("#district_name").val(),
          "subdistrict_name": $("#subdistrict_name").val(),
          "village_name": $("#village_name").val(),
          "home_detail": $("#home_detail").val()
        },
        cache: false,
        success: function() {
          alert("Data successfully forwarded");
          cartshow();
        }
      });
    }
  }

  function number_idr(v) {
    var value = v.toLocaleString(undefined, {
      minimumFractionDigits: 0
    });
    return value;
  }

  <?php
  if ($this->session->userdata('log_valid') == FALSE) { ?>

    function courier_show() {
      if (home_detail == "" || village_name == "") {
        alert("Please fill all fields");
      } else {
        $.ajax({
          type: "POST",
          url: "<?= base_url('guest/get_weight/echo') ?>",
          cache: false,
          success: function(data) {

            var tb_kg = data / 1000;

            var x = "";
            x += ('<td colspan="5">\
              <table class="table table-striped">\
              <tbody>\
              <tr>\
                    <th>\
                    <label class="form-control-label" for="id_kurir">Pilih Jasa Pengiriman <small><font id="total_weight" color="blue">Total Berat : (' + tb_kg + ' Kg)</font></small></label>\
                    <select class="form-control form-control-sm" id="kurir" onchange="set_kurir()" required="">\
                      <option value=""> Pilih Kurir</option>\
                      <option value="anteraja">Anteraja</option>\
                      <option value="jne">JNE - Jalur Nugraha Ekakurir</option>\
                      <option value="jnt">JNT</option>\
                      <option value="ninja">Ninja Express</option>\
                      <option value="pos">POS Indonesia</option>\
                      <option value="sicepat">Sicepat</option>\
                      <option value="tiki">Tiki - Titipan Kilat</option>\
                    </select>\
                    <br>\
                    <div id="datakurir"></div>\
                    </th>\
                  <tr></tbody></table></td>');

            $("#courier_div").html(x);

          }
        });
      }

    }

    function btn_add_to_cart(product_id, stok) {
      let id = product_id;

      // let qty = $('#qty_' + id).val();
      let qty = 1;
      // var stock = $(this).data("produkstok");
      // alert(qty);

      if (qty > stok) {
        alert('Jumlah produk yang anda pilih melebihi stok tersedia (' + stok + ')');
      } else {

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "<?php echo base_url('guest/cart_add/') ?>");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id_produk=" + id + "&quantity=" + qty + "");

        xhttp.onload = function() {
          // alert(this.responseText);
          $('#cart_qty').load("<?php echo base_url('guest/cart_qty/'); ?>");

          $('#detail_cart').html(this.responseText);
          total_tagihan();
          cartshow();
        }

      }
    }

    function cartshow() {
      let id_kurir = $('#id_kurir').val();
      $('#cart_qty').load("<?php echo base_url('guest/cart_qty/'); ?>");
      $('#detail_cart').load("<?php echo base_url('guest/cart_load/'); ?>");
      total_tagihan();
    }

    $('#id_kurir').on('change', function() {
      let id_kurir = $('#id_kurir').val();
      $('#cart_qty').load("<?php echo base_url('guest/cart_qty/'); ?>");
      $('#detail_cart').load("<?php echo base_url('guest/cart_load/'); ?>");
    });

    $(document).ready(function() {

      $.ajax({
        type: "GET",
        dataType: "html",
        url: "<?php echo base_url('api/location/get_province') ?>",
        success: function(msg) {
          $("select#new_province").html(msg);
        }
      });

      $('#province').change(function() {
        var idp = $('#province').val();

        var province_name = $("#id_province option:selected").text();
        $("#province_name").val(province_name);

        $('#id_district').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#id_district').load('<?php echo base_url('member/get/district/') ?>/' + idp, function(responseTxt, statusTxt, xhr) {
          if (statusTxt === "success")
            $('.loading').remove();
        });
        return false;
      });

      $('#id_district').change(function() {
        var idd = $('#id_district').val();

        var district_name = $("#id_district option:selected").text();
        $("#district_name").val(district_name);

        $('#subdistrict_id').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#subdistrict_id').load('<?php echo base_url('member/get/subdistrict/') ?>/' + idd, function(responseTxt, statusTxt, xhr) {
          if (statusTxt === "success")
            $('.loading').remove();
        });
        return false;
      });

      $('#subdistrict_id').change(function() {
        var province_name = $("#province_name").val();
        var district_name = $("#district_name").val();
        var subdistrict_name = $("#subdistrict_id option:selected").text();
        $("#subdistrict_name").val(subdistrict_name);
        $("#full_address").val('RT RW/Jalan No Rumah, Desa/Kelurahan, ' + subdistrict_name + ', ' + district_name + ', ' + province_name);
        return false;
      });

      $('.cart_qty').click(function() {
        total_tagihan();
      });
      $("#modal_cart").on('shown.bs.modal', function(e) {
        cartshow();
      });


      // Load shopping cart
      $('#cart_qty').load("<?php echo base_url('guest/cart_qty/'); ?>");
      $('#detail_cart').load("<?php echo base_url('guest/cart_load/'); ?>");

      //Hapus Item Cart
      $(document).on('click', '.hapus_cart', function() {
        let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
        $.ajax({
          url: "<?php echo base_url('guest/cart_del/'); ?>",
          method: "POST",
          data: {
            row_id: row_id
          },
          success: function(data) {
            $('#detail_cart').html(data);
            total_tagihan();
            cartshow();
          }
        });
      });
    });

    function updateQty(rowid, id_produk) {
      var row = rowid;
      var qty = $('#qty' + row).val();
      var id_produk = id_produk;
      $.ajax({
        url: "<?php echo base_url('guest/update_qty_cart'); ?>",
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
          total_tagihan();
          $('#cart_qty').load("<?php echo base_url('guest/cart_qty/'); ?>");

        }
      });
    }

    function set_kurir() {
      // e.preventDefault();
      var courier = $('#kurir').val();
      // var courier = 2;
      // alert(courier);
      var des = $('#subdistrict_id').val();

      // alert(courier);
      $.ajax({
        url: "<?php echo base_url('guest/get_weight/echo'); ?>",
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

    function getOrigin(courier) {
      $('.loading').remove();
      var str = "'";
      // var $op = $("#datakurir");
      var i, j, x = "";
      var add = 0;
      var des = $('#subdistrict_id').val();
      //biaya tambahan, misal tambahan berat kemasan dll
      $('#datakurir').after('<th class="loading"><i class="fa fa-spinner fa-pulse fa-2x fa-fw color0"></i>Loading ...</th>');
      $.getJSON("<?php echo base_url('guest/get_cost/') ?>" + courier + "/" + des, function(data) {
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
      var x = "";

      var subtotal = $('#nilai_subtotal').val();
      var shipping_costs = $('#shipping_costs').val();
      var discount_value = $('#discount_value').val();

      if (Number.isNaN(shipping_costs) || shipping_costs == "" || shipping_costs === null) {

        var total_tagihan = ((parseInt(subtotal) - parseInt(discount_value)));

        x += ('<td colspan="5" class="text-center"><div class="col-md-12"><div class="row">\
        <button form="save" class="btn btn-success btn-lg btn-block" disabled onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="lni lni-arrow-right"></i></button>\
        </div></div></td>');
      } else {
        var total_tagihan = ((parseInt(subtotal) + parseInt(shipping_costs)) - parseInt(discount_value));
        if (typeof shipping_costs == 'undefined') {
          // x += ('<td colspan="5"><button form="save" class="btn btn-success btn-lg btn-block disabled" readonly onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
        } else {
          x += ('<td colspan="5"><div class="col-md-12"><div class="row"><button id="pay-button" onclick="act_checkout(); this.disabled=true;" form="save" class="btn btn-success btn-lg btn-block">Ke Pembayaran <i class="lni lni-arrow-right"></i></button></div></div></td>');
        }
      }

      $('#shipping_costs_text').html('Rp.' + number_idr((parseInt(shipping_costs))) + '');
      $('#total_tagihan').html('Rp.' + number_idr((total_tagihan)) + '');
      $("#btn_checkout").html(x);
    }

    function act_checkout() {
      var shipping_costs = $('#shipping_costs').val();

      var courier = document.getElementById("shiping");
      var courier_name = $('input[name="shiping"]:checked').parent().text();

      document.getElementById('shipping_costs_text').value = shipping_costs;
      document.getElementById('shipping_costs_checkout').value = shipping_costs;
      document.getElementById('courier_name').value = courier_name;

      document.getElementById("act_checkout_form").submit();
    }

  <?php } else { ?>

    $('#id_kurir').val('1');

    // $('.add_cart').click(function() {
    function btn_add_to_cart(product_id, stok) {
      let id = product_id;

      let qty = $('#qty_' + id).val();
      // var stock = $(this).data("produkstok");
      // alert(qty);

      if (qty > stok) {
        alert('Jumlah produk yang anda pilih melebihi stok tersedia (' + stok + ')');
      } else {

        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "<?php echo base_url('member/store/cart_add/') ?>");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id_produk=" + id + "&quantity=" + qty + "");

        xhttp.onload = function() {
          // alert(this.responseText);
          $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");

          $('#detail_cart').html(this.responseText);
          total_tagihan();
          cartshow();
          // document.getElementById("demo").innerHTML = this.responseText;
        }

        // $.ajax({
        //   url: "<?php echo base_url('member/store/cart_add/') ?>",
        //   method: "POST",
        //   data: {
        //     id_produk: id,
        //     quantity: qty
        //   },
        //   success: function(data) {
        //     $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");

        //     $('#detail_cart').html(data);
        //     total_tagihan();
        //     cartshow();
        //   }
        // });
      }
    }

    function cartshow() {
      let id_kurir = $('#id_kurir').val();
      $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");
      $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");
      total_tagihan();

    }

    $('#id_kurir').on('change', function() {
      let id_kurir = $('#id_kurir').val();
      $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");
      $('#detail_cart').load("<?php echo base_url('member/store/cart_load/'); ?>");
    });

    $(document).ready(function() {

      $.ajax({
        type: "GET",
        dataType: "html",
        url: "<?php echo base_url('api/location/get_province') ?>",
        success: function(msg) {
          $("select#new_province").html(msg);
        }
      });

      $('#province').change(function() {
        var idp = $('#province').val();

        var province_name = $("#id_province option:selected").text();
        $("#province_name").val(province_name);

        $('#id_district').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#id_district').load('<?php echo base_url('member/get/district/') ?>/' + idp, function(responseTxt, statusTxt, xhr) {
          if (statusTxt === "success")
            $('.loading').remove();
        });
        return false;
      });

      $('#id_district').change(function() {
        var idd = $('#id_district').val();

        var district_name = $("#id_district option:selected").text();
        $("#district_name").val(district_name);

        $('#subdistrict_id').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
        $('#subdistrict_id').load('<?php echo base_url('member/get/subdistrict/') ?>/' + idd, function(responseTxt, statusTxt, xhr) {
          if (statusTxt === "success")
            $('.loading').remove();
        });
        return false;
      });

      $('#subdistrict_id').change(function() {
        var province_name = $("#province_name").val();
        var district_name = $("#district_name").val();
        var subdistrict_name = $("#subdistrict_id option:selected").text();
        $("#subdistrict_name").val(subdistrict_name);
        $("#full_address").val('RT RW/Jalan No Rumah, Desa/Kelurahan, ' + subdistrict_name + ', ' + district_name + ', ' + province_name);
        return false;
      });

      $('.cart_qty').click(function() {
        total_tagihan();
      });
      $("#modal_cart").on('shown.bs.modal', function(e) {
        cartshow();
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
            total_tagihan();
            cartshow();
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
          total_tagihan();
          $('#cart_qty').load("<?php echo base_url('member/store/cart_qty/'); ?>");

        }
      });
    }

    function set_kurir() {
      // e.preventDefault();
      var courier = $('#kurir').val();
      // var courier = 2;
      // alert(courier);
      var des = $('#subdistrict_id').val();

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
      var x = "";
      // console.log(shipping_costs);

      // $.ajax({
      //     type: "GET",
      //     dataType: "html",
      //     url: "<?= base_url('member/store/cart_qty_value') ?>",
      //     success: function(qty) {
      // $("select#new_province").html(msg);
      // if (qty > 0) {
      // alert('lebih 0');

      var subtotal = $('#nilai_subtotal').val();
      var shipping_costs = $('#shipping_costs').val();
      var discount_value = $('#discount_value').val();

      if (Number.isNaN(shipping_costs) || shipping_costs == "" || shipping_costs === null) {

        var total_tagihan = ((parseInt(subtotal) - parseInt(discount_value)));

        // x += ('');
        x += ('<td colspan="5"><button form="save" class="btn btn-success btn-lg btn-block disabled" readonly onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
      } else {
        var total_tagihan = ((parseInt(subtotal) + parseInt(shipping_costs)) - parseInt(discount_value));
        if (typeof shipping_costs == 'undefined') {
          // x += ('<td colspan="5"><button form="save" class="btn btn-success btn-lg btn-block disabled" readonly onclick="alert(\'Silahkan pilih jasa pengiriman terlebih dahulu\')">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
        } else {
          x += ('<td colspan="5"><button id="pay-button" onclick="act_checkout()" form="save" class="btn btn-success btn-lg btn-block">Ke Pembayaran <i class="fa fa-arrow-right"></i></button></td>');
        }
      }

      $('#shipping_costs_text').html('Rp.' + number_idr((parseInt(shipping_costs))) + '');
      $('#total_tagihan').html('Rp.' + number_idr((total_tagihan)) + '');
      $("#btn_checkout").html(x);
      // console.log(discount_value);
      // } else {
      //     x += ('<div class="card-header text-center"><h1>Keranjang Belanja anda masih kosong</h1></div><div class="card-body text-center"><a href="<?= base_url('member/store') ?>"><h2 class="text-info">Silahkan pilih produk disini...</h2></a></div><div class="card-footer"></div>');

      //     $("#cart").html(x);
      // }
      // }
      // });
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
      // var subdistrict_id = $('#subdistrict_id').val();
      // var province_name = $('#province_name').val();
      // var district_name = $('#district_name').val();
      // var subdistrict_name = $('#subdistrict_name').val();
      // var postal_code = $('#postal_code').val();
      // var full_address = $('#full_address').val();

      // alert("Biaya Pengiriman : " + shipping_costs + " Nama kurir : " + courier_name);
      // window.location.href = '<?php echo base_url('member/store/act_add_transaction/') ?>' + shipping_costs + '/' + courier_name + '';
      document.getElementById("act_checkout_form").submit();
    }
  <?php
  }
  ?>
</script>
</body>

</html>