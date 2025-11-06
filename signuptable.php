<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "bca4th";

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the signup table if it doesn't exist
$table = "CREATE TABLE IF NOT EXISTS signup (
    id int,
    Fullname VARCHAR(100),
    Emailid VARCHAR(100),
    Password VARCHAR(255),
    ConfirmPassword VARCHAR(255),
    Role ENUM('admin', 'user'),
    PRIMARY KEY (id)
)";

if ($conn->query($table) === FALSE) {
    die("Table creation failed: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);

    // Debugging: log inputs
    error_log("Submitted Fullname: $fullname");
    error_log("Submitted Email: $email");
    error_log("Submitted Password: $password");

    // Hash the passwords securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedConfirmPassword = password_hash($confirmpassword, PASSWORD_DEFAULT);

   

    // Debugging: log role and redirect
    error_log("Assigned Role: $role");
    error_log("Redirect URL: $redirect");

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO signup (Fullname, Emailid, Password, ConfirmPassword, Role) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $fullname, $email, $hashedPassword, $hashedConfirmPassword, $role);
        
        if ($stmt->execute()) {
            // Debugging: log successful insertion
            error_log("Data inserted successfully.");
            // Redirect based on role
            header("Location: $redirect");
            exit();
        } else {
            echo "Error inserting data: " . $stmt->error;
            // Debugging: log error
            error_log("Error inserting data: " . $stmt->error);
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
        // Debugging: log error
        error_log("Error preparing statement: " . $conn->error);
    }
}

$conn->close();
?>
