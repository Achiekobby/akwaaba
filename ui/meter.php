<?php 

include_once 'connectdb.php';
session_start();



include_once "header.php";

if(isset($_POST['btnsave'])){

$meter = $_POST['txtmeter'];

if(empty($meter)){

    $_SESSION['status']="Meter Feild is Empty";
    $_SESSION['status_code']="warning";



}else{

$insert=$pdo->prepare("insert into tbl_meter (meter) value(:met)");

$insert->bindParam(':met',$meter);

if($insert->execute()){
    $_SESSION['status']="Meter Added seccessfully";
    $_SESSION['status_code']="success";

}else{

    $_SESSION['status']="Meter Added Faild";
    $_SESSION['status_code']="warning";
}
}}








if(isset($_POST['btnupdate'])){

    $meter = $_POST['txtmeter'];
    $id = $_POST['txtmetid'];
    
    if(empty($meter)){
    
        $_SESSION['status']="Meter Feild is Empty";
        $_SESSION['status_code']="warning";
    
    
    
    }else{
    
    $update=$pdo->prepare("update tbl_meter set meter=:met where metid=".$id);
    
    $update->bindParam(':met',$meter);
    
    if($update->execute()){
        $_SESSION['status']="Meter Update seccessfully";
        $_SESSION['status_code']="success";
    
    }else{
    
        $_SESSION['status']="Meter Added Faild";
        $_SESSION['status_code']="warning";
    }

}}



If(isset($_POST['btndelete'])){

    $delete=$pdo->prepare("delete from tbl_meter where metid=".$_POST['btndelete']);
    
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
            <h1 class="m-0">Meter</h1>
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
                <h5 class="m-0">Meter Form</h5>
              </div>
              

              <form action="" method="post">
              <div class="card-body">
<div class="row"> 


<?php 

if(isset($_POST['btnedit'])){

$select=$pdo->prepare("select * from tbl_meter where metid =".$_POST['btnedit']);

$select->execute();

if($select){
$row=$select->fetch(PDO::FETCH_OBJ);

echo'<div class="col-md-4">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Meter</label>

  <input type="hidden" class="form-control"  placeholder="Enter Meter" value="'.$row->metid.'" name="txtmetid">

  <input type="text" class="form-control"  placeholder="Enter Meter" value="'.$row->meter.'" name="txtmeter">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-info" name="btnupdate">Update</button>
</div>



</div>';
 



}





}else{

echo'<div class="col-md-6">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Category</label>
  <input type="text" class="form-control"  placeholder="Enter Meter"  name="txtmeter">
</div>


<div class="card-footer">
<button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>



</div>';




}




?>





<div class="col-md-6"> 
 
<table id="table_meter" class="table table-striped table-hover">
<thead>
<tr>
 <td>#</td>
 <td>Meter</td> 
 <td>Edit</td>  
 <td>Delete</td> 

</tr>

</thead>


<tbody>

<?php 

$select = $pdo->prepare("select * from tbl_meter order by metid ASC");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ))
{

echo'
<tr>
<td>'.$row->metid.'</td>
<td>'.$row->meter.'</td>

<td>

<button type="submit" class="btn btn-primary" value="'.$row->metid.'" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="'.$row->metid.'" name="btndelete">Delete</button>

</td>


</tr>';

}

?> 

</tbody>

<tfoot>

<td>#</td>
 <td>Meter</td> 
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
    $('#table_meter').DataTable();
} );

</script>