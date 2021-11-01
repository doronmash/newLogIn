<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
// require_once 'functions.inc.php';
// require_once 'dbh.inc.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/Exception.php';
// require 'PHPMailer/PHPMailer.php';
// require 'PHPMailer/SMTP.php';
require_once 'functions.inc.php';
require_once 'dbh.inc.php';

$randomNumber = rand(100,999);
// echo "<h2>" . $randomNumber . "</h2>";
if (isset($_POST["sendCode"])) {
  $email = $_POST["email"];

  if (invalidUidEmail($email) !== false) {
    header("location: ../getCode.php?error=invalidemail");
    exit();
  }

  saveCode($conn, $email, "" . $randomNumber);
  $mail = new PHPMailer;

  $mail->isSMTP();                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;               // Enable SMTP authentication
  $mail->Username = 'checkdoron@gmail.com';   // SMTP username
  $mail->Password = 'popisheli1';   // SMTP password
  $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                    // TCP port to connect to

  // Sender info
  $mail->setFrom('checkdoron@gmail.com', 'CodexWorld');
  $mail->addReplyTo('checkdoron@gmail.com', 'CodexWorld');

  // Add a recipient
  $mail->addAddress($email);

  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  // Set email format to HTML
  $mail->isHTML(true);

  // Mail subject
  $mail->Subject = 'Verification code';

  // Mail body content
  $bodyContent = '<h1 dir="ltr">Your code is: </h1>';
  $bodyContent .= '<p dir="ltr"><b>' . $randomNumber . '</b></p>';
$mail->Body    = $bodyContent;

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
} else {
  header("location: ../signup.php");
    // echo 'Message has been sent.';
}
}
