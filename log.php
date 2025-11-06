<?php
session_start(); 




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = ""; 
    $database = "bca4th";

    
    $conn = mysqli_connect($host, $username, $password, $database);

    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieving email and password from the login form (using POST method)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the email and password match in the signup table
    $query = "SELECT * FROM signup WHERE Emailid = '$email' AND Password = '$password'";

    // Executing the query
    $result = mysqli_query($conn, $query);

    // Checking if the query execution was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Checking if any matching record is found
    if (mysqli_num_rows($result) > 0) {
        // User found in the database, set session variables and redirect to index.php
        $row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true; 

        $_SESSION['username'] = $row['Fullname']; 
        echo '<script>alert("Login successful."); window.location.href = "index.php";</script>'; 
        exit(); 
    } else {
        // No matching email or password found in the database
        echo '<script>alert("Incorrect email or password. Please retry."); window.location.href = "login.php";</script>';
        exit(); // Stop further execution of the script
    }

    // Closing the database connection
    mysqli_close($conn);
}

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to the index page if already logged in
    header("Location: index.php");
    exit(); // Stop further execution of the script
} else {
    // Redirect to the login page if not logged in
    header("Location: signup.php");
    exit();
}
?>
