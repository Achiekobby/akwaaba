<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

$current_date = (new DateTime())->format('Y-M-d');
$current_time = (new DateTime())->format('H:i:s');

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
          <div class="col-lg-6 col-6" id="periodic_sorting">

          <div class="small-box bg-info">
          <div class="inner">
          <h3>Periodic Reports</h3>
          <p>This section of the report shows the Quarterly, Midyear and Yearly Reports</p>
          </div>
          <div class="icon">
          <i class="ion ion-people"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">View Report<i class="fas fa-arrow-circle-right"></i></a> -->
          <!-- <a class="nav-link small-box-footer" id="customerTab" data-toggle="tab" href="#customerReport" role="tab">View Customer Report</a> -->
          </div>
          </div>

          <div class="col-lg-6 col-6" id="custom_sorting">
            <a href="custom_reports.php" class="small-box bg-warning">
              <div class="inner">
                <h3>Custom Sorting</h3>
                <p>Click on this section to load the custom sorting section</p>
              </div>
              <div class="icon">
                <i class="fas fa-arrow-circle-right"></i>
              </div>
            </a>
          </div>
</div>

<!-- Table to display the report -->
<div class="row">
  <div class="col-lg-12">
    <div class="card" id="productCard">
      <div class="card-header text-bold bg-success">
        Products Report
      </div>
      <div class="report_heading mt-4" style="display: none;">
          <h4 class="ml-3">
            <i class="fa fa-gears"></i> WAYBILL.
            <small class="mr-2 text-bold float-right">Date: <?php echo $current_date ?></small>
          </h4>
          <p class="ml-3 text-bold">Consignor Name: ___________________________________________</p>
          <p class="ml-3 text-bold">Product Report Period: ______________________________________</p>
          <p class="ml-3 text-bold">Report Generated At: <?php echo $current_time; ?></p>
          <hr> <!-- A horizontal line to separate the sections -->
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
                              <label for="customer_duration">Period:</label>
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
                      </div>
                  </div>
                  <div class="supervisor-signature mt-3" style="display: none;">
                    <p>Supervisor Name: __________________________</p>
                    <p>Supervisor Sign: ___________________________</p>
                    <p>Remarks: _______________________________________________________________________________________________________</p>
                    <hr> <!-- A horizontal line to separate the sections -->
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12">
                        <a href="#" class="btn btn-primary float-right" id="printProducts">Print</a>
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
    <div class="card" id="customer_report">
      <div class="card-header text-bold bg-warning">
        Customer Report
      </div>
      <div class="report_heading mt-4" style="display: none;">
          <h4 class="ml-3">
            <i class="fa fa-gears"></i> WAYBILL.
            <small class="mr-2 text-bold float-right">Date: <?php echo $current_date ?></small>
          </h4>
          <p class="ml-3 text-bold">Consignor Name: ___________________________________________</p>
          <p class="ml-3 text-bold">Product Report Period: ______________________________________</p>
          <p class="ml-3 text-bold">Report Generated At: <?php echo $current_time; ?></p>
          <hr> <!-- A horizontal line to separate the sections -->
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
                  <div class="supervisor-signature mt-3" style="display: none;">
                    <p>Supervisor Name: __________________________</p>
                    <p>Supervisor Sign: ___________________________</p>
                    <p>Remarks: _______________________________________________________________________________________________________</p>
                    <hr> <!-- A horizontal line to separate the sections -->
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-12">
                        <a href="#" class="btn btn-primary float-right" id="printCustomers">Print</a>
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

    <script>
      //* Function to handle the print function for the products report
      function printTableWithSignature(tableId){
        const table             = document.getElementById(tableId);
        const supervisorSignature = table.querySelector(".supervisor-signature");
        const reportHeading     = table.querySelector(".report_heading")
        const printBtn          = document.getElementById("printProducts");
        const periodic_sorting  = document.getElementById("periodic_sorting");
        const custom_sorting    = document.getElementById("custom_sorting");
        const customer_report   = document.getElementById("customer_report");
        const footer = document.getElementById("footer");
        const copyright = document.getElementById("copyright");

        supervisorSignature.style.display ="block";
        reportHeading.style.display ="block";
        printBtn.style.display ="none";
        periodic_sorting.style.display ="none";
        custom_sorting.style.display ="none";
        customer_report.style.display ="none";
        footer.style.display ="none";
        copyright.style.display ="none";

        window.print();

        supervisorSignature.style.display ="none";
        reportHeading.style.display ="none";
        printBtn.style.display ="block";
        periodic_sorting.style.display ="block";
        custom_sorting.style.display ="block";
        customer_report.style.display ="block";
        footer.style.display ="block";
        copyright.style.display ="block";

      }

        //* Function to handle the print function for the customer report
        function printCustomerTableWithSignature(tableId){
        const table             = document.getElementById(tableId);
        const supervisorSignature = table.querySelector(".supervisor-signature");
        const reportHeading     = table.querySelector(".report_heading")
        const printBtn          = document.getElementById("printCustomers");
        const periodic_sorting  = document.getElementById("periodic_sorting");
        const custom_sorting    = document.getElementById("custom_sorting");
        const product_report   = document.getElementById("productCard");
        const footer = document.getElementById("footer");
        const copyright = document.getElementById("copyright");


        supervisorSignature.style.display ="block";
        reportHeading.style.display ="block";

        printBtn.style.display ="none";
        periodic_sorting.style.display ="none";
        custom_sorting.style.display ="none";
        product_report.style.display ="none";
        footer.style.display ="none";
        copyright.style.display ="none";


        window.print();

        supervisorSignature.style.display ="none";
        reportHeading.style.display ="none";
        printBtn.style.display ="block";
        periodic_sorting.style.display ="block";
        custom_sorting.style.display ="block";
        product_report.style.display ="block";
        footer.style.display ="block";
        copyright.style.display ="block";


      }

      const printButton = document.getElementById("printProducts");
      const customerPrintButton = document.getElementById("printCustomers");
      printButton.addEventListener("click", function(){
        printTableWithSignature("productCard");
      })

      customerPrintButton.addEventListener("click", function(){
        printCustomerTableWithSignature("customer_report");
      })
    </script>
