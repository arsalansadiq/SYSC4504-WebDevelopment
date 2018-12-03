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

function outputCartRow($file, $product, $quantity, $price) {

  echo '<td><img class="img-thumbnail" src="images/art/tiny/' . $file.'"' . 'alt="..."></td>';
  echo '<td>'.$product."</td>";
  echo "<td>".$quantity."</td>";
  echo "<td>".$price."</td>";
  echo "<td>".($quantity*$price)."</td>";
  global $subtotal;
  $subtotal += ($quantity*$price);
  global $grandtotal;
  global $tax;
  $grandtotal = $subtotal + ($subtotal*$tax);
}
?> -->


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
         <tr>

           <!-- <?php outputCartRow($file1, $product1, $quantity1, $price1); ?> -->

         </tr>
         <tr>

           <!-- <?php outputCartRow($file2, $product2, $quantity2, $price2); ?> -->


         </tr>
         <tr class="success strong">
           <?php
          echo '<td colspan="4" class="moveRight">Subtotal</td>';
          echo '<td >'.$subtotal.'</td>';
            ?>
         </tr>
         <tr class="active strong">
           <?php
           echo '<td colspan="4" class="moveRight">Tax</td>';
           echo '<td>'.$subtotal*$tax.'</td>';
            ?>
         </tr>
         <tr class="strong">
           <?php
           $shipping = 0;
           if($subtotal>2000){
             $shipping=100;
           }
           echo '<td colspan="4" class="moveRight">Shipping</td>';
           echo '<td>'.$shipping.'</td>'; ?>

         </tr>
         <tr class="warning strong text-danger">
           <?php
           echo '<td colspan="4" class="moveRight">Grand Total</td>';
           echo '<td>'.number_format($grandtotal,2).'</td>';
            ?>
         </tr>
         <tr >
            <td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
            <td><button type="button" class="btn btn-success" >Checkout</button></td>
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
