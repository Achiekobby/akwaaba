<?php
include_once 'connectdb.php';
session_start();
include_once "header.php";

$serialNumber = uniqid();

//* extract all product names and their corresponding ids
$products_query = $pdo->prepare('select * from tbl_product');
$products_query->execute();
$products = $products_query->fetchAll(PDO::FETCH_ASSOC);

//* creating a waybill entry
if(isset($_POST['btnsavewaybill'])){
  $serial_number  = $_POST['txt_serial_number'];
  $pid            = $_POST['pid'];
  $opening        = $_POST['opening'];
  $closing        = $_POST['closing'];
  $quantity       = $_POST['txt_quantity'];
  $variance       = $_POST['variance'];
  $meter_number   = $_POST['meter_number'];

  $timezone = new DateTimeZone('Africa/Accra');
  $current_date = new DateTime('now', $timezone);
  $created_at = $current_date->format('Y-m-d H:i:s');

  $insert = $pdo->prepare("insert into tbl_bill
  (pid, meter_number, opening, closing, variance, serial_number, quantity, created_at)
  values(
    :pid,
    :meter_number,
    :opening,
    :closing,
    :variance,
    :serial_number,
    :quantity,
    :created_at
    )"
  );

  $insert->bindParam(':pid', $pid);
  $insert->bindParam(':meter_number', $meter_number);
  $insert->bindParam(':opening', $opening);
  $insert->bindParam(':closing', $closing);
  $insert->bindParam(':variance', $variance);
  $insert->bindParam(':serial_number', $serial_number);
  $insert->bindParam(':quantity', $quantity);
  $insert->bindParam(':created_at', $created_at);

  if ($insert->execute()) {
    $_SESSION['status'] = "Waybill created successfully";
    $_SESSION['status_code'] = "success";
    $_SESSION['serial_number'] = $serial_number;
} else {
    $_SESSION['status'] = "Sorry, Waybill creation encountered a problem";
    $_SESSION['status_code'] = "error";
}
}

?>

