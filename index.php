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

Flight::start();
