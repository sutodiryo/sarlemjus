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
    <style>
        thead,
        th,
        tr,
        td {
            border: 1px solid #e9ecef
        }
    </style>
</head>

<body class="dt-print-view" onload="window.print()">

    <hr>
    <h1 class="text-center"><?php echo $title;
                            if (!empty($tgl_1)) {
                                echo " Periode ($tg1 - $tg2)";
                            } ?></h1>

    <hr>

    <table class="table">
        <thead>
            <tr>
                <th width="1%" class="text-center" rowspan="2">No</th>
                <th width="19%" rowspan="2" rowspan="2">Nama</th>
                <th width="10%" rowspan="2">Level</th>
                <th width="10%" rowspan="2">Team</th>
                <th width="60%" colspan="5" class="text-center">Penghasilan</th>
            </tr>
            <tr>
                <th width="12%" class="text-center">A</th>
                <th width="12%" class="text-center">B</th>
                <th width="12%" class="text-center">C</th>
                <th width="12%" class="text-center">D</th>
                <th width="12%" class="text-center">E</th>
            </tr>
        </thead>

        <!--         
        Ada 3 sumber pendapatan : 1. Model A : PENDAPATAN LANGSUNG
				  2. Model B : PENDAPATAN GET MEMBER
				   3. Model C : PENDAPATAN TEAM
				   4. Model D : PENDAPATAN BONUS
                   5. Model E : PENDAPATAN STOKIS
        -->

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
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->pl, 0, ",", ".") . "</font></td>
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->pgm, 0, ",", ".") . "</font></td>
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->pt, 0, ",", ".") . "</font></td>
                    <td class='text-right'><font color='$bl->color'>" . number_format($bl->pb, 0, ",", ".") . " PV</font></td>
                    <td class='text-right'><font color='$bl->color'>Rp " . number_format($bl->ps, 0, ",", ".") . "</font></td>";
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