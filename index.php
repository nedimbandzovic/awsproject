<?php

require 'flight/Flight.php';
//Hiding errors
error_reporting(0);
ini_set('display_errors', 0);

Flight::route('/hello', function () {
    echo 'Hello to the world from Nedim!';
});

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
