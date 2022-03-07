<?php $this->load->view('member/_/header'); ?>

<?php
$date_created = new DateTime($inv->date_created);

$date_created = $date_created->format('d M Y');
$subtotal = $inv->total;
$discount_value = ($inv->discount / 100) * $subtotal;
$subtotal_disc = ($subtotal - $discount_value);
$total = $subtotal_disc + $inv->shipping_costs;
?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Invoice</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div>
                    <div class="card" id="print_invoice">
                        <div class="print-scale">
                            <div class="row text-center">
                                <span class="col-sm-12 invoice-btn-group text-center">
                                    <!-- <img class="img-fluid" src="assets/images/logo-dark.png" alt="Able pro Logo"> -->
                                    <br>
                                    <img class="img-fluid" src="<?php echo FRONT_ASSETS ?>img/logo-1.png" alt="" class="logo">
                                </span>
                            </div>
                            <div class="row invoice-contact">
                                <div class="col-md-8">
                                    <div class="invoice-box row">
                                        <div class="col-sm-12">
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
                                                        <td>Alamat : <small><?php echo $inv->full_address; ?></small></td>
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
                                <div class="col-md-4">
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
                                <!-- <div class="row invoive-info">
                                <div class="col-md-4 col-xs-12 invoice-client-info">
                                    <h6>Client Information :</h6>
                                    <h6 class="m-0">Josephin Villa</h6>
                                    <p class="m-0 m-t-10">1065 Mandan Road, Columbia MO, Missouri. (123)-65202</p>
                                    <p class="m-0">(1234) - 567891</p>
                                    <p><a class="text-secondary" href="mailto:demo@gmail.com" target="_top">demo@gmail.com</a></p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6>Order Information :</h6>
                                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Date :</th>
                                                <td>November 14</td>
                                            </tr>
                                            <tr>
                                                <th>Status :</th>
                                                <td>
                                                    <span class="label label-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Id :</th>
                                                <td>
                                                    #146859
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <h6 class="m-b-20">Invoice Number <span>#125863478945</span></h6>
                                    <h6 class="text-uppercase text-primary">Total Due :
                                        <span>$950.00</span>
                                    </h6>
                                </div>
                            </div> -->
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
                                    <div class="col-sm-8">
                                        <h6>Catatan :</h6>
                                        <p>1. Pengiriman dilakukan setelah pembayaran</p>
                                        <p>2. Transfer ke Bank BCA/Mandiri/BRI A.n Efri Korina</p>
                                        <p>3. Batas waktu pembayaran 2 X 24 Jam</p>
                                        <p>No Rekening</p>
                                        <p>BCA : </p>
                                        <p>Mandiri : </p>
                                        <p>BRI : </p>
                                    </div>
                                    <div class="col-sm-4">
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
                                    <div class="col-sm-4 text-center">
                                        <p>Dibuat Oleh :</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <h6><u>Anjelita</u></h6>
                                        <p>Keuangan</p>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <p>Disetujui Oleh :</p>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <h6><u>Efri Korina</u></h6>
                                        <p>Direktur</p>
                                    </div>
                                    <div class="col-sm-4 text-center">
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
                            <a href="<?php echo base_url('member/transaction') ?>" class="btn waves-effect waves-light btn-secondary m-b-10"><i class="feather icon-corner-up-left"></i> Semua Transaksi</a>
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