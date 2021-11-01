<?php
  include_once 'header.php';
 ?>


  <section class="signup-form">
    <!-- <h2>Sign Up</h2> -->
    <div class="signup-form-form">
      <form action="includes/signup.inc.php" method="post" id="signup-form">
        <div class="box">
          <label for="text">Full name:</label>
          <input class="name" type="text" name="name" placeholder="Full name...">
          <label for="text">Email:</label>
          <input  class="email" type="text" name="email" placeholder="Email...">
          <label for="text">Username:</label>
          <input class="username" type="text" name="Uid" placeholder="Username...">

          <label for="text">Password:</label>
          <div class="tooltip">
            <input type="password" name="pwd" placeholder="Password..." >
            <span style="font-size:20px" class="tooltiptext"><li><b>Password must be</b></li><li>at least 4 characters</li><li>at least 1 number</li><li>at least 1 letter</li></span>
         </div>
         <label for="text">Repeat password:</label>

         <div class="tooltip">
           <input class="pass" type="password" name="pwdRepeat" placeholder="Repeat password...">
           <span style="font-size:20px" class="tooltiptext"><li><b>Password must be</b></li><li>at least 4 characters</li><li>at least 1 number</li><li>at least 1 letter</li></span>
        </div>
          <label for="text">Code:</label>

          <input class="code" type="text" name="code" placeholder="Code...">
          <button class="signup" type="submit" name="submit">Sign Up</button>
        </div>

    </form>
    </div>




    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          // echo "<br></br><br></br>";
          echo"<p><b>Fill in all fields!</b></p>";
        }
        else if($_GET["error"] == "invaliduid"){
          // echo "<br></br><br></br>";
          echo"<p><b>Choosedd a proper username!</b></p>";
        }
        else if($_GET["error"] == "invaliemail"){
          // echo "<br></br><br></br>";
          echo"<p><b>Choose a proper email!</b></p>";
        }
        else if($_GET["error"] == "invalidpass"){
          // echo "<br></br><br></br>";
          echo"<p><b>Invalid password try again</b></p>";
        }
        else if($_GET["error"] == "passwordsdontmatch"){
          // echo "<br></br><br></br>";
          echo"<p><b>Passwords doesnt match!</b></p>";
        }
        else if($_GET["error"] == "usernametaken"){
          // echo "<br></br><br></br>";
          echo"<p><b>Username already taken!</b></p>";
        }
        else if($_GET["error"] == "stmtfailed"){
          // echo "<br></br><br></br>";
          echo"<p><b>Something went wrong, try again!</b></p>";
        }
        else if($_GET["error"] == "none"){
          // echo "<br></br><br></br>";
          echo"<p><b>You have signed up!</b></p>";
          echo "<p> you can now <a href='login.php'>Log in</a></p>";
        }
      }
     ?>
  </section>


  <style>
  label{
    color: white;

  }
  .signup-form-form{
    height: 800px;
    width: 500px;
    padding: 40px;
    position: absolute;
    top: 85%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #191919;
    text-align: center;
  }
  .signup-form-form.box:focus{
    width: 280px;
    border-color: #2ecc71
  }


.signup-form-form.box{
  padding: 10px 0;
  display: flex;
  justify-content: center;}
}
input{
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
.signup-form-form .box .name{
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
.signup-form-form .box .name:focus{
  width: 280px;
  border-color: #2ecc71
}
.signup-form-form .box .email{
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
.signup-form-form .box .email:focus{
  width: 280px;
  border-color: #2ecc71
}
.signup-form-form .box .username{
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
.signup-form-form .box .username:focus{
  width: 280px;
  border-color: #2ecc71
}

.signup-form-form .box .tooltip .email{
  background: black;
}
.signup-form-form .box .code{
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

.signup-form-form .box .code:focus{
  width: 280px;
  border-color: #2ecc71
}




  .tooltip {
    position: relative;
    display: inline-block;


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

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 220px;
    background-color: #fff;
    color: #555;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.7s;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 10px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

.signup-form-form .box .signup{
  border-radius: 24px;
  width: 55%;
  background-color: #191919;
  margin: auto;
  color: white;
  border-color: #3498bd
}
.signup-form-form .box .signup:focus{
  width: 280px;
  border-color: #2ecc71
}


  </style>

  <?php
    include_once 'footer.php';
   ?>
