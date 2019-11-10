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
  $productID = $_SESSION['productID'];


  $sql ="UPDATE product 
        SET productName = '{$productName}',
        price = '{$price}',
        stock = '{$stock}',
        description = '{$description}',
        manufacturer= '{$manufacturer}',
        imageLink = '{$imageLink}'
        WHERE productID = '{$productID}'";


  if (mysqli_query($con, $sql)) {
    echo "1 - Success";
  } else {
    echo "2 - Listing is invalid!";
  }

} else {
  echo "3";
}
