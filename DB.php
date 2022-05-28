<?php


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
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO users (username,password,email,phone)
    VALUES ('$username', '$password', '$email', '$phone')";
   $connection->query($query);
    
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



  
  
     


}



?>