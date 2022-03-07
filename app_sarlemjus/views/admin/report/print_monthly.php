<html>

<?php
$t1 = new DateTime($tgl_1);
$t2 = new DateTime($tgl_2);

$tg1 = $t1->format('d M Y');
$tg2 = $t2->format('d M Y');
?>

<head>
    <title><?php echo $title ?> <?php if (!empty($tgl_1)) {
                                                echo " Periode ($tg1 - $tg2)";
                                            } ?></title>
    <link rel="icon" href="<?php echo ASSETS ?>img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/argon.css?v=1.1.0" type="text/css">
</head>

<body class="dt-print-view" onload="window.print()">

    <hr>
    <h1 class="text-center"><?php echo $title; if (!empty($tgl_1)) {
                                                                echo " Periode ($tg1 - $tg2)";
                                                            } ?></h1>

    <hr>

    <table class="table table-flush dataTable">
        <thead>
            <tr>
                <th width="1%" class="text-center">No</th>
                <th width="15%">Nama Member</th>
                <th width="9%">Level</th>
                <th width="10%">Team</th>
                <th width="15%" class="text-right">Pembelian Pribadi</th>
                <th width="15%" class="text-right">Pembelian Team</th>
                <th width="10%">Total PV Pribadi</th>
                <th width="10%">Total PV Team</th>
                <th width="15%" class="text-right">Total Komisi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bulanan)) {
                echo "<tr><td colspan='7'>Tidak ada data...</td></tr>";
            } else {
                $no = 0;
                foreach ($bulanan as $bl) {
                    $no++;
                    echo "<tr>
                    <td class='text-center'>$no</td>
                    <td>" . substr($bl->nama, 0, 40) . "</td>
                    <td>$bl->lv</td>
                    <td>$bl->team</td>
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->tp, 0, ",", ".") . "</font></td>
                    <td class='text-right'>Rp " . number_format($bl->tt, 0, ",", ".") . "</td>
                    <td>" . number_format($bl->pv_m, 0, ",", ".") . "</td>
                    <td>" . number_format($bl->pv_team, 0, ",", ".") . "</td>
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->com, 0, ",", ".") . "</font></td>";
                }
            }

            ?>
        </tbody>
    </table>
    <footer class="text-center">
        <small>
            <font color="lavender"><?php echo "" . base_url() . " (" . date('d F Y') . ")"; ?></font>
        </small>
    </footer>
</body>

</html>