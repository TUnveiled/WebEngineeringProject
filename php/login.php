<?php
include "config.php";

if(isset($_POST['email'])){

  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['pwd']);

  if ($email != "" && $password != ""){

    $sql_query = "select count(*) as cnt from user where emailAddress='".$email."' and passwordHash='".$password."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);
    $count = $row['cnt'];

    if($count > 0){
      $row = mysqli_fetch_array($result);

      $token = getToken(10);
      //echo "login successful";
      $_SESSION['email'] = $email;
      $_SESSION['token'] = $token;

      $sql_query = "select administrator from user where emailAddress='".$email."' and passwordHash='".$password."'";
      $result = mysqli_query($con,$sql_query);
      $row = mysqli_fetch_array($result);
      $admin = $row['administrator'];

      if ($admin) {
        $_SESSION['admin'] = true;
        echo "Admin Login Successful";
      }
      else{
        echo "User Login Successful";
      }

      // Update user token
      $result_token = mysqli_query($con, "select count(*) as allcount from usertoken WHERE emailAddress='{$email}'");
      $row_token = mysqli_fetch_assoc($result_token);
      if($row_token['allcount'] > 0){
        mysqli_query($con,"update usertoken set token='".$token."' where emailAddress='".$email."'");
      }else{
        mysqli_query($con,"insert into usertoken(emailAddress,token) values('".$email."','".$token."')");
      }
    }else{
      echo "Invalid username and password";
    }

  }

}

// Generate token
function getToken($length){
  $token = "";
  $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
  $codeAlphabet.= "0123456789";
  $max = strlen($codeAlphabet); // edited

  for ($i=0; $i < $length; $i++) {
    $token .= $codeAlphabet[random_int(0, $max-1)];
  }

  return $token;
}
