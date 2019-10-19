<?php

include "config.php";
include "checkToken.php";  // Check user token

if (isset($_SESSION['email'])) {

  $email = mysqli_real_escape_string($con, $_SESSION['email']);

  $sql = "select count(*) as cntUser from seller where userEmail='{$email}'";

  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);

  $count = $row['cntUser'];

  if ($count == 0) {
    echo "0 - Not a Seller";
  } else {
    echo "1 - A Seller";
  }

} else {
  echo "9 - Not Logged in";
}
