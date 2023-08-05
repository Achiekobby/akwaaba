<?php
include_once'connectdb.php';
session_start();

// Step 1: Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Step 2: Get the temperature value from the form
    $temperature = $_POST["temperature"];

    try {

        // Assuming you have a table named 'temperature_data'
        $user_name= $_SESSION['username']; // Replace with the actual user ID who set the temperature
        //* datetime
        $timezone     = new DateTimeZone('Africa/Accra');
        $current_date = new DateTime('now', $timezone);
        $date         = $current_date->format('Y-m-d H:i:s');

        $stmt = $pdo->prepare("INSERT INTO temperature_data (username, temperature, date) VALUES (:user_name, :temperature, :date)");
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':temperature', $temperature);
        $stmt->bindParam(':date', $date);

        if ($stmt->execute()) {
            echo "Temperature set successfully.";
        } else {
            echo "Error inserting data into the database.";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
