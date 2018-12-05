<?php
session_start();

if (!ISSET($_GET['id'])) {
  // code...
  $_GET['id'] =99;
}
$page = $_SERVER['PHP_SELF'];
require_once('config.php');


//setup the sql fann_get_total_connections
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if ( mysqli_connect_errno() ) {
  die( mysqli_connect_error() );
}

$sql = "select * from artists where ArtistID=". $_GET['id'];
if ($result = mysqli_query($connection, $sql)) {
  // loop through the data
  while($row = mysqli_fetch_assoc($result))
  {
    $FirstName = $row['FirstName'];
    $LastName = $row['LastName'];
    if($FirstName==null){
      $fullName = $LastName;
    }else{
      $fullName = $FirstName .' '. $LastName;
    }
    $Nationality = $row['Nationality'];
    $YearOfBirth = $row['YearOfBirth'];
    $YearOfDeath = $row['YearOfDeath'];
    $Details = $row['Details'];
    $ArtistLink = $row['ArtistLink'];


  }
  // release the memory used by the result set
  mysqli_free_result($result);

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

      <div class="col-md-10">
        <h2><?php echo $fullName; ?></h2>
        <div class="row">
          <div class="col-md-5">
            <img src=<?php echo 'images/art/artists/medium/'.$_GET['id'].'.jpg' ?> class="img-thumbnail img-responsive" alt="" title=""/>

          </div>
          <div class="col-md-7">
            <p>
              <?php echo $Details; ?>
            </p>
            <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-default">
                <a href="#"><span class="glyphicon glyphicon-heart"></span> Add to Favorites List</a>
              </button>
            </div>
            <p>&nbsp;</p>
            <div class="panel panel-default">
              <div class="panel-heading"><h4>Artist Details</h4></div>
              <table class="table">
                <tr>
                  <th>Date:</th>
                  <td><?php echo $YearOfBirth.'-'.$YearOfDeath; ?></td>
                </tr>
                <tr>
                  <th>Nationality:</th>
                  <td><?php echo $Nationality ?></td>
                </tr>
                <tr>
                  <th>More Info:</th>
                  <td><?php echo $ArtistLink ?></td>
                </tr>
              </table>
            </div>

          </div>  <!-- end col-md-7 -->
        </div>  <!-- end row (product info) -->

        <p>&nbsp;</p>

        <?php include 'includes/art-artist-works.inc.php'; ?>


      </div>  <!-- end col-md-10 (main content) -->

      <div class="col-md-2">
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
