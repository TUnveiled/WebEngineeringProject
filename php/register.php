<?php

$emailAddress = $_POST['emailAddress'];
$passwordHash = $_POST['passwordHash'];
$passwordHashCheck = $_POST['passwordHashCheck'];
$msg = "Passwords don't match!";

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

  $sql = "insert into User (emailAddress, passwordHash, administrator) VALUES ('".$emailAddress."', '".$passwordHash."', 0)";

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
