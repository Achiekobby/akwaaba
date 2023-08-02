<?php
include_once'connectdb.php';

if (isset($_GET['year'])) {
    $selectedYear = $_GET['year'];

    try {

        // Fetch data for the selected year.
        $query = "
            SELECT
                DATE_FORMAT(created_at, '%Y-%m') AS month,
                COUNT(*) AS bill_count,
                customer
            FROM
                tbl_product
            WHERE
                YEAR(created_at) = :selectedYear
            GROUP BY
                customer,
                MONTH(created_at)
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmt->execute();

        // Prepare data for Chart.js.
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $customerId = $row['customer'];
            $month = $row['month'];
            $billCount = $row['bill_count'];

            $data[$customerId][$month] = $billCount;
        }

        // Convert data to JSON format and send it back to the client.
        header('Content-Type: application/json');
        echo json_encode($data);

        $pdo = null;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
} else {
    // If no year is provided, return an empty JSON object.
    echo json_encode([]);
}
