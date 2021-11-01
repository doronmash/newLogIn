<?php
  session_start();

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head class="headHeader">
    <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
        }

        #wrapper {
          text color: white;
            min-height: 100%;
        }
        /* button{
          color: white;

          border-radius: 24px;
          width: 250%;
          height: 50%;
          background-color: #191919;
          margin: auto;
          text-align: center;
          margin: 5px;
          text-decoration:underline;
          color: white;

          border-color: #2ecc71
          text color: white;
        } */


    </style>
    <meta charset="utf-8">
    <title>PHP Project 01</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>


    <nav>
      <div class="wrapper">

        <ul>
          <li><a href="index.php">Home</a></li>
          <!--<li><a href="discover.php">About Us</a></li>-->
          <!--<li><a href="blog.php">Find Blogs</a></li>-->
          <?php
            if (isset($_SESSION["useruid"])) {
            //   echo "<li><a href='profile.php'>Profile page</a></li>";
              echo "<li ><a href='includes/logout.inc.php'>Log out</a></li>";
            }
            else {
              // echo "<li><a href='getCode.php'>Sign up</a></li>";
              echo "<li><a href='getCode.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
           ?>
        </ul>
      </div>
    </nav>


<div class="wrapper">
