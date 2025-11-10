<?php
session_start();

require_once 'esewa_config.php';
require_once 'esewa_helper.php';

$host = "localhost";
$username = "root";
$password = "";
$db = "csit6th";
$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Server not connected: " . mysqli_connect_error());
}

// Check if we have the encoded data from eSewa
if (isset($_GET['data'])) {
    $encodedData = $_GET['data'];
    
    // Decode the response
    $responseData = decodeEsewaResponse($encodedData);
    
    if ($responseData === null) {
        die("Failed to decode eSewa response!");
    }
    
    // Verify the signature
    if (!verifyEsewaSignature($responseData)) {
        die("Invalid signature! Payment verification failed.");
    }
    
    // Check if payment was successful
    if ($responseData['status'] !== 'COMPLETE') {
        header("Location: esewa_failure.php?reason=incomplete");
        exit();
    }
    
    // Verify transaction details match our records
    if (!isset($_SESSION['esewa_payment']) || 
        $responseData['transaction_uuid'] !== $_SESSION['esewa_payment']['transaction_uuid'] ||
        $responseData['total_amount'] != $_SESSION['esewa_payment']['total_amount']) {
        die("Transaction mismatch! Please contact support.");
    }
    
    // Double-check with eSewa status API
    $statusCheck = checkEsewaTransactionStatus(
        $responseData['product_code'],
        $responseData['total_amount'],
        $responseData['transaction_uuid']
    );
    
    if ($statusCheck === null || $statusCheck['status'] !== 'COMPLETE') {
        die("Payment verification failed. Please contact support.");
    }
    
    // Payment verified successfully - now process the order
    if (isset($_SESSION['pending_order'])) {
        $orderData = $_SESSION['pending_order'];
        $name = mysqli_real_escape_string($conn, $orderData['name']);
        $email = mysqli_real_escape_string($conn, $orderData['email']);
        $address = mysqli_real_escape_string($conn, $orderData['address']);
        $phone = mysqli_real_escape_string($conn, $orderData['phone']);
        $transactionUuid = mysqli_real_escape_string($conn, $responseData['transaction_uuid']);
        $transactionCode = mysqli_real_escape_string($conn, $responseData['transaction_code']);
        
        $errorOccurred = false;
        
        // Check if orders table has payment columns
        $checkColumns = mysqli_query($conn, "SHOW COLUMNS FROM orders LIKE 'transaction_uuid'");
        $hasPaymentColumns = (mysqli_num_rows($checkColumns) > 0);
        
        foreach ($orderData['cart'] as $key => $value) {
            $itemName = mysqli_real_escape_string($conn, $value['Item_Name']);
            $price = mysqli_real_escape_string($conn, $value['price']);
            $quantity = mysqli_real_escape_string($conn, $value['Quantity']);
            
            // Insert order with payment details if columns exist
            if ($hasPaymentColumns) {
                $sql = "INSERT INTO orders (Item_Name, price, quantity, Customer_name, Address, phone_number, email, transaction_uuid, transaction_code, payment_status, payment_method) 
                        VALUES ('$itemName', '$price', '$quantity', '$name', '$address', '$phone', '$email', '$transactionUuid', '$transactionCode', 'COMPLETE', 'ESEWA')";
            } else {
                // Fallback to basic insert if columns don't exist
                $sql = "INSERT INTO orders (Item_Name, price, quantity, Customer_name, Address, phone_number, email) 
                        VALUES ('$itemName', '$price', '$quantity', '$name', '$address', '$phone', '$email')";
            }
            
            if (!mysqli_query($conn, $sql)) {
                $errorOccurred = true;
                error_log("Error inserting order: " . mysqli_error($conn));
            }
        }
        
        if (!$errorOccurred) {
            // Clear session data
            unset($_SESSION['cart']);
            unset($_SESSION['pending_order']);
            unset($_SESSION['esewa_payment']);
            unset($_SESSION['transaction_uuid']);
            
            // Redirect to order confirmation
            header("Location: order_confirmation.php?email=" . urlencode($email) . "&payment=success&txn=" . urlencode($transactionCode));
            exit();
        } else {
            die("Error processing order. Payment was successful but order creation failed. Transaction Code: " . $transactionCode);
        }
    } else {
        die("Order data not found in session!");
    }
} else {
    die("No payment data received!");
}

mysqli_close($conn);
?>
