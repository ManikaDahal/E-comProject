<?php
session_start();

// Check if user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "csit6th";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count admins, orders, and products
$countQuery = "SELECT 
                (SELECT COUNT(*) FROM admins) AS adminCount, 
                (SELECT COUNT(*) FROM orders) AS orderCount, 
                (SELECT COUNT(*) FROM products) AS productCount";

$result = $conn->query($countQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminCount = $row['adminCount'];
    $orderCount = $row['orderCount'];
    $productCount = $row['productCount'];
} else {
    $adminCount = 0;
    $orderCount = 0;
    $productCount = 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
            color: #333;
        }

        .header {
            width: 100%;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #4CAF50;
            color: #fff;
        }

        .header h2 {
            margin: 0;
            font-size: 2em;
        }

        .container {
            display: flex;
            justify-content: space-around;
            width: 80%;
            max-width: 1000px;
            margin: 20px auto;
            flex-grow: 1;
            flex-wrap: wrap;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 28%;
            margin: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin: 0;
            font-size: 1.4em;
            color: #333;
        }

        .card p {
            font-size: 2em;
            margin: 20px 0 0;
            color: #4CAF50;
        }

        .card .icon {
            font-size: 2em;
            color: #4CAF50;
            position: absolute;
            top: 15px;
            right: 15px;
        }

    </style>
</head>

<body>
    <?php include 'admin_nav.php'; ?><br>

    <div class="header">
        <h2>Welcome, Admin!</h2>
    </div>

    <div class="container">
        <div class="card">
            <i class="fas fa-user-shield icon"></i>
            <h3>Admins</h3>
            <p><?php echo $adminCount; ?></p>
        </div>
        <div class="card">
            <i class="fas fa-shopping-cart icon"></i>
            <h3>Orders</h3>
            <p><?php echo $orderCount; ?></p>
        </div>
        <div class="card">
            <i class="fas fa-box icon"></i>
            <h3>Products</h3>
            <p><?php echo $productCount; ?></p>
        </div>
    </div>
<?php include 'admin_footer.php'; ?> 
</body>
</html>
