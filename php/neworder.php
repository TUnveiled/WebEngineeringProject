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

    $sql = "select sellerName, price, stock
          from listing l join product p on l.productID = p.productID where
          p.productID = '{$productID}'";

    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_array($result)){
      $stock = $row['stock'] - 1;
      $totalPrice = $row['price'];
      $sellerName = $row['sellerName'];

      $sql = "insert into customerorder (buyerEmail, sellerName, productID, totalPrice, custAddress) values
            ('{$buyerEmail}', '{$sellerName}', '{$productID}', '{$totalPrice}', '{$address}')";

      if ($stock < 1) {
        echo "out of stock";
      } else if (mysqli_query($con, $sql)) {
        $sql = "UPDATE product SET stock = stock - 1 WHERE productID = '{$productID}'";
        mysqli_query($con, $sql);
      } else
        echo "failed to place order";

    } else {
      echo "product not found";
    }

  } else {
    echo "you need to log in to make a purchase";
  }
}
