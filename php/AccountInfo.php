<?php

include "config.php";
include "checkToken.php";

if (($_POST['searchName']!="")){
  $email=$_POST['searchName'];
}else{
  $email=$_SESSION["email"];
}
  // find the information about the user


$sql="select emailAddress,passwordHash, administrator
    from user u  where
    u.emailAddress='{$email}'";

$result=mysqli_query($con,$sql);

if($row=mysqli_fetch_array($result)){
  echo "<div class=\"row text-white\">";
  echo "<div class=\"col-sm-3 text-center\">";

  echo "<br><p>Email Address: ";
  echo $row['emailAddress'];
  echo "</p><br>";
  echo "<p>Password: ";
  echo $row['passwordHash'];
  echo "</p><br>";
  if($row['administrator']==0)
  {
    echo "<p>Administrator: No</p><br>";
  }
  else{
    echo "<p>Administrator: Yes</p><br>";
  }

  echo "<input type='button' class='btn btn-success' value='Change Password' id='modify'>";
  echo "<br> <br>";
  echo "<input type='button' class='btn btn-success' value='Delete Account' id='Delete'>";

  echo "</div>";
  echo "</div>";
}


