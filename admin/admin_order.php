<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$db = "csit6th";
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Server not connected: " . mysqli_connect_error());
}

// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

$orders = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}

$alertMessage = "";

// Handle order acceptance or deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        $orderId = $_POST['accept'];
        // Implement your logic to mark the order as accepted in your system
        // For now, just set the alert message
        $alertMessage = "Order $orderId has been accepted.";
    } elseif (isset($_POST['delete'])) {
        $orderId = $_POST['delete'];
        // Implement your logic to delete the order from your system
        // For now, just set the alert message
        $alertMessage = "Order $orderId has been deleted.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
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
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-button {
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <?php include 'admin_nav.php'; ?><br><br>
    <div class="container">
        <h2> Orders</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['Item_Name']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['order_time']; ?></td>
                    <td><?php echo $order['Customer_name']; ?></td>
                    <td><?php echo $order['Address']; ?></td>
                    <td><?php echo $order['phone_number']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="accept" value="<?php echo $order['id']; ?>">
                            <button type="submit" class="action-button">Accept</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="delete" value="<?php echo $order['id']; ?>">
                            <button type="submit" class="action-button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include 'admin_footer.php'; ?><br><br>
    <?php if (!empty($alertMessage)) : ?>
        <script>
            alert("<?php echo $alertMessage; ?>");
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>"; // Reload the page
        </script>
    <?php endif; ?>
</body>
</html>
