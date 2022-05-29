<?php

//require 'flight/Flight.php';
require_once 'DB.php';
require_once 'password_checker.php';
//Hiding errors
error_reporting(0);
ini_set('display_errors', 0);

Flight::route('/hello', function () {
    echo 'Hello to the world from Nedim!';
});
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"user"},
     *     summary="Register user",
     *     description="This can only be done by the logged in user.",
     *     operationId="registerUser",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="Create user object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterModel")
     *     )
     * )
     */
Flight::route('POST /register', function () {
    $username=Flight::request()->data->username;
    $password=Flight::request()->data->password;
    $email=Flight::request()->data->email;
    $phone=Flight::request()->data->phone;
    $test=PasswordChecker::password_checker($password);
    
  if (strlen($username)<3){
       return Flight::json(array(
         'status'=>'error',
         'message'=>'The username is too short'
       ));
       die();
     }
     if ($test){
      return Flight::json(array(
        'status'=>'error',
        'message'=>'The password is not safe'
      ));
      die();

     }
     if (strlen($password)<8){
      return Flight::json(array(
        'status'=>'error',
        'message'=>'The password must have 8 characters'
      ));
      die();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
       return Flight::json(array(

         'status'=>'error',
        'message'=>'The email is not in supported format'
      ));
       die();
     }
     DB::register($username, $password, $email, $phone);

     return Flight::json(array(

      'status'=>'Successful',
    'message'=>'Registration successful'
   
    ));
     die();


});
 /**
     * @OA\Post(
     *     path="/login",
     *     tags={"user"},
     *     summary="Log in user",
     *     description="This can only be done by the logged in user.",
     *     operationId="Log in",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     ),
     *     @OA\RequestBody(
     *         description="Login object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginModel")
     *     )
     * )
     */
    Flight::route('POST /login', function () {
      $username=Flight::request()->data->username;
      $password=Flight::request()->data->password;
      DB::login($username,$password);
  
  });
  
  Flight::route('GET /confirm/@token', function ($token) {
    DB::confirm($token);
    

});

Flight::route('GET /confirm/@username/@status', function ($username,$status) {
  DB::set_2fa_status($username,$status);
  

});

Flight::route('GET /get/@username', function ($username) {
  DB::get($username);
  

});

Flight::route('GET /getSecret/@username', function ($username) {
  DB::generate_secret($username);
  

});

Flight::route('GET /getQRnumber/@username', function ($username) {
  DB::getQRCode($username);
  

});

Flight::route('GET /getSMScode/@username', function ($username) {
  DB::generate_sms_code($username);
  

});
Flight::route('GET /getSMSvercode/@username', function ($username) {
  DB::getSMS($username);
  

});

Flight::route('GET /reset/@email', function ($email) {
  DB::get_user_by_email($email);
  

});

Flight::route('GET /setup/@token/@password', function ($token,$password) {
  DB::set_new_password($token,$password);
  

});








Flight::start();
