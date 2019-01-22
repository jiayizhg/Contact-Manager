<?php

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];

if (!empty($Username) || !empty($Password)) {
  $host = "localhost";
  $dbUsername = "";
  $dbPassword = "";
  $dbName = "";

  // Create connection
  $conn = new mysqli($host, $dbUsername, $$dbPassword, $dbName);

  if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
  }
  
  else {
    $SELECT = "SELECT Email From register Where Email = ? Limit 1";
    $INSERT = "INSERT Into register (Username, Password)" values(?, ?);

    // Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($Email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum == 0) {
      $stmt->close();

      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $Username, $Password, $Email);
      $stmt->execute();

      echo "New record inserted sucessfully";
    }

    else {
      echo "Someone already register using using this email";
    }
    $stmt->close();
    $conn->close();
  }
}

else {
  echo "All field are required";
  die();
}

?>
