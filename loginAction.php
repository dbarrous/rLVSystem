<?php
if (isset($_POST['login'])) {

  require 'db.php';

  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email)|| empty($password)) {
    header("Location index.php?error=emptyfields");
  }

  else{
    $sql = "SELECT * FROM users WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: index.php?error=mysql");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $email );
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($password, $row['pwd']);
        $confNum = $row['confNum'];

        if($pwdCheck == false){
          header("Location: index.php?error=wrongPass");
          exit();
        }elseif($pwdCheck == true && $confNum == 1){
          session_start();
          $_SESSION['email'] = $row['email'];

          header("Location: index.php?login=success");
          exit();
        }else {
          header("Location: index.php?error=wrongPass");
          exit();
        }

      }else{
        header("Location: index.php?error=nouser");
      }
    }

  }

}else {
  header("Location: index.php");
  exit();
}

?>
