<?php
function checkTelegramAuthorization($auth_data) {
    $bot_token = "7014756913:AAGoh27MAmM2N9lAlWpj3KCQJ2T-_SL2JgA";
    $check_hash = $auth_data['hash'];
    unset($auth_data['hash']);
    ksort($auth_data);
    $data_check_string = "";
    
    foreach ($auth_data as $key => $value) {
        $data_check_string .= $key . "=" . $value . "\n";
    }
    
    $secret_key = hash('sha256', $bot_token, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);
    
    return hash_equals($hash, $check_hash);
}

if (checkTelegramAuthorization($_GET)) {
    echo "Welcome, " . $_GET['first_name'] . "!";
} else {
    echo "Authorization failed.";
}
?>
