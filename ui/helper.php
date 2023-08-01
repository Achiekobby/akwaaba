<?php

include_once'connectdb.php';

//* creating a waybill entry
if(isset($_POST['pid'])){
  $pid  = $_POST['pid'];

$select=$pdo->prepare("select * from tbl_product where pid=$pid");
$select->execute();

$product          = $select->fetch(PDO::FETCH_ASSOC);
$meter_number     = $product['meter'];
$opening          = $product['opening'];
$closing          = $product['closing'];
$serial_number    = $product['barcode'];
$variance         = $product['closing'] - $product['opening'];
$quantity         = $product['volume'];

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

  $insert->execute();

  $useful_data  = [];
  array_push($useful_data, [
    'status'=>'success',
    'pid'=>$pid,
    'serial_number'=>$serial_number
  ]);

  header('Content-Type: application/json');

  echo json_encode($useful_data);

}
?>
