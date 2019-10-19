<?php

include "config.php";
include "checkToken.php";

if (isset($_POST['searchString'])) {

  $searchString = $_POST['searchString'];
  // temp search algorithm for increment 2

  $sql = "select productName, p.productID, price, stock, description, manufacturer, imageLink, sellerName
          from listing l join product p on l.productID = p.productID where
          p.productName like '%{$searchString}%' or 
          p.manufacturer like '%{$searchString}%' or 
          l.sellerName like '%{$searchString}%'";

  $result = mysqli_query($con, $sql);


  while($row = mysqli_fetch_array($result)){
    echo "<div class=\"row\" style=\"max-height:200px\">";
    echo "<div class=\"col-sm-3 text-center\">";
    echo "<img src=\"{$row['imageLink']}\" class=\"img-thumbnail\" style=\"max-height:200px\" alt=\"{$row['productName']}\">";
    echo "</div>";
    echo "<div class=\"col-sm-8\">";
    echo "<a href='/product.html?id={$row['productID']}'><h2 class=\"text-white\">";
    echo $row['productName'];
    echo "</h2></a>";
    echo "<h2 class=\"text-white-50\">";
    echo "$".$row['price'];
    echo "</h2>";
    echo "</div>";
    echo "</div>";
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
