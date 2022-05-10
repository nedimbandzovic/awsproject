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
print_r($responseData);

if($responseData->success) {
    // your success code goes here
} 
else {
   // return error to user; they did not pass
}
?>
</pre>