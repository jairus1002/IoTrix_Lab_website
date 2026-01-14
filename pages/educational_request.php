<?php
// submit_training.php

// Database connection
$host = "localhost";
$user = "root";        // your DB username
$pass = "";            // your DB password
$db   = "iotrix_labs";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
$email        = $conn->real_escape_string($_POST['email']);
$phone_number = $conn->real_escape_string($_POST['phone_number']);
$area_intrest = $conn->real_escape_string($_POST['area_intrest']);
$skill_level  = $conn->real_escape_string($_POST['skill_level']);
$goal         = $conn->real_escape_string($_POST['goal']);

// Insert into database
$sql = "INSERT INTO educational_mentorship (email, phone_number, area_intrest, skill_level, goal) 
        VALUES ('$email', '$phone_number', '$area_intrest', '$skill_level', '$goal')";

if ($conn->query($sql) === TRUE) {
    // Redirect to success page
    header("Location: success2.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
