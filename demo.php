<?php


// A sample PHP Script to POST data using cURL

 $data = array(
     'from' => 'OurPlatform',
     'text' => '',
     'to' => '38761648664',
     'api_key' => 'f68f2ebe',
     'api_secret' => 'l5B7VZ1xVqWDlHKy'


 );

 $post_data = json_encode($data);

 // Prepare new cURL resource
 $crl = curl_init('https://rest.nexmo.com/sms/json');
 curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($crl, CURLINFO_HEADER_OUT, true);
 curl_setopt($crl, CURLOPT_POST, true);
 curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

 // Set HTTP Header for POST request
 curl_setopt($crl, CURLOPT_HTTPHEADER, array(
     'Content-Type: application/json'

   )
 );

 // Submit the POST request
 $result = curl_exec($crl);

 // handle curl error
 if ($result === false) {
     // throw new Exception('Curl error: ' . curl_error($crl));
     //print_r('Curl error: ' . curl_error($crl));
     $result_noti = 0; die();
 } else {

     $result_noti = 1; die();
 }
 // Close cURL session handle
 curl_close($crl);



 ?>
