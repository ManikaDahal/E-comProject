<?php
$host = "localhost";
$username = "root";
$password = "";

// Attempt to connect to the database server
$conn = mysqli_connect($host, $username, $password);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS csit6th";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}

// Select the database
mysqli_select_db($conn, "csit6th");
?>