<style type="text/css">

  .tableFixHead{
  overflow: scroll;
  height: 520px;
  }
  .tableFixHead thead th {
  position: sticky;
  top: 0;
  z-index: 1;
  }

  table {border-color:collapse; width: 100px;}
  th,td {padding: 8px 16px;}
  th{background: #eee;}




</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
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
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Generate Waybill</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                    </div>
                    <input type="text" class="form-control" disabled placeholder="Waybill Serial Number" name="txt_serial_number" id="txt_serial_number" value="<?php echo $serialNumber; ?>">
                </div>
                <select id="productSelect" class="form-control select2" style="width: 100%;">
                    <option selected="selected" disabled="disabled">Select Product</option>
                    <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['pid'] ?>"><?php echo $product['product'] ?></option>
                    <?php endforeach;?>
                </select>
              </br>

              <div class="tableFixHead">
                <table id="producttable" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Unit</th>
                      <th>Meter No</th>
                      <th>Quantity</th>
                      <th>Opening Readings</th>
                      <th>Closing Readings</th>
                      <th>Variance</th>
                      <th>Del</th>
                    </tr>
                  </thead>
                  <tbody class="details" id="itemtable">
                    <tr data-widget="expandable-table" aria-expanded="false">

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


            <div class="col-md-4">
                <form action="" method="post" enctype="multipart/form">
                <input type="text" class="form-control" hidden placeholder="Waybill Serial Number" name="txt_serial_number" id="txt_serial_number" value="<?php echo $serialNumber; ?>">
                  <input type="text" class="form-control" hidden placeholder="Waybill Serial Number" name="txt_quantity" id="txt_quantity">
                  <input type="text" class="form-control" hidden placeholder="Waybill Serial Number" name="meter_number" id="meter_number">
                  <input type="text" class="form-control" hidden placeholder="Waybill Serial Number" name="pid" id="pid">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Quantity</span>
                  </div>
                  <input type="text" class="form-control  text-right text-bold" name="quantity" id="quantity" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">00</span>
                  </div>
                </div>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Opening</span>
                  </div>
                  <input type="text" class="form-control text-right text-bold" id="opening" name="opening" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">00</span>
                  </div>
                </div>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Closing</span>
                  </div>
                  <input type="text" class="form-control text-right text-bold" name="closing" id="closing" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">00</span>
                  </div>
                </div>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Variance</span>
                  </div>
                  <input type="text" class="form-control text-right text-bold" name="variance" id="variance" readonly >
                  <div class="input-group-append">
                    <span class="input-group-text">00</span>
                  </div>
                </div>
                <hr style="height:2px; border-width:0; color:black; background-color:black;">

              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-success" name="btnsavewaybill">Save Waybill</button></div>
                </div>
                <hr style="height:2px; border-width:0; color:black; background-color:black;">
              </div>
          </div>
                </form>
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
  $(document).ready(function() {
    $('#productSelect').select2({
      theme: 'bootstrap4'
    });

    // Add the change event listener to the Select2 element
    $('#productSelect').on('change', function () {
      var selectedProductId = $(this).val(); // Get the selected value
      const serverUrl = window.location.origin;

    const apiUrl = `${serverUrl}/akwaaba/ui/getproduct.php?id=${selectedProductId}`;

    fetch(apiUrl)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(productDetails => {
        console.log('product details', productDetails);

        // Extract the meter_id from productDetails
        const meterId = productDetails.meter;

        // Fetch the meter details using the getmeter.php API
        const meterApiUrl = `${serverUrl}/akwaaba/ui/getmeter.php?id=${meterId}`;
        const variance = parseFloat(productDetails.closing) - parseFloat(productDetails.opening);

        //* summary data
        document.getElementById("variance").value = variance;
        document.getElementById("quantity").value = productDetails.volume;
        document.getElementById("opening").value  = productDetails.opening;
        document.getElementById("closing").value  = productDetails.closing;

        fetch(meterApiUrl)
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(meterDetails => {
            console.log('meter details', meterDetails);

            // Get the meter name from the API response
            const meterName = meterDetails.meter;
             //* Extra data
            document.getElementById("meter_number").value = meterName;
            document.getElementById("txt_quantity").value = productDetails.volume;

            // Get the product ID
            const pid = parseInt(productDetails.pid);

            document.getElementById("pid").value = pid;

            // Generate the HTML for the table rows and update the table
            var html = '<thead><tr><th>Product</th><th>Unit</th><th>Meter No</th><th>Volume</th><th>Opening</th><th>Closing</th><th>Variance</th><th>Del</th></tr></thead>';
            html += '<tbody><tr data-widget="expandable-table" aria-expanded="false">';
            html += '<td>' + productDetails.product + '</td>';
            html += '<td>' + productDetails.unit_number + '</td>';
            html += '<td>' + meterName + '</td>'; // Populating the meter name in the table
            html += '<td>' + productDetails.volume + '</td>';
            html += '<td>' + productDetails.opening + '</td>';
            html += '<td>' + productDetails.closing + '</td>';
            html += '<td>' + variance.toFixed(2) + '</td>'; // Two decimal places for variance
            html += '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove" data-id="' + pid + '"><span class="fas fa-trash"></span></center></td>';
            html += '</tr></tbody>';

            // Update the table with the new content
            document.getElementById("producttable").innerHTML = html;
          })
          .catch(error => {
            console.error('Error fetching meter data:', error);
          });
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
    });
  });
  </script>

  <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <script>
      Swal.fire({
          icon: '<?php echo $_SESSION['status_code']; ?>',
          title: '<?php echo $_SESSION['status']; ?>'
    }).then((result)=>{
      if(result.isConfirmed){
        window.location.href = "invoice.php?serial_number=<?php echo $_SESSION['serial_number'] ?>";
      }
    });
    </script>
    <?php
      unset($_SESSION['status']);
    }?>

</script>
