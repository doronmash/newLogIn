<?php
  include_once 'header.php';
  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  if(isset($_COOKIE["userId"]) && isset($_COOKIE["sessionId"])){
    // echo $_COOKIE["userId"] . " " . $_COOKIE["sessionId"];

    checkSession($conn,$_COOKIE["userId"], $_COOKIE["sessionId"]);

 }
 ?>

  <section class="signup-form">
    <!-- <h2>Log In</h2> -->
    <div class="signup-form-form">
      <form action="includes/login.inc.php" method="post">
        <div class="box">
          <label class="label"for="text">Username/Email: </label>
          <input type="text" name="uid" placeholder="Username/Email...">
        <!-- </div> -->
        <!-- <div class="box"> -->
          <label class="label"for="text">Password: </label>
          <input type="password" name="pwd" placeholder="Password...">
        <!-- </div> -->



        <button class="btn1" type="submit" name="submit">Log In</button>
        <div class="box1">
          <input type="checkbox" name="rememberMe" value="ch" id="check">
          <label for="check">Remember Me</label>
        </div>
      </form>

    </div>
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo"<p>Fill in all fields!</p>";
        }
        else if($_GET["error"] == "wronglogin"){
          echo"<p>Incorrect login information!</p>";
        }
      }
     ?>
  </section>

<style>

/* button{
  border-radius: 24px;
  width: 55%;
  background-color: #191919;
  margin: auto;
  color: white;
  border-color: #2ecc71
}
button:focus{
  width: 280px;
  border-color: #2ecc71
} */
.signup-form-form .box .btn1{
  border-radius: 24px;
  width: 55%;
  background-color: #191919;
  margin: auto;
  color: white;
  border-color: #3498bd
}
.signup-form-form .box .btn1:focus{
  width: 280px;
  border-color: #2ecc71
}

.signup-form-form .box .box1{
         padding: 10px 0;
         display: flex;
         justify-content: center;}
label{
  color: white;
}
  .signup-form-form .box{
    width: 400px;
    padding: 40px;
    position: absolute;
    top: 75%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #191919;
    text-align: center;
      /* margin: : 20px auto;
      font-size: 100%;
      text-align: center;
      display: block;
      position: absolute; */
  }
.signup-form-form .box input[type = text]:focus, .signup-form-form .box input[type = password]:focus{
  width: 280px;
  border-color: #2ecc71

}

.signup-form-form .box input[type = text], .signup-form-form .box input[type = password],.signup-form-form .box input[type = checkbox]{
  border: 0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #3498bd;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
}


</style>
  <?php
    include_once 'footer.php';
   ?>
