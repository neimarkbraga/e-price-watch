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
                <h3>About us</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="container">
                        <p style="white-space: pre-line; width: 95%; margin: auto;">
                            <?php
                                $sql = 'SELECT * FROM about_us WHERE ID=1';
                                $result = mysqli_query( $con, $sql);
                                if($row = mysqli_fetch_array($result))
                                {
                                    echo $row['DESCRIPTION'];
                                }
                            ?>
                        </p>
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