<?php


include "config.php";
include "checkToken.php";


if (isset($_POST['productID'])) {

  $productID = $_POST['productID'];
  $_SESSION['productID'] = $productID;
  // temp search algorithm for increment 2

  $sql = "select productName, p.productID, price, stock, description, manufacturer, imageLink, l.sellerName, s.userEmail
          from listing l 
          join product p on l.productID = p.productID 
          join seller s on l.sellerName = s.sellerName 
          where p.productID = '{$productID}'";

  $result = mysqli_query($con, $sql);


  if ($row = mysqli_fetch_array($result)) {
    if ($row['userEmail'] == $_SESSION['email']) {
      echo "<div class=\"form-group text-left\">";
      echo "<label>Product Name:</label>";
      echo "<input class=\"form-control\" type=\"text\" name=\"productName\" id=\"pname\" value='{$row['productName']}'>";
      echo "</div>";

      echo "<div class=\"form-group text-left\">";
      echo "<label>Manufacturer:</label>";
      echo "<input class=\"form-control\" type=\"text\" name=\"manufacturer\" id=\"manu\" value='{$row['manufacturer']}'><br>";
      echo "</div>";

      echo "<div class=\"form-group text-left\">";
      echo "<label>Price (CAD):</label>";
      echo "<input class=\"form-control\" type=\"text\" name=\"price\" id=\"price\" value='{$row['price']}'><br>";
      echo "</div>";

      echo "<div class=\"form-group text-left\">";
      echo "<label>Link to Image:</label>";
      echo "<input class=\"form-control\" type=\"text\" name=\"imageLink\" id=\"image\" value='{$row['imageLink']}'><br>";
      echo "</div>";

      echo "<div class=\"form-group text-left\">";
      echo "<label>Stock:</label>";
      echo "<input class=\"form-control\" type=\"text\" name=\"stock\" id=\"stock\" value='{$row['stock']}'><br>";
      echo "</div>";

      echo "<div class=\"form-group text-left\">";
      echo "<label>Description:</label>";
      echo "<textarea class=\"form-control\" rows=\"10\" name=\"description\" id=\"desc\">{$row['description']}</textarea><br>";
      echo "</div>";

      echo "<button class=\"btn\" id=\"EditListingButton\">Submit</button>";
    } else {
      echo "home.html";
    }
  }

}
/*
 *      <div class="form-group text-left">
        <label>Product Name:</label>
        <input class="form-control" type="text" name="productName" id="pname">
      </div>

      <div class="form-group text-left">
        <label>Manufacturer:</label>
        <input class="form-control" type="text" name="manufacturer" id="manu"><br>
      </div>

      <div class="form-group text-left">
        <label>Price (CAD):</label>
        <input class="form-control" type="text" name="price" id="price"><br>
      </div>

      <div class="form-group text-left">
        <label>Link to Image:</label>
        <input class="form-control" type="text" name="imageLink" id="image"><br>
      </div>

      <div class="form-group text-left">
        <label>Stock:</label>
        <input class="form-control" type="text" name="stock" id="stock"><br>
      </div>

      <div class="form-group text-left">
        <label>Description:</label>
        <textarea class="form-control" rows="10" name="description" id="desc"></textarea><br>
      </div>

      <button class="btn" id="EditListingButton">Submit</button>
 */
