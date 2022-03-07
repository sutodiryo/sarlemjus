<?php $this->load->view('admin/_/header'); ?>


<div class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo $title ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a>Transaction</a></li>
              <!-- <li class="breadcrumb-item"><a href="<?php echo base_url('admin/member/all') ?>">Member</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6 text-right ">
                <button type="button" class="btn btn-sm btn-info btn-round has-ripple" data-toggle="modal" data-target="#modal_add_transaction" data-whatever="@getbootstrap"><i class="feather icon-plus"></i> Transaksi Baru</button>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_transaction" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="20%">ID Transaksi</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%" class="text-center">Status</th>
                    <th width="10%" class="text-center">Tipe Transaksi</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="15%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  foreach ($transaction as $t) {

                    $date_created = new DateTime($t->date_created);

                    echo "<tr>
                    <td><a href='" . base_url('admin/transaction/invoice/') . "$t->invoice_number' target='_blank'>$t->invoice_number</a></td>
                    <td class='text-right'>" . date_time_id($date_created) . "</td>
                    <td class='text-center'>";

                    if ($t->status == 0) {
                      echo "<span class='badge badge-pill badge-warning'>Belum Bayar</span>";
                    } elseif ($t->status == 1) {
                      echo "<span class='badge badge-pill badge-success'>Diproses</span>";
                    } elseif ($t->status == 2) {
                      echo "<span class='badge badge-pill badge-info'>Diterima</span>";
                    }

                    echo "</td><td class='text-center'>";

                    if ($t->type == 0) {
                      echo "<span class='badge badge-pill badge-dark'>Online</span>";
                    } elseif ($t->type == 1) {
                      echo "<span class='badge badge-pill badge-light-dark'>COD</span>";
                    }

                    echo "</td>
                    <td class='text-right'>" . idr($t->total) . "</td>
                    <td class='text-center'>
                      <a href='" . base_url('admin/transaction/invoice/') . "$t->invoice_number' target='_blank' class='btn btn-sm btn-outline-dark has-ripple'><i class='fas fa-eye icon-info'></i> Detail</a>
                    </td>
                    </tr>";
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modal_add_transaction" tabindex="-1" role="dialog" aria-labelledby="modal_add_transaction" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_add_transaction">Transaksi Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="id_member">Member</label>
                <select class="js-example-basic-single form-control" id="id_member" name="id_member" required>
                  <?php foreach ($sel_member as $sm) {

                    // $count  = strlen($sm->phone) - 6;
                    // $phone  = substr_replace($sm->phone, str_repeat('#', $count), 3, $count);

                    echo "<option value='$sm->id'>$sm->name ($sm->phone)</option>";
                  } ?>
                </select>
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group">
                <label class="form-control-label" for="id_product">Produk</label>
                <select class="js-example-basic-single form-control" id="id_product_0" name="id_product[0]" required>
                  <option readonly selected>Pilih Produk</option>
                  <?php foreach ($sel_product as $sp) {
                    echo "<option value='$sp->id'>$sp->name (qty)</option>";
                  } ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              </div>
            </div>
            <!-- <div class="col-md-7">
              <div class="form-group">
                <label class="form-control-label" for="id_product">Produk</label>
                <select class="js-example-basic-single form-control" id="id_product_0" name="id_product[0]" required>
                  <option readonly selected>Pilih Produk</option>
                  <?php foreach ($sel_product as $sp) {
                    echo "<option value='$sp->id'>$sp->name (qty)</option>";
                  } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label" for="quantity">Jumlah</label>
                <input type="number" name="quantity" class="form-control" id="quantity" required>
              </div>
            </div> -->

            <div class="col-sm-12" id="new_product_row">
            </div>

            <div class="col-md-12">
              <input type="button" class="btn btn-sm btn-block btn-info" id="add_product_row" value="Tambah produk" />
              <hr>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
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


<script>
  $('body').on('shown.bs.modal', '.modal', function() {
    $(this).find('select').each(function() {
      var dropdownParent = $(document.body);
      if ($(this).parents('.modal.in:first').length !== 0)
        dropdownParent = $(this).parents('.modal.in:first');
      $(this).select2({
        dropdownParent: $("#modal_add_transaction")

      });
    });
  });

  $(document).ready(function() {

    var counter = 1;

    $("#add_product_row").on("click", function() {
      var newRow = $("<div class='row product'>");
      var cols = "";

      cols += '<div class="col-7 col-md-7"><div class="form-group"><select class="js-example-basic-single form-control" id="id_product_' + counter + '" name="id_product[' + counter + ']" required><?php foreach ($sel_product as $sp) {
                                                                                                                                                                                                      echo "<option value=\"$sp->id\">$sp->name (qty)</option>";
                                                                                                                                                                                                    } ?></select></div></div>';
      cols += '<div class="col-3 col-md-3"><div class="form-group"><input type="number" name="quantity[' + counter + ']" class="form-control" id="quantity_' + counter + '" required></div></div>';
      cols += '<div class="col-2 col-md-2"><button class="del_product btn btn-danger "><i class="fas fa-trash"></i></button></div>';
      cols += '</div>';
      newRow.append(cols);
      $("#new_product_row").append(newRow);
      counter++;

      // $('#id_product_' + counter + '').select2();


    });

    $("#new_product_row").on("click", ".del_product", function(event) {
      $(this).closest('.product').remove();
      counter -= 1
    });
  });

  $('#id_product_0').on('select2:select', function(e) {
    var data = e.params.data.id;
    // console.log(data);
    // alert(data);
  });

  // $(document).ready(function() {
  //   $("#id_member").select2({
  //     dropdownParent: $("#modal_add_transaction")
  //   });
  // });


  // function loadSelect2() {

  // }
</script>