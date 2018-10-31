<?php
  require "header.php"
  ?>

  <main>
    <div>
      <h1>Sign Up</h1>
      <form action="signupAction.php" method="post">
      <label for="email">E-Mail:</label>
      <input type="text" name="email" >
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <label for="password-repeat">Repeat Password:</label>
      <input type="password" name="password-repeat" required>
      <button type="submit" name="signup-submit">Sign Up</button>
    </form>

    </div>
  </main>


  <?php
    require 'footer.php';
    ?>
