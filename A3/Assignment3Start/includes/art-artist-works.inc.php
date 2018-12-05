<?php

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ( mysqli_connect_errno() ) {
  die( mysqli_connect_error() );
}

$sql = "select * from artists NATURAL JOIN artworks where ArtistID=".$_GET['id'];//sql query

?>
<!-- this full name is shown from the previous page and is updated here -->
<h3>Art by <?php echo $fullName;?> </h3>
<div class="row">

  <?php
  if ($result = mysqli_query($connection, $sql)) {
    // loop through the data
    while($row = mysqli_fetch_assoc($result))
    {//for each row available in the table related to the pictures for the artwork by a certain artist print it below
      ?>
      <div class="col-md-3">
        <div class="thumbnail">
          <img src="images/art/works/square-medium/<?php echo $row['ImageFileName']?>.jpg" title="" alt="" class="img-thumbnail img-responsive">
          <div class="caption">
            <a class="btn btn-primary btn-xs" href=<?php echo "display-art-work.php?id=".$_GET['id']."&artID=".$row['ArtWorkID']?>><span class="glyphicon glyphicon-info-sign"></span> View</a>
            <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish</button>
            <button type="button" class="btn btn-info btn-xs" onClick="window.location.href='<?php echo "display-cart.php?artID=".$row['ArtWorkID']." "; ?>';"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</button>
            <!-- buttons for view and cart direct to the view and cart for each specific artwork and its IDs associated with it and depending on the functionality shows the artwork on the page or add the item into the cart -->
          </div>
        </div>
      </div>

      <?php
    }
    mysqli_free_result($result);

  }
  mysqli_close($connection);
  ?>

</div>  <!-- end artist's works row -->
