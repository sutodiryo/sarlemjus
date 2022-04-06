<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-4">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h6 class="text-white">Omset Bulan Ini</h6>
                        <h2 class="text-white"><?= idr(($monthly_income->total + $monthly_income->shipping_costs)) ?></h2>
                        <!-- <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10"></i></p> -->
                        <i class="card-icon feather icon-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card bg-c-green order-card">
                    <div class="card-body">
                        <h6 class="text-white">Total Member</h6>
                        <h2 class="text-white"><?= $member_stat ?></h2>
                        <!-- <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10 m-r-10"></i>$1,055 <i class="feather icon-arrow-down"></i></p> -->
                        <i class="card-icon feather icon-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h6 class="text-white">Produk Terjual</h6>
                        <h2 class="text-white"><?= $produk_stat->quantity ?></h2>
                        <!-- <p class="m-b-0">$5,032 <i class="feather icon-arrow-down m-l-10 m-r-10"></i>$1,055 <i class="feather icon-arrow-up"></i></p> -->
                        <i class="card-icon feather icon-tag"></i>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-12 col-md-12">
                <div class="card ">
                    <div class="card-body ">
                        <h2 class="text-center f-w-400 "><?= idr(($monthly_income->total + $monthly_income->shipping_costs)) ?></h2> -->
                        <!-- <h2 class="text-center f-w-400 "><?= idr((($monthly_income->total + $monthly_income->shipping_costs) - $monthly_income->discount_value)) ?></h2> -->
                        <!-- <p class="text-center text-muted ">Monthly Profit</p>
                        <div id="monthlyprofit-1"></div>
                    </div>
                </div>
            </div> -->


            <div class="col-xl-12 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h2>Order Terbaru</h2>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <!-- <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="stock-scroll" style="height:500px;position:relative;">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Name</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($last_sales as $ls) {
                                            echo "<tr>
                                                <td><a href='#' target='_blank'>#$ls->invoice_number</a></td>
                                                <td>$ls->member_name</td>
                                                <td class='text-right'>" . idr($ls->total) . "</td>
                                                <td class='text-center'><label class='badge badge-light-danger'>Out Stock</label></td>
                                            </tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- order  end -->
            <!-- Latest Customers start -->
            <!-- <div class="col-lg-8 col-md-12">
                <div class="card table-card review-card">
                    <div class="card-header borderless ">
                        <h5>Customer Reviews</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="review-block">
                            <div class="row">
                                <div class="col-sm-auto p-r-0">
                                    <img src="<?php echo ASSETS ?>images/user/avatar-2.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                                </div>
                                <div class="col">
                                    <h6 class="m-b-15">John Deo <span class="float-right f-13 text-muted"> a week ago</span></h6>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                                    <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                                    <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-auto p-r-0">
                                    <img src="<?php echo ASSETS ?>images/user/avatar-4.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                                </div>
                                <div class="col">
                                    <h6 class="m-b-15">Allina D’croze <span class="float-right f-13 text-muted"> a week ago</span></h6>
                                    <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                                    <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                    <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                                    <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                                    <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                                    <blockquote class="blockquote m-t-15 m-b-0">
                                        <h6>Allina D’croze</h6>
                                        <p class="m-b-0 text-muted">Lorem Ipsum is simply dummy text of the industry.</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="text-right  m-r-20">
                            <a href="#!" class="b-b-primary text-primary">View all Customer Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card ">
                    <div class="card-body ">
                        <h2 class="text-center f-w-400 ">$45,567</h2>
                        <p class="text-center text-muted ">Monthly Profit</p>
                        <div id="monthlyprofit-1"></div>
                        <div class="m-t-20">
                            <div class="row ">
                                <div class="col-6 text-center ">
                                    <h6 class="f-20 f-w-400">$6,234</h6>
                                    <p class="text-muted f-14 m-b-0">Today</p>
                                </div>
                                <div class="col-6 text-center ">
                                    <h6 class="f-20 f-w-400">$4,387</h6>
                                    <p class="text-muted f-14 m-b-0">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body ">
                        <h2 class="text-center f-w-400 ">2,413</h2>
                        <p class="text-center text-muted ">Total Sales</p>
                        <div id="monthlyprofit-2"></div>
                        <div class="m-t-20">
                            <div class="row ">
                                <div class="col-6 text-center ">
                                    <h6 class="f-20 f-w-400">1578</h6>
                                    <p class="text-muted f-14 m-b-0">Today</p>
                                </div>
                                <div class="col-6 text-center ">
                                    <h6 class="f-20 f-w-400">1028</h6>
                                    <p class="text-muted f-14 m-b-0">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        </div>
    </div>
</div>
<?php $this->load->view('admin/_/footer'); ?>