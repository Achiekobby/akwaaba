<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

// Function to compute total quantities
function computeTotalQuantities($pdo, $result)
{
    $totalQuantities = 0;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $totalQuantities += $row['volume'];
    }
    return $totalQuantities;
}

    // Function to clean the select value
    function cleanSelectValue($value)
    {
        return trim(htmlspecialchars($value));
    }
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
      <div class="col-lg-6 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>Custom Filter Report</h3>
            <p>This section of the reports give you the opportunity to filter the data based on the parameters below</p>
          </div>
          <div class="icon">
            <i class="ion ion-people"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-6">
        <a href="report.php" class="small-box bg-info">
          <div class="inner">
            <h3>Periodic Reports</h3>
            <p>Go back to the periodic section of the report that shows the Quarterly, Midyear and Yearly Reports</p>
          </div>
          <div class="icon">
            <i class="fas fa-arrow-circle-right"></i>
          </div>
        </a>
      </div>
  </div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header text-bold bg-success">
        Custom Filter Results
      </div>
      <div class="card-body">
  <div class="row">
    <form class="form-inline float-right" method="POST">
      <div class="col-lg-3">
          <select class="form-control mx-2" name="select_customer" id="select_customer">
            <option value="">Select a Customer</option>
            <?php
              $query_customer = $pdo->prepare("SELECT customer FROM tbl_customer ORDER BY customer DESC");
              $query_customer->execute();
              $customers = $query_customer->fetchAll(PDO::FETCH_ASSOC);
              foreach ($customers as $customer):
                $cleanedCustomer = htmlspecialchars($customer['customer']);
            ?>
            <option value="<?php echo $cleanedCustomer; ?>"><?php echo $cleanedCustomer; ?></option>
            <?php endforeach ?>
          </select>
      </div>
      <div class="col-lg-3">
          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
            <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="select a start date" />
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
      </div>

      <div class="col-lg-3">
          <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
            <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="select an end date" />
            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="input-group">
            <input type="submit" name="filter" value="Apply" class="bg-success btn btn-sidebar"/>
            <button type="submit" name="reset" id="reset" value="Reset" class="ml-2 bg-danger btn btn-sidebar">
            <i class="fa fa-refresh" aria-hidden="true"></i>
              Reset Filter
            </button>

          </div>
      </div>
    </form/>
  </div>
  <hr>
  <?php

    //* checking to see if the apply button has been pressed
    if(isset($_POST['filter'])){
      $start_date       = cleanSelectValue($_POST['start_date']);
      $end_date         = cleanSelectValue($_POST['end_date']);
      $select_customer  = cleanSelectValue($_POST['select_customer']);

       //* Validate and convert start_date
        $startDateObj = DateTime::createFromFormat('m/d/Y', $start_date);
        if (!$startDateObj) {
            $start_date = null;
        } else {
            $start_date = $startDateObj->format('Y-m-d H:i:s');
        }

        //* Validate and convert end_date
        $endDateObj = DateTime::createFromFormat('m/d/Y', $end_date);
        if (!$endDateObj) {
            $end_date = null;
        } else {
            $end_date = $endDateObj->format('Y-m-d H:i:s');
        }

      //* Validate the input submitted
      if(!empty($start_date) && empty($end_date)){
        echo "<p class='text-danger text-bold'>Error! You must enter an end date if you enter an start date</p>";
      }
      elseif(empty($start_date) && !empty($end_date)){
        echo "<p class='text-danger text-bold'>Error! You must enter a start date if you enter an end date</p>";
      }
      else{
        $sql ="SELECT tbl_product.*, tbl_consignor.consignor AS consignor_name,
              DATE_FORMAT(tbl_product.created_at, '%d-%b-%Y') AS formatted_created_at
              FROM tbl_product
              INNER JOIN tbl_consignor ON tbl_product.consignor = tbl_consignor.conid
              WHERE 1=1 ";

        if (!empty($start_date) && !empty($end_date)) {
          $sql .= "AND tbl_product.created_at BETWEEN :start_date AND :end_date ";
        }
        if (!empty($select_customer)) {
          $sql .= "AND tbl_product.customer = :customer ";
        }

        //* Prepare and execute the query with parameter binding
        $stmt = $pdo->prepare($sql);

        if (!empty($start_date) && !empty($end_date)) {
          $stmt->bindParam(':start_date', $start_date);
          $stmt->bindParam(':end_date', $end_date);
        }

        if (!empty($select_customer)) {
          $stmt->bindParam(':customer', $select_customer);
        }

        $stmt->execute();
        // echo "<p>{$stmt->rowCount()}</p>";
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";

        //* Displaying the results
        if ($stmt->rowCount() > 0) {
          echo "<p class='text-bold'>Total Quantities for Filtered Items: <h1><span class='badge bg-primary'>".computeTotalQuantities($pdo, $stmt). "</span></h1></p>";

          echo"<table class='table table-hover'>
                <thead  class='text-center'>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Consignor</th>
                    <th>Product</th>
                    <th>Truck (Head/Trailer)</th>
                    <th>Quantity</th>
                    <th>Date Created</th>
              </thead>";
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo "<tbody><tr class='text-center'>
                    <td>{$row['pid']}</td>
                    <td>{$row['customer']}</td>
                    <td>{$row['consignor_name']}</td>
                    <td>{$row['product']}</td>
                    <td>{$row['truck_header_number']}/{$row['truck_trailer_number']}</td>
                    <td>{$row['volume']}</td>
                    <td>{$row['formatted_created_at']}</td>
                </tr></tbody>";
            }

            echo "</table>";

        } else {
          echo "<p>No products found in the database.</p>";
        }

      }

    }else{
      $sql = "SELECT tbl_product.* , tbl_consignor.consignor AS consignor_name, DATE_FORMAT(tbl_product.created_at, '%d-%b-%Y') AS formatted_created_at
      FROM tbl_product
      INNER JOIN tbl_consignor ON tbl_consignor.conid = tbl_product.consignor";
      $result = $pdo->query($sql);
      // $stmt->execute();
      if ($result->rowCount() > 0) {
      echo "<p class='text-bold'>Total Quantities for All Items: <h1><span class='badge bg-primary'>".computeTotalQuantities($pdo, $result). "</span></h1></p>";

      echo"<table class='table table-hover'>
            <thead  class='text-center'>
                <th>#</th>
                <th>Customer</th>
                <th>Consignor</th>
                <th>Product</th>
                <th>Truck (Head/Trailer)</th>
                <th>Quantity</th>
                <th>Date Created</th>
          </thead>";

      // Move the result pointer back to the beginning for filter processing
      $result->execute();

      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

          echo "<tbody><tr class='text-center'>
              <td>{$row['pid']}</td>
              <td>{$row['customer']}</td>
              <td>{$row['consignor_name']}</td>
              <td>{$row['product']}</td>
              <td>{$row['truck_header_number']}/{$row['truck_trailer_number']}</td>
              <td>{$row['volume']}</td>
              <td>{$row['formatted_created_at']}</td>
          </tr></tbody>";
      }

      echo "</table>";
      } else {
      echo "<p>No products found in the database.</p>";
      }
    }
  ?>

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

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({format: 'L'});
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker({format: 'L'});
    });
</script>

<script>
  // Add an event listener to the "Reset" button
  document.getElementById('reset').addEventListener('click', function() {
    // Reset the form fields by setting the form to its initial state
    // document.getElementById('your_form_id').reset();

    // Reload the page to show the original data without search filters
    location.reload();
  });
</script>




