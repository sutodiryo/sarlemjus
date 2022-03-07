<?php $this->load->view('admin/_/header'); ?>

<!-- Header -->
<div class="header pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a data-toggle="modal" href="#modal_add_notification_msg" class="btn btn-sm btn-neutral" title="Tambah Pesan Notifikasi Baru"><i class="fa fa-plus"></i> Notifikasi Baru</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">

        <div class="table-responsive py-4">
          <table class="table table-flush" id="datatable-buttons">
            <thead class="thead-light">
              <tr>
                <th width="1%">No</th>
                <th width="20%">Judul</th>
                <th width="40%">Isi</th>
                <th width="25%">Action Link</th>
                <th width="10%">Update Terakhir</th>
                <th width="4%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $no = 0;
              foreach ($msg as $m) {
                $no++;

                echo "<tr>
                          <td>$no</td>
                          <td>$m->title</td>
                          <td><textarea class='form-control' readonly  style=\"font-size:10px;\">$m->body</textarea></td>
                          <td><a href='$m->action_link' target='_blank'>$m->action_link</a></td>
                          <td>$m->last_update<br>$m->level_member</td>
                          <td class='text-center'>
                              <a data-toggle='modal' href='#modal_send_notification_msg_$m->id_push_notification_msg' class='table-action text-success' title='Kirim Pesan Notifikasi'>
                              <i class='fa fa-user-edit'></i>
                              </a>
                              <a href='javascript:void(0)' onclick=\"push_notification_msg('$m->id_push_notification_msg')\" class='table-action' data-toggle='tooltip' data-original-title='Edit Pesan Notifikasi'>
                              <i class='fa fa-edit'></i>
                              </a>
                              <a href='" . base_url('admin/del/push_notification_msg/') . "$m->id_push_notification_msg/' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Promo'>
                              <i class='fas fa-trash'></i>
                              </a>
                          </td>
                      </tr>";
              } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-12">
        <div class="copyright text-center text-lg-center text-muted">
          &copy; <?php echo date('Y'); ?> <a href="https://najahnet.id" class="font-weight-bold ml-1" target="_blank">Najah Network</a>
        </div>
      </div>
    </div>
  </footer>
</div>


<div class="modal fade" id="modal_add_notification_msg" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Pesan Notifikasi Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="<?php echo base_url('admin/add/push_notification_msg'); ?>" method="POST">
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="title">Judul Pesan</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Judul Pesan Notifikasi" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="body">Isi Pesan</label>
                <textarea name="body" class="form-control" id="body" rows="3" required placeholder="Isi Pesan Notifikasi"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="action_link">Link Action</label>
                <input type="text" name="action_link" class="form-control" id="action_link" placeholder="Link Aksi Notifikasi" required>
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

<div class="modal fade" id="modal_push_notification_msg" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="<?php echo base_url('admin/act/update_push_notification_msg/0'); ?>" method="POST">
        <input type="hidden" name="id_push_notification_msg">
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="title_edt">Judul Pesan</label>
                <input type="text" name="title_edt" class="form-control" id="title_edt" placeholder="Judul Pesan Notifikasi" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="body_edt">Isi Pesan</label>
                <textarea name="body_edt" class="form-control" id="body_edt" rows="3" required placeholder="Isi Pesan Notifikasi"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="action_link_edt">Link Action</label>
                <input type="text" name="action_link_edt" class="form-control" id="action_link_edt" placeholder="Link Aksi Notifikasi" required>
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


<?php foreach ($msg as $msg) {
  ?>

  <div class="modal fade" id="modal_send_notification_msg_<?php echo $msg->id_push_notification_msg ?>" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Pesan Notifikasi Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">

          <div class="row">
            <?php foreach ($level as $l) {
                if ($l->id_member_level == 0) {
                  $col = "danger";
              } else if ($l->id_member_level == 1) {
                  $col = "warning";
              } else if ($l->id_member_level == 2) {
                  $col = "primary";
              } else if ($l->id_member_level == 3) {
                  $col = "info";
              } else if ($l->id_member_level == 4) {
                  $col = "success";
              } else {
                  $col = "default";
              }
                echo "<div class='col-md-12'>
                        <div class='form-group'>
                          <a href='" . base_url('admin/send_push_notification/') . "send_now/$l->id_member_level/$msg->id_push_notification_msg' onclick=\"return confirm('Anda yakin ingin mengirim notifikasi ke semua member $l->nama_level?')\" class='btn btn-$col btn-lg btn-block'>Kirim Pesan ke member $l->nama_level</a>
                        </div>
                      </div>";
              } ?>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </div>
      </div>
    </div>
  </div>

<?php
} ?>



<?php $this->load->view('admin/_/footer'); ?>

<script type="text/javascript">
  function push_notification_msg(id) {
    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo base_url('admin/get/push_notification_msg') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_push_notification_msg"]').val(data.id_push_notification_msg);
        $('[name="title_edt"]').val(data.title);
        $('[name="body_edt"]').val(data.body);
        $('[name="action_link_edt"]').val(data.action_link);

        $('#modal_push_notification_msg').modal('show');
        $('.modal-title').text('Edit Promo');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax server');
      }
    });
  }
</script>