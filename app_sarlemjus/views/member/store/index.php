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
        <!-- <div class="card">
          <div class="card-body">
            <div class="row align-items-center m-l-0">
              <div class="col-sm-6">
              </div>
              <div class="col-sm-6 text-right">
                <a data-toggle="modal" href="#modal_cart" class="btn btn-primary"><i class="feather icon-shopping-cart"></i> Keranjang Belanja</a>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">

          <?php foreach ($product as $p) {
            $stock = $p->stock_plus - $p->stock_min;
            ?>

            <div class="col-md-6 col-xl-4">
              <div class="card mb-3">
                <img class="img-fluid card-img-top" src="<?= "" . base_url('public/upload/product/') . "$p->image" ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?= $p->name ?></h5>
                  <!-- <p class="card-text"><?= idr($p->selling_price) ?></p> -->
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-yellow"><?= idr($p->selling_price) ?></h4>
                      <h6 class="text-muted m-b-0">Stok : <?= $stock >= 1  ? "$stock $p->unit" : "<span style='color:red;'>$stock $p->unit</span>"; ?></h6>
                    </div>
                    <div class="col-4 text-center">
                      <input <?= $stock >= 1  ? "" : "disabled"; ?> type='number' name='quantity' id='qty_<?= $p->id ?>' value='1' min='1' max='<?= $stock ?>' class='quantity form-control form-control-sm'>
                      <p class="text-muted m-b-0">Quantity (<?= $p->unit ?>)</p>
                      
                      <!-- <i class="feather icon-bar-chart-2 f-28"></i> -->
                    </div>
                  </div>

                  <!-- <button class='add_cart btn btn-icon btn-info' data-produkid='<?= $p->id ?>'><i class='fas fa-cart-plus'></i></button> -->
                  <!-- <p class="card-text"><?= substr($c->article, 0, 200) ?> . . .</p> -->
                  <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                  <!-- <a class="btn btn-primary btn-sm has-ripple" href="<?= base_url('member/course/detail/') . $c->slug ?>">Read More<span class="ripple ripple-animate"></span></a> -->
                </div>
                <button <?= $stock >= 1  ? "" : "disabled"; ?> class="card-footer bg-c-yellow add_cart" data-produkid='<?= $p->id ?>'>
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">Tambah ke keranjang</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-shopping-cart text-white f-16"></i>
                    </div>
                  </div>
                </button>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </div>


  </div>
</div>

<?php $this->load->view('member/_/footer'); ?>