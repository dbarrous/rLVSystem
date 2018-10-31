<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lab 9</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">About Me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>

      </nav>
    </header>
    <div>
      <?php
      if(isset($_SESSION['email'])){
        echo '<p>You are logged in!</p><form action= "logoutAction.php" method = "post"><button type="submit" name= "logout">Log Out</button></form>';

      }else{
        echo '<p>You are logged out!</p></form><form action="loginAction.php" method="post"><label for="email">E-Mail:</label><input type="text" name="email" required><label for="password">Password:</label><input type="password" name="password" required><button type="submit" name="login">Login</button><a href="signup.php">Sign Up!</a></form>';


      }
      ?>
    </div>


  </body>
</html>
