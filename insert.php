<?php
session_start(); 

$host = "localhost";
$username = "root";
$password = "";
$database = "csit6th";

// Establishing connection to MySQL database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    echo "Server database not connected";
} else {
    // Retrieve form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
   $hashedPassword = mysqli_real_escape_string($conn, $_POST['password']); 
     $hashedconfirmPassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
    // Use a different variable name for password field

    // Check if the email already exists
    $check_query = "SELECT * FROM signup WHERE Emailid = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    // Check if the query was successful
    if (!$check_result) {
        echo "Query error: " . mysqli_error($conn);
    } else {
        // Check if the email already exists in the database
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>
            alert('This email is already registered. Please use a different email.');
            window.history.go(-1);
            </script>";
            exit(); // Stop further execution
        } else {
            // Email is not registered, proceed with signup
            $insert_query = "INSERT INTO signup (Fullname, Emailid, Password,ConfirmPassword)
                             VALUES ('$fullname', '$email', '$hashedPassword','$hashedconfirmPassword')";

            if (mysqli_query($conn, $insert_query)) {
                // Signup successful
                $_SESSION['signup_success'] = true;
                header("Location: login.php");
                exit;
            } else {
                // Error in SQL query
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
