<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

//* count the number of customers in the system
$query = "SELECT COUNT(*) AS total_customers FROM tbl_customer";
$stmt = $pdo->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

//* Getting the count from the results of the query
$total_customers = $result['total_customers'];

//* count the number of consignor in the system
$query_consignor  = "SELECT COUNT(*) AS total_consignors FROM tbl_consignor";
$stmt_consignor   = $pdo->query($query_consignor);
$result_consignor = $stmt_consignor->fetch(PDO::FETCH_ASSOC);

//* Getting the count from the result_consignors of the query
$total_consignor = $result_consignor['total_consignors'];

//* count the number of consignor in the system
$query_bills  = "SELECT COUNT(*) AS total_bills FROM tbl_product";
$stmt_bills   = $pdo->query($query_bills);
$result_bills = $stmt_bills->fetch(PDO::FETCH_ASSOC);

//* Getting the count from the result_bills of the query
$total_bills = $result_bills['total_bills'];

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">


          <div class="card card-primary card-outline">
              <div class="card-header">

              </div>
              <div class="card-body">



 <!-- Main content -->

 <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-4 col-6">

          <div class="small-box bg-info">
          <div class="inner">
          <h3><?php echo $total_customers; ?></h3>
          <p>Customers Report</p>
          </div>
          <div class="icon">
          <i class="ion ion-people"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">View Report<i class="fas fa-arrow-circle-right"></i></a> -->
          <!-- <a class="nav-link small-box-footer" id="customerTab" data-toggle="tab" href="#customerReport" role="tab">View Customer Report</a> -->
          </div>
          </div>

          <div class="col-lg-4 col-6">

          <div class="small-box bg-success">
          <div class="inner">
          <h3><?php echo $total_consignor; ?><sup style="font-size: 20px">%</sup></h3>
          <p>Consignors Total</p>
          </div>
          <div class="icon">
          <i class="ion ion-water-outline"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          </div>

          <div class="col-lg-4 col-6">

          <div class="small-box bg-warning">
          <div class="inner">
          <h3><?php echo $total_bills; ?></h3>
          <p>Bills</p>
          </div>
          <div class="icon">
          <i class="fas fa-money-bill"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">View Report <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          </div>

          <!-- <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div> -->
</div>

<!-- Table to display the report -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-bold bg-success">
        Products Report
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="tab-content">
              <!-- Customer Report Tab -->
              <div class="tab-pane active" id="customerReport" role="tabpanel">
                  <div class="row mt-3">
                      <div class="col-md-12">
                          <form class="form-inline float-right">
                              <label for="customer_duration">Select Duration:</label>
                              <select class="form-control mx-2" name="customer_duration" id="customer_duration">
                                  <option value="quarterly">Quarterly</option>
                                  <option value="midyear">Mid-Year</option>
                                  <option value="yearly">Yearly</option>
                              </select>
                          </form>
                      </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12" id="customerReportTable">
                          <!-- Customer report table will be displayed here -->
                      </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12">
                        <a href="#" class="btn btn-primary float-right">Print</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-bold bg-warning">
        Customer Report
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="tab-content">
              <!-- Customer Report Tab -->
              <div class="tab-pane active" id="productReport" role="tabpanel">
                  <div class="row mt-3">
                      <div class="col-md-12">
                          <form class="form-inline float-right">
                              <label for="bill_duration">Select Duration:</label>
                              <select class="form-control mx-2" name="bill_duration" id="bill_duration">
                                  <option value="quarterly">Quarterly</option>
                                  <option value="midyear">Mid-Year</option>
                                  <option value="yearly">Yearly</option>
                              </select>
                          </form>
                      </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12" id="productReportTable">
                          <!-- Customer report table will be displayed here -->
                      </div>
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12">
                        <a href="#" class="btn btn-primary float-right">Print</a>
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
        </div>
        </div>
        </div>
        </div>



  <?php

include_once "footer.php";

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script>
  $(document).ready( function () {
    $('#reportForm').submit(function(event){
      event.preventDefault();
      const formData = $(this).serialize();

      const serverUrl = window.location.origin;
      const url = `${serverUrl}/report_data.php?report_type=`
    })
  })
