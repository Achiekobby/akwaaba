<?php

include_once 'connectdb.php';
session_start();
include_once "header.php";

if (isset($_GET['id'])) {
  echo "heelo";
  // Ensure that the value is an integer (for security reasons)
  $pidToDelete = intval($_GET['id']);

  // Prepare the delete query using a placeholder
  $delete = $pdo->prepare("DELETE FROM tbl_product WHERE pid = :pidToDelete");

  // Bind the parameter safely
  $delete->bindParam(':pidToDelete', $pidToDelete, PDO::PARAM_INT);

  if ($delete->execute()) {
      $_SESSION['status'] = "Deleted";
      $_SESSION['status_code'] = "success";
  } else {
      $_SESSION['status'] = "Delete Failed";
      $_SESSION['status_code'] = "warning";
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
            <h1 class="m-0">All Products</h1>
          </div>
          <div class="col-sm-6 d-flex justify-content-end">
            <div class="bg-primary">
              <a href="addproduct.php" class="btn btn-primary">New Waybill</a>
            </div><!-- /.col -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

            <div class="card card-warning card-outline">
              <div class="card-body">

              <div class="row">


              <div class="col-md-12">

                <table  id="table_brv" class="table table-striped table-hover">
                  <thead class="text-bold text-center">
                    <tr>
                      <td>#</td>
                      <td>Product</td>
                      <td>Category</td>
                      <td>Consignor</td>
                      <td>Customer</td>
                      <td>Meter</td>
                      <td>Volume</td>
                      <td>Opening</td>
                      <td>Closing</td>
                      <td>Destination</td>
                      <td>Driver</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                <tbody>

<?php

$select = $pdo->prepare("select * from tbl_product order by created_at DESC");
$select->execute();
$products = $select->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($products as $product) :?>
  <tr>
        <td><?php echo htmlspecialchars($product['pid']); ?></td>
        <td><?php echo htmlspecialchars($product['product']); ?></td>
        <td>
          <?php
            $cat_id = $product['category']; // Assuming you have an 'id' column in the tbl_product table
            $category = $pdo->prepare("SELECT brvcategory FROM tbl_brv WHERE brvid = :category_id");
            $category->bindParam(':category_id', $cat_id);
            $category->execute();
            $category_name = $category->fetch(PDO::FETCH_COLUMN);

            echo htmlspecialchars($category_name);
          ?>
        </td>
        <td>
          <?php
            $consignor_id = $product['consignor']; // Assuming you have an 'id' column in the tbl_product table
            $consignor = $pdo->prepare("SELECT consignor FROM tbl_consignor WHERE conid = :consignor_id");
            $consignor->bindParam(':consignor_id', $consignor_id);
            $consignor->execute();
            $consignor_name = $consignor->fetch(PDO::FETCH_COLUMN);

            echo htmlspecialchars($consignor_name);
          ?>
          <td><?php echo htmlspecialchars($product['customer']) ?></td>
        <td>
          <?php
            $meter_id = $product['meter']; // Assuming you have an 'id' column in the tbl_product table
            $meter = $pdo->prepare("SELECT meter FROM tbl_meter WHERE metid = :meter_id");
            $meter->bindParam(':meter_id', $meter_id);
            $meter->execute();
            $meter_name = $meter->fetch(PDO::FETCH_COLUMN);

            echo htmlspecialchars($meter_name);
          ?>
        </td>
        <td><?php echo htmlspecialchars($product['volume']); ?></td>
        <td><?php echo htmlspecialchars($product['opening']); ?></td>
        <td><?php echo htmlspecialchars($product['closing']); ?></td>
        <td><?php echo htmlspecialchars($product['destination']); ?></td>
        <td><?php echo htmlspecialchars($product['driver']); ?></td>
        <td>
          <div class="d-flex">
            <button type='submit' data-id="<?php echo $product['pid']; ?>" class="btn btn-info mr-2 save"  name="btnsave">
              <i class="fas fa-save fa-sm"></i>
            </button>
            <a href="editproduct.php?id=<?php echo $product['pid'] ?>" class="btn btn-warning" name="btnedit">
              <i class="fas fa-edit fa-sm"></i>
            </a>
            <a type="submit" class="btn btn-danger ml-2" href="showproducts.php?id=<?php echo  htmlspecialchars($product['pid']); ?>">
              <i class="fas fa-trash fa-sm"></i>
            </a>
          </div>
        </td>



      </tr>
  <?php endforeach; ?>

</tbody>

</table>
</div>
              </div>

              </form>


              </div>
            </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once "footer.php";
?>

<?php
if(isset($_SESSION['status']) && $_SESSION['status']!=''){
?>
<script>
      Swal.fire({
        icon: '<?php echo $_SESSION['status_code'];?>',
        title: '<?php echo $_SESSION['status'];?>'
      });
</script>
<?php
unset($_SESSION['status']);
}
?>
<script>

$(document).ready( function () {
    $('#table_brv').DataTable();

    $(".save").on("click",function(event){
        event.preventDefault();

        //* Retrieve the id value from the data-id
        const pid = $(this).data('id');
        console.log("pid",pid);

        //* Make the Ajax Request
        $.ajax({
          type: "POST",
          url:"helper.php",
          data:{pid:pid},
          dataType: "json",
          success:function(response){
            console.log("response",response);
            const serial_number = response[0].serial_number;

            const redirectUrl = `invoice.php?serial_number=${serial_number}`;
            window.location.href = redirectUrl;
          },
          error:function(xhr, status, error){
            console.log(error);
          }
        });
      })
} );

</script>

