<?php

require_once 'functions.inc.php';
require_once 'dbh.inc.php';



if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $Username = $_POST["Uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdRepeat"];
  $code  = $_POST["code"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';


  if (emptyInputSignup($name, $email, $Username, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  if (invalidUid($Username) !== false) {
    header("location: ../signup.php?error=invaliduid");
    exit();
  }
  if (invalidUidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidemail");
    exit();
  }
  if(validPass($pwd) !== true){
    header("location: ../signup.php?error=invalidpass");
    exit();
  }
  if (pwdmatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }
  if (uidExists($conn, $Username, $email) !== false) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }
  if (empty($code)) {
    header("location: ../signup.php?error=emptycode");
    exit();
  }

  if (!checkCode($conn, $email, $code)) {
    header("location: ../signup.php?error=codedontmatch");
    exit();
  }


  createUser($conn, $name, $email, $Username, $pwd);
  removeCode($conn, $email);

}
else{
  header("location: ../signup.php");
  exit();
}
