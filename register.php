<?php
$errors = array(); 
session_start();

$servernameX = "ibu-sql-2022.adnan.dev";
$usernameX = "user_nedim";
$passwordX = "IQ642N";

try {
  $conn = mysqli_connect($servernameX, $usernameX, $passwordX, "db_nedim");
 
} catch(PDOException $e) {
    throw $e;
}
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
  
    if (strlen($password)<8){
        echo("<script>alert('Password must have more than 8 characters')</script>");
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
        echo("<script>alert('Username must not have special characters')</script>");
    }
  
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
      if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
      }
  
      if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
  
        $query = "INSERT INTO users (username, email, password, phone) 
                  VALUES('$username', '$email', '$password', $phonenumber)";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
  }
  


