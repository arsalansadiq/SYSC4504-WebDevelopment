<?php
session_start();

if (!ISSET($_SESSION['cart'])) {
  // code...
  $_SESSION['cart']=array(); // Declaring session array
  //check if the cart is being set, and if are not being set then set it to a new empty array., this is done to avoid
  //inital page laoding errors.
}

if (ISSET($_GET['artID'])) {
  $artID = $_GET['artID'];
  if (!array_key_exists($artID,$_SESSION['cart'])) {

    $_SESSION['cart'][$artID] = array('artID' => $artID, 'quantity' => 1);
  }else {
      $_SESSION['cart'][$artID]['quantity']++;
  }
}

if (ISSET($_GET['action']) and !ISSET($_GET['artID'])) {
  //whenever the checkout button is clicked make a new session array
  $_SESSION['cart']=array(); // Declaring session array
}


function artworkDetail(){
  foreach ($_SESSION['cart'] as $value) {
    // loop through are the values of ID in the session array and for each of them run the sql query to display the cart row

    require_once('config.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if ( mysqli_connect_errno() ) {
      die( mysqli_connect_error() );
    }

    $sql = "select * from artworks where ArtWorkID=". $value['artID'];
    if ($result = mysqli_query($connection, $sql)) {
      // loop through the data
      while($row = mysqli_fetch_assoc($result))
      {

        $ImageFile = $row['ImageFileName'];
        $Title= $row['Title'];
        $Price = $row['MSRP'];

        outputCartRow($ImageFile, $Title, $value['quantity'], $Price);//output the cart row
      }
      // release the memory used by the result set
      mysqli_free_result($result);

    }


    mysqli_close($connection);
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chapter 8</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="display-cart.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="bootstrap3_defaultTheme/assets/js/html5shiv.js"></script>
  <script src="bootstrap3_defaultTheme/assets/js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <?php include 'includes/art-header.inc.php'; ?>

  <?php
  // include 'art-data.php';
  $subtotal=0;
  $tax = 0.1;
  $grandtotal=0;
  $shipping = 100;

  function outputCartRow($file, $product, $quantity, $price) {//prints out the row on the cart

    echo '<tr>';
    echo '<td><img class="img-thumbnail" src="images/art/works/square-thumbs/' . $file.'.jpg"' . 'alt="..."></td>';
    echo '<td>'.$product."</td>";
    echo "<td>".$quantity."</td>";
    echo "<td>$".number_format($price,2)."</td>";
    echo "<td>$".($quantity*$price)."</td>";
    echo '</tr>';
    global $subtotal;
    $subtotal += ($quantity*$price);
    global $grandtotal;
    global $shipping;
    global $tax;
    $grandtotal = $subtotal + ($subtotal*$tax)+ $shipping;//calculation from lab 3
  }
  ?>


  <div class="container">

    <div class="page-header">
      <h2>View Cart</h2>
    </div>

    <table class="table table-condensed">
      <tr>
        <th>Image</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
      </tr>

      <?php artworkDetail(); ?>


      <tr class="success strong">
        <?php
        echo '<td colspan="4" class="moveRight">Subtotal</td>';
        echo '<td >$'.number_format($subtotal,2).'</td>';
        ?>
      </tr>
      <tr class="active strong">
        <?php
        echo '<td colspan="4" class="moveRight">Tax</td>';
        echo '<td>$'.number_format($subtotal*$tax,2).'</td>';
        ?>
      </tr>
      <tr class="strong">
        <?php

        if($subtotal>2000){
          $shipping=0;
        }
        echo '<td colspan="4" class="moveRight">Shipping</td>';
        echo '<td>$'.number_format($shipping,2).'</td>'; ?>

      </tr>
      <tr class="warning strong text-danger">
        <?php
        echo '<td colspan="4" class="moveRight">Grand Total</td>';
        echo '<td>$'.number_format($grandtotal,2).'</td>';
        ?>
      </tr>
      <tr >
        <td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
        <td><button type="button" class="btn btn-success" onclick='window.location.href="display-cart.php?action=destroyCart"' >Checkout</button></td>
      </tr>
    </table>

  </div>  <!-- end container -->

  <?php include 'includes/art-footer.inc.php'; ?>



  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
  <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
</body>
</html>
