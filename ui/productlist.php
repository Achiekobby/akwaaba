<?php 

include_once 'connectdb.php';
session_start();



include_once "header.php";

if(isset($_POST['btnsave'])){

$productlist = $_POST['txtproductlist'];

if(empty($productlist)){

    $_SESSION['status']="Product Feild is Empty";
    $_SESSION['status_code']="warning";



}else{

$insert=$pdo->prepare("insert into tbl_productlist (productlist) value(:prol)");

$insert->bindParam(':prol',$productlist);

if($insert->execute()){
    $_SESSION['status']="Product Added seccessfully";
    $_SESSION['status_code']="success";

}else{

    $_SESSION['status']="Product Added Faild";
    $_SESSION['status_code']="warning";
}
}}








if(isset($_POST['btnupdate'])){

    $productlist = $_POST['txtproductlist'];
    $id = $_POST['txtprolid'];
    
    if(empty($productlist)){
    
        $_SESSION['status']="Product Feild is Empty";
        $_SESSION['status_code']="warning";
    
    
    
    }else{
    
    $update=$pdo->prepare("update tbl_productlist set productlist=:prol where prolid=".$id);
    
    $update->bindParam(':prol',$productlist);
    
    if($update->execute()){
        $_SESSION['status']="Product Update seccessfully";
        $_SESSION['status_code']="success";
    
    }else{
    
        $_SESSION['status']="Product Added Faild";
        $_SESSION['status_code']="warning";
    }

}}



If(isset($_POST['btndelete'])){

    $delete=$pdo->prepare("delete from tbl_productlist where prolid=".$_POST['btndelete']);
    
    if($delete->execute()){
        $_SESSION['status']="Deleted";
        $_SESSION['status_code']="success";
       
    }else{
    
        $_SESSION['status']="Delete Faild";
        $_SESSION['status_code']="warning";
    
    
    }

}else{




}


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
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
        
      <div class="card card-warning card-outline">
              <div class="card-header">
                <h5 class="m-0">Product Form</h5>
              </div>
              

              <form action="" method="post">
              <div class="card-body">
<div class="row"> 


<?php 

if(isset($_POST['btnedit'])){

$select=$pdo->prepare("select * from tbl_productlist where prolid =".$_POST['btnedit']);

$select->execute();

if($select){
$row=$select->fetch(PDO::FETCH_OBJ);

echo'<div class="col-md-4">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Product</label>

  <input type="hidden" class="form-control"  placeholder="Enter Product" value="'.$row->prolid.'" name="txtprolid">

  <input type="text" class="form-control"  placeholder="Enter Product" value="'.$row->productlist.'" name="txtproductlist">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-info" name="btnupdate">Update</button>
</div>



</div>';
 



}





}else{

echo'<div class="col-md-6">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Product Name</label>
  <input type="text" class="form-control"  placeholder="Enter Product"  name="txtproductlist">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>



</div>';




}




?>





<div class="col-md-6"> 
 
<table id="table_productlist" class="table table-striped table-hover">
<thead>
<tr>
 <td>#</td>
 <td>Product</td> 
 <td>Edit</td>  
 <td>Delete</td> 

</tr>

</thead>


<tbody>

<?php 

$select = $pdo->prepare("select * from tbl_productlist order by prolid ASC");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ))
{

echo'
<tr>
<td>'.$row->prolid.'</td>
<td>'.$row->productlist.'</td>

<td>

<button type="submit" class="btn btn-primary" value="'.$row->prolid.'" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="'.$row->prolid.'" name="btndelete">Delete</button>

</td>


</tr>';

}

?> 

</tbody>

<tfoot>

<td>#</td>
 <td>Product</td> 
 <td>Edit</td>  
 <td>Delete</td> 
</tfoot>

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
  <!-- /.content-wrapper -->


<?php 

include_once "footer.php";


?>

<?php 
if(isset($_SESSION['status']) && $_SESSION['status']!='')

{

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
    $('#table_productlist').DataTable();
} );

</script>