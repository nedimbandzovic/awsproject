<?php


// A sample PHP Script to POST data using cURL

 $data = array(
     'from' => 'Nedim',
     'text' => 'Hi there',
     'to' => '38761648664',
     'api_key' => 'f68f2ebe',
     'api_secret' => 'l5B7VZ1xVqWDlHKy',


 );

 $post_data = json_encode($data);

 // Prepare new cURL resource
 $crl = curl_init('https://rest.nexmo.com/sms/json');
 curl_setopt($crl, CURLOPT_RETURNTRANtSFER, true);
 curl_setopt($crl, CURLINFO_HEADER_OUT, true);
 curl_setopt($crl, CURLOPT_POST, true);
 curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

 // Set HTTP Header for POST request
 curl_setopt($crl, CURLOPT_HTTPHEADER, array(
     'Content-Type: application/json',
     //'Content-Length: ' . strlen($payload))
 );

 // Submit the POST request
 $result = curl_exec($crl);
 print($result);


 // Close cURL session handle
 curl_close($crl);



 ?>
