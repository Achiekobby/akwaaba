<?php 
include_once'connectdb.php';
$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_waybill_details a INNER JOIN tbl_product b ON a.product_id=b.pid where a.waybill_id=$id");
$select->execute();

$row_waybill_details=$select->fetchAll(PDO::FETCH_ASSOC);

$response=$row_waybill_details;

header('content-type: application/json');

echo json_encode($response);

?>