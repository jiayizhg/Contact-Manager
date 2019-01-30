<?php
if (isset($_POST['submit'])) {
  include_once 'dbh.inc.php';
  $userID = mysqli_real_escape_string($dbconn, $_POST['userID']);
  $password = mysqli_real_escape_string($dbconn, $_POST['password']);

?>
