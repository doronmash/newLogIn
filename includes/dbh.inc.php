<?php
// $serverName = "localhost";
// $dBUsername = "id17769391_root";
// $dBPassword = "GCl_XR5?tL#oj8u7";
// $dBName = "id17769391_phpproject01";

$serverName = "localhost";
$dBUsername = "id17769391_dorondata1";
$dBPassword = "O=d|J5ih&rz-\sqv";
$dBName = "id17769391_dorondata";
//O=d|J5ih&rz-\sqv

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}
