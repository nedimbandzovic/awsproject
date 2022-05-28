<pre>
<?php
$data = array(
            'secret' => "0xBF13aa72F33262DFB2aC0fdeBAB8Ed48376cbEa6",
            'response' => $_POST['h-captcha-response']
        );
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
// var_dump($response);
$responseData = json_decode($response);


if($responseData->success) {
    echo "Captcha successfully solved, you will be redirected to login page";
    header('Refresh: 10; URL=http://127.0.0.1/22-cen343-nedim-b/login.html');
} 
else {
    echo "Failed";

}
?>
</pre>