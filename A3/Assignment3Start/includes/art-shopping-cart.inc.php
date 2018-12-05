
<?php

function artworkDetail(){
  foreach ($_SESSION['cart'] as $value) {
    // code...

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

        outputCartRow($ImageFile, $Title, $value['Quantity'], $Price);
      }
      // release the memory used by the result set
      mysqli_free_result($result);

    }


    mysqli_close($connection);
  }
}
$subtotal=0;
function outputCartRow($file, $product, $quantity, $price) {

  // echo '<tr>';
  // echo '<td><img class="img-thumbnail" src="images/art/works/square-thumbs/' . $file.'.jpg"' . 'alt="..."></td>';
  // echo '<td>'.$product."</td>";
  // echo "<td>".$quantity."</td>";
  // echo "<td>$".number_format($price,2)."</td>";
  // echo "<td>$".($quantity*$price)."</td>";
  // echo '</tr>';

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
  $subtotal += ($quantity*$price);

}


?>




<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Cart </h3>
  </div>
  <div class="panel-body">
    <?php artworkDetail(); ?>
    <strong class="cartText">Subtotal: <span class="text-warning"><?php echo $subtotal; ?></span></strong>
    <div>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
    </div>
  </div>
</div>
