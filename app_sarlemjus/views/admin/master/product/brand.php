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
              <li class="breadcrumb-item"><a>Member</a></li>
              <!-- <li class="breadcrumb-item"><a href="<?php echo base_url('admin/member/all') ?>">Member</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <!-- <button class="btn btn-info btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal_tambah_member"><i class="feather icon-filter"></i> Filter</button> -->
              </div>
              <div class="col-sm-6 text-right ">
                <a class="btn btn-info btn-sm btn-round has-ripple" href="<?php echo base_url('admin/master/add/brand') ?>"><i class="feather icon-plus"></i> Tambah Brand</a>
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_brand" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="50%">Nama Brand</th>
                    <th width="25%">Status</th>
                    <th width="20%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no = 0;
                  foreach ($brand as $b) {
                    $no++;
                    echo "<tr>
                    <td>$no</td>
                    <td>$b->name</td>
                    <td>$b->status Poin</td>
                    <td class='text-center'>
                      <div class='btn-group mb-2 mr-2'>
                      <button class='btn btn-outline-secondary dropdown-toggle btn-sm has-ripple' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action<span class='ripple ripple-animate' style='height: 118.875px; width: 118.875px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -31.8125px; left: -7.5px;'></span></button>
                      <div class='dropdown-menu' style=''>
                          <a class='dropdown-item badge-secondary' href='#!'><i class='feather icon-tag'></i> Harga Member</a>
                          <a class='dropdown-item badge-success' href='#!'><i class='feather icon-edit'></i> Edit</a>
                          <div class='dropdown-divider'></div>
                          <a class='dropdown-item badge-danger' href='#!' onclick=\"return confirm('Anda yakin ingin menghapus data ini ?');\" ><i class='feather icon-trash-2'></i> Hapus</a>
                      </div>
                      </div>
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


<script>
    $('#table_brand').DataTable();
  </script>