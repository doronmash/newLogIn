<?php
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  
  if(isset($_COOKIE["userId"]) && isset($_COOKIE["sessionId"])){
    removeSession($conn, $_COOKIE['userId']);

}
  
  session_start();
  session_unset();
  session_destroy();
  header("location: ../index.php");
  exit();
