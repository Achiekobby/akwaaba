<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

//* Retrieve all the details of the item being edited
if(isset($_GET['id'])){
  $product_id = $_GET['id'];

  //Tip:: Query to extract the details of the product
  $product_query =$pdo->prepare("select * from tbl_product where pid=$product_id");
  $product_query->execute();

  $old_product_data=$product_query->fetch(PDO::FETCH_ASSOC);
}

//* Append the relative path to show_products.php
$showProductsUrl = $baseUrl . "/akwaaba/ui/";

if (isset($_POST['btnedit'])) {

    $product    = $_POST['txtproductname'];
    $unit       = $_POST['txtunit'];

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
    $created_at = $old_product_data['created_at'];

    $update_product = $pdo->prepare("update tbl_product set
        product=:product,
        category=:category,
        description=:description,
        volume=:volume,
        opening=:opening,
        closing=:closing,
        unit_number=:unit_number,
        meter=:meter,
        destination=:destination,
        driver=:driver,
        truck_header_number=:truck_header_number,
        truck_trailer_number=:truck_trailer_number,
        customer=:customer,
        order_type=:order_type,
        created_at=:created_at,
        consignor=:consignor where pid=$product_id"
      );

      $update_product->bindParam(':product', $product);
      $update_product->bindParam(':unit_number', $unit);
      $update_product->bindParam(':category', $category);
      $update_product->bindParam(':meter', $meter);
      $update_product->bindParam(':description', $description);
      $update_product->bindParam(':destination', $destination);
      $update_product->bindParam(':truck_header_number', $truck_header_number);
      $update_product->bindParam(':truck_trailer_number', $truck_trailer_number);
      $update_product->bindParam(':customer', $customer);
      $update_product->bindParam(':consignor', $consignor);
      $update_product->bindParam(':order_type', $order_type);
      $update_product->bindParam(':created_at', $created_at);
      $update_product->bindParam(':opening', $opening);
      $update_product->bindParam(':closing', $closing);
      $update_product->bindParam(':driver', $driver);
      $update_product->bindParam(':volume', $volume);

      $update_product->execute();
      $old_barcode = $old_product_data['barcode'];

      $update = $pdo->prepare("update tbl_product SET barcode='$old_barcode' where pid='" . $product_id . "'");

      if ($update->execute()) {

          $_SESSION['status'] = "Product Updated Successfully";
          $_SESSION['status_code'] = "success";
      } else {
          $_SESSION['status'] = "Product Update Failed";
          $_SESSION['status_code'] = "error";
      }

}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Product[<?php echo $old_product_data['product'] ?>]</h1>
      </div>
      <div class="col-sm-6 d-flex justify-content-end">
        <div class="bg-primary">
          <a href="<?php echo $baseUrl .'/akwaaba/ui/showproducts.php'; ?>" class="btn btn-success">Products</a>
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
                <h5 class="m-0">Edit Product</h5>
              </div>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <!-- <div class="form-group">
                      <label>Barcode</label>
                      <input type="text" class="form-control"  placeholder="Enter Barcode" name="txtbarcode">
                    </div> -->

                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control"  placeholder="Enter Product Name" name="txtproductname" value="<?php echo $old_product_data['product'] ?>" required>
                    </div>

                    <!-- <div class="form-group">
                      <label>Unit</label>
                      <input type="text" class="form-control"  placeholder="Enter Product Unit" value="<?php echo $old_product_data['unit_number'] ?>" name="txtunit" required>
                    </div> -->

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="txtselect_option" required>
                          <!-- <option value="" disabled selected>Select Category</option> -->
                          <?php
                            $cat_id = $old_product_data['category'];
                            $cat_query = $pdo->prepare("select * from tbl_brv where brvid=:cat_id");
                            $cat_query->bindParam(':cat_id', $cat_id);
                            $cat_query->execute();
                            $cat_name = $cat_query->fetch(PDO::FETCH_ASSOC);

                          ?>
                          <option value="<?php echo $cat_name['brvid']; ?>"><?php echo $cat_name['brvcategory']; ?></option>

                          <?php
                          $select = $pdo->prepare("select * from tbl_brv order by brvcategory desc");
                          $select->execute();
                          $rows = $select->fetchAll(PDO::FETCH_ASSOC);

                          foreach ($rows as $row) :
                          ?>
                              <option value="<?php echo $row['brvid']; ?>"><?php echo $row['brvcategory']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="txtselect_option">Meter</label>
                      <select class="form-control" name="txtselect_meter" required>
                      <?php
                            $meter_id = $old_product_data['meter'];
                            $meter_query = $pdo->prepare("select * from tbl_meter where metid=:meter_id");
                            $meter_query->bindParam(':meter_id', $meter_id);
                            $meter_query->execute();
                            $meter_name = $meter_query->fetch(PDO::FETCH_ASSOC);

                          ?>
                          <option value="<?php echo $meter_name['metid']; ?>"><?php echo $meter_name['meter'] ?></option>
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
                <?php
                      $consignor_id = $old_product_data['consignor'];
                      $con_query = $pdo->prepare("select * from tbl_consignor where conid=:consignor_id");
                      $con_query->bindParam(':consignor_id', $consignor_id);
                      $con_query->execute();
                      $con_name = $con_query->fetch(PDO::FETCH_ASSOC);
                  ?>
                    <option value="<?php echo $con_name['conid']; ?>"><?php echo $con_name['consignor'] ?></option>
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
                      <?php
                      $customer_id = $old_product_data['customer'];
                      $customer_query = $pdo->prepare("select * from tbl_customer where cusid=:customer_id");
                      $customer_query->bindParam(':customer_id', $customer_id);
                      $customer_query->execute();
                      $customer_name = $customer_query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <option value="<?php echo $customer_name['cusid'] ?>"><?php echo $customer_name['customer'] ?></option>
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
                          <option value="<?php echo $old_product_data['order_type']  ?>" disabled ><?php echo $old_product_data['order_type'] ?></option>
                          <option value="Domestic" >Domestic</option>
                          <option value="Foreign" >Foreign</option>
                      </select>
                </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea  class="form-control" value="<?php echo $old_product_data['description'] ?>"  placeholder="Enter Description" name="txtdescription" rows="3" required><?php echo $old_product_data['description'] ?></textarea>
                  </div>
              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label>Unit</label>
                  <input type="text" class="form-control" value="<?php echo $old_product_data['unit_number'] ?>"  placeholder="Enter Product Unit" name="txtunit" required>
                </div>

                <div class="form-group">
                  <label >Destination</label>
                  <input type="text"  class="form-control" value="<?php echo $old_product_data['destination'] ?>"   placeholder="Enter Order Destination" name="txtdestination" required>
                </div>

                <div class="form-group">
                  <label >Quantity</label>
                  <input type="number" min="1" step="any" class="form-control" value="<?php echo $old_product_data['volume'] ?>"   placeholder="Enter Volume Quantity" name="txtquantity" required>
                </div>

                <div class="form-group">
                  <label >Opening Readings</label>
                  <input type="number" min="1" step="any" class="form-control" value="<?php echo $old_product_data['opening'] ?>"   placeholder="Enter Opening Readings" name="txtopening" required>
                </div>

                <div class="form-group">
                  <label >Closing Readings</label>
                  <input type="number" min="1" step="any" class="form-control" value="<?php echo $old_product_data['closing'] ?>"   placeholder="Enter Closing Reading" name="txtclosing" required>
                </div>

                <div class="form-group">
                  <label >Driver</label>
                  <input type="text"   class="form-control" value="<?php echo $old_product_data['driver'] ?>"   placeholder="Enter Driver Name" name="txtdriver" required>
                </div>
                <div class="form-group">
                      <label>Truck Head Number</label>
                      <input type="text" class="form-control" value="<?php echo $old_product_data['truck_header_number'] ?>"   placeholder="Enter Truck Head Number" name="truck_header_number" required>
                </div>
                <div class="form-group">
                      <label>Truck Trailer Number</label>
                      <input type="text" class="form-control" value="<?php echo $old_product_data['truck_trailer_number'] ?>"   placeholder="Enter Truck Trailer Number" name="truck_trailer_number" required>
                </div>

              </div>
      </div>

  </div>

          <div class="card-footer">
                <div class="text-center">
                <button type="submit" class="btn btn-success" name="btnedit">Update Product</button></div>
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

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

    ?>
    <script>
      Swal.fire({
          icon: '<?php echo $_SESSION['status_code']; ?>',
          title: '<?php echo $_SESSION['status']; ?>'
    }).then((result)=>{
      if(result.isConfirmed){
        window.location.href = "showproducts.php";
      }
    });
    </script>
    <?php
unset($_SESSION['status']);
}
?>
