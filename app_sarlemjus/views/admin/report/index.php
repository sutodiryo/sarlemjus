<?php $this->load->view('admin/_/header'); ?>

<section class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?php echo $title ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/master/course') ?>">Course</a></li>
              <li class="breadcrumb-item"><a>List</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <h5><?php echo $course->name ?></h5>
              </div>
              <div class="col-sm-6 text-right ">
                <button class="btn btn-info btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_add_course_category"><i class="feather icon-plus"></i> Tambah Course</button>
                <a class="btn btn-danger btn-sm btn-round has-ripple" href="<?php echo base_url('admin/master/course') ?>"><i class="feather feather icon-arrow-left"></i> Kembali</a>
              </div>
            </div>
          </div>
          <!-- <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-3.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div> -->
          <!-- <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe allowfullscreen="" src="http://player.vimeo.com/video/49614043?title=0&amp;byline=0&amp;portrait=0"></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe allowfullscreen="" src="http://player.vimeo.com/video/49614043?title=0&amp;byline=0&amp;portrait=0"></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe allowfullscreen="" src="http://player.vimeo.com/video/49614043?title=0&amp;byline=0&amp;portrait=0"></iframe>
                    </div>
                    <div class="mt-3 text-center">
                      <h5 class="job-card-desc">Job Description</h5>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
                      <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/iGkl34KTRaU"></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/iGkl34KTRaU"></iframe>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-6">
                <div class="thumbnail mb-4">
                  <div class="thumb">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/iGkl34KTRaU"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>

      <div class="col-sm-12 gallery-masonry">
        <div class="card-columns">

          <?php foreach ($course_youtube as $cy) { ?>

            <div class="card">
              <div class="thumbnail">
                <div class="thumb">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://youtube.com/embed/<?php echo $cy->media_link ?>"></iframe>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h5 class="job-card-desc"><?php echo $cy->title ?></h5>
                <p><?php echo $cy->description ?></p>
                <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
                <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
              </div>
            </div>

          <?php } ?>
          <!-- <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-3.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div>
          <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-4.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div>
          <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-5.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div>
          <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-8.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div>
          <div class="card">
            <img class="img-fluid card-img-top" src="assets/images/gallery-grid/masonry-2.jpg" alt="Card image">
            <div class="card-body">
              <h5 class="job-card-desc">Job Description</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <div class="job-meta-data mb-1"><i class="fas fa-map-marker-alt"></i>washington</div>
              <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('admin/_/footer'); ?>