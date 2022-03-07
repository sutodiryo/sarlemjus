<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_stock_product_list', current_url()); ?>

<div class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo "$title"; ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a>Stock</a></li>
              <li class="breadcrumb-item"><a>Product</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-md-12">
        <div class="card">

          <?php echo $this->session->flashdata('report'); ?>
          <div class="card-header">

            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <!-- <h5>Inventory <?php echo $product->name ?></h5> -->
              </div>
              <div class="col-sm-6 text-right ">
                <?php $current_stock = $product->stock_plus - $product->stock_min;
                if ($current_stock < 1) {
                  echo "<button type='button' class='btn btn-sm btn-dark has-ripple'>Kosong <span class='badge badge-light'>$current_stock</span><span class='ripple ripple-animate'></span></button>";
                } elseif ($current_stock <= 10) {
                  echo "<button type='button' class='btn btn-sm btn-danger has-ripple'>Kurang <span class='badge badge-light'>$current_stock</span><span class='ripple ripple-animate'></span></button>";
                } elseif ($current_stock > 10) {
                  echo "<button type='button' class='btn btn-sm btn-warning has-ripple'>Aman <span class='badge badge-light'>$current_stock</span><span class='ripple ripple-animate'></span></button>";
                }
                ?>
                <a data-toggle="modal" href="#modal_add_stock" class="btn btn-info btn-sm btn-round has-ripple"><i class="feather icon-plus"></i> Update Stok</a>
                <a class="btn btn-primary btn-sm btn-round has-ripple" href="<?= base_url('admin/stock/product') ?>"><i class="feather feather icon-arrow-left"></i> Kembali</a>
              </div>
            </div>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table id="table_stock_product_list" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="30%">Produk</th>
                    <th width="10%" class="text-center">Tipe</th>
                    <th width="10%">Waktu Update</th>
                    <th width="10%">Jumlah</th>
                    <th width="30%">Catatan</th>
                    <th width="5%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 0;
                  foreach ($stock as $s) {
                    $i++;
                    echo "<tr>
                    <td class='text-center'>$i</td>
                    <td>$s->product</td>
                    <td class='text-center'>";

                    if ($s->type == 1) {
                      echo "<span class='badge badge-info'>Penambahan</span>";
                    } elseif ($s->type == 2) {
                      echo "<span class='badge badge-danger'>Pengurangan</span>";
                    } else {
                      echo "<span class='badge badge-default'>Lain-lain</span>";
                    }

                    echo "</td>
                    <td>$s->time</td>
                    <td>";

                    if ($s->type == 1) {
                      echo "+$s->stock_update";
                    } elseif ($s->type == 2) {
                      echo "-$s->stock_update";
                    } else {
                      echo "$s->stock_update";
                    }

                    // echo " $s->unit</td>
                    echo "</td>
                    <td><textarea class='form-control' readonly>$s->note</textarea></td>
                    <td class='text-center'>
                      <a href='" . base_url('admin/master/del/stock/') . "$s->id' onclick=\"return confirm('Anda yakin ingin menghapus update stok ini?')\" class='btn btn-icon btn-outline-danger has-ripple'><i class='feather icon-trash-2'></i></a>
                    </td>
                    </tr>";
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">

            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <h5>Daftar Transaksi <?php echo $product->name ?></h5>
              </div>
              <div class="col-sm-6 text-right ">
                <?php
                $total_sell = $product->stock_plus - $product->stock_min;
                  echo "<button type='button' class='btn btn-sm btn-secondary has-ripple'>Total : <span class='badge badge-light'>$current_stock</span><span class='ripple ripple-animate'></span></button>";
               
                ?>
              </div>
            </div>
          </div>

          <div class="card-body">

            <div class="table-responsive">
              <table id="table_stock_product_list_trans" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="30%">Produk</th>
                    <th width="10%" class="text-center">Tipe</th>
                    <th width="10%">Waktu Update</th>
                    <th width="10%">Jumlah</th>
                    <th width="30%">Catatan</th>
                    <th width="5%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 0;
                  foreach ($stock as $s) {
                    $i++;
                    echo "<tr>
                    <td class='text-center'>$i</td>
                    <td>$s->product</td>
                    <td class='text-center'>";

                    if ($s->type == 1) {
                      echo "<span class='badge badge-info'>Penambahan</span>";
                    } elseif ($s->type == 2) {
                      echo "<span class='badge badge-danger'>Pengurangan</span>";
                    } else {
                      echo "<span class='badge badge-default'>Lain-lain</span>";
                    }

                    echo "</td>
                    <td>$s->time</td>
                    <td>";

                    if ($s->type == 1) {
                      echo "+$s->stock_update";
                    } elseif ($s->type == 2) {
                      echo "-$s->stock_update";
                    } else {
                      echo "$s->stock_update";
                    }

                    // echo " $s->unit</td>
                    echo "</td>
                    <td><textarea class='form-control' readonly>$s->note</textarea></td>
                    <td class='text-center'>
                      <a href='" . base_url('admin/master/del/stock/') . "$s->id' onclick=\"return confirm('Anda yakin ingin menghapus update stok ini?')\" class='btn btn-icon btn-outline-danger has-ripple'><i class='feather icon-trash-2'></i></a>
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

<?php $this->load->view('admin/_/footer'); ?>


<div class="modal fade" id="modal_add_stock" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Update Stok<br><?php echo $product->name; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="<?php echo base_url('admin/transaction/add/stock/'); ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <!-- <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="id_product">Produk</label>
                <select id="id_product" class="form-control" name="id_product" required>
                  <?php foreach ($product_list as $p) {
                    echo "<option value='$p->id'>$p->name</option>";
                  }
                  ?>
                </select>
              </div>
            </div> -->
            <input type="hidden" name="id_product" value="<?php echo $product->id ?>">
            <div class="col-md-8">
              <div class="form-group">
                <label class="form-control-label" for="type">Tipe Update</label>
                <select id="type" class="form-control" name="type" required>
                  <option value="1">Penambahan</option>
                  <option value="2">Pengurangan</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label" for="stock_update">Jumlah</label>
                <input type="number" name="stock_update" class="form-control" id="stock_update" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="note">Catatan</label>
                <textarea class="form-control" name="note" id="note"></textarea>
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