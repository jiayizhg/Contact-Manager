<?php

// Check if user clicked the submit button on signup page
// If false, send user back to the signup page
if (isset($_POST['submit'])) {
  include_once 'dbh.inc.php';

  $firstName = mysqli_real_escape_string($dbconn, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($dbconn, $_POST['lastName']);
  $userID = mysqli_real_escape_string($dbconn, $_POST['userID']);
  $password = mysqli_real_escape_string($dbconn, $_POST['password']);

  // Check for empty fields
  if (empty($firstName) || empty($lastName) || empty($userID) || empty($password)) {
    header("Location: ../signup.php?signup=empty");
    exit();
  }
  else {
    // Check if input characters are valid
    if (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lasttName)) {
      header("Location: ../signup.php?signup=invalid");
      exit();
    }
    else {
      $sql = "SELECT * FROM users WHERE user_id='$userID'";
      $result = mysqli_query($dbconn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
        header("Location: ../signup.php?signup=usertaken");
        exit();
      }
      else {
        // Hashing the password
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        // Insert the user into the Database
        $sql = "INSERT INTO users() VALUES (userFirst, user:ast, userID, userPwd) VALUES ('$firstName', '$lastName', '$userID', '$password');";
        mysqli_query($$dbconn, $sql);
        header("Location: ../signup.php?signup=success");
        exit();
      }
    }
  }
}
else {
  header("Location: ../signup.php");
  exit();
}
?>
