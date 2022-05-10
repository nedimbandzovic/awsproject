<?php

require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('in-v3.mailjet.com', 587))
  ->setUsername('5fde2e547ac65c2ed99d7a081629e907')
  ->setPassword('')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['nedim.bandzovic@stu.ibu.edu.ba' => 'John Doe'])
  ->setTo(['nedim.bandzovic2001@gmail.com', 'other@domain.org' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);