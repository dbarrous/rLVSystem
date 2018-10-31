<?php
if(isset($_POST['signup-submit'])){
  //calls database connection file
  require 'db.php';
  //gets the variables from the signup form
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password-repeat'];
  $confNum = 0;
  //checks to see if any of the variables are empty and returns users back to page
  if (empty($email)|| empty($password) || empty($password2)) {
    header("Location: signup.php?error=emptyfields&email=".$email);
    exit();
  }
  //checks if email is valid and returns users back to page
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: signup.php?error=invalidEmail");
    exit();
  }
  //checks to see if passwords match and returns users back to page
  elseif($password !== $password2){
    header("Location: signup.php?error=invalidPassword&email=".$email);
    exit();
  }
  // If it passes all the checks above then it runs mysqli prepared statements
  else{
    //selects the emails to check if the same ones exist already in the database
    $sql = "SELECT email FROM users WHERE email=?;";
    //starts the prepared statement
    $stmt = mysqli_stmt_init($conn);
    //checks if it is valid if not returns back to signup
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: signup.php?error=sqlError1&email=".$email);
      exit();
    }
    //if it is valid then it continues
    else {

      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);

      $resultCheck = mysqli_stmt_num_rows($stmt);
      //check to see if email exists in database
      if ($resultCheck > 0) {
        header("Location: signup.php?error=emailTaken");
        exit();
      }
      else {
        $sql = "INSERT INTO users(email,pwd,confNum) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: signup.php?error=sqlError2&email=".$email);
          exit();

      }else {
        //hashes password and adds the user to database via prepared statement then returns user
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $email,$hashedPass,$confNum);
        mysqli_stmt_execute($stmt);



            $theurl = "http://localhost:8888/lab9/verify.php?email=".$email;
            mail ($email, "Verification Link", $theurl);
            header("Location: index.php?signup=success");
            exit();
      }

    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

}
?>
