<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();// Start the session to access session variables
}
$total = 0; // Initialize total variable

require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Increment quantity
    if (isset($_POST['add_quantity'])) {
        $key = $_POST['item_key'];
        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['Quantity']++;
        }
        header("Location: cart.php");
        exit();
    }

    // Decrement quantity
    if (isset($_POST['subtract_quantity'])) {
        $key = $_POST['item_key'];
        if (isset($_SESSION['cart'][$key])) {
            if ($_SESSION['cart'][$key]['Quantity'] > 1) {
                $_SESSION['cart'][$key]['Quantity']--;
            }
        }
        header("Location: cart.php");
        exit();
    }

    // Remove item
    if (isset($_POST['remove_item'])) {
        $key = $_POST['item_key'];
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        /* Your existing CSS styles here */
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
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        .quantity-btns {
            display: flex;
            align-items: center;
        }
        .update-button, .remove-button {
            background-color: #ea1538;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
        }
        .update-button:hover, .remove-button:hover {
            background-color: #c10e2e;
        }
        .checkout-section {
            margin-top: 20px;
            text-align: right;
        }
        .checkout-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .checkout-button:hover {
            background-color: #45a049;
        }
        .checkout-button a {
            text-decoration: none;
            color: #fff;
        }
        .continue {
    background-color: #3b92d9;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    margin-right: 10px; /* small space from checkout button */
}

        .continue:hover {
            background-color: #3177b0;
        }
        .continue a {
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <h1>MY CART</h1>
        <table>
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }

                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $total += $value['price'] * $value['Quantity'];
                        echo "<tr>
                            <td>" . ($key + 1) . "</td>
                            <td>" . $value['Item_Name'] . "</td>
                            <td>Rs." . $value['price'] . "</td>
                            <td>
                                <form action='cart.php' method='post' class='quantity-btns'>
                                    <input type='hidden' name='item_key' value='" . $key . "'>
                                    <button type='submit' name='add_quantity' class='update-button'>+</button>
                                    <span>" . $value['Quantity'] . "</span>
                                    <button type='submit' name='subtract_quantity' class='update-button'>-</button>
                                </form>
                            </td>
                            <td>
                                <form action='cart.php' method='post'>
                                    <input type='hidden' name='item_key' value='" . $key . "'>
                                    <button type='submit' name='remove_item' class='remove-button'>Remove</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
        </table>
       <div class="checkout-section">
    <h3>Total: Rs.<?php echo $total ?></h3>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <!-- Proceed only if cart is not empty -->
        <button class="checkout-button">
            <a href="ordertable.php">Proceed to Checkout</a>
        </button>
    <?php else: ?>
        <!-- Show message if cart is empty -->
        <p style="color: red; font-weight: bold;">Your cart is empty. Please add items before checkout.</p>
    <?php endif; ?>

    <button class="continue">
        <a href="products.php">Continue Shopping</a>
    </button>
</div>

    <?php include 'footer.php'; ?>
</body>
</html>
