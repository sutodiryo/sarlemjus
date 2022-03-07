<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?= MAIN_TITLE . $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?= MAIN_DESC ?>" />
    <meta name="keywords" content="<?= KEYWORDS ?>">
    <meta name="author" content="<?= AUTHOR ?>" />

    <link href="<?= FAVICON ?>" rel="icon">

    <?php if ($page == "dashboard") { ?>
        <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/dataTables.bootstrap4.min.css">
    <?php } elseif ($page == "transaction" || $page == "member" || $page == "product" || $page == "course" || $page == "notice" || $page == "bonus" || $page == "stock") { ?>

        <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/select2.min.css">
        <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/dataTables.bootstrap4.min.css">
        <?php if ($title = "Detail Member") { ?>

            <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/ekko-lightbox.css">
            <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/lightbox.min.css">
    <?php
        }
    }  ?>

    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css">
</head>

<body class="" id="body">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-2.jpg" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details"><?= $this->session->userdata('log_name') ?> <i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                            <!-- <li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li> -->
                            <li class="list-inline-item"><a href="<?= base_url('logout') ?>" onclick="return confirm('Anda yakin ingin keluar ?');" data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Menu</label>
                    </li>

                    <li class="nav-item <?php if ($page == "dashboard") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li> <!-- fas fa-tachometer-alt -->

                    <li class="nav-item <?php if ($page == "transaction") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/transaction/list/all') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-shopping-cart"></i></span><span class="pcoded-mtext">Transaksi</span></a></li>

                    <li class="nav-item <?php if ($page == 'stock') : echo "active";
                                            endif; ?>"><a href="<?= base_url('admin/stock/product') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-cubes"></i></span><span class="pcoded-mtext">Stok</span></a></li>

                    <li class="nav-item pcoded-menu-caption">
                        <label>Master</label>
                    </li>

                    <li class="nav-item <?php if ($page == 'member') : echo "active";
                                            endif; ?>"><a href="<?= base_url('admin/member/list/all') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Member</span></a></li>

                    <!-- <li class="nav-item pcoded-hasmenu <?php if ($page == "member") {
                                                            echo "active pcoded-trigger";
                                                        } ?>">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Member</span></a>
                        <ul class="pcoded-submenu">
                            <li class="<?php if ($title == "Daftar Semua Member" || $title == "Daftar Member") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/member/list/all') ?>" class="has-ripple">Data Member<span class="ripple ripple-animate"></span></a></li>
                            <li class="<?php if ($title == "Brand Produk") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/member/level') ?>">Member Level</a></li>
                        </ul>
                    </li> -->

                    <li class=" nav-item pcoded-hasmenu <?php if ($page == "product") {
                                                            echo "active pcoded-trigger";
                                                        } ?>">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-tag"></i></span><span class="pcoded-mtext">Produk</span></a>
                        <ul class="pcoded-submenu">
                            <li class="<?php if ($title == "Master Produk" || $title == "Tambah Produk") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/master/product/all') ?>">Data Produk</a></li>
                            <li class="<?php if ($title == "Brand Produk") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/master/product_brand') ?>">Brand</a></li>
                            <li class="<?php if ($title == "Kategori Produk") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/master/product_category') ?>">Kategori</a></li>
                            <!-- <li class=" <?php if ($title == "Satuan Produk") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/master/product_unit') ?>">Satuan</a></li> -->
                        </ul>
                    </li>

                    <li class=" nav-item <?php if ($page == 'course') : echo "active";
                                            endif; ?>">
                        <a href="<?= base_url('admin/master/course') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-graduation-cap"></i></span><span class="pcoded-mtext">Course</span></a>
                    </li>

                    <li class=" nav-item <?php if ($page == 'notice') : echo "active";
                                            endif; ?>"><a href="<?= base_url('admin/master/notice') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-bell"></i></span><span class="pcoded-mtext">Pengumuman</span></a>
                    </li>

                    <!-- <li class=" nav-item <?php if ($page == 'bonus') : echo "active";
                                            endif; ?>"><a href="<?= base_url('admin/master/bonus') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-gift"></i></span><span class="pcoded-mtext">Bonus</span></a>
                    </li> -->

                    <li class=" nav-item pcoded-menu-caption">
                        <label>Laporan</label>
                    </li>

                    <li class="nav-item <?php if ($page == "report") {
                                            echo "active";
                                        } ?>"><a href="<?= base_url('admin/report') ?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-print"></i></span><span class="pcoded-mtext">Laporan</span></a></li>


                </ul>

            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <img src="<?= ASSETS ?>images/logo-mini.png" alt="" class="logo">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-shopping-cart"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0 text-center">Keranjang Belanja</h6>
                                <!-- <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div> -->
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="<?= ASSETS ?>images/user/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?= ASSETS ?>images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                                <span>John Doe</span>
                                <a href="auth-signin.html" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
    </header>