<?php
// ================= DATABASE CONNECTION =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iotrix_labs";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// ================= HANDLE FORM SUBMISSION =================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

   $full_names          = $conn->real_escape_string($_POST['full_names'] ?? '');
$email               = $conn->real_escape_string($_POST['email'] ?? '');
$phonenumber         = $conn->real_escape_string($_POST['phonenumber'] ?? '');
$category            = $conn->real_escape_string($_POST['category'] ?? '');
$application_area    = $conn->real_escape_string($_POST['application_area'] ?? '');
$project_description = $conn->real_escape_string($_POST['project_description'] ?? '');
$timeline            = $conn->real_escape_string($_POST['timeline'] ?? '');
$budget              = $conn->real_escape_string($_POST['budget'] ?? 0);


    // Insert query
    $sql = "INSERT INTO project_info 
            (full_names, email, phonenumber, category, application_area, project_description, timeline, budget, timedate)
            VALUES 
            ('$full_names', '$email', '$phonenumber', '$category', '$application_area', '$project_description', '$timeline', '$budget', NOW())";

    if ($conn->query($sql) === TRUE) {

        // ================= SUCCESS ANIMATION OUTPUT =================
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Request Submitted | IoTRIX Labs</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    margin: 0;
                    height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #0d0d0d;
                    color: #fff;
                    font-family: "Segoe UI", sans-serif;
                }

                .success-box {
                    text-align: center;
                    animation: fadeIn 0.8s ease-in-out;
                }

                .checkmark {
                    width: 90px;
                    height: 90px;
                    border-radius: 50%;
                    border: 4px solid #0d6efd;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                    animation: pop 0.6s ease;
                }

                .checkmark::after {
                    content: "✓";
                    font-size: 48px;
                    color: #0d6efd;
                }

                h2 {
                    margin-bottom: 10px;
                }

                p {
                    opacity: 0.8;
                    font-size: 15px;
                }

                .btn {
                    margin-top: 25px;
                    padding: 10px 24px;
                    background: #0d6efd;
                    border: none;
                    color: #fff;
                    border-radius: 6px;
                    cursor: pointer;
                    text-decoration: none;
                }

                .btn:hover {
                    background: #0b5ed7;
                }

                @keyframes pop {
                    0% { transform: scale(0.5); opacity: 0; }
                    100% { transform: scale(1); opacity: 1; }
                }

                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
            </style>
        </head>
        <body>

            <div class="success-box">
                <div class="checkmark"></div>
                <h2>Request Submitted Successfully</h2>
                <p>Thank you for reaching out. Our team will review your request and respond within 24–48 hours.</p>
                <a href="../pages/project_submit.html" class="btn">Submit Another Request</a>
            </div>

        </body>
        </html>
        ';
    } else {
        echo "Something went wrong. Please try again.";
    }

    $conn->close();
}
?>
