<?php 

include_once 'connectdb.php';
session_start();



include_once "header.php";

if(isset($_POST['btnsave'])){

$customer       = $_POST['txtcustomer'];
$address        = $_POST['txtaddress'];
$city           = $_POST['txtcity'];
$contact        = $_POST['txtcontact'];
$email           = $_POST['txtemail'];

if(empty($customer)){

    $_SESSION['status']="Customer Feild is Empty";
    $_SESSION['status_code']="warning";



}else{

$insert=$pdo->prepare("insert into tbl_customer (customer,address,city,contact,email) value(:cus,:address,:city,:contact,:email)");

$insert->bindParam(':cus',$customer);
$insert->bindParam(':address',$address);
$insert->bindParam(':city',$city);
$insert->bindParam(':contact',$contact);
$insert->bindParam(':email',$email);


if($insert->execute()){
    $_SESSION['status']="Customer Added seccessfully";
    $_SESSION['status_code']="success";

}else{

    $_SESSION['status']="Customer Added Faild";
    $_SESSION['status_code']="warning";
}
}}



if(isset($_POST['btnupdate'])){

    $customer = $_POST['txtcustomer'];
    $id = $_POST['txtcusid'];
    $address = $_POST['txtaddress'];
    $city = $_POST['txtcity'];
    $contact = $_POST['txtcontact'];
    $email = $_POST['txtemail'];
    
    if(empty($customer)){
    
        $_SESSION['status']="Customer Feild is Empty";
        $_SESSION['status_code']="warning";
    
    
    
    }else{
    
    $update=$pdo->prepare("update tbl_customer set customer=:cus, address=:address, city=:city, contact=:contact, email=:email where cusid=".$id);

    $update->bindParam(':cus',$customer);
    $update->bindParam(':address',$address);
    $update->bindParam(':city',$city);
    $update->bindParam(':contact',$contact);
    $update->bindParam(':email',$email);
   
    
    if($update->execute()){
    $_SESSION['status']="Customer Update seccessfully";
    $_SESSION['status_code']="success";
    
    }else{
    
        $_SESSION['status']="Customer Update Faild";
        $_SESSION['status_code']="warning";
    }
    }}


    If(isset($_POST['btndelete'])){

        $delete=$pdo->prepare("delete from tbl_customer where cusid=".$_POST['btndelete']);
        
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
            <h1 class="m-0">Customer</h1>
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
                <h5 class="m-0">Customer Form</h5>
              </div>
              

              <form action="" method="post">
              <div class="card-body">
<div class="row"> 


<?php 

if(isset($_POST['btnedit'])){

$select=$pdo->prepare("select * from tbl_customer where cusid =".$_POST['btnedit']);

$select->execute();

if($select){
$row=$select->fetch(PDO::FETCH_OBJ);

echo'<div class="col-md-4">  

               
<div class="form-group">
  <label for="exampleInputEmail1">Customer</label>
  <input type="hidden" class="form-control"  placeholder="Enter Customer" value="'.$row->cusid.'" name="txtcusid">
  <br>
  <input type="text" class="form-control"  placeholder="Enter Customer" value="'.$row->customer.'" name="txtcustomer">
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

echo'<div class="col-md-4">  


               
<div class="form-group">
  <label for="exampleInputEmail1">Customer</label>
  <input type="text" class="form-control"  placeholder="Enter Customer"  name="txtcustomer">
</div>

<div class="form-group">
  <label for="exampleInputEmail1">CustOder No</label>
  <input type="text" class="form-control"  placeholder="Enter CustOrder No"  name="txtcustoderno">
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




<div class="col-md-8"> 
 
<table id="table_customer" class="table table-striped table-hover">
<thead>
<tr>
 <td>#</td>
 <td>Customer</td> 
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

$select = $pdo->prepare("select * from tbl_customer order by cusid ASC");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ))
{

echo'
<tr>
<td>'.$row->cusid.'</td>
<td>'.$row->customer.'</td>
<td>'.$row->address.'</td>
<td>'.$row->city.'</td>
<td>'.$row->contact.'</td>
<td>'.$row->email.'</td>

<td>

<button type="submit" class="btn btn-primary" value="'.$row->cusid.'" name="btnedit">Edit</button>

</td>

<td>

<button type="submit" class="btn btn-danger" value="'.$row->cusid.'" name="btndelete">Delete</button>

</td>


</tr>';

}

?> 

</tbody>

<tfoot>
<td>#</td>
 <td>Customer</td> 
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
    $('#table_customer').DataTable();
} );

</script>