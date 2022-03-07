<?php $this->load->view('admin/_/header'); ?>

<div class="pcoded-main-container">
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
              <li class="breadcrumb-item"><a>Course</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <?php echo $this->session->flashdata('report'); ?>
          <div class="card-body">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6"></div>
              <div class="col-sm-6 text-right ">
                <button class="btn btn-info btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_add_course_category"><i class="feather icon-plus"></i> Tambah Kategori</button>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_course" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="40%">Kategori Course</th>
                    <th width="25%" class="text-center">Akses Member</th>
                    <th width="15%" class="text-center"></th>
                    <th width="15%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no = 0;
                  foreach ($course as $c) {
                    $no++;
                    echo "<tr>
                            <td><h5>$no</h5></td>
                            <td><img src='" . base_url() . "public/upload/course/category/$c->cover' class='img-radius' width='30px' height='30px'> $c->name</td>
                            <td class='text-center'>";

                    if ($c->tot_access > 0) {
                      $q =  $this->db->query("SELECT (SELECT name FROM member_level WHERE id=course_acces.id_member_level) AS level FROM course_acces WHERE id_course_category='$c->id'")->result();
                      foreach ($q as $l) {
                        echo "<span class='badge badge-info'>$l->level</span> ";
                      }
                    } else {
                      echo "<span class='badge badge-dark'>Belum ada</span> ";
                    }

                    echo "</td>
                            <td class='text-center'><a href='" . base_url('admin/master/course_list/') . "$c->id' class='btn btn-sm btn-info'><i class='feather icon-eye'></i> Detail Course</a></td>
                            <td class='text-center'>";
                            
                    if ($c->tot_access < 1) {
                      echo "<a href='javascript:void(0)' onclick=\"add_course_category_access('$c->id')\" class='btn btn-sm btn-info' title='Tambah akses ke : $c->name'><i class='feather icon-user-check'></i></a>";
                    }

                    echo "<a href='#' class='btn btn-sm btn-success' title='Edit $c->name'><i class='feather icon-edit'></i></a>
                              <a href='#' class='btn btn-sm btn-danger' title='Hapus $c->name' onclick=\"return confirm('Anda yakin ingin menghapus data ini ?');\" ><i class='feather icon-trash'></i></a>
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

<script type="text/javascript">
  function edit_course_category(id_course_category) {
    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo base_url('admin/get/course_category') ?>/" + id_course_category,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id"]').val(data.id);
        $('[name="id_upline"]').val(data.id_upline);
        $('[name="nama"]').val(data.nama);
        $('[name="no_hp"]').val(data.no_hp);
        $('[name="email"]').val(data.email);
        $('[name="level"]').val(data.level);
        $('[name="kota"]').val(data.id_location);
        $('[name="alamat"]').val(data.alamat);

        $('#modal_edit_course_category').modal('show');
        $('.modal-title').text('Edit Kategori');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax server');
      }
    });
  }

  function add_course_category_access(id) {
    $.ajax({
      url: "<?php echo base_url('api/get/course_category/') ?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.name);

        $('#modal_add_course_category_access').modal('show');
        $('.modal-title').text('Set Akses Member');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax server');
      }
    });
  }
</script>

<div class="modal fade" id="modal_add_course_category" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori Kelas Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('admin/master/act/add_course_category/0'); ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="name">Nama Kategori Kelas</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Nama Kategori" required>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label class="form-control-label" for="cover">Cover</label>
              <input type="file" class="form-control" id="cover" name="cover" placeholder="Cover">
            </div>
          </div>
          <!-- <div class="col-sm-12">
            <div class="form-group fill">
              <label class="form-control-label">Akses Member Level</label>
              <br>
              <?php foreach ($member_level as $ml) {
                echo "<div class='form-check'>
                                    <input name='member_level[]' class='form-check-input' type='checkbox' value='$ml->id' id='ml_$ml->id'>
                                    <label class='form-check-label' for='ml_$ml->id''>$ml->name</label>
                                </div>";
              } ?>
            </div>
          </div> -->
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

<div class="modal fade" id="modal_add_course_category_access" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="<?php echo base_url('admin/master/act/add_course_category_access/0'); ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" name="id" id="id">
                <input type="text" name="name" class="form-control" id="name" disabled>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <?php foreach ($member_level as $ml) {
                  echo "<div class='form-check'>
                                    <input name='member_level[]' class='form-check-input' type='checkbox' value='$ml->id' id='ml_$ml->id'>
                                    <label class='form-check-label' for='ml_$ml->id''>$ml->name</label>
                                </div>";
                } ?>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>