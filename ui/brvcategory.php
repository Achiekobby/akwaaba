<?php

include_once 'connectdb.php';
session_start();



include_once "header.php";

if(isset($_POST['btnsave'])){

$brvcategory = $_POST['txtbrv'];

if(empty($brvcategory)){

    $_SESSION['status']="BRV Category Feild is Empty";
    $_SESSION['status_code']="warning";



}else{

$insert=$pdo->prepare("insert into tbl_brv (brvcategory) value(:brv)");

$insert->bindParam(':brv',$brvcategory);

if($insert->execute()){
    $_SESSION['status']="BRV Category Added seccessfully";
    $_SESSION['status_code']="success";

}else{

    $_SESSION['status']="BRV Category Added Faild";
    $_SESSION['status_code']="warning";
}
}}








if(isset($_POST['btnupdate'])){

    $brvcategory = $_POST['txtbrv'];
    $id = $_POST['txtbrvid'];

    if(empty($brvcategory)){

        $_SESSION['status']="BRV Category Feild is Empty";
        $_SESSION['status_code']="warning";



    }else{

    $update=$pdo->prepare("update tbl_brv set brvcategory=:brv where brvid=".$id);

    $update->bindParam(':brv',$brvcategory);

    if($update->execute()){
        $_SESSION['status']="BRV Category Update seccessfully";
        $_SESSION['status_code']="success";

    }else{

        $_SESSION['status']="BRV Category Added Faild";
        $_SESSION['status_code']="warning";
    }
    }}


If(isset($_POST['btndelete'])){

$delete=$pdo->prepare("delete from tbl_brv where brvid=".$_POST['btndelete']);

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
            <h1 class="m-0">BRV Category</h1>
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
                <h5 class="m-0">BRV Category Form</h5>
              </div>
              <form action="" method="post">
              <div class="card-body">
<div class="row">


<?php

if(isset($_POST['btnedit'])){

$select=$pdo->prepare("select * from tbl_brv where brvid =".$_POST['btnedit']);

$select->execute();

if($select){
$row=$select->fetch(PDO::FETCH_OBJ);

echo'<div class="col-md-8">



<div class="form-group">
  <label for="exampleInputEmail1">BRV Category</label>

  <input type="hidden" class="form-control"  placeholder="Enter BRV Category" value="'.$row->brvid.'" name="txtbrvid">

  <input type="text" class="form-control"  placeholder="Enter BRV Category" value="'.$row->brvcategory.'" name="txtbrv">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-info" name="btnupdate">Update</button>
</div>



</div>';




}





}else{

echo'<div class="col-md-6">



<div class="form-group">
  <label for="exampleInputEmail1">BRV Category</label>
  <input type="text" class="form-control"  placeholder="Enter BRV Category"  name="txtbrv">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>



</div>';




}




?>






<div class="col-md-6">

<table  id="table_brv" class="table table-striped table-hover">
<thead>
<tr>
 <td>#</td>
 <td>BRV</td>
 <td>Edit</td>
 <td>Delete</td>

</tr>

</thead>


<tbody>

<?php

$select = $pdo->prepare("select * from tbl_brv order by brvid ASC");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ))
{

echo'
<tr>
<td>'.$row->brvid.'</td>
<td>'.$row->brvcategory.'</td>

<td>

<button type="submit" class="btn btn-primary" value="'.$row->brvid.'" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="'.$row->brvid.'" name="btndelete">Delete</button>

</td>


</tr>';

}

?>

</tbody>

<tfoot>

<td>#</td>
 <td>BRV</td>
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
    $('#table_brv').DataTable();
} );

</script>