</script> -->

<script>
        $(document).ready(function() {
            // Fetch and display the default customer quarterly report table on page load
            fetchReportData('customer', 'quarterly', '#customerReportTable');
            fetchProductsReportData('product', 'quarterly', '#productReportTable');

            // Handle tab switching
            $('.nav-tabs a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
                var activeTab = $(this).attr('href');
                var reportType = activeTab.substring(1, activeTab.length - 6); // Extract 'customer' or 'product'
                var selectedDuration = $(activeTab).find('select').val();
                fetchReportData(reportType, selectedDuration, activeTab + 'Table');
            });

            // Handle duration selection change
            $('select[name="customer_duration"], select[name="product_duration"]').change(function() {
                var activeTab = $('.tab-pane.active').attr('id');
                var reportType = activeTab.substring(0, activeTab.length - 6); // Extract 'customer' or 'product'
                var selectedDuration = $(this).val();
                fetchReportData(reportType, selectedDuration, '#' + activeTab + 'Table');
            });

            $('select[name="bill_duration"], select[name="bill_duration"]').change(function() {
                var activeTab = $('.tab-pane.active').attr('id');
                var reportType = "product";
                var selectedDuration = $(this).val();
                fetchProductsReportData(reportType, selectedDuration, '#productReportTable');
            });

            function fetchReportData(reportType, selectedDuration, targetTable) {
                // Implement AJAX request here to fetch report data based on reportType and selectedDuration
                $.ajax({
                    type: 'GET',
                    url: 'report_data.php?report_type=' + reportType,
                    data: { report_duration: selectedDuration },
                    dataType: 'json',
                    success: function(response) {
                      console.log(response);
                      console.log(targetTable);
                        // Display the report data in a table
                        displayReportData(response, targetTable);
                    },
                    error: function() {
                        console.log('Error occurred while fetching the data.');
                    }
                });
            }

            function fetchProductsReportData(reportType, selectedDuration, targetTable) {
                // Implement AJAX request here to fetch report data based on reportType and selectedDuration
                $.ajax({
                    type: 'GET',
                    url: 'report_product_data.php?report_type=' + reportType,
                    data: { report_duration: selectedDuration },
                    dataType: 'json',
                    success: function(response) {
                      console.log(response);
                      console.log(targetTable);
                        // Display the report data in a table
                        displayProductReportData(response, targetTable);
                    },
                    error: function() {
                        console.log('Error occurred while fetching the data.');
                    }
                });
            }

            function displayReportData(data, targetTable) {
                // Clear the existing table content
                $(targetTable).empty();

                // Generate the table header
                var table = '<table class="table">';
                table += '<thead><tr><th>Year</th><th>Duration</th><th>Product</th><th>Number of Customers</th><th>Total Quantity</th></tr></thead>';
                table += '<tbody>';

                // Generate the table rows with data
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i]['year'] + '</td>';
                    table += '<td>' + data[i]['period'] + '</td>';
                    table += '<td>' + data[i]['product'] + '</td>';
                    table += '<td>' + data[i]['num_customers'] + '</td>';
                    table += '<td>' + data[i]['total_quantity'] + '</td>';
                    table += '</tr>';
                }

                table += '</tbody></table>';

                // Append the table to the target element
                $(targetTable).html(table);
            }

            function displayProductReportData(data, targetTable) {
                // Clear the existing table content
                $(targetTable).empty();

                // Generate the table header
                var table = '<table class="table">';
                table += '<thead><tr><th>Year</th><th>Duration</th><th>Customer</th><th>Number of Bills</th><th>Total Quantity</th></tr></thead>';
                table += '<tbody>';

                // Generate the table rows with data
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i]['year'] + '</td>';
                    table += '<td>' + data[i]['period'] + '</td>';
                    table += '<td>' + data[i]['customer'] + '</td>';
                    table += '<td>' + data[i]['num_bills'] + '</td>';
                    table += '<td>' + data[i]['total_quantity'] + '</td>';
                    table += '</tr>';
                }

                table += '</tbody></table>';

                // Append the table to the target element
                $(targetTable).html(table);
            }
        });
    </script>
