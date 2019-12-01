<?php

include "config.php";
include "checkToken.php";

if (isset($_POST['address'])) {
  if (isset($_SESSION['email'])) {
    $address = $_POST['address'];
    $address .= " " . $_POST['city'];
    $address .= ", " . $_POST['state'];
    $address .= ". " . $_POST['pcode'];
    $address .= ". " . $_POST['country'];
    $buyerEmail = $_SESSION['email'];
    $productID = $_POST['pid'];

    $servername = "localhost";
    $username = "root";
    $password = "newpassword";

    // Create connection
    $conn = new mysqli($servername, $username, $password, "ecommerce");

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select sellerName, price, stock
          from listing l join product p on l.productID = p.productID where
          p.productID = '{$productID}'";

    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)){
      $stock = $row['stock'] - 1;
      $totalPrice = $row['price'];
      $sellerName = $row['sellerName'];

      $sql = "insert into customerOrder (buyerEmail, sellerName, productID, totalPrice, sourceAddress,custAddress) values
            ('{$buyerEmail}', '{$sellerName}', '{$productID}', '{$totalPrice}','{$address}' ,'{$address}')";
      if ($stock < 1) {
        echo "out of stock";
      } else if (mysqli_query($conn, $sql)) {
        $sql = "UPDATE product SET stock = stock - 1 WHERE productID = '{$productID}'";
        mysqli_query($conn, $sql);
      } else
        echo $buyerEmail;

    } else {
      echo "product not found";
    }

  } else {
    echo "you need to log in to make a purchase";
  }
}
