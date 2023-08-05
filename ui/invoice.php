<?php

include_once 'connectdb.php';
session_start();
include_once "header.php";

$sql = "SELECT * FROM temperature_data ORDER BY date DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$latestTemperature = $stmt->fetch(PDO::FETCH_ASSOC);
$latestTemperatureValue = $latestTemperature['temperature'];

if (isset($_GET['serial_number'])) {
    $serial_number = $_GET['serial_number'];

    //* extract the details of the waybill
    $waybill_query = $pdo->prepare("SELECT * FROM tbl_bill WHERE serial_number = :serial_number");
    $waybill_query->bindParam(':serial_number', $serial_number);
    $waybill_query->execute();
    $waybill = $waybill_query->fetch(PDO::FETCH_OBJ);

    //* date
    $date = new DateTime($waybill->created_at);
    $new_date = $date->format('d/m/Y');

    //* extract the product details
    $pid = $waybill->pid;
    $product_query = $pdo->prepare("SELECT * FROM tbl_product WHERE pid = :pid");
    $product_query->bindParam(':pid', $pid);
    $product_query->execute();
    $product = $product_query->fetch(PDO::FETCH_OBJ);

    $time = new DateTime($product->created_at);
    $new_time = $time->format("h:i A");

    //* consignor
    $conid = $product->consignor;
    $consignor_query = $pdo->prepare("SELECT * FROM tbl_consignor WHERE conid = :conid");
    $consignor_query->bindParam(':conid', $conid);
    $consignor_query->execute();
    $consignor = $consignor_query->fetch(PDO::FETCH_OBJ);

    //* customer
    $cusid = $product->customer;
    $customer_query = $pdo->prepare("SELECT * FROM tbl_customer WHERE cusid = :cusid");
    $customer_query->bindParam(':cusid', $cusid);
    $customer_query->execute();
    $customer = $customer_query->fetch(PDO::FETCH_OBJ);

}

?>

<style>
  @media print {
    #print{
      display:none;
    }
    #pdf{
      display:none;
    }
  }
</style>


  <!-- Content Wrapper. Contains page content -->
  <div id="content_wrapper" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div id="content-header" class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Waybill</h1>
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
            <div id="invoice" class="card card-primary card-outline">
                <div class="card-header">
                  <!-- <h5 class="m-0">WAYBILL</h5> -->
                </div>
                <div class="card-body">
                  <!-- Main content -->
                  <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                      <div class="col-12">
                        <h4>
                          <i class="fa fa-gears"></i> WAYBILL.
                          <small class="float-right">Date: <?php echo $new_date ?></small>
                        </h4>
                      </div>
                      <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        <H5><strong>CONSIGNOR</strong>
                          <address>
                            <strong><?php echo $consignor->consignor; ?></strong><br>
                            <?php echo $consignor->address . ", " . $consignor->city; ?><br>
                            Phone: <?php echo $consignor->contact; ?><br>
                            Email: <?php echo $consignor->email; ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        <h5><strong>CUSTOMER:</strong> <?php echo $product->customer ?>
                        <!-- <br><strong>CUSTOMER NO:</strong> GB1607601 -->
                        <br><strong>DESTINATION:</strong><?php echo strtoupper($product->destination); ?>
                        <br><strong>DRIVER:</strong> <?php echo strtoupper($product->driver); ?>
                        <br><strong>NPA REFRENCE :</strong>..........................

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                         <h5> <b>Waybill Serial #<?php echo $waybill->serial_number; ?></b><br>
                          <b>Order TYPE:</b> <?php echo $product->order_type; ?><br>
                          <b>Loading Time:</b> <?php echo $new_time; ?><br>
                          <b>Truck Header No:</b> <?php echo $product->truck_header_number; ?><br>
                          <b>Truck Trailer No:</b> <?php echo $product->truck_trailer_number; ?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-12 table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                  <hr style="height:2px; border-width:0; color:black; background-color:black;"> <br>
                                  <div class="card-header">
                                  <h4> <class="m-0"><strong><CENTER><u>COMPARTMENT DETAILS</u></CENTER></strong></h4>
                                  <hr style="height:2px; border-width:0; color:black; background-color:black;"><br>
                                  </div><BR><h4><b>Seals:
                                  <br><br>
                                  <h4><b><BR>Seals:<br>
                                  <hr>
                                    <b>Ullages:<br></b> <br>
                                    <div><br></div>
                                    <!-- <div class="container justify-content-start bg-primary"> -->
                                      <div class="row justify-content-start">
                                        <div class="col">
                                          <b>Front:</b> <br>
                                        </div>

                                        <div class="col">
                                          <b>Rear:</b> <br>
                                        </div>
                                      <!-- </div> -->
                                    </div>


<br>
<br>
<br>

