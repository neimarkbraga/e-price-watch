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


<div class="container">
    <div style="width: 100%; height: 80px;"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Stores</h3>
        </div>
        <div class="panel-body">
            <?php

                $line1 = "";
                $searchkeyword = '';
                if(isset($_GET['SEARCH']))
                {
                    $searchkeyword = $_GET['SEARCH'];
                    $line1 = 'WHERE STORENAME LIKE "%' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $searchkeyword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '%" OR ADDRESS LIKE "%' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $searchkeyword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '%"';
                }
                $sql = 'SELECT CONCAT(STORENAME, ADDRESS) AS GR, STORENAME, ADDRESS FROM encoded_products ' . $line1 . ' GROUP BY GR ORDER BY DATECREATED DESC';
                $result = mysqli_query( $con, $sql); 
                $total = mysqli_num_rows($result);
            ?>
            <form method="get">
                <div class="input-group">
                    <input type="text" name="SEARCH" value="<?php echo $searchkeyword; ?>" id="searchinput" class="form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="Search" />
                      </span>
                </div><!-- /input-group -->
            </form>
            <?php
                if($total < 1)
            {
            ?>
                <br />
                <div class="alert alert-info" role="alert">There are no results. <a href="stores.php">Click here to go to Stores</a></div>
            <?php } ?>
            <div class="row" style="padding-top: 20px;">
                <div class="container-fluid">
                    <div class="row my_thumb_container">

                        <?php 
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <a href="<?php echo 'viewstore.php?STORE=' . $row['STORENAME'] . '&ADDRESS=' . $row['ADDRESS'];?>" class="thumbnail">
                                <div class="my_thumb_img" style="background-image: url('img/site images/store.jpg ');"></div>
                                <div class="caption">
                                    <h3><?php echo $row['STORENAME']; ?></h3>
                                    <p><?php echo $row['ADDRESS']; ?></p>
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