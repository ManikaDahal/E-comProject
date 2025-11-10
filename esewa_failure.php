<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .failure-icon {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        .info-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }
        .info-box h3 {
            margin-top: 0;
            color: #856404;
        }
        .info-box ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .info-box li {
            margin: 5px 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <div class="container">
        <div class="failure-icon">✕</div>
        <h1>Payment Failed</h1>
        
        <?php
        $reason = isset($_GET['reason']) ? $_GET['reason'] : 'unknown';
        
        switch ($reason) {
            case 'incomplete':
                echo '<p>Your payment was not completed successfully. The transaction status is incomplete.</p>';
                break;
            case 'cancelled':
                echo '<p>You have cancelled the payment process.</p>';
                break;
            default:
                echo '<p>Unfortunately, your payment could not be processed.</p>';
        }
        ?>
        
        <div class="info-box">
            <h3>What happened?</h3>
            <p>Your payment was not successful. This could be due to:</p>
            <ul>
                <li>Payment was cancelled</li>
                <li>Insufficient balance in eSewa account</li>
                <li>Incorrect credentials entered</li>
                <li>Session timeout</li>
                <li>Network connectivity issues</li>
            </ul>
        </div>
        
        <p><strong>Don't worry!</strong> Your order has not been placed and no money has been deducted from your account.</p>
        
        <div class="button-group">
            <a href="ordertable.php" class="btn btn-primary">Try Again</a>
            <a href="cart.php" class="btn btn-secondary">Back to Cart</a>
            <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #888;">
            If you continue to experience issues, please contact our support team.
        </p>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
// Clear payment session data
if (isset($_SESSION['esewa_payment'])) {
    unset($_SESSION['esewa_payment']);
}
if (isset($_SESSION['transaction_uuid'])) {
    unset($_SESSION['transaction_uuid']);
}
// Note: We keep pending_order in case user wants to retry
?>
