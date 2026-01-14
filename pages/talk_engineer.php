<?php
// ================= DATABASE CONNECTION =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iotrix_labs";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed");
}

// ================= HANDLE FORM SUBMISSION =================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validate required fields
    if (
        empty($_POST['full_name']) ||
        empty($_POST['message'])
    ) {
        die("Invalid request");
    }

    // Sanitize inputs
    $full_names = $conn->real_escape_string(trim($_POST['full_name']));
    $message    = $conn->real_escape_string(trim($_POST['message']));

    // Insert query
    $sql = "INSERT INTO talk_engineer 
            (full_names, message, timedate)
            VALUES 
            ('$full_names', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {

        // Redirect to success page (recommended)
        header("Location: ../pages/success.html");
        exit();

    } else {
        echo "Error saving message";
    }
}

$conn->close();
?>
