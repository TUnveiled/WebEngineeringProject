<?php

$AdminEmailAddress = $_POST['AdminEmailAddress'];
$AdminPasswordHash = $_POST['AdminPasswordHash'];
$AdminPasswordHashCheck = $_POST['AdminPasswordHashCheck'];
$msg = "Passwords don't match!";

if ($AdminPasswordHash==$AdminPasswordHashCheck) { //if the password and check match
  $servername = "localhost";
  $username = "root";
  $password = "newpassword";

  // Create connection
  $conn = new mysqli($servername, $username, $password, "ecommerce");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "insert into User (emailAddress, passwordHash, administrator) VALUES ('".$AdminEmailAddress."', '".$AdminPasswordHash."', 1)";

  if (mysqli_query($conn, $sql)) {
    $msg = "Account created successfully!";
    # sleep(1);
  } else {
    $msg = "This email is already associated with an account!";
  }



  mysqli_close($conn);
}
echo $msg;

?>
