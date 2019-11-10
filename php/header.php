<?php
include "config.php";
include "checkToken.php";  // Check user token

// Check user login or not
if(isset($_SESSION['admin'])) {
  echo "Administrator Access for {$_SESSION['email']}";
} else if(isset($_SESSION['email'])){
  echo "Logged in as {$_SESSION['email']}";
} else {
  echo "Not Logged in";
}

// logout
if(isset($_POST['but_logout'])){
  session_destroy();
}
