<?php
session_start();

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "csit6th";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product_id is set in the URL
if (!isset($_GET['product_id'])) {
    die("Product ID is not specified in the URL.");
}

$id = $_GET['product_id'];

// Fetch product details based on the ID
$product_query = $conn->query("SELECT * FROM products WHERE product_id = $id");

if ($product_query === false) {
    // Handle the error if the query fails
    die("Error fetching product details: " . $conn->error);
}

$product = $product_query->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        .form-container input[type="file"] {
            padding: 3px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Update Product</h2>
        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
            <input type="text" name="name" value="<?php echo $product['Item_Nmae']; ?>" placeholder="Product Name" required>
            <input type="number" name="price" value="<?php echo $product['price']; ?>" placeholder="Product Price" required>
            <input type="text" name="category" value="<?php echo $product['category']; ?>" placeholder="Product Category" required>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="edit_product">Update Product</button>
        </form>
    </div>
</div>
<br><br>
<?php include 'admin_footer.php'; ?><br><br>
</body>
</html>
