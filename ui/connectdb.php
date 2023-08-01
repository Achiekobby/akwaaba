<?php

try{

    $pdo = new PDO('mysql:host=localhost;dbname=akwaaba','root','');

}catch(PDOException $e ){

    echo $e->getMessage();


}




   
// echo'connection success';




?>