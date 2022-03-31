<?php $this->load->view('guest/_/header'); ?>

<section class="blog-section pt-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="left-side-wrapper">
                    <div class="row">

                        <!--
                        <div class='col-md-4 col-lg-12 col-xl-4'>
                            <div class='single-blog mb-40 wow fadeInUp' data-wow-delay='.2s' style='visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;'>
                                <div class='blog-img'>
                                    <a href='blog-single.html'><img src='assets/img/blog/blog-1.jpg' alt=''></a>
                                    <span class='date-meta'>15 June, 2025</span>
                                </div>
                                <div class='blog-content'>
                                    <h4><a href='blog-single.html'>Start a Business Guide</a></h4>
                                    <p>Lorem ipsum dolor sit amet, adipscing elitr, sed diam nonumy eirmod
                                        tempor
                                        ividunt dolore
                                        magna.</p>
                                    <a href='blog-single.html' class='read-more-btn'>Read More <i class='lni lni-arrow-right'></i></a>
                                </div>
                            </div>
                        </div>
                        -->

                        <?php
                        foreach ($product as $p) {
                            $stock = $p->stock_plus - $p->stock_min;

                            echo "<div class='col-md-4 col-lg-12 col-xl-4'>
                                    <div class='single-blog mb-40 wow fadeInUp' data-wow-delay='.2s' style='visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;'>
                                        <div class='blog-img'>
                                            <a href='blog-single.html'><img src='" . base_url('public/upload/product/') . "" . $p->image . "' alt=''></a>";
                            if ($stock > 0) {
                                echo "<span class='date-meta' style='background-color:#00ca4c; color:white;'>$stock $p->unit</span>";
                            } else {
                                echo "<span class='date-meta' style='background-color:#c2c4c8; color:white;'>Stok Habis</span>";
                            }


                            echo "</div>
                                        <div class='blog-content'>                    
                                        <h4><a href='" . base_url() . "'>$p->name</a></h4>
                                        <p>" . idr($p->selling_price) . "</p>
                                        <p>Lorem ipsum dolor sit amet, adipscing elitr, sed diam nonumy eirmod tempor ividunt dolore magna.</p>"; ?>

                            <div class="col-md-12">
                                <div class="row">
                                    <!--
                                    <div class="col-sm-4">
                                        <input <?= $stock >= 1  ? "" : "disabled"; ?> type='number' name='quantity' id='qty_<?= $p->id ?>' value='1' min='1' max='<?= $stock ?>' class="checkout-input">
                                    </div>
                                    -->
                                    <!-- <div class="col-sm-8" style="align-content: right;"> -->
                                    <button <?= $stock >= 1  ? "" : "disabled"; ?> class="theme-btn border-btn" onclick="btn_add_to_cart('<?= $p->id ?>','<?= $stock ?>')">Beli <i class='lni lni-cart'></i></button>
                                    <!-- </div> -->
                                </div>
                            </div>
                        <?php
                            // echo "<a href='blog-single.html' class='read-more-btn'>Read More <i class='lni lni-arrow-right'></i></a>
                            echo "
                                                </div>
                                            </div>
                                        </div>";
                        }
                        ?>

                    </div>
                </div>
</section>

<!-- <section class="portfolio-section pt-130">
    <div id="container" class="container">
    </div>
    <div class="row grid">
        <?php
        foreach ($product as $p) {
            $stock = $p->stock_plus - $p->stock_min;

            echo "<div class='col-lg-4 col-md-6 grid-item branding'>
                <div class='portfolio-item-wrapper'>
                    <div class='portfolio-img'>
                        <img src='" . base_url('public/upload/product/') . "" . $p->image . "' alt=''>
                    </div>
                    <div class='portfolio-overlay'>
                        <div class='overlay-content'>
                            <h4>$p->name</h4>
                            <p>" . idr($p->selling_price) . "</p>
                            <p>We Crafted an awesome design library that is robust and intuitive to business presentation.</p>"; ?>

            <input <?= $stock >= 1  ? "" : "disabled"; ?> type='number' name='quantity' id='qty_<?= $p->id ?>' value='1' min='1' max='<?= $stock ?>' class='quantity form-control form-control-sm'>
            <button <?= $stock >= 1  ? "" : "disabled"; ?> class="theme-btn border-btn" onclick="btn_add_to_cart('<?= $p->id ?>','<?= $stock ?>')">Beli</button>

        <?php echo "<a href='" . base_url() . "' class='theme-btn border-btn'>Detail</a>
                        </div>
                    </div>
                </div>
            </div>";
        } ?>

    </div>
    </div>
</section> -->

<?php $this->load->view('guest/_/footer'); ?>