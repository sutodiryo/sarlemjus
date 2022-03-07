<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo $title; ?></h5>
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

          <div class="card-body">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <!-- <button class="btn btn-secondary btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_tambah_member"><i class="feather icon-filter"></i> Filter</button> -->
              </div>
              <div class="col-sm-6 text-right ">
                <!-- <a data-toggle="modal" href="#modal_add_stock" class="btn btn-info btn-sm btn-round has-ripple"><i class="feather icon-plus"></i> Update Stok</a> -->
              </div>
            </div>

            <div class="table-responsive">
              <table id="table_stock_product" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="45%">Produk</th>
                    <th width="30%">Info</th>
                    <th width="20%" class="text-center">Stok</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 0;
                  foreach ($product as $p) {
                    $i++;
                    $stock = $p->stock_plus - $p->stock_min;
                    echo "<tr>
                    <td class='text-center'>$i</td>
                    <td><a href='" . base_url('admin/stock/') . "$p->id'>$p->name</a></td>
                    <td><textarea class='form-control' readonly style='font-size:80%;'>$p->description</textarea></td>
                    <td class='text-center'><h4><span class='badge badge-info'>$stock</span></h4></td>
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