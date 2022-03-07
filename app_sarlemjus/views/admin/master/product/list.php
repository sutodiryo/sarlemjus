<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?= $title ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a>Member</a></li>
              <!-- <li class="breadcrumb-item"><a href="<?= base_url('admin/member/all') ?>">Member</a></li> -->
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
                <!-- <button class="btn btn-info btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_tambah_member"><i class="feather icon-filter"></i> Filter</button> -->
              </div>
              <div class="col-sm-6 text-right ">
                <a class="btn btn-info btn-sm btn-round has-ripple" href="<?= base_url('admin/master/add/product') ?>"><i class="feather icon-plus"></i> Tambah Produk</a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_product" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="30%" class="text-center">Nama Produk</th>
                    <th width="25%" class="text-center">Deskripsi</th>
                    <th width="15%" class="text-center">Satuan</th>
                    <th width="15%" class="text-center">Harga</th>
                    <!-- <th width="10%" class="text-center">Stok</th> -->
                    <th width="10%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no = 0;
                  foreach ($product as $p) {
                    $no++;
                    echo "<tr>
                    <td class='align-middle text-center'>$no</td>
                    <td class='align-middle'>
                      <img src='" . base_url('public/upload/product/') . "$p->image' alt='$p->name' title='$p->name' class='rounded mr-3' height='48' />
                      <p class='m-0 d-inline-block align-middle font-16'><a href='" . base_url() . "' class='text-body'>$p->name</a></p>
                    </td>
                    <td><textarea class='form-control' disabled style=\"font-size:80%;\">$p->description</textarea></td>
                    <td class='text-center'>$p->unit</td>
                    <td>" . idr($p->selling_price) . "</td>";

                    // <td class='text-center'>";
                    // $stock = $this->db->query("SELECT id_unit,type,
                    //                                   SUM(stock_update) AS total,
                    //                                   product_unit.name AS unit
                    //                                 FROM product_stock
                    //                                 JOIN product_unit ON product_unit.id=product_stock.id_unit
                    //                                 WHERE id_product='$p->id'
                    //                                 GROUP BY id_unit")->result();

                    // (SELECT SUM(stock_update) FROM product_stock WHERE type=1) AS total_plus,
                    // (SELECT SUM(stock_update) FROM product_stock WHERE type IN (0,2)) AS total_min,
                    // var_dump($q);

                    // foreach ($stock as $sp) {

                    //   if (empty($sp->total) || $sp->total < 1) {
                    //     echo "<span class='badge badge-pill badge-dark'>Kosong</span><br>";
                    //   } elseif ($sp->total >= 1 && $sp->total <= 10) {
                    //     echo "<span class='badge badge-pill badge-danger'>$sp->total $sp->unit</span><br>";
                    //   } elseif ($sp->total > 10 && $sp->total <= 50) {
                    //     echo "<span class='badge badge-pill badge-warning'>$sp->total $sp->unit</span><br>";
                    //   } elseif ($sp->total > 50) {
                    //     echo "<span class='badge badge-pill badge-success'>$sp->total $sp->unit</span><br>";
                    //   }
                    // }

                    // $stock = $p->stock_plus - $p->stock_min;
                    // echo "</td>

                    echo "<td class='align-middle text-center'>
                      <div class='btn-group mb-2 mr-2'>
                      <button class='btn btn-outline-secondary dropdown-toggle btn-sm has-ripple' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action<span class='ripple ripple-animate' style='height: 118.875px; width: 118.875px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -31.8125px; left: -7.5px;'></span></button>
                      <div class='dropdown-menu' style=''>
                          <a class='dropdown-item badge-info' href='" . base_url('admin/master/product_stock/') . "$p->id' target='_blank'><i class='feather icon-layers'></i> Update Stock</a>
                          <a class='dropdown-item badge-secondary' href='#!'><i class='feather icon-tag'></i> Harga Member</a>
                          <a class='dropdown-item badge-success' href='#!'><i class='feather icon-edit'></i> Edit</a>
                          <div class='dropdown-divider'></div>
                          <a class='dropdown-item badge-danger' href='#!' onclick=\"return confirm('Anda yakin ingin menghapus data ini ?');\" ><i class='feather icon-trash-2'></i> Hapus</a>
                      </div>
                      </div>
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