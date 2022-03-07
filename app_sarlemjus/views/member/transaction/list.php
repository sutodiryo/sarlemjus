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
                <!-- <?php echo "<button type='button' class='btn btn-sm btn-secondary has-ripple'>Total Team : <span class='badge badge-light'>" . $member_tot . "</span><span class='ripple ripple-animate'></span></button>"; ?> -->
              </div>
              <div class="col-sm-6 text-right">
                <!-- <button class="btn btn-info btn-sm btn-round has-ripple" onclick="link_aff()" class="btn btn-sm btn-neutral" title="Copy link pendaftaran team baru"><i class="feather icon-link"></i> Copy Link Daftar Member</button> -->
                <!-- <a data-toggle="modal" href="#modal_add_team" class="btn btn-sm btn-success" title="Tambah Member Baru"><i class="fa fa-user-plus"></i> Daftarkan Team Baru</a> -->
                <!-- <input style="position:absolute; left:-9999px" type="text" id="aff_link" value="<?php echo "" . base_url('reg/') . "" . $this->session->userdata('log_id') . ""; ?>"> -->
              </div>
            </div>
            <div class="table-responsive">
              <table id="table_trans" class="table table-bordered table-striped mb-0">
                <thead>
                  <tr>
                    <th width="20%" class="text-center">ID Transaksi</th>
                    <th width="20%" class="text-center">Total Pesanan</th>
                    <th width="20%" class="text-center">Tanggal Transaksi</th>
                    <th width="30%" class="text-center">Status</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  foreach ($trans as $t) {

                    $date_created = new DateTime($t->date_created);
                    // <td><a href='#'>" . substr($t->name, 0, 30) . "</a></td>

                    echo "<tr>
                            <td class='text-center'><a href='" . base_url('member/transaction/invoice/') . "$t->invoice_number'>$t->invoice_number</a></td>
                            <td class='text-right'>" . idr($t->total) . "</td>
                            <td class='text-center'>" . $date_created->format('d M Y') . " <small>Pukul " . $date_created->format('H:i') . "</small></td>
                            <td class='text-center'>";

                    if ($t->status == 0) {
                      echo "<button class='btn btn-sm btn-warning has-ripple'><i class='fas fa-exclamation-circle'></i> Belum Bayar</span></button>";
                    } elseif ($t->status == 1) {
                      echo "<button type='button' class='btn btn-sm btn-success has-ripple'><i class='fas fa-play-circle'></i> Diproses</span></button>";
                    } elseif ($t->status == 2) {
                      echo "<button type='button' class='btn btn-sm btn-info has-ripple'><i class='fas fa-check-circle'></i> Diterima</span></button>";
                    }

                    echo "</td>
                            <td class='text-center'>
                              <a href='" . base_url('member/transaction/invoice/') . "$t->invoice_number' class='btn btn-sm btn-outline-dark has-ripple'><i class='fas fa-eye icon-info'></i> Detail</a>
                            </td>
                        </tr>";
                  }
                  ?>
                  <!-- <a href='https://api.whatsapp.com/send/?phone=62$t->phone' class='badge badge-success'><i class='fab fa-whatsapp'></i> $t->phone</a> -->
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