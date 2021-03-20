<div class="pcoded-inner-content">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">

        <div class="row">









          <!-- !-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Rekap Transaksi Pelanggan

                <form action='<?php echo base_url("c_dashboard/search_date_1"); ?>' class='no_voucer_area' method="post" id=''>
                  <table>
                    <tr>

                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_from_dashboard_1' value='<?php echo $this->session->userdata('date_from_dashboard_1'); ?>'>
                      </th>
                      <th>-</th>
                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_to_dashboard_1' value='<?php echo $this->session->userdata('date_to_dashboard_1'); ?>'>
                      </th>
                      <th>
                        <input type="submit" name="submit_date" class='btn btn-primary waves-effect waves-light' value="Search">
                      </th>
                    </tr>
                  </table>


                </form>

                </h5>

                
              </div>
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>QTY</th>
                        <th>Total Penjualan</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($select_rekap_pelanggan as $key => $value) {
                       
                        
                        echo "<tr>";
                        echo "<td>" . ($key + 1) . "</td>";
                        echo "<td>" . $value->PELANGGAN . "</td>";
                        echo "<td>" . (round($value->SUM_QTY)) . "</td>";
                        echo "<td>" . number_format(round($value->SUM_SUB_TOTAL)) . "</td>";


                        /*
            echo "<td>";
              

              echo "<a href='".site_url('c_t_ak_terima_pelanggan_no_faktur/delete/' . $value->ID)."' ";
              
              echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
            echo "</td>";

            echo "</tr>";
            */
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>








          <!-- !-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Rekap Kinerja Sales

                <form action='<?php echo base_url("c_dashboard/search_date_2"); ?>' class='no_voucer_area' method="post" id=''>
                  <table>
                    <tr>

                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_from_dashboard_2' value='<?php echo $this->session->userdata('date_from_dashboard_2'); ?>'>
                      </th>
                      <th>-</th>
                      <th>
                        <form action='/action_page.php'>
                          <input type='date' class='form-control' name='date_to_dashboard_2' value='<?php echo $this->session->userdata('date_to_dashboard_2'); ?>'>
                      </th>
                      <th>
                        <input type="submit" name="submit_date" class='btn btn-primary waves-effect waves-light' value="Search">
                      </th>
                    </tr>
                  </table>


                </form>

                </h5>

                
              </div>
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                  <table id="order-table" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Sales</th>
                        <th>QTY</th>
                        <th>Total Penjualan</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($select_rekap_sales as $key => $value) {
                       
                        
                        echo "<tr>";
                        echo "<td>" . ($key + 1) . "</td>";
                        echo "<td>" . $value->SALES . "</td>";
                        echo "<td>" . (round($value->SUM_QTY)) . "</td>";
                        echo "<td>" . number_format(round($value->SUM_SUB_TOTAL)) . "</td>";


                        /*
            echo "<td>";
              

              echo "<a href='".site_url('c_t_ak_terima_pelanggan_no_faktur/delete/' . $value->ID)."' ";
              
              echo "onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\"";


              echo "> <i class='feather icon-trash-2 f-w-600 f-16 text-c-red'></i></a>";
            echo "</td>";

            echo "</tr>";
            */
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>











          


        </div>