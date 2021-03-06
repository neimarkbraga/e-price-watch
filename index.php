<!DOCTYPE html>
<?php
  session_start();
  include('library/connection.php');
  include('library/functionlibrary.php');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>E-Price Watch</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
  </head>
  <body role="document">
    <?php include('library/logregpas.php'); ?>
     <!-- Fixed navbar -->
    <?php include('library/navbar.php'); ?>
    <div class="home_panel">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" id="home_carousel-inner" role="listbox">
          <div class="item active home_slide_img" style="background-image: url('<?php echo getsliderimagelink(1) ?>');">
            <img src="<?php echo getsliderimagelink(1) ?>" alt="..." />
            <div class="carousel-caption">

            </div>
          </div>
          <div class="item home_slide_img" style="background-image: url('<?php echo getsliderimagelink(2) ?>');">
            <img src="<?php echo getsliderimagelink(2) ?>" alt="...">
            <div class="carousel-caption">

            </div>
          </div>
          <div class="item home_slide_img" style="background-image: url('<?php echo getsliderimagelink(3) ?>');">
            <img src="<?php echo getsliderimagelink(3) ?>" alt="...">
            <div class="carousel-caption">
              <!--<h3>...</h3>
              <p>...</p>-->
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="home_panel2">
      <div class="container">
        <div style="width: 100%; height: 30px;"></div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Categories</h3>
          </div>
            <div class="panel-body">
              <div class="row my_thumb_container">

                <?php
                    $sql = 'SELECT * FROM product_category';
                    $result = mysqli_query( $con, $sql);
                    
                    while ($row = mysqli_fetch_array($result)) {
                ?>

                <div class="col-xs-6 col-sm-4 col-md-3">
                  <a href="products.php?category=<?php echo $row['ID']; ?>" class="thumbnail">
                    <div class="my_thumb_img" style="background-image: url('<?php echo getcategorypic($row["ID"]);?> ');"></div>
                    <div class="caption">
                      <h3><?php echo $row["NAME"]; ?></h3>
                      <p><?php echo $row["DESCRIPTION"]; ?></p>
                    </div>
                  </a>
                </div>

                <?php
                }
                ?>

              </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('library/footer.php'); ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/1.11.3_jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/home.js"></script>

    <script src="js/logregpas.js"></script>
  </body>
</html>