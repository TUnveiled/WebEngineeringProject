<?php
include "config.php";
include "checkToken.php";

$passwordHash = $_POST['passwordHash'];
$passwordHashCheck = $_POST['passwordHashCheck'];
$msg = "Passwords don't match!";

if (($_POST['user'])!=""){
  $email=$_POST['user'];
}else{
  $email=$_SESSION["email"];
}



if ($passwordHash==$passwordHashCheck) {
  $servername = "localhost";
  $username = "root";
  $password = "newpassword";

  // Create connection
  $conn = new mysqli($servername, $username, $password, "ecommerce");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }





  $sql = "UPDATE user u
  SET   u.passwordHash='{$passwordHash}'
  WHERE  u.emailAddress='{$email}'";



  if (mysqli_query($conn, $sql) ) {
    $msg = "Password Changed successfully!";
    # sleep(1);
  } else {
    $msg = "Error";
  }



  mysqli_close($conn);
}
echo $msg;

?>
