<?php
  include_once 'header.php';
 ?>

  <section class="code-form">
    <!-- <h2>Sign Up</h2> -->
    <div class="code-form-form">

      <form action="includes/code.inc.php" method="post" id="code-form">
        <div class="">

        </div>
        <label class="label"for="text">Email: </label>
        <input class="email" type="text" name="email" placeholder="Email...">
          <br></br>
        <button class="getCode" type="sendCode" name="sendCode">Get Code</button>
      </form>
    </div>

    <?php
      if (isset($_GET["error"])) {
        // echo"<p>Fill in all fieldaaas!</p>";

        if ($_GET["error"] == "emptyinput") {
          // echo "<br></br>";
          echo"<p>Fill in all fields!</p>";
        }

        else if($_GET["error"] == "invalidemail"){
          // echo "<br></br>";
          echo"<p><b>Choose a proper email!</b></p>";
        }

      }
     ?>
  </section>

<style >
label{
  color: white;
}
.code-form-form{
  width: 400px;
  padding: 40px;
  position: absolute;
  top: 60%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: #191919;
  text-align: center;
}
.code-form-form .email{
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
  background-color: #191919;
}
.code-form-form .email:focus{
  width: 280px;
  border-color: #2ecc71

}

  .code-form-form .getCode{
    border-radius: 24px;
    width: 55%;

    background-color: #191919;
    margin: auto;
    color: white;
    border-color: #3498bd
  }
  .code-form-form .getCode:focus{
    width: 280px;
    border-color: #2ecc71
  }
</style>

  <?php
    include_once 'footer.php';
   ?>
