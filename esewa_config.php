<?php
/**
 * eSewa Payment Gateway v2 Configuration
 * Testing/Sandbox Environment
 */

// eSewa Test Credentials
define('ESEWA_MERCHANT_CODE', 'EPAYTEST');
define('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');

// eSewa URLs (Testing Environment)
define('ESEWA_PAYMENT_URL', 'https://rc-epay.esewa.com.np/api/epay/main/v2/form');
define('ESEWA_STATUS_CHECK_URL', 'https://rc.esewa.com.np/api/epay/transaction/status/');

// Application URLs (Update these to match your server)
define('ESEWA_SUCCESS_URL', 'http://localhost/E-commerce/esewa_success.php');
define('ESEWA_FAILURE_URL', 'http://localhost/E-commerce/esewa_failure.php');

// For Production, use these URLs:
// define('ESEWA_PAYMENT_URL', 'https://epay.esewa.com.np/api/epay/main/v2/form');
// define('ESEWA_STATUS_CHECK_URL', 'https://epay.esewa.com.np/api/epay/transaction/status/');

// Test Login Credentials (for your reference)
// eSewa ID: 9806800001, 9806800002, 9806800003, 9806800004, or 9806800005
// Password: Nepal@123
// MPIN: 1122
// Token: 123456
?>
