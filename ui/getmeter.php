<?php

include_once'connectdb.php';

$meter_id=$_GET["id"];


$select=$pdo->prepare("select * from tbl_meter where metid=$meter_id");
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$response=$row;

header('Content-Type: application/json');

echo json_encode($response);





?>
