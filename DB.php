<?php


require_once 'vendor/autoload.php';
error_reporting(0);
ini_set('display_errors', 0);

use OTPHP\TOTP;
class DB {
  protected $connection;

  public function __construct(){
    
    try {
     
    } catch(PDOException $e) {
      throw $e;
    }
  }

  public static function register($username,$password,$email, $phone){
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $token=md5(random_bytes(16));
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO users (username,password,email,phone,check_token, status, 2fa)
    VALUES ('$username', '$password', '$email', '$phone', '$token','ENABLED', 'null')";
   $connection->query($query);
   $transport = (new Swift_SmtpTransport('in-v3.mailjet.com', 587))
   ->setUsername('5fde2e547ac65c2ed99d7a081629e907')
   ->setPassword('1378421cf8c22f5adf8e05eb3c3653d3')
 ;

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Welcome to Our Platform'))
  ->setFrom(['nedim.bandzovic@stu.ibu.edu.ba' => 'OurPlatform'])
  ->setTo([$email])
  ->setBody('Welcome to our platform. Please confirm your account by clicking on http://127.0.0.1/22-cen343-nedim-b/confirm/'.$token);
  ;

// Send the message
$result = $mailer->send($message);
alert($result);
    
  }

  public static function get_user_by_email($email){
    $token=md5(random_bytes(16));
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query=("UPDATE users SET reset_token='$token' WHERE email='$email'");
      $sth = $connection->prepare($query);
      $sth->execute();
      $result = $sth->fetchColumn();
     
      $transport = (new Swift_SmtpTransport('in-v3.mailjet.com', 587))
  ->setUsername('5fde2e547ac65c2ed99d7a081629e907')
  ->setPassword('1378421cf8c22f5adf8e05eb3c3653d3')
;

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Welcome to Our Platform'))
  ->setFrom(['nedim.bandzovic@stu.ibu.edu.ba' => 'OurPlatform'])
  ->setTo([$email])
  ->setBody('You have demanded to reset your password. The token for resetting is: '.$token);
  ;

// Send the message
$result = $mailer->send($message);
  
  }

  public static function set_new_password($token, $newPassword){
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET password='$newPassword' WHERE reset_token='$token'";
    $connection->query($query);
    $query4="UPDATE users SET reset_token='null' WHERE reset_token='$token'";
    $connection->query($query4);

  
  
  }

  public static function login ($username, $password){

    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT 2fa FROM users WHERE username='$username' AND password='$password'";
    $sth = $connection->prepare($query);
    $sth->execute();
    $result = $sth->fetchColumn();
   
    echo $result;
}
  

public static function get_secret_db($username){
  $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT otp FROM users WHERE username='$username'";
    $sth = $connection->prepare($query);
    $sth->execute();
    $result = $sth->fetchColumn();
    return $result;
    

}

   public static function generate_secret ($username){
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $secret=DB::get_secret_db($username);
    $otp = TOTP::create($secret);
    $current_otp=$otp->now();
    $query=("UPDATE users SET otp_number='$current_otp' WHERE username='$username'");
    $connection->query($query);


    $otp->setLabel('nedim@ibu');
$grCodeUri = $otp->getQrCodeUri(
    'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
    '[DATA]'
);

    echo $grCodeUri;


  

   }

   public static function getQRcode($username){
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query=("SELECT otp_number FROM users WHERE username='$username'");
    $sth = $connection->prepare($query);
    $sth->execute();
    $result = $sth->fetchColumn();
    echo $result;


   }

  public static function get ($username){
    $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query=("SELECT 2fa FROM users WHERE username='$username'");
    $sth = $connection->prepare($query);
    $sth->execute();
    $result = $sth->fetchColumn();
    echo $result;
}

public static function getSMS ($username){
  $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query=("SELECT sms FROM users WHERE username='$username'");
  $sth = $connection->prepare($query);
  $sth->execute();
  $result = $sth->fetchColumn();
  echo $result;
}
public static function generate_sms_code($username){

  
 
  $SMScode=(rand(1000,9000));
  $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET sms='$SMScode' WHERE username='$username'";
    $connection->query($query);
    $access_token=strtoupper('user_nedim');
    $final=strtoupper(hash('sha256',$access_token));
    $data = array(
      'from' => 'OurPlatform',
      'text' => 'Your verification code is: '. $SMScode,
      'to' => '38761648664',
      'api_key' => 'f68f2ebe',
      'api_secret' => 'l5B7VZ1xVqWDlHKy'
 
 
  );
  $post_data = json_encode($data);
   $crl = curl_init('https://rest.nexmo.com/sms/json');
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
 
    )
  );
   $result = curl_exec($crl);
 
  if ($result === false) {
      $result_noti = 0; die();
  } else {
 
      $result_noti = 1; die();
  }
  curl_close($crl);
 
 
 
}

public static function set_2fa_status ($username, $status){

  $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET 2fa='$status' WHERE username='$username'";
    $connection->query($query);
    $query=("SELECT 2fa FROM users WHERE username='$username'");
    $sth = $connection->prepare($query);
    $sth->execute();
    $result = $sth->fetchColumn();
    if ($result=='QR'){
      $otp = TOTP::create();
    $secret=$otp->getSecret();
    $query4=("UPDATE users SET otp='$secret' WHERE username='$username'");
    $connection->query($query4);



    }
    echo "Your status is '$status', wait for 10 seconds to be redirected";

    header('Refresh: 10; URL=http://127.0.0.1/22-cen343-nedim-b/login.html');


    
  }
public static function confirm($token){

  $connection = new PDO("mysql:host=sql11.freemysqlhosting.net;port=3306;dbname=sql11592258", "sql11592258", "ZNd3RjfNK8");
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET status='ENABLED' WHERE check_token='$token'";
   $connection->query($query);
   $query45="UPDATE users SET check_token='null' WHERE check_token='$token'";
    $connection->query($query45);
   echo "Account confirmation successful, wait for 10 seconds";

    header('Refresh: 10; URL=http://127.0.0.1/22-cen343-nedim-b/login.html');
    
    
  }



  
  
     


}



?>