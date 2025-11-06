<?php
session_start(); // Start the session to access session variables

$host = "localhost";
$username = "root";
$password = "";
$db = "bca4th";
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    echo "Server not connected: " . mysqli_connect_error();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .confirmation-message {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <h1>Order Confirmation</h1>
        <?php
        if (isset($_GET['email'])) {
            $email = $_GET['email'];

            // Get today's date
            $currentDate = date('Y-m-d');

            // Fetch orders placed today for the given email
            $sql = "SELECT * FROM orders WHERE email='$email' AND DATE(order_time) = '$currentDate'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<thead><tr><th>Item Name</th><th>Price</th><th>Quantity</th><th>Order Time</th></tr></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Item_Name'] . "</td>";
                    echo "<td>Rs." . $row['price'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['order_time'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                echo "<p class='confirmation-message'>Your order has been successfully placed. We will contact you shortly for further details.</p>";
            } else {
                echo "<p class='confirmation-message'>No orders found for the provided email today.</p>";
            }
        } else {
            echo "<p class='confirmation-message'>Email parameter is not set.</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
     <?php include 'footer.php'; ?>
</body>
</html>
