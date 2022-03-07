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
      <div class="col-md-12">
        <div class="card">

          <?php echo $this->session->flashdata('report'); ?>

          <div class="card-body">
            <div class="table-responsive">
              <table id="table_course" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="60%">Kategori Kelas</th>
                    <th width="35%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $no = 0;
                  foreach ($course as $c) {
                    $no++;
                    echo "<tr>
                            <td><h5>$no</h5></td>
                            <td><h5><img src='" . base_url() . "public/upload/course/category/$c->cover' class='img-radius' width='30px' height='30px'> $c->name</h5></td>
                            <td class='text-center'><a href='" . base_url('member/course/list/') . "$c->id' class='btn btn-sm btn-info'><i class='feather icon-eye'></i> Masuk Kelas</a>
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

<?php $this->load->view('member/_/footer'); ?>