<?php
// ================= DEBUG MODE =================
// Turn on error reporting (development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<pre>";
echo "DEBUG: Script reached ✔️\n";

// ================= DATABASE CONNECTION =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iotrix_labs";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("DEBUG: Database connection failed ❌ : " . $conn->connect_error);
}

echo "DEBUG: Database connected successfully ✔️\n";

// ================= HANDLE FORM SUBMISSION =================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "DEBUG: Request method is POST ✔️\n";
    echo "DEBUG: Raw POST data:\n";
    print_r($_POST);

    // ================= COLLECT & SANITIZE =================
    $full_names          = $conn->real_escape_string($_POST['name'] ?? '');
    $email               = $conn->real_escape_string($_POST['email'] ?? '');
    $phonenumber         = $conn->real_escape_string($_POST['phone'] ?? '');
    $category            = $conn->real_escape_string($_POST['category'] ?? '');
    $application_area    = $conn->real_escape_string($_POST['application'] ?? '');
    $project_description = $conn->real_escape_string($_POST['description'] ?? '');
    $timeline            = $conn->real_escape_string($_POST['timeline'] ?? '');
    $budget              = $conn->real_escape_string($_POST['budget'] ?? '');

    echo "DEBUG: Sanitized values ✔️\n";
    echo "Name: $full_names\n";
    echo "Email: $email\n";
    echo "Phone: $phonenumber\n";
    echo "Category: $category\n";
    echo "Application Area: $application_area\n";
    echo "Timeline: $timeline\n";
    echo "Budget: $budget\n";

    // ================= SQL QUERY =================
    $sql = "INSERT INTO project_info 
            (full_names, email, phonenumber, category, application_area, project_description, timeline, budget, timedate)
            VALUES 
            ('$full_names', '$email', '$phonenumber', '$category', '$application_area', '$project_description', '$timeline', '$budget', NOW())";

    echo "DEBUG: SQL Query Prepared ✔️\n";
    echo $sql . "\n";

    // ================= EXECUTE QUERY =================
    if ($conn->query($sql) === TRUE) {

        echo "DEBUG: Data inserted successfully ✅\n";

        // ⚠️ Comment redirect during debugging
        // header("Location: thank_you.html");
        // exit();

    } else {
        echo "DEBUG: SQL ERROR ❌\n";
        echo $conn->error;
    }

    $conn->close();
    echo "DEBUG: Database connection closed ✔️\n";

} else {
    echo "DEBUG: Request method is NOT POST ❌\n";
}

echo "</pre>";
?>
