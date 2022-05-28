<?php


require_once 'vendor/autoload.php';

class DB {
  protected $connection;

  public function __construct(){
    
    try {
     
    } catch(PDOException $e) {
      throw $e;
    }
  }

  public static function register($username,$password,$email, $phone){
    $connection = new PDO("mysql:host=ibu-sql-2022.adnan.dev;port=3306;dbname=db_nedim", "user_nedim", "IQ642N");
    $token=md5(random_bytes(16));
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO users (username,password,email,phone,check_token, status)
    VALUES ('$username', '$password', '$email', '$phone', '$token','DISABLED')";
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
    
  }

  public static function login ($username, $password){

    $connection = new PDO("mysql:host=ibu-sql-2022.adnan.dev;port=3306;dbname=db_nedim", "user_nedim", "IQ642N");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=$connection->query($query);
    $row_count = $result->rowCount();
    if ($row_count>0){
      echo ('User is found');
    } else{
      echo ('User not found');
      exit();
    }


    
  }

  public static function confirm($token){

    $connection = new PDO("mysql:host=ibu-sql-2022.adnan.dev;port=3306;dbname=db_nedim", "user_nedim", "IQ642N");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="UPDATE users SET status='ENABLED' WHERE check_token='$token'";
   $connection->query($query);
   echo "Account confirmation successful, wait for 10 seconds";

    header('Refresh: 10; URL=http://127.0.0.1/22-cen343-nedim-b/login.html');
    
    
  }



  
  
     


}



?>