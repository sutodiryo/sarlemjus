<?php $this->load->view('admin/_/header'); ?>

<?php $this->session->set_userdata('referred_course_category', current_url()); ?>

<section class="pcoded-main-container">
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/master/course') ?>">Course</a></li>
              <li class="breadcrumb-item"><a>List</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">

        <?= $this->session->flashdata('report'); ?>

        <div class="card">
          <div class="card-header">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <h5><?= $course->name ?></h5>
              </div>
              <div class="col-sm-6 text-right ">
                <button class="btn btn-info btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_add_course"><i class="feather icon-plus"></i> Tambah Course</button>
                <a class="btn btn-danger btn-sm btn-round has-ripple" href="<?= base_url('admin/master/course') ?>"><i class="feather feather icon-arrow-left"></i> Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12 gallery-masonry">
        <div class="card-columns">

          <?php foreach ($course_youtube as $cy) { ?>

            <div class="card">
              <div class="thumbnail">
                <div class="thumb">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://youtube.com/embed/<?= $cy->media_link ?>"></iframe>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h5 class="job-card-desc"><?= $cy->title ?></h5>
                <p><?= $cy->description ?></p>
                <div class="job-meta-data mb-1"><i class="fab fa-youtube"></i>Kelas Video</div>
                <!-- <div class="job-meta-data"><i class="far fa-handshake"></i>10 Years</div> -->
                <hr>
                <a href='javascript:void(0)' onclick="edit_notice('<?= $cy->slug ?>')" type="button" class="btn btn-success has-ripple"><i class="feather mr-2 icon-edit"></i>Edit<span class="ripple ripple-animate"></span></a>
                <a href="<?= "" . base_url('admin/master/del/course/') . "$cy->slug"; ?>" onclick="return confirm('Anda yakin ingin menghapus kelas ini?')" type="button" class="btn btn-danger has-ripple"><i class="feather mr-2 icon-trash-2"></i>Hapus</a>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('admin/_/footer'); ?>


<script type="text/javascript">
  function get_slug() {

    let title = document.getElementById('title').value;

    $.ajax({
      url: "<?= base_url('api/get/slug/') ?>",
      method: "POST",
      data: {
        slug: title
      },
      success: function(data) {

        $('#slug').val(data);
      }
    });
  }

  function get_slug_edit() {

    let title = document.getElementById('title_edit').value;

    $.ajax({
      url: "<?= base_url('api/get/slug/') ?>",
      method: "POST",
      data: {
        slug: title
      },
      success: function(data) {

        $('#slug_edit').val(data);
      }
    });
  }


  function edit_notice(slug) {
    $.ajax({
      url: "<?= base_url('api/get/course/y/') ?>" + slug,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="slug"]').val(data.slug);
        $('[name="slug_edit"]').val(data.slug);
        $('[name="title_edit"]').val(data.title);
        $('[name="category"]').val(data.category);
        $('[name="media_link"]').val(data.media_link);
        $('[name="description"]').val(data.description);

        $('#modal_edit_course').modal('show');
        $('.modal-title').text('Edit Kelas');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax server');
      }
    });
  }
</script>

<div class="modal fade" id="modal_add_course" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('admin/master/act/add_course/' . $course->id . ''); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="title">Nama Kelas</label>
              <input type="text" class="form-control" name="title" id="title" onkeyup="get_slug()" placeholder="Nama Kelas" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="slug">Slug</label>
              <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly required>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="media_link">Link Youtube</label>
              <input type="text" class="form-control" name="media_link" id="media_link" placeholder="Link Youtube" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="description">Deskripsi</label>
              <textarea type="text" class="form-control" rows="3" name="description" id="description" placeholder="Deskripsi" required></textarea>
            </div>
          </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_edit_course" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('admin/master/act/update_course/' . $course->id . ''); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="title_edit">Nama Kelas</label>
              <input type="hidden" class="form-control" name="slug" required>
              <input type="text" class="form-control" name="title_edit" id="title_edit" onkeyup="get_slug_edit()" placeholder="Nama Kelas" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="slug_edit">Slug</label>
              <input type="text" class="form-control" name="slug_edit" id="slug_edit" placeholder="Slug" readonly required>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="media_link">Link Youtube</label>
              <input type="text" class="form-control" name="media_link" id="media_link" placeholder="Link Youtube" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="description">Deskripsi</label>
              <textarea type="text" class="form-control" rows="3" name="description" id="description" placeholder="Deskripsi" required></textarea>
            </div>
          </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>