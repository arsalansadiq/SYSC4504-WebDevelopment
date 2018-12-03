<?php

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ( mysqli_connect_errno() ) {
  die( mysqli_connect_error() );
}

$sql = "select * from artists NATURAL JOIN artworks where ArtistID=". $_GET['id'];

?>

<h3>Art by <?php echo $fullName;?> </h3>
<div class="row">

  <?php
  if ($result = mysqli_query($connection, $sql)) {
    // loop through the data
    while($row = mysqli_fetch_assoc($result))
    {
      $filename = $row['ImageFileName'];
      $ArtWorkID = $row['ArtWorkID'];

      // $FirstName = $row['FirstName'];
      // $LastName = $row['LastName'];
      // global $fullName;
      // if($FirstName==null){
      //   $fullName = $LastName;
      // }else{
      //   $fullName = $FirstName .' '. $LastName;
      // }
      echo '
      <div class="col-md-3">
         <div class="thumbnail">
            <img src="images/art/works/square-medium/'.$filename.'.jpg" title="" alt="" class="img-thumbnail img-responsive">
            <div class="caption">
               <a class="btn btn-primary btn-xs" href="display-art-work.php?id='.$ArtWorkID.'"><span class="glyphicon glyphicon-info-sign"></span> View</a>
               <button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish</button>
               <button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</button>
            </div>
         </div>
      </div>
  ';
    }
    // release the memory used by the result set
    mysqli_free_result($result);

  }
  mysqli_close($connection);
  ?>



</div>  <!-- end artist's works row -->
