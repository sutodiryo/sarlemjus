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
            <div class="row align-items-center m-l-1 mb-3">
              <div class="col-sm-6">
                <?php echo "<button type='button' class='btn btn-sm btn-secondary has-ripple'>Total Team : <span class='badge badge-light'>" . $member_tot . "</span><span class='ripple ripple-animate'></span></button>"; ?>
              </div>
              <div class="col-sm-6 text-right">
                <button class="btn btn-info btn-sm btn-round has-ripple" onclick="link_aff()" class="btn btn-sm btn-neutral" title="Copy link pendaftaran team baru"><i class="feather icon-link"></i> Copy Link Daftar Member</button>
                <!-- <a data-toggle="modal" href="#modal_add_team" class="btn btn-sm btn-success" title="Tambah Member Baru"><i class="fa fa-user-plus"></i> Daftarkan Team Baru</a> -->
                <input style="position:absolute; left:-9999px" type="text" id="aff_link" value="<?php echo "" . base_url('reg/') . "" . $this->session->userdata('log_id') . ""; ?>">
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_team" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="5%">ID</th>
                    <th width="30%">Name</th>
                    <th width="20%" class="text-center">Kontak</th>
                    <th width="35%">Transaksi</th>
                    <th width="10%" class="text-center"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  foreach ($member as $m) {
                    echo "<tr>
                            <td>#$m->id</td>
                            <td><a href='#'><img src='" . base_url() . "public/upload/member/$m->img' class='img-radius' width='30px' height='30px'> " . substr($m->name, 0, 30) . "</a></td>
                            <td class='text-center'><a class='btn btn-sm btn-success' href='https://api.whatsapp.com/send/?phone=62$m->phone'><i class='fab fa-whatsapp'></i> $m->phone</a></td>
                            <td></td>
                            <td class='text-center'>
                              <button type='button' class='btn btn-icon btn-info has-ripple' title='Lihat detail transaksi'><i class='fas fa-eye'></i><span class='ripple ripple-animate'></span></button>
                            </td>
                        </tr>";
                  }
                  ?>
                  <!-- <a href='https://api.whatsapp.com/send/?phone=62$m->phone' class='badge badge-success'><i class='fab fa-whatsapp'></i> $m->phone</a> -->
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



<script type="text/javascript">
  function link_aff() {
    var copyText = document.getElementById("aff_link");
    copyText.select();
    document.execCommand("copy");
    alert("Link pendaftaran sudah tercopy : " + copyText.value);
  }
</script>