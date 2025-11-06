<?php
session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: signup.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$db = "bca4th";
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Server not connected: " . mysqli_connect_error());
}

// Fetch user data from the signup table using email stored in session
$userEmail = $_SESSION['email']; 
$sqlUser = "SELECT Fullname, Emailid FROM signup WHERE Emailid = '$userEmail'";
$resultUser = mysqli_query($conn, $sqlUser);

if ($resultUser && mysqli_num_rows($resultUser) > 0) {
    $user = mysqli_fetch_assoc($resultUser);
    $fullName = $user['Fullname'];
    $email = $user['Emailid']; 
} else {
    die("User not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $errorOccurred = false;
            foreach ($_SESSION['cart'] as $key => $value) {
                $itemName = mysqli_real_escape_string($conn, $value['Item_Name']);
                $price = mysqli_real_escape_string($conn, $value['price']);
                $quantity = mysqli_real_escape_string($conn, $value['Quantity']);

                $sql = "INSERT INTO orders (Item_Name, price, quantity, Customer_name, Address, phone_number, email) VALUES ('$itemName', '$price', '$quantity', '$name', '$address', '$phone', '$email')";

                if (mysqli_query($conn, $sql)) {
                    echo "Item '$itemName' added to the orders table successfully<br>";
                } else {
                    echo "Error inserting item '$itemName': " . mysqli_error($conn) . "<br>";
                    $errorOccurred = true;
                }
            }

            if (!$errorOccurred) {
                unset($_SESSION['cart']); // Clear the cart
                header("Location: order_confirmation.php?email=" . urlencode($email)); // Redirect with email
                exit();
            } else {
                echo "There was an error processing your order. Please try again.";
            }
        } else {
            echo "Your cart is empty!";
        }
    } else {
        echo "Please fill in all the required fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceed to Checkout</title>
      
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="tel"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <h1>Proceed to Checkout</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fullName); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
    <label for="address">Address for delivery:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" pattern="^9[78][0-9]{8}$" required>
    
    <input type="submit" value="Confirm Order">
</form>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
