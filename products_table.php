<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "bca4th";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Server database not connected";
} else {
    $table = "CREATE TABLE products(
        Item_Name VARCHAR(100),
        price VARCHAR(100),
        product_image VARCHAR(100),
        product_id int,
        category VARCHAR(100),
        PRIMARY KEY (product_id)
    )";

    $check = mysqli_query($conn, $table);

    if (!$check) {
        echo "Table not created: " . mysqli_error($conn);
    } else {
        echo "Table created";
    }

    mysqli_close($conn); // Close the database connection
}
?>
