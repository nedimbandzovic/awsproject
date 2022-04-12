<?php

$password="1234";
generate_new_hash($password);
function generate_new_hash ($password){
  $pass_hash=password_hash($password, PASSWORD_DEFAULT);
  echo $pass_hash;
}

function password_checker($password){

$hash=strtoupper(hash("sha1",$password));
$hash_first_five=substr($hash,0,5);
$hash_remainder=substr($hash,5);
$response=file_get_contents("https://api.pwnedpasswords.com/range/".$hash_first_five);

if (strpos($response,$hash_remainder)){
  return true;
}else{
  return false;
}

}