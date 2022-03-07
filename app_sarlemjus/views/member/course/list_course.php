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
        <div class="row">

          <?php foreach ($course as $c) { ?>

            <?php
              if ($c->tipe == 0) {
                ?>

              <div class="col-md-6 col-xl-4">
                <div class="card mb-3">
                  <img class="img-fluid card-img-top" src="<?= $c->media_link ?>" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?= $c->title ?></h5>
                    <!-- <p class="card-text"><?= $c->description ?></p> -->
                    <p class="card-text"><?= substr($c->article, 0, 200) ?> . . .</p>
                    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                    <a class="btn btn-primary btn-sm has-ripple" href="<?= base_url('member/course/detail/') . $c->slug ?>">Read More<span class="ripple ripple-animate"></span></a>
                  </div>
                </div>
              </div>

            <?php
              } elseif ($c->tipe == 1) {
                ?>

              <div class="col-lg-4 col-sm-6">
                <div class="card">
                  <div class="thumbnail">
                    <div class="thumb">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://youtube.com/embed/<?= $c->media_link ?>"></iframe>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="job-meta-data mb-1"><i class="fab fa-youtube"></i>Kelas Video</div>
                    <hr>
                    <h5 class="job-card-desc"><?= $c->title ?></h5>
                    <p><?= $c->description ?></p>
                  </div>
                </div>
              </div>

            <?php
              }
              ?>

          <?php } ?>

        </div>
      </div>
    </div>

  </div>
</div>

<?php $this->load->view('member/_/footer'); ?>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="text-center">
            <h3 class="mt-3">Welcome To <span class="text-primary">Able pro</span><sup>v8.0</sup></h3>
          </div>
          <div class="carousel-inner text-center">
            <div class="carousel-item active" data-interval="50000">
              <img src="assets/images/model/welcome.svg" class="wid-250 my-4" alt="images">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p class="f-16"><strong>Able pro v8.0</strong> will come with new Structure.</p>
                  <p class="f-16"> it include <strong>Gulp / npm support, UI kit, Live customizer improved version, New improved layouts with RTL support, 8+ New Admin Panels</strong></p>
                  <div class="row justify-content-center text-left">
                    <div class="col-md-10">
                      <h4 class="mb-3">Feature</h4>
                      <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> Gulp / npm support</p>
                      <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> UI kit</p>
                      <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> Live customizer improved version</p>
                      <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> New improved layouts with RTL support</p>
                      <p class="mb-2 f-16"><i class="feather icon-check-circle mr-2 text-primary"></i> 8+ New Admin Panels</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-interval="50000">
              <img src="assets/images/model/able-admin.jpg" class="img-fluid mt-0" alt="images">
            </div>
            <!-- <div class="carousel-item" data-interval="50000">
                            <img src="assets/images/model/welcome.svg" class="wid-250 my-4" alt="images">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <p class="f-16"><strong>Able pro v8.0</strong> will come with new Structure.</p>
                                    <p class="f-16"> it include  <strong>Gulp / npm support, UI kit, Live customizer improved version, New improved layouts with RTL support, 8+ New Admin Panels</strong></p>
                                </div>
                            </div>
                        </div> -->
          </div>

        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" style="transform:rotate(180deg);margin-bottom:-1px">
          <path class="elementor-shape-fill" fill="#4680ff" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
          </path>
          <path class="elementor-shape-fill" fill="#4680ff" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
          <path class="elementor-shape-fill" fill="#4680ff" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
        </svg>
        <div class="modal-body text-center bg-primary py-4">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
          </ol>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="ml-2">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="mr-2">Next</span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>