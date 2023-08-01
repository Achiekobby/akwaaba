<?php 

include_once 'connectdb.php';
session_start();



include_once "header.php";

if(isset($_POST['btnsave'])){

$consignor      = $_POST['txtconsignor'];
$address        = $_POST['txtaddress'];
$city           = $_POST['txtcity'];
$contact        = $_POST['txtcontact'];
$email           = $_POST['txtemail'];

if(empty($consignor)){

    $_SESSION['status']="Consignor Feild is Empty";
    $_SESSION['status_code']="warning";



}else{

$insert=$pdo->prepare("insert into tbl_consignor (consignor,address,city,contact,email) value(:con,:address,:city,:contact,:email)");

$insert->bindParam(':con',$consignor);
$insert->bindParam(':address',$address);
$insert->bindParam(':city',$city);
$insert->bindParam(':contact',$contact);
$insert->bindParam(':email',$email);


if($insert->execute()){
    $_SESSION['status']="Consignor Added seccessfully";
    $_SESSION['status_code']="success";

}else{

    $_SESSION['status']="Consignor Added Faild";
    $_SESSION['status_code']="warning";
}
}}



if(isset($_POST['btnupdate'])){

    $consignor = $_POST['txtconsignor'];
    $id = $_POST['txtconid'];
    $address = $_POST['txtaddress'];
    $city = $_POST['txtcity'];
    $contact = $_POST['txtcontact'];
    $email = $_POST['txtemail'];
    
    if(empty($consignor)){
    
        $_SESSION['status']="Consignor Feild is Empty";
        $_SESSION['status_code']="warning";
    
    
    
    }else{
    
    $update=$pdo->prepare("update tbl_consignor set consignor=:con, address=:address, city=:city, contact=:contact, email=:email where conid=".$id);

    $update->bindParam(':con',$consignor);
    $update->bindParam(':address',$address);
    $update->bindParam(':city',$city);
    $update->bindParam(':contact',$contact);
    $update->bindParam(':email',$email);
   
    
    if($update->execute()){
    $_SESSION['status']="Consignor Update seccessfully";
    $_SESSION['status_code']="success";
    
    }else{
    
        $_SESSION['status']="Consignor Update Faild";
        $_SESSION['status_code']="warning";
    }
    }}


    If(isset($_POST['btndelete'])){

        $delete=$pdo->prepare("delete from tbl_consignor where conid=".$_POST['btndelete']);
        
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
        <div class="row mb-4">
          <div class="col-sm-8">
            <h1 class="m-0">Consignor</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
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
                <h5 class="m-0">Consignor Form</h5>
              </div>
              <div class="card-body">

              <form action="" method="post">

<div class="row"> 


<?php 

if(isset($_POST['btnedit'])){

$select=$pdo->prepare("select * from tbl_consignor where conid =".$_POST['btnedit']);

$select->execute();

if($select){
$row=$select->fetch(PDO::FETCH_OBJ);

echo'<div class="col-md-3">  

               
<div class="form-group">
  <label for="exampleInputEmail1">Consignor</label>
  <input type="hidden" class="form-control"  placeholder="Enter Consignor" value="'.$row->conid.'" name="txtconid">
  <br>
  <input type="text" class="form-control"  placeholder="Enter Consignor" value="'.$row->consignor.'" name="txtconsignor">
  <br>
  <input type="text" class="form-control"  placeholder="Enter Address"  value="'.$row->address.'" name="txtaddress">
  <br>
  <input type="text" class="form-control"  placeholder="Enter City" value="'.$row->city.'" name="txtcity">
  <br>
  <input type="text" class="form-control"  placeholder="Enter Contact" value="'.$row->contact.'" name="txtcontact">
  <br>
  <input type="text" class="form-control"  placeholder="Enter Email" value="'.$row->email.'" name="txtemail">
</div>

<div class="card-footer">
<button type="submit" class="btn btn-info" name="btnupdate">Update</button>
</div>


</div>';
               

}





}else{

echo'<div class="col-md-3">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Consignor</label>
  <input type="text" class="form-control"  placeholder="Enter Consignor"  name="txtconsignor">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Address</label>
  <input type="text" class="form-control"  placeholder="Enter Address"  name="txtaddress">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">City</label>
  <input type="text" class="form-control"  placeholder="Enter City"  name="txtcity">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Contact</label>
  <input type="text" class="form-control"  placeholder="Enter Contact"  name="txtcontact">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">User</label>
  <input type="text" class="form-control"  placeholder="Enter Email"  name="txtemail">
</div>

<div class="card-footer">
<button type="submit" class="btn btn-warning" name="btnsave">Save</button>
</div>



</div>';




}




?>




<div class="col-md-6"> 
 
<table id="table_consignor" class="table table-striped table-hover">
<thead>
<tr>
 <td>#</td>
 <td>Consignor</td> 
 <td>Address</td> 
 <td>City</td> 
 <td>Contact</td> 
 <td>Email</td> 
 <td>Edit</td>  
 <td>Delete</td> 

</tr>

</thead>


<tbody>

<?php 

$select = $pdo->prepare("select * from tbl_consignor order by conid ASC");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ))
{

echo'
<tr>
<td>'.$row->conid.'</td>
<td>'.$row->consignor.'</td>
<td>'.$row->address.'</td>
<td>'.$row->city.'</td>
<td>'.$row->contact.'</td>
<td>'.$row->email.'</td>

<td>

<button type="submit" class="btn btn-primary" value="'.$row->conid.'" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="'.$row->conid.'" name="btndelete">Delete</button>

</td>


</tr>';

}

?> 

</tbody>

<tfoot>
<td>#</td>
 <td>Consignor</td> 
 <td>Address</td> 
 <td>City</td> 
 <td>Contact</td> 
 <td>Email</td> 
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
    $('#table_consignor').DataTable();
} );

</script>