<?php

include "config.php";
include "checkToken.php";

if (isset($_POST['UserName']) && isset($_SESSION['admin'])) {

  $UserName = $_POST['UserName'];
  // temp search algorithm for increment 2

  $sql = "select emailAddress, passwordHash, administrator
          from user u where
          u.emailAddress like '%{$UserName}%' and u.emailAddress!='{$_SESSION['email']}' ";


  $result = mysqli_query($con, $sql);


  while($row = mysqli_fetch_array($result)){

    echo "<a href='/AccountInfo.html?acc={$row['emailAddress']}'><h2 class=\"text-white\">";
    echo $row['emailAddress'];
    echo "</h2>";
    echo "<br>";
  }

}
/*
 * <div class="row" style="max-height:200px">
        <div class="col-sm-3 text-center">
          <img src="https://images-na.ssl-images-amazon.com/images/I/61q45h8wMfL._SL1500_.jpg" class="img-thumbnail" style="max-height:200px" alt="BESTEK 8-Outlet Surge Protector Power Strip with 4 USB Charging Ports">
        </div>
        <div class="col-sm-8">
          <h2 class="text-white">
            BESTEK 8-Outlet Surge Protector Power Strip with 4 USB Charging Ports
          </h2>
          <h2 class="text-white-50">
            $32.99
          </h2>
        </div>
      </div>
      <br>
 */
