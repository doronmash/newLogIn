<?php

ob_start();

function emptyInputSignup($name, $email, $Username, $pwd, $pwdRepeat){
  $result;
  if (empty($name) || empty($email) || empty($Username) || empty($pwd) || empty($pwdRepeat)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function validPass($pwd){
  $result;
  $lowercase = preg_match('@[a-z]@', $pwd);
  $number    = preg_match('@[0-9]@', $pwd);
  if (strlen($pwd) < 4 || !$number || !$lowercase) {

    $result = false;
  }
  else {
    $result = true;
  }
  return $result;
}


function invalidUid($Username){
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $Username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUidEmail($email){
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdmatch($pwd, $pwdRepeat){
  $result;
  if ($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $Username, $email){
  $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
  
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken18");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $Username, $email);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

function getUserName($conn, $userId){
  $sql = "SELECT * FROM users WHERE userId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken2");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $userId);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}


function saveCode($conn, $email, $code){
  $sql = "INSERT INTO code (email, code) VALUES (?, ?);";
  // $stmt = mysqli_stmt_init($conn);
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $code);
  $stmt->execute();
  $stmt->close();

  // if (!mysqli_stmt_prepare($stmt, $sql)) {
  //   header("location: ../signup.php?error=usernametaken");
  //   exit();
  // }
  //
  // mysqli_stmt_bind_param($stmt, "ss", $email, $code);
  // mysqli_stmt_execute($stmt);
  // mysqli_stmt_close($stmt);
  // exit();
}

function createUser($conn, $name, $email, $username, $pwd){
  $sql = "INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (?, ?, ?, ?);";
//   $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }
  echo $pwd;
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  // $hashedPwd =  $pwd;
  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  // exit();
}


function emptyInputLogin($Username, $pwd){
  $result;
  if (empty($Username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
function checkCode($conn,$email, $code){
  $checkCode = getCode($conn,$email);

  if ($checkCode === false) {
    header("location: ../signup.php?error=unregisteredemail");
    exit();
  }

   if ($code == $checkCode["code"]) {
     return true;
   }

  if ($checkPwd === false) {
    header("location: ../signup.php?error=unregisteredemail");
    exit();
  }
  else if($checkPwd === true){
    session_start();
    $_SESSION["userid"] = $checkCode["userId"];
    $_SESSION["useruid"] = $checkCode["userUid"];
    header("location: ../index.php");
    exit();
  }
}

function removeCode($conn,$email){
  $sql = "DELETE FROM code WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}



function getCode($conn,$email){
  $sql = "SELECT * FROM code WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}


function loginUser($conn, $Username, $pwd, $rememberMe){
  $uidExists = uidExists($conn, $Username, $Username);

  if ($uidExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["userPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {

    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if($checkPwd === true){
    session_start();
    if($rememberMe){
        $sessionId = generateRandomString(15);
        setcookie("userId", $uidExists["userId"], time() + (86400 * 30), "/");
        setcookie("sessionId", $sessionId, time() + (86400 * 30), "/");
        $hashedSessionId = password_hash($sessionId, PASSWORD_DEFAULT);
        saveSession($conn,$uidExists["userId"], $hashedSessionId);
    }

    $_SESSION["userid"] = $uidExists["userId"];
    $_SESSION["useruid"] = $uidExists["userUid"];
    header("location: ../index.php");

    exit();
  }
}

function saveSession($conn, $userId, $sessionId){
 // echo "dsfsdf";
  $sql = "INSERT INTO session (userId, sessionId) VALUES (?, ?);";
   //echo $userId;
  // echo $sessionId;
   $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=usernametaken");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "is", $userId, $sessionId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
   //echo "dsfsd77777777777777777777777777f";
  

}

function getSession($resultData){
    if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }
}


function checkSession($conn,$userId, $sessionId){
  $sql = "SELECT * FROM session WHERE userId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      return;
    }

  mysqli_stmt_bind_param($stmt, "s", $userId);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  $row = getSession($resultData);
  if($row == false){

      return;
  }
  $checkSessionId = password_verify($sessionId, $row["sessionId"]);

  if ($checkSessionId === false) {


      return;
    }
  else{
    $user = getUserName($conn, $row['userId']);
    $_SESSION['userid'] = $user['userId'];
    $_SESSION['useruid'] = $user['userUid'];
    // $_SESSION['userid'] = $user['usersId'];
    // $_SESSION['useruid'] = $user['usersUid'];

    header("location: ../index.php");
    // header("location: ../hello.php");
    ob_end_flush();
    exit();
  }

  mysqli_stmt_close($stmt);

}

function removeSession($conn,$userId){
  $sql = "DELETE FROM session WHERE userId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    return;
  }

  mysqli_stmt_bind_param($stmt, "s", $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  // unset($_COOKIE['userId']);
  // unset($_COOKIE['sessionId']);
  setcookie("userId", "", time() - (86400 * 30));
  setcookie("sessionId", "", time() - (86400 * 30));
}



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
