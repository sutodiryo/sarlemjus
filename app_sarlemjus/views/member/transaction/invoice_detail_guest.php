<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo MAIN_TITLE . $page['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="<?php echo MAIN_DESC ?>" />
    <meta name="keywords" content="<?php echo KEYWORDS ?>">
    <meta name="author" content="<?php echo AUTHOR ?>" />

    <style>
        @media print {
            .print-scale {
                scale: 70%;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>

    <link href="<?php echo FAVICON ?>" rel="icon">

    <?php if ($page['id'] == "transaction" || $page['id'] == "store") { ?>
        <!-- <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/select2.min.css"> -->
        <link rel="stylesheet" href="<?= ASSETS ?>css/plugins/dataTables.bootstrap4.min.css">
    <?php } elseif ($page['id'] == "profile") { ?>

        <!-- <link rel="stylesheet" href="<?php echo ASSETS ?>css/plugins/select2.min.css"> -->
    <?php
    } ?>

    <link rel="stylesheet" href="<?php echo ASSETS ?>css/plugins/select2.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/style.css">
</head>

<body class="">
    <?php
    $date_created = new DateTime($inv->date_created);

    $date_created = $date_created->format('d M Y');
    $subtotal = $inv->total;
    $discount_value = ($inv->discount / 100) * $subtotal;
    $subtotal_disc = ($subtotal - $discount_value);
    $total = $subtotal_disc + $inv->shipping_costs;
    ?>

    <div class="">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div>
                        <div class="card" id="print_invoice">
                            <div class="print-scale">
                                <div class="row text-center">
                                    <span class="col-sm-12 invoice-btn-group text-center">
                                        <?php echo $this->session->flashdata('report'); ?>
                                        <!-- <img class="img-fluid" src="assets/images/logo-dark.png" alt="Able pro Logo"> -->
                                        <br>
                                        <img class="img-fluid" src="<?php echo FRONT_ASSETS ?>img/logo-1.png" alt="" class="logo">
                                        <br>
                                    </span>
                                </div>
                                <div class="row invoice-contact">
                                    <div class="col-8">
                                        <div class="invoice-box row">
                                            <div class="col-12">
                                                <table class="table table-responsive invoice-table table-borderless p-l-20">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h5>INVOICE ID : <?php echo $inv->invoice_number ?></h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama : <?php echo $inv->member_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat : <small><?= "$inv->home_detail, $inv->village_name, $inv->subdistrict_name, $inv->district_name, $inv->province_name" ?></small></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal : <?php echo $date_created ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status : <?php if ($inv->status == 0) {
                                                                                echo "<button class='btn btn-sm btn-warning has-ripple'><i class='fas fa-exclamation-circle'></i> Belum Bayar</span></button>";
                                                                            } elseif ($inv->status == 1) {
                                                                                echo "<button type='button' class='btn btn-sm btn-success has-ripple'><i class='fas fa-play-circle'></i> Diproses</span></button>";
                                                                            } elseif ($inv->status == 2) {
                                                                                echo "<button type='button' class='btn btn-sm btn-info has-ripple'><i class='fas fa-check-circle'></i> Diterima</span></button>";
                                                                            } ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="invoice-box row">
                                            <div class="col-sm-12">
                                                <table class="table table-responsive invoice-table table-borderless p-l-20">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h5>PT.SAHANA PLUS SUKSES</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email : <a class="text-secondary" href="mailto:sarlemjusplus@gmail.com" target="_top">sarlemjusplus@gmail.com</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>HP/WA : <a class="text-secondary" href="https://api.whatsapp.com/send/?phone=6282123602448&text=Halo" target="_top">082123602448</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Perumahan Griya Ciledug<br>Jl.ANggrek 2 Blok K No. 1<br>Kel. Paninggilan Utara, Kec. Ciledug, Tangerang</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table invoice-detail-table">
                                                    <thead>
                                                        <tr class="thead-default">
                                                            <th>No</th>
                                                            <th>Nama Produk</th>
                                                            <th class="text-center">Keterangan</th>
                                                            <th class="text-center">Qty</th>
                                                            <th class="text-right">Harga Retail</th>
                                                            <th class="text-right" style="padding-right: 20px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $no = 0;
                                                        foreach ($items as $i) {
                                                            $no++;
                                                            echo "<tr>
                                                            <td>$no</td>
                                                            <td>
                                                                <h6>$i->product_name</h6>
                                                            </td>
                                                            <td class='text-center'>BTL</td>
                                                            <td class='text-center'><p>$i->quantity</p></td>
                                                            <td class='text-right'><p>" . number_format($i->price, 0, ',', ',') . "</p></td>
                                                            <td class='text-right' style='padding-right: 20px;'><p>" . number_format(($i->quantity * $i->price), 0, ',', ',') . "</p></td>
                                                        </tr>";
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <h6>Catatan :</h6>
                                            <p>1. Pengiriman dilakukan setelah pembayaran</p>
                                            <p>2. Transfer ke Bank BCA/Mandiri/BRI A.n Efri Korina</p>
                                            <p>3. Batas waktu pembayaran 2 X 24 Jam</p>
                                            <p>No Rekening</p>
                                            <p>BCA : </p>
                                            <p>Mandiri : </p>
                                            <p>BRI : </p>
                                        </div>
                                        <div class="col-4">
                                            <table class="table table-responsive invoice-table invoice-total">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <p>Sub Total :</p>
                                                        </th>
                                                        <td>
                                                            <p><?php echo number_format($subtotal, 0, ',', ','); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <p class="text-success">Discount (<?php echo $inv->discount ?>%) :</p>
                                                        </th>
                                                        <td>
                                                            <p class="text-success"><?php echo number_format($discount_value, 0, ',', ','); ?></p>
                                                            <hr>
                                                            <p class="text-primary"><b><?php echo number_format($subtotal_disc, 0, ',', ','); ?></b></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <p>Biaya Pengiriman :</p>
                                                        </th>
                                                        <td>
                                                            <p><?php echo number_format($inv->shipping_costs, 0, ',', ','); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr />
                                                            <h5 class="text-primary m-r-10">Total :</h5>
                                                        </td>
                                                        <td>
                                                            <hr />
                                                            <h5 class="text-primary">Rp<?php echo number_format($total, 0, ',', ','); ?></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" style="margin-top:30px;">
                                        <div class="col-6 text-center">
                                            <p>Dibuat Oleh :</p>
                                            <?= ($inv->status >= 0) ? '<img src="' . base_url() . 'public/back/images/anjelita.png" height="90px">' : '<br><br><br><br>'; ?>
                                            <h6><u>Anjelita</u></h6>
                                            <p>Keuangan</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <p>Konfirmasi :</p>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <h6><u><?php echo $inv->member_name ?></u></h6>
                                            <p>Customer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-12 invoice-btn-group text-center">
                                <button type="button" class="btn waves-effect waves-light btn-info m-b-10" onClick="printdiv('print_invoice');"><i class="feather icon-printer"></i> Print</button>
                                <a href="https://api.whatsapp.com/send/?phone=6282123602448&text&" class="btn waves-effect waves-light btn-success m-b-10"><i class="fab fa-whatsapp"></i> WA Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('member/_/footer'); ?>

    <script>
        function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>