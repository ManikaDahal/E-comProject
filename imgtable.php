<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "csit6th"; // Name of your database

// Create a connection to the database server
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create the images table
$sql = "CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255),
    filedata LONGBLOB
)";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Table 'images' created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
