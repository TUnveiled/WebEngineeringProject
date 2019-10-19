<?php

include "config.php";
include "checkToken.php";  // Check user token

//
if (isset($_POST['price'])) {
  $productName = $_POST['productName'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $description = $_POST['description'];
  $manufacturer = $_POST['manufacturer'];
  $imageLink = $_POST['imageLink'];

  $sql = "insert into product (productName, price, stock, description, manufacturer, imageLink) values ('{$productName}', '{$price}','{$stock}','{$description}','{$manufacturer}','{$imageLink}')";

  if (mysqli_query($con, $sql)) {
    $sql = "select sellerName from seller where userEmail = '{$_SESSION['email']}'";

    $result = mysqli_query($con, $sql);

    if ($result) {

      $row = mysqli_fetch_array($result);

      $sellerName = $row['sellerName'];

      $sql = "select max(productID) as maxProductID from product where productName = '{$productName}' and ";
      $sql = $sql."price = '{$price}' and stock = '{$stock}' and description = '{$description}'";
      $sql = $sql." and manufacturer = '{$manufacturer}' and imageLink = '{$imageLink}'";

      $result = mysqli_query($con, $sql);

      $productID = mysqli_fetch_array($result)['maxProductID'];

      $sql = "insert into listing (sellerName, productID) values ('{$sellerName}', '{$productID}')";

      if (mysqli_query($con, $sql)) {
        echo "2 - Listing successfully created!";
      } else {
        echo "3 - Fatal error, contact customer support!";
      }

    } else {
      # there shouldnt be a way for this to run
      echo "4 - You're not a seller!";
    }

  } else {
    echo "5 - Listing is invalid!";
  }

} else {
  echo "6";
}
