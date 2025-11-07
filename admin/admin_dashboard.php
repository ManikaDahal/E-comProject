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

// Handle form submissions for adding, updating, and deleting products
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        // Check if a file was uploaded
        if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['images']['name'];
            $target = "uploads/" . basename($image);

            if (move_uploaded_file($_FILES['images']['tmp_name'], $target)) {
                $sql = "INSERT INTO products (Item_Name, price, product_image, category) VALUES ('$name', '$price', '$image', '$category')";
                if ($conn->query($sql) === TRUE) {
                    $message = "Product added successfully!";
                } else {
                    $message = "Error adding product: " . $conn->error;
                }
            } else {
                $message = "Failed to upload image. Ensure the 'uploads' directory exists and has the correct permissions.";
            }
        } else {
            $uploadError = $_FILES['images']['error'];
            $message = "No file uploaded or file upload error occurred. Error code: $uploadError";
        }
    }

    if (isset($_POST['edit_product'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $image = $_FILES['images']['name'];
        $target = "uploads/" . basename($image);

        if ($image) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $target)) {
                $sql = "UPDATE products SET Item_Name='$name', price='$price', category='$category', product_image='$image' WHERE product_id='$id'";
            } else {
                $message = "Failed to upload image.";
            }
        } else {
            $sql = "UPDATE products SET Item_Name='$name', price='$price', category='$category' WHERE id='$id'";
        }

        if ($conn->query($sql) === TRUE) {
            $message = "Product updated successfully!";
        } else {
            $message = "Error updating product: " . $conn->error;
        }
    }

    if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Product deleted successfully!";
        } else {
            $message = "Error deleting product: " . $conn->error;
        }
    }
}

$products = $conn->query("SELECT * FROM products");

if ($products === false) {
    // Handle the error if the query fails
    die("Error fetching products: " . $conn->error);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* css */
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
        .dashboard-header {
            background: #96938a;
            color: #fff;
            padding: 10px 0;
            text-align: center;
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
        .product-list {
            margin: 20px 0;
        }
        .product-list table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .product-list table, th, td {
            border: 1px solid #ddd;
        }
        .product-list th {
            background-color: #f2f2f2;
            padding: 15px;
            text-align: left;
            color: #333;
            text-transform: uppercase;
            font-size: 14px;
        }
        .product-list td {
            padding: 15px;
            text-align: left;
            color: #555;
        }
        .product-list img {
            width: 50px;
            height: auto;
            border-radius: 3px;
        }
        .product-list form {
            display: inline-block;
            margin: 0;
        }
        .product-list button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }
        .product-list button:hover {
            background-color: #45a049;
        }
        .product-list button.delete {
            background-color: #f44336;
        }
        .product-list button.delete:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <?php include 'admin_nav.php'; ?><br><br>

    <div class="container">
        <div class="dashboard-header">
            <h1>Manage Products</h1>
        </div>

        <?php if (isset($message)) { echo '<script>alert("' . $message . '");</script>'; } ?>

        <div class="form-container">
            <h2>Add New Product</h2>
            <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" placeholder="Product Price" required>
                <input type="text" name="category" placeholder="Product Category" required>
                <input type="file" name="images" accept="image/*" required>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>

        <div class="product-list">
            <h2>Manage Products</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php while ($product = $products->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['Item_Name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td><img src="uploads/<?php echo $product['product_image']; ?>" alt="<?php echo $product['Item_Name']; ?>"></td>
                    <td>
                        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <input type="text" name="name" value="<?php echo $product['Item_Name']; ?>" required>
                            <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
                            <input type="text" name="category" value="<?php echo $product['category']; ?>" required>
                            <input type="file" name="images" accept="image/*">
                            <button type="submit" name="edit_product">Update</button>
                        </form>
                        <form action="admin_dashboard.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="delete_product" class="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>
 <?php include 'admin_footer.php'; ?><br><br>
</html>
