<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

// Get the base URL dynamically
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
    . "://$_SERVER[HTTP_HOST]";

//* Append the relative path to show_products.php
$showProductsUrl = $baseUrl . "/akwaaba/ui/";

if (isset($_POST['btnsave'])) {

    $productlist    = $_POST['txtselect_product'];
    $unit       = "#";

    //* Select Inputs
    $category     = $_POST['txtselect_option'];
    $meter        = $_POST['txtselect_meter'];
    $consignor    = $_POST['txtselect_consignor'];
    $customer     = $_POST['txtselect_customer'];

    $order_type   = $_POST['txt_order_type'];
    $description  = $_POST['txtdescription'];
    $destination  = $_POST['txtdestination'];
    $volume       = $_POST['txtquantity'];
    $opening      = $_POST['txtopening'];
    $closing      = $_POST['txtclosing'];
    $driver       = $_POST['txtdriver'];

    //* Truck details
    $truck_header_number  = $_POST['truck_header_number'];
    $truck_trailer_number = $_POST['truck_trailer_number'];

    //* datetime
    $timezone = new DateTimeZone('Africa/Accra');
    $current_date = new DateTime('now', $timezone);
    $created_at = $current_date->format('Y-m-d H:i:s');
    $error = "";
    //* checking to see if the opening and closing values are valid figures
    // if(((int)($closing-$opening)) != (int)$volume ){
    //     $error = "Opening or closing value is not valid. Please check again";
    //     echo $error;
    //     $_SESSION['status'] = $error;
    //     $_SESSION['status_code'] = "error";
    //   }
    // else{
      $insert = $pdo->prepare("insert into tbl_product
      (product,category, description, volume, opening, closing, unit_number, meter, destination, driver, truck_header_number,truck_trailer_number, customer, order_type, created_at,consignor)
      values(
        :product,
        :category,
        :description,
        :volume,
        :opening,
        :closing,
        :unit_number,
        :meter,
        :destination,
        :driver,
        :truck_header_number,
        :truck_trailer_number,
        :customer,
        :order_type,
        :created_at,
        :consignor
        )"
      );

      $insert->bindParam(':product', $productlist);
      $insert->bindParam(':unit_number', $unit);
      $insert->bindParam(':category', $category);
      $insert->bindParam(':meter', $meter);
      $insert->bindParam(':description', $description);
      $insert->bindParam(':destination', $destination);
      $insert->bindParam(':truck_header_number', $truck_header_number);
      $insert->bindParam(':truck_trailer_number', $truck_trailer_number);
      $insert->bindParam(':customer', $customer);
      $insert->bindParam(':consignor', $consignor);
      $insert->bindParam(':order_type', $order_type);
      $insert->bindParam(':created_at', $created_at);
      $insert->bindParam(':opening', $opening);
      $insert->bindParam(':closing', $closing);
      $insert->bindParam(':driver', $driver);
      $insert->bindParam(':volume', $volume);

      $insert->execute();

      $pid = $pdo->lastInsertId();

      date_default_timezone_set("Africa/Accra");
      $new_barcode = $pid . date('his');

      $update = $pdo->prepare("update tbl_product SET barcode='$new_barcode' where pid='" . $pid . "'");

      if ($update->execute()) {

          $_SESSION['status'] = "Product Inserted Successfully";
          $_SESSION['status_code'] = "success";
      } else {
          $_SESSION['status'] = "Product Insert Failed";
          $_SESSION['status_code'] = "error";
      }
    }
