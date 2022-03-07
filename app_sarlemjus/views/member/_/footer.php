<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/ripple.js"></script>
<script src="<?php echo ASSETS ?>js/pcoded.min.js"></script>

<!-- <script src="<?php echo ASSETS ?>js/plugins/apexcharts.min.js"></script> -->

<?php if ($page['id'] == "dashboard") { ?>
    <script src="<?php echo ASSETS ?>js/plugins/apexcharts.min.js"></script>

    <script>
        'use strict';
        $(document).ready(function() {
            setTimeout(function() {
                floatchart()
            }, 700);
        });

        function floatchart() {
            $(function() {
                var options = {
                    chart: {
                        type: 'area',
                        height: 70,
                        sparkline: {
                            enabled: true
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ["#4680ff"],
                    fill: {
                        type: 'solid',
                        opacity: 0.3,
                    },
                    markers: {
                        size: 2,
                        opacity: 0.9,
                        colors: "#4680ff",
                        strokeColor: "#4680ff",
                        strokeWidth: 2,
                        hover: {
                            size: 4,
                        }
                    },
                    stroke: {
                        curve: 'straight',
                        width: 3,
                    },
                    series: [{
                        name: 'series1',
                        data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 9]
                    }],
                    tooltip: {
                        fixed: {
                            enabled: false
                        },
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function(seriesName) {
                                    return 'Monthly Profit :'
                                }
                            }
                        },
                        marker: {
                            show: false
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#monthlyprofit-1"), options);
                chart.render();
            });
        }
    </script>

    <script src="<?php echo ASSETS ?>js/pages/dashboard-sale.js"></script>
<?php } elseif ($page['id'] == "transaction") { ?>
    <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#table_trans').DataTable();
    </script>
<?php } elseif ($page['id'] == "store") { ?>

    <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
    <script>
        // DataTable start
        $('#table-store').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
        // DataTable end
    </script>
<?php } ?>
</body>

</html>