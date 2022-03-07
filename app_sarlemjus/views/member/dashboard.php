<?php $this->load->view('member/_/header'); ?>

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
            
            <!-- <div class="col-md-12 col-xl-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Halooo!</strong> Selamat datang.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Belanja Rp 00000 lagi dan dapatkan bonus ***** dari sarlemjus...</h5>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-12 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h6 class="text-white">Revenue</h6>
                        <h2 class="text-white">$42,562</h2>
                        <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10"></i></p>
                        <i class="card-icon feather icon-filter"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-body">
                        <h6 class="text-white">Orders Received</h6>
                        <h2 class="text-white">486</h2>
                        <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10 m-r-10"></i>$1,055 <i class="feather icon-arrow-down"></i></p>
                        <i class="card-icon feather icon-users"></i>
                    </div>
                </div>
            </div> -->

            <div class="col-xl-12 col-md-6">

                <?php echo $this->session->flashdata('report'); ?>

                <?php foreach ($notice as $nt) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>$nt->title</h4>
                    <hr>
                    <p class='mb-0'>$nt->content</p>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    </div>";
                } ?>

                <div class="card table-card">
                    <div class="card-header">
                        <h5>Top Pembelian Bulan Ini</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="stock-scroll" style="position:relative;">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Peringkat</th>
                                            <th class="text-left">Nama Member</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-right">Total Pembelian</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 0;
                                        foreach ($top as $t) {
                                            $no++;
                                            echo "<tr>
                                                    <td class='text-center'><h5>$no</h5></td>
                                                    <td><h5>$t->name</h5></td>
                                                    <td class='text-center'><label class='badge badge-light-dark'>$t->level</label></td>
                                                    <td class='text-right'><h4>" . idr($t->total) . "</h4></td>
                                                </tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="card table-card">
                    <div class="card-header">
                        <h5>Top Rekrut</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="stock-scroll" style="position:relative;">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Peringkat</th>
                                            <th>Nama Member</th>
                                            <th>Level</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <h4>1</h4>
                                            </td>
                                            <td>
                                                <h4>Sofa</h4>
                                            </td>
                                            <td><label class="badge badge-light-danger">Out Stock</label></td>
                                            <td>
                                                <a href="#!"><i class="fa fa-star f-14 text-c-yellow"></i></a>
                                                <a href="#!"><i class="fa fa-star f-14 text-c-yellow"></i></a>
                                                <a href="#!"><i class="fa fa-star f-14 text-c-yellow"></i></a>
                                                <a href="#!"><i class="fa fa-star f-14 text-muted"></i></a>
                                                <a href="#!"><i class="fa fa-star f-14 text-muted"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

        </div>
    </div>

    <?php $this->load->view('member/_/footer'); ?>