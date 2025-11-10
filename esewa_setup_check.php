<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Integration Setup Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #60bb46;
            padding-bottom: 10px;
        }
        .check-item {
            margin: 15px 0;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .check-item.success {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
        }
        .check-item.error {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
        }
        .check-item.warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        .icon {
            font-size: 24px;
            margin-right: 15px;
            min-width: 30px;
        }
        .info {
            background-color: #d1ecf1;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #0c5460;
        }
        .code {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #60bb46;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #4a9636;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 eSewa Integration Setup Checker</h1>
        
        <?php
        // Check 1: Config file exists
        $configExists = file_exists('esewa_config.php');
        echo '<div class="check-item ' . ($configExists ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($configExists ? '✓' : '✗') . '</span>';
        echo '<div><strong>Configuration File:</strong> ' . ($configExists ? 'Found' : 'Not Found') . '</div>';
        echo '</div>';
        
        // Check 2: Helper file exists
        $helperExists = file_exists('esewa_helper.php');
        echo '<div class="check-item ' . ($helperExists ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($helperExists ? '✓' : '✗') . '</span>';
        echo '<div><strong>Helper Functions File:</strong> ' . ($helperExists ? 'Found' : 'Not Found') . '</div>';
        echo '</div>';
        
        // Check 3: Success callback file exists
        $successExists = file_exists('esewa_success.php');
        echo '<div class="check-item ' . ($successExists ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($successExists ? '✓' : '✗') . '</span>';
        echo '<div><strong>Success Callback File:</strong> ' . ($successExists ? 'Found' : 'Not Found') . '</div>';
        echo '</div>';
        
        // Check 4: Failure callback file exists
        $failureExists = file_exists('esewa_failure.php');
        echo '<div class="check-item ' . ($failureExists ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($failureExists ? '✓' : '✗') . '</span>';
        echo '<div><strong>Failure Callback File:</strong> ' . ($failureExists ? 'Found' : 'Not Found') . '</div>';
        echo '</div>';
        
        // Check 5: cURL extension
        $curlEnabled = function_exists('curl_version');
        echo '<div class="check-item ' . ($curlEnabled ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($curlEnabled ? '✓' : '✗') . '</span>';
        echo '<div><strong>PHP cURL Extension:</strong> ' . ($curlEnabled ? 'Enabled' : 'Disabled - Please enable in php.ini') . '</div>';
        echo '</div>';
        
        // Check 6: Database connection
        $host = "localhost";
        $username = "root";
        $password = "";
        $db = "csit6th";
        $conn = @mysqli_connect($host, $username, $password, $db);
        $dbConnected = ($conn !== false);
        echo '<div class="check-item ' . ($dbConnected ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($dbConnected ? '✓' : '✗') . '</span>';
        echo '<div><strong>Database Connection:</strong> ' . ($dbConnected ? 'Connected' : 'Failed - Check credentials') . '</div>';
        echo '</div>';
        
        // Check 7: Orders table exists
        $ordersTableExists = false;
        if ($dbConnected) {
            $result = @mysqli_query($conn, "SHOW TABLES LIKE 'orders'");
            $ordersTableExists = ($result && mysqli_num_rows($result) > 0);
        }
        echo '<div class="check-item ' . ($ordersTableExists ? 'success' : 'error') . '">';
        echo '<span class="icon">' . ($ordersTableExists ? '✓' : '✗') . '</span>';
        echo '<div><strong>Orders Table:</strong> ' . ($ordersTableExists ? 'Exists' : 'Not Found') . '</div>';
        echo '</div>';
        
        // Check 8: Payment columns in orders table
        $hasPaymentColumns = false;
        if ($dbConnected && $ordersTableExists) {
            $result = @mysqli_query($conn, "SHOW COLUMNS FROM orders LIKE 'transaction_uuid'");
            $hasPaymentColumns = ($result && mysqli_num_rows($result) > 0);
        }
        echo '<div class="check-item ' . ($hasPaymentColumns ? 'success' : 'warning') . '">';
        echo '<span class="icon">' . ($hasPaymentColumns ? '✓' : '⚠') . '</span>';
        echo '<div><strong>Payment Tracking Columns:</strong> ' . ($hasPaymentColumns ? 'Added' : 'Not Added - Run esewa_database_update.sql') . '</div>';
        echo '</div>';
        
        if ($dbConnected) {
            mysqli_close($conn);
        }
        
        // Overall status
        $allChecks = $configExists && $helperExists && $successExists && $failureExists && $curlEnabled && $dbConnected && $ordersTableExists;
        ?>
        
        <div class="info">
            <h3>📋 Next Steps:</h3>
            <?php if ($allChecks && $hasPaymentColumns): ?>
                <p><strong>✅ All checks passed!</strong> Your eSewa integration is ready to test.</p>
                <p>You can now test the payment flow by:</p>
                <ol>
                    <li>Login to your account</li>
                    <li>Add products to cart</li>
                    <li>Proceed to checkout</li>
                    <li>Use the test credentials to complete payment</li>
                </ol>
            <?php elseif ($allChecks && !$hasPaymentColumns): ?>
                <p><strong>⚠ Almost ready!</strong> You need to update the database schema.</p>
                <p>Run the SQL script to add payment tracking columns:</p>
                <div class="code">
                    1. Open phpMyAdmin (http://localhost/phpmyadmin)<br>
                    2. Select database 'csit6th'<br>
                    3. Go to SQL tab<br>
                    4. Copy content from esewa_database_update.sql<br>
                    5. Click 'Go' to execute
                </div>
            <?php else: ?>
                <p><strong>❌ Setup Incomplete</strong></p>
                <p>Please fix the failed checks above before testing.</p>
            <?php endif; ?>
        </div>
        
        <?php if ($configExists): ?>
        <div class="info">
            <h3>🧪 Test Credentials (eSewa Sandbox):</h3>
            <div class="code">
                eSewa ID: 9806800001<br>
                Password: Nepal@123<br>
                Token: 123456<br>
                MPIN: 1122
            </div>
        </div>
        <?php endif; ?>
        
        <div style="text-align: center;">
            <a href="index.php" class="btn">Go to Homepage</a>
            <a href="products.php" class="btn">View Products</a>
        </div>
        
        <p style="margin-top: 30px; text-align: center; color: #666; font-size: 14px;">
            For detailed setup instructions, see <strong>ESEWA_INTEGRATION_GUIDE.md</strong>
        </p>
    </div>
</body>
</html>
