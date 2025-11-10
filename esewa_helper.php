<?php
/**
 * eSewa Payment Gateway Helper Functions
 */

require_once 'esewa_config.php';

/**
 * Generate HMAC-SHA256 signature for eSewa payment
 * 
 * @param string $totalAmount Total amount including tax, service and delivery charges
 * @param string $transactionUuid Unique transaction identifier
 * @param string $productCode Merchant product code
 * @return string Base64 encoded signature
 */
function generateEsewaSignature($totalAmount, $transactionUuid, $productCode) {
    $secretKey = ESEWA_SECRET_KEY;
    
    // Create message string in the exact order required by eSewa
    $message = "total_amount=" . $totalAmount . ",transaction_uuid=" . $transactionUuid . ",product_code=" . $productCode;
    
    // Generate HMAC SHA256 hash
    $hash = hash_hmac('sha256', $message, $secretKey, true);
    
    // Encode to Base64
    $signature = base64_encode($hash);
    
    return $signature;
}

/**
 * Verify eSewa response signature
 * 
 * @param array $responseData Decoded response data from eSewa
 * @return bool True if signature is valid, false otherwise
 */
function verifyEsewaSignature($responseData) {
    $secretKey = ESEWA_SECRET_KEY;
    
    // Extract signed field names
    $signedFieldNames = explode(',', $responseData['signed_field_names']);
    
    // Build message from signed fields
    $messageParts = array();
    foreach ($signedFieldNames as $fieldName) {
        $fieldName = trim($fieldName);
        if ($fieldName !== 'signature' && isset($responseData[$fieldName])) {
            $messageParts[] = $fieldName . "=" . $responseData[$fieldName];
        }
    }
    $message = implode(',', $messageParts);
    
    // Generate expected signature
    $hash = hash_hmac('sha256', $message, $secretKey, true);
    $expectedSignature = base64_encode($hash);
    
    // Compare signatures
    return hash_equals($expectedSignature, $responseData['signature']);
}

/**
 * Generate unique transaction UUID
 * Format: YYMMDD-HHMMSS
 * 
 * @return string Unique transaction UUID
 */
function generateTransactionUuid() {
    return date('ymd-His');
}

/**
 * Decode Base64 encoded response from eSewa
 * 
 * @param string $encodedData Base64 encoded JSON string
 * @return array Decoded array or null on failure
 */
function decodeEsewaResponse($encodedData) {
    $decodedJson = base64_decode($encodedData);
    return json_decode($decodedJson, true);
}

/**
 * Check transaction status from eSewa
 * 
 * @param string $productCode Merchant product code
 * @param string $totalAmount Total transaction amount
 * @param string $transactionUuid Transaction UUID
 * @return array Response array with status
 */
function checkEsewaTransactionStatus($productCode, $totalAmount, $transactionUuid) {
    $url = ESEWA_STATUS_CHECK_URL . "?product_code=" . urlencode($productCode) 
           . "&total_amount=" . urlencode($totalAmount) 
           . "&transaction_uuid=" . urlencode($transactionUuid);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For testing only
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200) {
        return json_decode($response, true);
    }
    
    return null;
}
?>
