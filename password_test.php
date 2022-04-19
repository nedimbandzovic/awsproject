<?php

require 'vendor/autoload.php';
//Hiding errors
error_reporting(0);
ini_set('display_errors', 0);

use OTPHP\TOTP;

// $otp = TOTP::create();
// echo "The OTP secret is: {$otp->getSecret()}\n";

$secret="TSRHYPFZYJVH6RRPYKCVENKQ6TL3ZH2Y7ZKTLD7QAQMMFPPGS6BJSOB6NQO5WP5HQETGTLB65QNLKDLNBIOKBJZCLV5B7HYUYZG2PJY";

$secret = $secret;
$otp = TOTP::create($secret);
echo "The current OTP is: {$otp->now()}\n";

$otp->setLabel('nedim@ibu');
$grCodeUri = $otp->getQrCodeUri(
    'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
    '[DATA]'
);
echo "<img src='{$grCodeUri}'>";

$otp = TOTP::create($secret);
$otp->verify($input);

