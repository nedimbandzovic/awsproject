<?php

require 'flight/Flight.php';
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

    if (strlen($username)<3){
      return Flight::json(array(
        'status'=>'error',
        'message'=>'The username is too short'
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

    return Flight::json(array(
      'status'=>'error',
      'message'=>'User has not been found'
    ));
    die();


});



Flight::start();
