<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



if (isset($_POST["submit"])) {

  $Username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  

  

  if (emptyInputLogin($Username, $pwd) !== false) {
    #echo("Username" . $pwd . $Username);

    header("location: ../login.php?error=emptyinput");
    exit();
  }

  loginUser($conn, $Username, $pwd, isset($_POST['rememberMe']));
}
else {
  header("location: ../login.php");
  exit();
}



