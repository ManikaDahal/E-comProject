<?php
session_start(); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once 'esewa_config.php';
require_once 'esewa_helper.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: signup.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$db = "csit6th";
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Server not connected: " . mysqli_connect_error());
}

// Fetch user data from the signup table using email stored in session
$userEmail = $_SESSION['Emailid']; 
$sqlUser = "SELECT Fullname, Emailid FROM signup WHERE Emailid = '$userEmail'";
$resultUser = mysqli_query($conn, $sqlUser);

if ($resultUser && mysqli_num_rows($resultUser) > 0) {
    $user = mysqli_fetch_assoc($resultUser);
    $fullName = $user['Fullname'];
    $email = $user['Emailid']; 
} else {
    die("User not found!");
}

// Calculate total amount from cart
$totalAmount = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalAmount += $item['price'] * $item['Quantity'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Store order details in session for processing after payment
            $_SESSION['pending_order'] = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'cart' => $_SESSION['cart'],
                'total_amount' => $totalAmount
            );
            
            // Generate unique transaction UUID
            $transactionUuid = generateTransactionUuid();
            $_SESSION['transaction_uuid'] = $transactionUuid;
            
            // Prepare eSewa payment parameters
            $amount = $totalAmount;
            $taxAmount = 0;
            $productServiceCharge = 0;
            $productDeliveryCharge = 0;
            $totalAmountWithCharges = $amount + $taxAmount + $productServiceCharge + $productDeliveryCharge;
            
            // Generate signature
            $signature = generateEsewaSignature($totalAmountWithCharges, $transactionUuid, ESEWA_MERCHANT_CODE);
            
            // Store payment details for verification
            $_SESSION['esewa_payment'] = array(
                'amount' => $amount,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmountWithCharges,
                'transaction_uuid' => $transactionUuid,
                'product_code' => ESEWA_MERCHANT_CODE
            );
            
            // Redirect to eSewa payment page will be handled by HTML form below
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
        
        <?php if (isset($_SESSION['pending_order']) && isset($_SESSION['esewa_payment'])): ?>
            <!-- Show eSewa Payment Form -->
            <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <h2 style="color: #60bb46;">Payment Gateway</h2>
                <p><strong>Order Summary:</strong></p>
                <p>Total Amount: Rs. <?php echo $_SESSION['esewa_payment']['total_amount']; ?></p>
                <p>You will be redirected to eSewa payment page to complete your payment.</p>
                
                <form action="<?php echo ESEWA_PAYMENT_URL; ?>" method="POST" id="esewaForm">
                    <input type="hidden" name="amount" value="<?php echo $_SESSION['esewa_payment']['amount']; ?>">
                    <input type="hidden" name="tax_amount" value="<?php echo $_SESSION['esewa_payment']['tax_amount']; ?>">
                    <input type="hidden" name="total_amount" value="<?php echo $_SESSION['esewa_payment']['total_amount']; ?>">
                    <input type="hidden" name="transaction_uuid" value="<?php echo $_SESSION['esewa_payment']['transaction_uuid']; ?>">
                    <input type="hidden" name="product_code" value="<?php echo $_SESSION['esewa_payment']['product_code']; ?>">
                    <input type="hidden" name="product_service_charge" value="0">
                    <input type="hidden" name="product_delivery_charge" value="0">
                    <input type="hidden" name="success_url" value="<?php echo ESEWA_SUCCESS_URL; ?>">
                    <input type="hidden" name="failure_url" value="<?php echo ESEWA_FAILURE_URL; ?>">
                    <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
                    <input type="hidden" name="signature" value="<?php echo generateEsewaSignature($_SESSION['esewa_payment']['total_amount'], $_SESSION['esewa_payment']['transaction_uuid'], $_SESSION['esewa_payment']['product_code']); ?>">
                    
                    <input type="submit" value="Pay with eSewa" style="background-color: #60bb46; color: white; border: none; padding: 15px 30px; border-radius: 5px; cursor: pointer; font-size: 18px; font-weight: bold;">
                </form>
                
                <p style="margin-top: 15px; font-size: 12px; color: #666;">
                    <strong>Test Credentials:</strong><br>
                    eSewa ID: 9806800001<br>
                    Password: Nepal@123<br>
                    Token: 123456
                </p>
            </div>
        <?php else: ?>
            <!-- Show Order Details Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fullName); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
    <label for="address">Address for delivery:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" pattern="^9[78][0-9]{8}$" required>
    
    <input type="submit" value="Proceed to Payment">
</form>
        <?php endif; ?>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
