<?php
  include_once 'header.php';
 ?>


  <section class="index-intro">
    <?php
    echo "doron login system";
      if (isset($_SESSION["useruid"])) {
        echo"<p>Hello there ". $_SESSION["useruid"] . "</p>";
      }
      else {
        // echo "<li><a href='signup.php'>Sign up</a></li>";
        // echo "<li><a href='login.php'>Log in</a></li>";
      }
     ?>
    <!-- <h1>This Is An Introduction</h1>
    <p>Here is an important paragraph</p> -->
  </section>

  <?php
    include_once 'footer.php';
   ?>
