<?php

include "config.php";
include "checkToken.php";

if (isset($_SESSION['email'])) {

  $email = $_SESSION['email'];

  $sql = "select productName, p.productID, price, stock, description, manufacturer, imageLink
          from customerorder o
          join product p on o.productID = p.productID 
          where buyerEmail = '{$email}'";

  $result = mysqli_query($con, $sql);

  if ($result)
  while ($row = mysqli_fetch_array($result)) {
    echo "<div class=\"row\" style=\"max-height:200px\">";
    echo "<div class=\"col-sm-3 text-center\">";
    echo "<img src=\"{$row['imageLink']}\" class=\"img-thumbnail\" style=\"max-height:200px\" alt=\"{$row['productName']}\">";
    echo "</div>";
    echo "<div class=\"col-sm-8\">";
    echo "<a href='/product.html?id={$row['productID']}'><h2 class=\"text-white\">";
    echo $row['productName'];
    echo "</h2></a>";
    echo "<h2 class=\"text-white-50\">";
    echo "$" . $row['price'];
    echo "</h2>";
    echo "</div>";
    echo "</div>";
    echo "<br>";
  }
}
