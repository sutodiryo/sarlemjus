<script src="<?php echo ASSETS ?>js/vendor-all.min.js"></script>
<script src="<?php echo ASSETS ?>js/plugins/bootstrap.min.js"></script>
<script src="<?php echo ASSETS ?>js/ripple.js"></script>
<script src="<?php echo ASSETS ?>js/pcoded.min.js"></script>
<!-- <script src="<?php echo ASSETS ?>js/menu-setting.min.js"></script> -->

<?php if ($page == "dashboard") { ?>
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
<?php } elseif ($page == "transaction") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
  <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <script>
    $('#table_transaction').DataTable();
  </script>
<?php } elseif ($page == "member") { ?>

  <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
  <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="<?php echo ASSETS ?>js/pages/data-basic-custom.js"></script> -->
  <script>
    $('#table_member').DataTable();
  </script>
  <?php if ($title == "Detail Member") { ?>

    <script src="<?php echo ASSETS ?>js/plugins/ekko-lightbox.min.js"></script>
    <script src="<?php echo ASSETS ?>js/plugins/lightbox.min.js"></script>
    <script src="<?php echo ASSETS ?>js/pages/ac-lightbox.js"></script>
    <script>
      // [ customer-scroll ] start
      var px = new PerfectScrollbar('.cust-scroll', {
        wheelSpeed: .5,
        swipeEasing: 0,
        wheelPropagation: 1,
        minScrollbarLength: 40,
      });
      // [ customer-scroll ] end
    </script>
  <?php
    } ?>



<?php } elseif ($page == "product") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
  <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <script>
    $('#table_product').DataTable();
  </script>
<?php } elseif ($page == "course") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
  <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <script>
    $('#table_course').DataTable();
  </script>
<?php } elseif ($page == "notice") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <script>
    $('#table_notice').DataTable();
  </script>
<?php } elseif ($page == "bonus") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>
  <script>
    $('#table_bonus').DataTable();
  </script>
<?php } elseif ($page == "stock") { ?>
  <script src="<?php echo ASSETS ?>js/plugins/select2.full.min.js"></script>
  <script src="<?php echo ASSETS ?>js/pages/form-select-custom.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo ASSETS ?>js/plugins/dataTables.bootstrap4.min.js"></script>

  <?php if ($title == "Stok Produk") { ?>
    <script>
      $('#table_stock_product').DataTable();
    </script>
  <?php
    } elseif ($title == "Stok Produk ") { ?>
      <script>
        $('#table_stock_product_list').DataTable();
      </script>
      <script>
        $('#table_stock_product_list_trans').DataTable();
      </script>
  <?php
    } ?>

<?php } ?>

</body>

</html>