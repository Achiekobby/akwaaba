<?php

include_once 'connectdb.php';
session_start();

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

//* count the number of consignor in the system
$query_users  = "SELECT COUNT(*) AS total_users FROM tbl_user";
$stmt_users   = $pdo->query($query_users);
$result_users = $stmt_users->fetch(PDO::FETCH_ASSOC);

//* Getting the count from the result_users of the query
$total_users = $result_users['total_users'];


//***************************CHART DATA ****************************/
$stmt_products = $pdo->prepare('SELECT product FROM tbl_product');
$stmt_products->execute();
$products_data = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

//* Calculate the counts
$productQuantities  = array_count_values(array_column($products_data, 'product'));
$productNames       = array_keys($productQuantities);
$productQuantities  = array_values($productQuantities);


if($_SESSION['useremail']==""){
  header('location:../index.php');
}
include_once "header.php";
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
              <li class="breadcrumb-item text-success text-bold">Temp:</li>
              <form id="temperatureForm">
                <input type="number" name="temperature" id="temperature" required>
                <button class="btn btn-success" type="submit">Set Temperature</button>
              </form>
              <script>
                // AJAX request to handle form submission without page refresh
                $(document).ready(function() {
                    $('#temperatureForm').submit(function(event) {
                        event.preventDefault();
                        var formData = $(this).serialize();

                        const serverUrl = window.location.origin;
                        const url = `${serverUrl}/akwaaba/ui/save_temperature.php`;

                        $.ajax({
                            type: 'POST',
                            url:url,
                            data: formData,
                            success: function(response) {
                                $('#temperatureForm')[0].reset();
                                console.log(response);
                                location.reload();
                            },
                            error: function() {
                                // $('#response').text('Error occurred while saving the temperature.');
                                console.log('Error occurred while saving the temperature.');
                            }
                        });
                    });
                });
              </script>
              <!-- End of the temperature form submission -->
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-address-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number">
                  <?php echo $total_customers; ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-address-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Consignors</span>
                <span class="info-box-number"><?php echo $total_consignor; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-clone"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Waybills</span>
                <span class="info-box-number"><?php echo $total_bills; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"><?php echo $total_users; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <strong>Bills Per Product</strong>
                    <div style="width: 400px; height: 400px;">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                  </div>
                  <div class="col-md-8">
                  <strong class="align">Customer Bills Per Month</strong>
                    <form method="post" id="yearForm" >
                    <input class="btn btn-success float-right mr-2 btn-sm" type="submit" value="Show Chart">

                      <select class="form-select float-right mr-2" name="year" id="year">
                          <?php
                            $query = "SELECT DISTINCT YEAR(created_at) AS year FROM tbl_product";
                            $result = $pdo->query($query);

                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (date('Y') == $row['year']) ? 'selected' : '';
                                echo '<option value="' . $row['year'] . '" ' . $selected . '>' . $row['year'] . '</option>';                            }
                          ?>
                        </select>
                    </form>
                    <p class="text-center">

                      <!-- <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                    </p>
                    <div style="width: 90%; margin: auto;">
                        <canvas id="billsChart"> <<?php echo "true"; ?></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- /.row -->

              </div>
            </div>

            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php

include_once "footer.php";


?>

<script>
    // Get data from PHP variables
    const productNames = <?php echo json_encode($productNames); ?>;
    const productQuantities = <?php echo json_encode($productQuantities); ?>;

    //* Create the doughnut chart
    const doughnutChart = new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: productNames,
            datasets: [{
                data: productQuantities,
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                borderWidth: 1,
            }]
        },
        options: {
        }
    });
</script>

<script>
        //* JavaScript code to fetch chart data and create the grouped bar chart using Chart.js
        const yearForm = document.getElementById('yearForm');
        const ctx = document.getElementById('billsChart').getContext('2d');
        let billsChart;

        const colors = [
            '#2a9d8f', '#f3722c', '#264653', '#f9c74f', '#90be6d', '#43aa8b',
            '#577590', '#f9844a', '#a5a58d', '#f8961e', '#f94144', '#e9c46a'
        ];

        const monthsList = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        yearForm.addEventListener('change', function() {
            const formData = new FormData(yearForm);
            const selectedYear = formData.get('year');

            fetchChart(selectedYear);
        });

        function fetchChart(year) {
            // Replace 'YOUR_DB_HOST', 'YOUR_DB_USER', 'YOUR_DB_PASSWORD', and 'YOUR_DB_NAME' with your actual database credentials.
            const serverUrl = window.location.origin;
            const url = `${serverUrl}/akwaaba/ui/fetch_chart_data.php?year=${year}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    updateChart(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function updateChart(data) {
    if (billsChart) {
        billsChart.destroy(); // Destroy the existing chart before creating a new one.
    }

    const labels = Object.keys(data); // Get the customer names as labels.

    const months = Array.from(new Set(Object.values(data).flatMap(Object.keys))); // Get unique months.

    // Sort the months in ascending order (January to December).
    months.sort((a, b) => parseInt(a.split('-')[1]) - parseInt(b.split('-')[1]));

    const datasets = labels.map((customer, index) => {
        const customerData = data[customer];
        return {
            label: customer,
            data: months.map(month => customerData[month] || 0), // Use 0 for months without data.
            backgroundColor: colors[index % colors.length], // Use fixed colors from the colors array.
            stack: index, // Group bars by customer index.
        };
    });

    // Convert month numbers to month names
    const formattedLabels = months.map(month => monthsList[parseInt(month.split('-')[1]) - 1]);

    billsChart = new Chart(ctx, {
        type: 'bar', // Change the chart type to 'bar' for grouped bar chart.
        data: {
            labels: formattedLabels,
            datasets: datasets,
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: false, // Not stacked.
                    beginAtZero: true,
                },
            },
        },
    });
}

        // Fetch the default chart data for the current year when the page loads.
        const defaultYear = <?php echo date('Y'); ?>;
        fetchChart(defaultYear);
    </script>
