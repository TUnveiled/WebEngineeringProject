<?php
include "config.php";
include "checkToken.php";

if (($_POST['deleteName'])!=null ){
  $email=$_POST['deleteName'];
}else {
  $email=$_SESSION["email"];
}

  // Check connection
  if ($con->connect_error) {
    $msg="Connection failed";
  }else {

    $sellercheck="select sellerName from seller where userEmail='".$email."'";
    $result=mysqli_query($con,$sellercheck);
    if($result){
      $row=mysqli_fetch_array($result);
      $seller=$row['sellerName'];
      // delete from all places with seller cascade was not in sql code so a bit more difficult
      $del="DELETE  FROM customerorder WHERE sellerName='".$seller."'";
      $del1="DELETE p.*,l.* FROM product p INNER JOIN listing l ON p.productID=l.productID WHERE l.sellerName='".$seller."'";
      $del2="DELETE  FROM seller WHERE sellerName='".$seller."'";
      $del3="DELETE  FROM user WHERE emailAddress='".$email."'";
      $del4="DELETE  FROM usertoken WHERE emailAddress='".$email."'";
        if(mysqli_query($con,$del) && mysqli_query($con,$del1) && mysqli_query($con,$del2) && mysqli_query($con,$del2) && mysqli_query($con,$del3) && mysqli_query($con,$del4)) {
          $msg="Account Deleted successfully";

        }else{
          $msg="Failure to Delete Account";
          $msg = "Failed to Delete account" .mysqli_error($con);

          }
    }else{
        $del5="DELETE  FROM user WHERE emailAddress='".$email."'";
        $del6="DELETE  FROM usertoken WHERE emailAddress='".$email."'";
        if(mysqli_query($con,$del5) && mysqli_query($con,$del6)){
           $msg="Account Deleted successfully";

        }else{
          $msg = "Failed to Delete account" .mysqli_error($con);


        }
      }

      mysqli_close($con);
    }
    echo $msg;


