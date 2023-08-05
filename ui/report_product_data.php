<?php
include_once'connectdb.php';

if(isset($_GET['report_type'])){
  $report_type = $_GET['report_type'];
  $report_duration = $_GET['report_duration'];

  if($report_type === "product"){
    if($report_duration==="quarterly"){
      $sql = "SELECT YEAR(created_at) AS year,
              CONCAT('Q', QUARTER(created_at)) AS period,
              customer,
              COUNT(*) AS num_bills,
              SUM(volume) AS total_quantity
              FROM tbl_product
              WHERE QUARTER(created_at) IN (1, 2, 3, 4)
              GROUP BY YEAR(created_at), QUARTER(created_at), customer
              ORDER BY YEAR(created_at), QUARTER(created_at), customer;";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Send JSON response
      header('Content-Type: application/json');
      echo json_encode($result);
    }
    elseif($report_duration === "midyear"){
      $sql = "SELECT YEAR(created_at) AS year,
      CONCAT('Q', QUARTER(created_at)) AS period,
      customer,
      COUNT(*) AS num_bills,
      SUM(volume) AS total_quantity
FROM tbl_product
WHERE QUARTER(created_at) = 2 -- Filter for the second quarter (mid-year)
GROUP BY YEAR(created_at), QUARTER(created_at), customer
ORDER BY YEAR(created_at), QUARTER(created_at), customer;
";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Send JSON response
      header('Content-Type: application/json');
      echo json_encode($result);
    }
    elseif($report_duration==="yearly"){
      $sql = "SELECT YEAR(created_at) AS year,
      'Yearly' AS period,
      customer,
      COUNT(*) AS num_bills,
      SUM(volume) AS total_quantity
FROM tbl_product
GROUP BY YEAR(created_at), customer
ORDER BY YEAR(created_at), customer;
";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Send JSON response
      header('Content-Type: application/json');
      echo json_encode($result);
    }
  }
}

?>
