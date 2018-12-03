<?php


$page = $_SERVER['PHP_SELF'];
require_once('config.php');

//setup the sql fann_get_total_connections
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ( mysqli_connect_errno() ) {
  die( mysqli_connect_error() );
}
//"select * from artworks NATURAL JOIN where ArtWorkID=". $_GET['id'];
$sql = "select * from artists NATURAL JOIN artworks where ArtistID= artworks.ArtistID AND ArtWorkID=". $_GET['id'];
// $sql .= "select * from artworks INNER JOIN artworkgenres ON artworkgenre.ArtWorkID=artworks.ArtWorkID INNER JOIN genres ON genres.GenreID=artworkgenres.GenreID and artworks.ArtWorkID=". $_GET['id'];
//
//
// if (mysqli_multi_query($connection, $sql)) {
//   do {
//     /* store first result set */
//     if ($result = mysqli_store_result($connection)) {
//       while ($row = mysqli_fetch_array($result))
//
//       /* print your results */
//       {
//         $Title = $row['Title'];
//         $Description = $row['Description'];
//         $Price = $row['MSRP'];
//         $Date = $row['YearOfWork'];
//         $Medium = $row['Medium'];
//         $Home = $row['OriginalHome'];
//         $height = $row['Height'];
//         $width = $row['Width'];
//         $ImageFile= $row['ImageFileName'];
//
//         if($height==null && $width!=null){
//           $dimensions = $width.' X ?';
//         }elseif ($width==null && $height!=null) {
//           $dimensions = '? X '.$height;
//         }elseif ($width==null && $height==null) {
//           $dimensions= '? X ?';
//         }else {
//           $dimensions = $width.' X '.$height;
//         }
//
//         $FirstName = $row['FirstName'];
//         $LastName = $row['LastName'];
//         if($FirstName==null){
//           $fullName = $LastName;
//         }else{
//           $fullName = $FirstName .' '. $LastName;
//         }
//         $fullName;
//         $ArtistID = $row['ArtistID'];
//         $GenreName = $row['GenreName'];
//       }
//       mysqli_free_result($result);
//     }
//   } while (mysqli_next_result($connection));
// }




if ($result = mysqli_query($connection, $sql)) {
  // loop through the data
  while($row = mysqli_fetch_assoc($result))
  {
    $Title = $row['Title'];
    $Description = $row['Description'];
    $Price = $row['MSRP'];
    $Date = $row['YearOfWork'];
    $Medium = $row['Medium'];
    $Home = $row['OriginalHome'];
    $height = $row['Height'];
    $width = $row['Width'];
    $ImageFile= $row['ImageFileName'];

    if($height==null && $width!=null){
      $dimensions = $width.' X ?';
    }elseif ($width==null && $height!=null) {
      $dimensions = '? X '.$height;
    }elseif ($width==null && $height==null) {
      $dimensions= '? X ?';
    }else {
      $dimensions = $width.' X '.$height;
    }

    $FirstName = $row['FirstName'];
    $LastName = $row['LastName'];
    if($FirstName==null){
      $fullName = $LastName;
    }else{
      $fullName = $FirstName .' '. $LastName;
    }
    $fullName;
    $ArtistID = $row['ArtistID'];
  }
  // release the memory used by the result set
  mysqli_free_result($result);

}


// if ($result = mysqli_query($connection, $sql1)) {
//   while($row = mysqli_fetch_assoc($result))
//   {
//     global $GenreName;
//     $GenreName = $row['GenreName'];
//   }
// }


mysqli_close($connection);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 3</title>

  <!-- Bootstrap core CSS  -->
  <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">

</head>

<body>

  <?php include 'includes/art-header.inc.php'; ?>

  <div class="container">
    <div class="row">

      <div class="col-md-10">
        <h2><?php echo $Title; ?></h2>
        <p>By <a href="display-artist.php?id=<?php echo $ArtistID; ?>"><?php echo $fullName; ?></a></p>
        <div class="row">
          <div class="col-md-5">
            <img src=<?php echo 'images/art/works/medium/'.$ImageFile.'.jpg' ?> class="img-thumbnail img-responsive" alt="title here"/>
          </div>
          <div class="col-md-7">
            <p>
              <?php echo $Description ?>
            </p>
            <p class="price"><?php echo $Price; ?></p>
            <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-default">
                <a href="#"><span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>
              </button>
              <button type="button" class="btn btn-default">
                <a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
              </button>
            </div>
            <p>&nbsp;</p>
            <div class="panel panel-default">
              <div class="panel-heading"><h4>Product Details</h4></div>
              <table class="table">
                <tr>
                  <th>Date:</th>
                  <td><?php echo $Date ?></td>
                </tr>
                <tr>
                  <th>Medium:</th>
                  <td><?php echo $Medium ?></td>
                </tr>
                <tr>
                  <th>Dimensions:</th>
                  <td><?php echo $dimensions ?></td>
                </tr>
                <tr>
                  <th>Home:</th>
                  <td>
                    <?php echo '<a href="#">'.$Home.'</a>'; ?>
                  </td>
                </tr>
                <tr>
                  <th>Genres:</th>

                  <td><?php echo $GenreName; ?></td>
                </tr>
                <tr>
                  <th>Subjects:</th>
                  <td>

                  </td>
                </tr>
              </table>
            </div>

          </div>  <!-- end col-md-7 -->
        </div>  <!-- end row (product info) -->


        <?php include 'includes/art-artist-works.inc.php'; ?>

      </div>  <!-- end col-md-10 (main content) -->

      <div class="col-md-2">
        <?php include 'includes/art-shopping-cart.inc.php'; ?>

        <?php include 'includes/art-right-nav.inc.php'; ?>
      </div> <!-- end col-md-2 (right navigation) -->
    </div>  <!-- end main row -->
  </div>  <!-- end container -->

  <?php include 'includes/art-footer.inc.php'; ?>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
  <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
