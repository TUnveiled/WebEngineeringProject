<?php

include "config.php";
include "checkToken.php";


if (isset($_POST['productID'])) {

  $productID = $_POST['productID'];
  // temp search algorithm for increment 2

  $sql = "select productName, p.productID, price, stock, description, manufacturer, imageLink, sellerName
          from listing l join product p on l.productID = p.productID where
          p.productID = '{$productID}'";

  $result = mysqli_query($con, $sql);


  if ($row = mysqli_fetch_array($result)){
    echo "<div class=\"row text-white\">";
    echo "<div class=\"col-sm-3 text-center\">";
    echo "<img src=\"{$row['imageLink']}\" class=\"img-thumbnail\" style=\"max-height:200px\" alt=\"{$row['productName']}\">";
    echo "</div>";
    echo "<div class=\"col-sm-8\">";
    echo "<h2>";
    echo $row['productName'];
    echo "</h2>";
    echo "<h2 class=\"text-white-50\" id='price'>";
    echo "$".$row['price'];
    echo "</h2>";
    echo "<h6>";
    echo $row['manufacturer'];
    echo "</h6>";
    echo "<p>Left in stock: {$row['stock']}</p>";
    echo "<p>{$row['description']}</p>";
    echo "<input type='button' class='btn btn-success' value='Buy Now' id='purchase'>";
    echo "</div>";
    echo "</div>";
    echo "<br>";
  }

}