<h3><center><strong> <u>LOADING SUMMARY</u></strong><center></center></h3>

                                    <!-- <b>Front:</b> <br>
                                    <b>Rear:</b> <br> -->

                                  <hr style="height:4px; border-width:0; color:black; background-color:black;">
                                  <h3>
                                  <th>Product</th>
                                  <th>Unit</th>
                                  <th>Meter No.</th>
                                  <th>BRV Volume</th>
                                  <th>Opening Readings</th>
                                  <th>Closing Readings</th>
                                  <th>Variance</th></h3>
                              </tr>
                            </thead>

                            <tbody>
                              <tr>
                                <td><?php echo $product->product; ?></td>
                                <td><?php echo $product->unit_number; ?></td>
                                <td><?php echo $waybill->meter_number; ?></td>
                                <td><?php echo $product->volume; ?></td>
                                <td><?php echo $product->opening; ?></td>
                                <td><?php echo $product->closing; ?></td>
                                <td><?php echo $waybill->variance; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- /.row -->
                      <hr style="height:4px; border-width:0; color:black; background-color:black;">
                      <div class="row">
                        <div class="col-6">
                        <p class="lead"><h4><b>Grand Total: <span class="text-bold"><?php echo " " . number_format((float) $waybill->variance, 2, '.', ''); ?></span></p>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Start of Remarks: -->
                      <div class="row justify-content-start">
                        <h5 class="m-0 text-bold"> Remarks:</h5>
                        <hr style="height:2px; border-width:0; color:black; background-color:black;"><br>
                      </div>
                      <!-- End of Remarks: -->
                      <div><br></div>

                    <form action="" id="invoice_form">
                      <div class="row justify-content-start">
                          <div class="col">
                            <div class="form-group">
                              <label for="cert">Cert: </label><span id="certificate"></span>
                              <input type="text" class="form-control" id="cert" name="cert">
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                              <label for="batch_no">Batch No:#</label><span id="batch_number"></span>
                              <input type="number" class="form-control" id="batch_no" name="batch_no">
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                              <label for="density">Density:</label><span id="density_number"></span>
                              <input type="number" class="form-control" id="density" name="density">
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                              <label for="tank">Tank:#</label><span id="tank_number"></span>
                              <input type="number" class="form-control" id="tank" name="tank">
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                              <label for="temp">Temp:</label><span id="temperature_number"></span>
                              <input type="number" class="form-control" id="temp" name="temp" value="<?php echo $latestTemperatureValue; ?>" readonly>
                            </div>
                          </div>
                        </div>
                    </form>
                    <!-- Hidden div to display the extracted values -->
<!-- <div id="hidden_display" class="row justify-content-start" style="display: none;">
  <div class="col">
    <b>Cert:</b><span id="certificate"></span> <br>
  </div>
  <div class="col">
    <b>Batch No:#</b><span id="batch_number"></span> <br>
  </div>
  <div class="col">
    <b>Density:</b><span id="density_number"></span> <br>
  </div>
  <div class="col">
    <b>Tank:</b><span id="tank_number"></span> <br>
  </div>
  <div class="col">
    <b>Temp:</b><span id="temperature_number"></span> <br>
  </div>
</div> -->

                    <hr style="height:2px; border-width:0; color:black; background-color:black;"><br>
                    <div><br></div>
                    <div><br></div>


<br>
<br>
<br>
<br>
                    <div class="row justify-content-start">
                        <div class="col">
                        <h5> <b>DRIVER:___________</b> <br>
                        </div>

                        <div class="col">
                        <h5><b>SUPERVISOR:___________</b> <br>
                        </div>
                        <div class="col">
                        <h5><b>CUSTOMS OFFICER:___________</b> <br>
                        </div>
                    </div>

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-12">
                          <a id="print" rel="noopener" onclick="printPage(event)" target="_blank" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</a>
                          <!-- <button id="pdf" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                          </button> -->
                        </div>
                      </div>
                    </div>
                    <!-- /.invoice -->
                    </div>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </div>
        </div>
  </div>


<?php
  // include_once "footer.php";
?>
<script>
    var originalUrl;

    function printPage(event) {
      event.preventDefault();
      //* form
      const form = document.getElementById("invoice_form");

          // Get the input values from the form fields
          const certValue = document.getElementById("cert").value;
          const batchNoValue = document.getElementById("batch_no").value;
          const densityValue = document.getElementById("density").value;
          const tankValue = document.getElementById("tank").value;
          const tempValue = document.getElementById("temp").value;

        // Display the values in the respective spans
        document.getElementById("certificate").textContent = certValue;
        document.getElementById("batch_number").textContent = batchNoValue;
        document.getElementById("density_number").textContent = densityValue;
        document.getElementById("tank_number").textContent = tankValue;
        document.getElementById("temperature_number").textContent = tempValue;

        // Hide the input fields
        document.getElementById("cert").style.display = "none";
        document.getElementById("batch_no").style.display = "none";
        document.getElementById("density").style.display = "none";
        document.getElementById("tank").style.display = "none";
        document.getElementById("temp").style.display = "none";

        // document.getElementById("hidden_display").style.display = "block";


        originalUrl = window.location.href; // Store the current URL with parameters
        window.onbeforeprint = function() {
            // Code to be executed before print
            console.log('Print dialog opened.');
        };
        window.onafterprint = function() {
            // Code to be executed after print (if the user cancels the print action)
            console.log('Print dialog closed.');
            window.location.hash = ''; // Remove the hash fragment
        };
        window.location.hash = 'print'; // Set a hash fragment temporarily
        window.print(); // Initiates the print action
    }

</script>


