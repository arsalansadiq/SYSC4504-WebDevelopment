<?php
session_start();

if (!ISSET($_GET['id']) and !ISSET($_GET['artID'])) {
  // code...
  $_GET['id'] =106;
  $_GET['artID']=424;
//check if the ID is being GET on the page and artID, and both are if not being set then send them., this is done to avoid
//inital page laoding errors.
}
$page = $_SERVER['PHP_SELF'];
require_once('config.php');//require the password

//setup the sql fann_get_total_connections
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ( mysqli_connect_errno() ) {
  die( mysqli_connect_error() );
}

$sql = "select * from artists NATURAL JOIN artworks where ArtWorkID='". $_GET['artID']."'";//query to get the items

if ($result = mysqli_query($connection, $sql)) {
  // loop through the data
  while($row = mysqli_fetch_assoc($result))
  {
    //grabbing the relevent data values needed to fill the information on the page
    $Title = $row['Title'];
    $Description = $row['Description'];
    $Price = $row['MSRP'];
    $Date = $row['YearOfWork'];
    $Medium = $row['Medium'];
    $Home = $row['OriginalHome'];
    $height = $row['Height'];
    $width = $row['Width'];
    $ImageFile= $row['ImageFileName'];
    $ArtworkID = $_GET['artID'];//need to use that to go to next page

    //height and width values are null in the table so a functionality not to include the null characters
    if($height==null && $width!=null){
      $dimensions = $width.' cm X ?';
    }elseif ($width==null && $height!=null) {
      $dimensions = '? X '.$height.' cm';
    }elseif ($width==null && $height==null) {
      $dimensions= '? X ?';
    }else {
      $dimensions = $width.' cm X '.$height.' cm';
    }
//First and Last Name values are null in the table so a functionality not to include the null characters
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
//another Sql query to include the additional tables for genre
$sql1 = "select * from genres NATURAL JOIN artworkgenres where ArtWorkID='". $_GET['artID']."'";
if ($result1 = mysqli_query($connection, $sql1)) {
  while($row1 = mysqli_fetch_assoc($result1))
  {

    $GenreName = $row1['GenreName'];
    $GenreLink = $row1['Link'];
  }
  mysqli_free_result($result1);
}
//another Sql query to include the additional tables for subject
$sql2 = "select * from subjects NATURAL JOIN artworksubjects where ArtWorkID='". $_GET['artID']."'";
if ($result2 = mysqli_query($connection, $sql2)) {
  while($row2 = mysqli_fetch_assoc($result2))
  {

    $SubjectName = $row2['SubjectName'];
  }
  mysqli_free_result($result2);
}


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
<!-- //included the the variables created above to display information -->
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
            <p class="price">$<?php echo number_format($Price,2); ?></p>
            <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-default">
                <a href="#"><span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>
              </button>
              <button type="button" class="btn btn-default" onClick="window.location.href='<?php echo "display-cart.php?artID=".$ArtworkID." "; ?>';">
                <a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
              </button>
            </div>
            <p>&nbsp;</p>
            <div class="panel panel-default">
              <div class="panel-heading"><h4>Product Details</h4></div>
              <table class="table">
                <tr>
                  <!-- //included the the variables created above to display information -->
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
                    <a href="#"><?php echo $Home; ?></a>
                  </td>
                </tr>
                <tr>
                  <th>Genres:</th>

                  <td>
                    <a href="<?php echo $GenreLink; ?>"><?php echo $GenreName; ?></a>
                  </td>
                </tr>
                <tr>
                  <th>Subjects:</th>
                  <td>
                    <a href="#"><?php echo $SubjectName; ?></a>
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
