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
            <h3>Contact</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table">
                    <?php
                        $sql = 'SELECT * FROM contact_us WHERE ID=1';
                        $result = mysqli_query( $con, $sql);
                        if($row = mysqli_fetch_array($result))
                        {
                            ?>
                            <tr>
                                <td><b>Email </b></td>
                                <td><?php echo $row['EMAIL']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Address </b></td>
                                <td><?php echo $row['ADDRESS']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Contact Number </b></td>
                                <td><?php echo $row['CONTACT']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Facebook </b></td>
                                <td><a href="http://www.facebook.com/<?php echo $row['FACEBOOK']; ?>"><?php echo $row['FACEBOOK']; ?></a></td>
                            </tr>
                            <tr>
                                <td><b>Instagram </b></td>
                                <td><a href="http://www.instagram.com/<?php echo $row['INSTAGRAM']; ?>"><?php echo $row['INSTAGRAM']; ?></a></td>
                            </tr>
                            <tr>
                                <td><b>Twitter </b></td>
                                <td><a href="http://www.twitter.com/<?php echo $row['TWITTER']; ?>"><?php echo $row['TWITTER']; ?></a></td>
                            </tr>
                            <?php
                                }
                            ?>
                </table>
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