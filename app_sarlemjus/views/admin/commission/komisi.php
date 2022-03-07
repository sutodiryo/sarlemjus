<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo MAIN_DESC ?>">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.ico">
    <title><?php echo MAIN_TITLE ?></title>
    <meta name="msapplication-tap-highlight" content="no">

    <link href="<?php echo base_url() ?>assets/admin/main.07a59de7b920cd76b874.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-gray">
        <div class="app-main">

            <?php $this->load->view('_/sidebar'); ?>


            <div class="app-inner-layout app-inner-layout-page">

                <div class="app-inner-layout__wrapper">

                    <div class="app-inner-layout__content">
                        <div class="tab-content">
                            <div class="container-fluid">
                                <div class="mb-3 card">

                                    <div class="no-gutters row">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">
                                                <div class="card-header-tab card-header">
                                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                        <i class="header-icon pe-7s-credit mr-3 text-muted opacity-6"> </i><?php echo $title ?>
                                                    </div>
                                                    <div class="btn-actions-pane-right actions-icon-btn">
                                                        <a data-toggle="modal" data-target="#modal-tambah-transaksi" aria-expanded="false" class="btn-icon btn-icon-only btn btn-link"><i class="pe-7s-plus btn-icon-wrapper"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%"></th>
                                                                <th width="30%">Nama</th>
                                                                <th width="29%">Total</th>
                                                                <th width="20%" class='text-center'>Status</th>
                                                                <th width="20%" class='text-center'></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php if (empty($transaksi)) {
                                                                echo "<tr><td colspan='5'>Belum ada penarikan komisi...</td></tr>";
                                                            } else {
                                                                $no = 0;
                                                                foreach ($transaksi as $t) {
                                                                    $no++;
                                                                    echo "<tr>
                                                                    <td class='text-center'>$no</td>
                                                                    <td><a href='" . base_url('admin/transaksi_detail/') . "$t->id_transaksi' title='Lihat Detail'>$t->member</a></td>
                                                                    <td>$t->total x $t->harga = ".($t->total*$t->harga)."</td>";

                                                                    echo "<td class='text-center'>";
                                                                    if ($t->status == 0) {
                                                                        echo "<div class='mb-2 mr-2 btn btn-danger btn-sm'>Belum Dibayar <i class='fa fa-sync-alt'></i></div>";
                                                                    } elseif ($t->status == 1) {
                                                                        echo "<div class='mb-2 mr-2 btn btn-success btn-sm'>Dibayar <i class='fa fa-check'></i></div>";
                                                                    } elseif ($t->status == 2) {
                                                                        echo "<div class='mb-2 mr-2 btn btn-dark btn-sm'>Dibatalkan <i class='fa fa-times'></i></div>";
                                                                    }
                                                                    echo "</td>";

                                                                    // echo "<td><a class='btn btn-xs btn-info' href='" . base_url('admin/set/transaksi/2/') . "$t->id_transaksi'>Approve <i class='fa fa-check'></i></a>
                                                                    // <a class='btn btn-xs btn-danger' href='" . base_url('admin/set/transaksi/0/') . "$t->id_transaksi''>Batal <i class='fa fa-close'></i></a>
                                                                    // <a class='btn btn-xs btn-success' href='https://api.whatsapp.com/send?phone=62$t->no_hp'>WA <i class='fa fa-whatsapp'></i></a>
                                                                    // <a class='btn btn-xs btn-black' href='" . base_url('admin/del/transaksi/') . "$t->id_transaksi''  onclick=\"return confirm('Data yang dihapus tidak bisa dikembalikan, anda yakin ingin menghapus data ini ?');\">Hapus <i class='fa fa-trash'></i></a>";
                            
                                                                    echo "<td class='text-center'>
                                                                    <div class='dropdown d-inline-block'>
                                                                    <button aria-haspopup='true' aria-expanded='false' data-toggle='dropdown' class='mb-2 dropdown-toggle mb-2 mr-2 btn btn-outline-2x btn-outline-primary btn-sm'>Action</button>
                                                                    <div tabindex='-1' role='menu' aria-hidden='true' class='dropdown-menu-right dropdown-menu-rounded dropdown-menu' x-placement='top-end' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-127px, -308px, 0px);'>
                                                                    <h6 tabindex='-1' class='dropdown-header'>$t->member</h6>
                                                                    <a tabindex='0' class='dropdown-item' href='" . base_url('admin/set/transaksi/0/') . "$t->id_transaksi' title='Set Pending'><i class='dropdown-icon lnr-question-circle'> </i><span>Set Pending</span></a>
                                                                    <a tabindex='0' class='dropdown-item' href='" . base_url('admin/set/transaksi/1/') . "$t->id_transaksi' title='Set Aktif'><i class='dropdown-icon lnr-checkmark-circle'> </i><span>Set Aktif</span></a>
                                                                    <a tabindex='0' class='dropdown-item' href='" . base_url('admin/edit/transaksi/') . "$t->id_transaksi' title='Edit transaksi'><i class='dropdown-icon lnr-pencil'> </i><span>Edit</span></a>
                                                                    <div tabindex='-1' class='dropdown-divider'></div>
                                                                    <a tabindex='0' class='dropdown-item' href='" . base_url() . "admin/del/transaksi/$t->id_transaksi' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" title='Hapus'><i class='dropdown-icon lnr-trash'> </i><span>Hapus</span></a>
                                                                    </div>
                                                                    </div>
                                                                    </td>
                                                                    </tr>";
                                                                }
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
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/scripts/main.07a59de7b920cd76b874.js"></script>
</body>

</html>