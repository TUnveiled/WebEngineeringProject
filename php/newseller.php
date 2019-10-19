<?php

include "config.php";
include "checkToken.php";  // Check user token



if (isset($_POST['sellerName'])) {


  $sellerName = mysqli_real_escape_string($con, $_POST['sellerName']);
  $email = mysqli_real_escape_string($con, $_SESSION['email']);

  $sql = "select count(*) as cntUser from user where emailAddress='{$email}' and administrator=1";

  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);

  $count = $row['cntUser'];

  if ($count == 0) {

    $sql = "insert into seller (userEmail, sellerName) values ('{$email}', '{$sellerName}')";

    if (mysqli_query($con, $sql)) {
      $msg = "You are now a seller!";
    } else {
      $msg = "This seller name is already taken!";
    }
  } else {
    $msg = "Administrators cannot sell products";
  }

  echo $msg;


}
