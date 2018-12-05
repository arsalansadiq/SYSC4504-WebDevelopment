
<?php

function artworkDetail(){
  foreach ($_SESSION['cart'] as $value) {//use the session cart array from the display-cart.php
    // code...

    require_once('config.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if ( mysqli_connect_errno() ) {
      die( mysqli_connect_error() );
    }

    $sql = "select * from artworks where ArtWorkID=". $value['artID'];//sql query
    if ($result = mysqli_query($connection, $sql)) {
      // loop through the data
      while($row = mysqli_fetch_assoc($result))
      {

        $ImageFile = $row['ImageFileName'];
        $Title= $row['Title'];
        $Price = $row['MSRP'];

        outputCartRow($ImageFile, $Title, $value['quantity'], $Price);//out the tiny image of all the artwork in the cart currently
      }
      // release the memory used by the result set
      mysqli_free_result($result);

    }


    mysqli_close($connection);
  }
}
$subtotal=0;
function outputCartRow($file, $product, $quantity, $price) {//the printing of the tiny box of the top right of artworks page

  ?>
  <div class="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="images/art/works/square-thumbs/<?php echo $file; ?>.jpg" alt="..." width="32">
    </a>
    <div class="media-body">
      <p class="cartText"><a href="display-art-work.php?id=443"><?php echo $product; ?></a></p>
    </div>
  </div>
  <?php
  global $subtotal;
  $subtotal += ($quantity*$price);//calculating the subtotal dynamically

}


?>




<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Cart </h3>
  </div>
  <div class="panel-body">
    <?php artworkDetail(); ?>
    <!-- diplaying the image and title here -->
    <strong class="cartText">Subtotal: <span class="text-warning"><?php echo number_format($subtotal,2); ?></span></strong>
    <!-- subtotal which is a global variable is being used here to update the value of the pictures -->
    <div>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
    </div>
  </div>
</div>
