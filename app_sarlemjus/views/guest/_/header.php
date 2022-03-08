<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Sarlemjus | Minuman kesehatan yang sudah teruji khasiat dan manfaatnya</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo FRONT_ASSETS ?>img/favicon.png">

  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/bootstrap-5.0.0-beta1.min.css">
  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/LineIcons.2.0.css">
  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/animate.css">
  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/tiny-slider.css">
  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/glightbox.min.css">
  <link rel="stylesheet" href="<?php echo FRONT_ASSETS ?>css/main.css">
</head>

<body>
  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <header class="header navbar-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12" style="float: left;">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="<?= base_url() ?>">
              <img src="<?php echo FRONT_ASSETS ?>img/logo-1.svg" alt="Logo" style="max-height: 80px; @media (max-width: 767px) {max-height: 10px;}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
              <ul id="nav" class="navbar-nav ms-auto">
                <li class="nav-item"><a class="page-scroll" href="<?= base_url() ?>"><?php echo ($page == 'homepage') ? '<b>Home</b>' : 'Home'; ?></a></li>
                <!-- <li class="nav-item"><a class="page-scroll" href="<?= base_url('join') ?>"><?php echo ($page == 'join') ? '<b>Join Bisnis</b>' : 'Join Bisnis'; ?></a></li> -->
                <li class="nav-item"><a class="page-scroll" href="<?= base_url('about') ?>"><?php echo ($page == 'about') ? '<b>About Us</b>' : 'About Us'; ?></a></li>
                <!-- <li class="nav-item"><a class="page-scroll" href="<?= base_url('contact') ?>"><?php echo ($page == 'contact') ? '<b>Contact Us</b>' : 'Contact Us'; ?></a></li> -->
                <li class="nav-item"><a class="page-scroll" href="<?= base_url('lp') ?>">Blog</a></li>
                <li class="nav-item"><a class="page-scroll" href="<?= base_url('#') ?>"><?php echo ($page == 'shop') ? '<b>Shop</b>' : 'Shop'; ?></a></li>
              </ul>
              <a href="javascript:void(0)" class="theme-btn">Daftar/Login</a>
              <!--
              <form action="#" class="search-form">
                <input type="text" placeholder="Search">
                <button type="submit"><i class="lni lni-search-alt"></i></button>
              </form>
              -->
            </div>
          </nav>
        </div>
      </div>
    </div>

  </header>