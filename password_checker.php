<?php

class PasswordChecker {
public static function generate_new_hash ($password){
  $pass_hash=password_hash($password, PASSWORD_DEFAULT);
  return $pass_hash;
}

public static function password_checker($password){

$hash=strtoupper(hash("sha1",$password));
$hash_first_five=substr($hash,0,5);
echo $hash;
$hash_remainder=substr($hash,5);
$response=file_get_contents("https://api.pwnedpasswords.com/range/".$hash_first_five);

if (strpos($response,$hash_remainder)){
  return true;
}else{
  return false;
}
}
}