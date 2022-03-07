<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="<?php echo MAIN_DESC ?>">
    <meta name="author" content="" />

    <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.ico">

    <title><?php echo MAIN_TITLE ?></title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">

    <script src="<?php echo base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
</head>

<body class="page-body">

    <div class="page-container">

        <?php $this->load->view('_part/sidebar'); ?>

        <div class="main-content">

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>
                                    <?php foreach ($produk as $p) { } ?>
                                    <?php echo "$p->nama_produk"; ?>
                                </h3>
                            </div>

                            <div class="panel-options">
                                <a data-toggle="modal" href="#modal-tambah-link"><i class="entypo-plus-squared"></i>Tambah Materi</a>
                                <a href="<?php echo base_url('admin/produk/list') ?>"><i class="entypo-reply"></i>Kembali</a>
                            </div>
                        </div>

                        <div class="panel-body with-table">

                            <!-- <a class="btn btn-block btn-primary"><?php echo $p->keterangan; ?></a> -->
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80%">Materi</th>
                                        <th width="20%" class="text-center">Link</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($link as $l) {
                                        echo "<tr>
                                <td>$l->nama_link</td>
                                <td class='text-center'>
                                    <a type='button' class='btn btn-green btn-icon' href='$l->link' target='_blank'>Akses<i class='entypo-link'></i></a>
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

            <?php echo FOOTER ?>

        </div>
    </div>

    <!-- Bottom scripts (common) -->
    <script src="<?php echo base_url() ?>assets/js/gsap/TweenMax.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/joinable.js"></script>
    <script src="<?php echo base_url() ?>assets/js/resizeable.js"></script>
    <script src="<?php echo base_url() ?>assets/js/neon-api.js"></script>

    <!-- Imported scripts on this page -->
    <script src="<?php echo base_url() ?>assets/js/neon-chat.js"></script>

    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo base_url() ?>assets/js/neon-custom.js"></script>

    <!-- Demo Settings -->
    <script src="<?php echo base_url() ?>assets/js/neon-demo.js"></script>


    
    <div class="modal fade" id="modal-tambah-link" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tambah Link Materi Baru di <?php echo "$p->nama_produk"; ?></h4>
                </div>

                <form action="<?php echo base_url('admin/add/produk_link') ?>" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id_produk" value="<?php echo "$p->id_produk"; ?>">
                                <input type="text" class="form-control" name="nama_link" placeholder="Nama Materi" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="link" placeholder="Link Materi/Google Drive dll" required=""></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>