// }

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Generate Waybill</h1>
      </div>
      <div class="col-sm-6 d-flex justify-content-end">
        <div class="bg-primary">
          <a href="<?php echo $baseUrl .'/akwaaba/ui/showproducts.php'; ?>" class="btn btn-success">Waybill List</a>
        </div><!-- /.col -->
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
                <h5 class="m-0">Product</h5>
              </div>
            <form id="add_product" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <!-- <div class="form-group">
                      <label>Barcode</label>
                      <input type="text" class="form-control"  placeholder="Enter Barcode" name="txtbarcode">
                    </div> -->

                    <div class="form-group">
                      <label>Product Name</label>
                      <select class="form-control" name="txtselect_product" required>
                          <option value="" disabled selected>Select Product</option>

                          <?php
                          $select = $pdo->prepare("select * from tbl_productlist order by productlist desc");
                          $select->execute();
                          $rows = $select->fetchAll(PDO::FETCH_ASSOC);


                          foreach ($rows as $row) :
                          ?>
                              <option value="<?php echo $row['productlist']; ?>"><?php echo $row['productlist']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </select>

                    </div>

                    <!-- <div class="form-group">
                      <label>Unit</label>
                      <input type="text" class="form-control"  placeholder="Enter Product Unit" name="txtunit" required>
                    </div> -->

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="txtselect_option" required>
                          <option value="" disabled selected>Select Category</option>

                          <?php
                          $select = $pdo->prepare("select * from tbl_brv order by brvcategory desc");
                          $select->execute();
                          $rows = $select->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($rows as $row) :
                          ?>
                              <option value="<?php echo $row['brvcategory']; ?>"><?php echo $row['brvcategory']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="txtselect_option">Meter</label>
                      <select class="form-control" name="txtselect_meter" required>
                          <option value="" disabled selected>Select Meter</option>

                          <?php
                          $select = $pdo->prepare("select * from tbl_meter order by meter desc");
                          $select->execute();
                          $rows = $select->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($rows as $row) :
                          ?>
                              <option value="<?php echo $row['metid']; ?>"><?php echo $row['meter']; ?></option>
                          <?php
                          endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                <label>Consignor</label>
                <select class="form-control" name="txtselect_consignor" required>
                  <option value="" disabled selected>Select Consignor</option>
                    <?php
                    $select = $pdo->prepare("select * from tbl_consignor order by consignor desc");
                    $select->execute();
                    $rows = $select->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) :
                    ?>
                        <option value="<?php echo $row['conid']; ?>"><?php echo $row['consignor']; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
              </div>
              <div class="form-group">
                      <label>Customer</label>
                      <select class="form-control" name="txtselect_customer" required>
                          <option value="" disabled selected>Select customer</option>

                          <?php
                          $select = $pdo->prepare("select * from tbl_customer order by customer ASC");
                          $select->execute();
                          $rows = $select->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($rows as $row) :
                          ?>
                              <option value="<?php echo $row['cusid']; ?>"><?php echo $row['customer']; ?></option>
                          <?php
                          endforeach;
                          ?>
                      </select>
                </div>
                <div class="form-group">
                      <label>Order Type</label>
                      <select class="form-control" name="txt_order_type" required>
                          <option value="" disabled selected>Select Order Type</option>
                          <option value="Domestic"  selected>Domestic</option>
                          <option value="Foreign"  selected>Foreign</option>
                      </select>
                </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control"  placeholder="Enter Description" name="txtdescription" rows="3" required></textarea>
                  </div>
              </div>

              <div class="col-md-6">

                <!-- <div class="form-group">
                  <label>Unit</label>
                  <input type="text" class="form-control"  placeholder="Enter Product Unit" name="txtunit" required>
                </div> -->

                <div class="form-group">
                  <label >Destination</label>
                  <input type="text"  class="form-control"  placeholder="Enter Order Destination" name="txtdestination" required>
                </div>

                <div class="form-group">
                  <label >Quantity</label>
                  <input type="number" min="1" step="any" class="form-control"  placeholder="Enter Volume Quantity" name="txtquantity" id="quantity" required>
                </div>

                <div class="form-group">
                  <label >Opening Readings</label>
                  <input id="opening" type="number" min="1" step="any" class="form-control"  placeholder="Enter Opening Readings" name="txtopening" required>
                </div>

                <div class="form-group">
                  <label >Closing Readings</label>
                  <input id="closing" type="number" min="1" step="any" class="form-control"  placeholder="Enter Closing Reading" name="txtclosing" required>
                </div>

                <div class="form-group">
                  <label >Driver</label>
                  <input type="text"   class="form-control"  placeholder="Enter Driver Name" name="txtdriver" required>
                </div>
                <div class="form-group">
                      <label>Truck Head Number</label>
                      <input type="text" class="form-control"  placeholder="Enter Truck Head Number" name="truck_header_number" required>
                </div>
                <div class="form-group">
                      <label>Truck Trailer Number</label>
                      <input type="text" class="form-control"  placeholder="Enter Truck Trailer Number" name="truck_trailer_number" required>
                </div>

              </div>
      </div>

  </div>

          <div class="card-footer">
                <div class="text-center">
                <button id="submit" type="submit" class="btn btn-primary" name="btnsave">Save Waybill</button></div>
                </div>
            </form>

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

<?php if (isset($error) && !empty($error)):?>
    <script>
      swal("Error","<?php echo $error; ?>","error");
    </script>
<?php endif; ?>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] != '') {?>
    <script>
      Swal.fire({
          icon: '<?php echo $_SESSION['status_code']; ?>',
          title: '<?php echo $_SESSION['status']; ?>'
    });
    </script>
<?php unset($_SESSION['status']);} ?>

<script>
  function validateForm(){
    // event.preventDefault();

    const quantity  = parseInt(document.getElementById('quantity').value);
    const opening   = parseInt(document.getElementById('opening').value);
    const closing   = parseInt(document.getElementById('closing').value);
    const button = document.getElementById('submit');

    const difference = closing -  opening;

    if(difference !==quantity){
      alert("The difference between the opening and closing should be equal to the quantity");
      // button.disabled = true;
      document.getElementById('opening').focus();
      return false;
    }
    else{
      button.disabled = false;
      return true;
      // document.getElementById('add_product').submit;
    }
  }
</script>
