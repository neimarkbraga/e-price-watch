<!DOCTYPE html>
<?php
  session_start();
  include('library/connection.php');
  include('library/functionlibrary.php');

$page_store_name = '';
$page_store_address = '';

if(isset($_GET['STORE']) && isset($_GET['ADDRESS']))
{
    $page_store_name = $_GET['STORE'];
    $page_store_address = $_GET['ADDRESS'];
    $sql = 'SELECT * FROM encoded_products WHERE STORENAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_name) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_address) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
    $result = mysqli_query( $con, $sql);
    $total_posts = mysqli_num_rows($result);
    if($total_posts < 1)
    {
        header('Location: stores.php');       
    }
}
else
{
    header('Location: stores.php');
}
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
            <h3>Store Profile</h3>
        </div>
        <div class="panel-body">
            <div class="row" style="padding-top: 20px;">
                <div class="container-fluid">
                    <div class="form-control" style="width: 100%; height:300px;">
                        <div id="map" style="width: 100%; height: 100%;"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1"></div>
                        <div class="col-xs-3 col-sm-3 col-lg-2 col-md-2">
                            <div class="thumbnail" style="margin-top: -50%;">
                                <img src="img/site%20images/store.jpg" style="max-width: 100%;" />
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <h4>Store Name: <?php echo $page_store_name; ?></h4>
                            <h5>Address: <a href="#" onclick="map.setCenter(storemarker.getPosition()); return false;"><?php echo $page_store_address; ?></a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <h3 style="text-align: center; padding-bottom: 20px;">Products</h3>
            <div class="row my_thumb_container">
                <?php
                    $argument = 'AND encoded_products.STORENAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_name) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND encoded_products.ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_address) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) .'"';
                    $sql = 'SELECT encoded_products.ID, product_table.NAME, product_table.ID AS PRODUCTORIGINALID, encoded_products.ADDRESS, encoded_products.STORENAME, product_table.DESCRIPTION, product_category.NAME AS CATEGORY, encoded_products.PRICE, product_table.SRP FROM encoded_products, product_table, product_category WHERE product_table.ID = encoded_products.PRODUCT AND product_category.ID = product_table.CATEGORY ' . $argument . ' GROUP BY encoded_products.ID ORDER BY encoded_products.DATECREATED DESC';
                    $result = mysqli_query( $con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    $indicator = getpricestatus($row['PRODUCTORIGINALID'], $row['PRICE']);
                    if($indicator == 'over')
                    {
                        $indicator = '<span class="label label-danger pull-right">Overprice</span>';
                    }
                    else if($indicator == 'average')
                    {
                        $indicator = '<span class="label label-success pull-right">Average Price</span>';
                    }
                    else if($indicator == 'under')
                    {
                        $indicator = '<span class="label label-info pull-right">Underprice</span>';
                    }
                ?>
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <a href="<?php echo 'viewproduct.php?PRODUCT=' . $row['ID']; ?>" class="thumbnail">
                        <div class="caption">
                            <?php echo $indicator; ?>
                            <h4><?php echo $row['PRICE'] . ' PHP';?></h4>
                        </div>
                        <div class="my_thumb_img" style="background-image: url('img/site images/box.jpg');"></div>
                        <div class="caption">
                            <h3><?php echo $row['NAME']; ?></h3>
                            <h4><?php echo $row['STORENAME']; ?></h4>
                            <p><?php echo $row['CATEGORY']; ?></p>
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

<?php include('library/footer.php'); ?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/1.11.3_jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/home.js"></script>
<script src="js/logregpas.js"></script>
<script>
    var map;
    var storemarker;
    var geocoder = {};

    function codeAddress(address) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);

            storemarker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title: 'Location of the store'
            });
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      }

      function pinstores()
      {
        <?php
            $sql = 'SELECT * FROM encoded_products WHERE STORENAME = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_name) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '" AND ADDRESS = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $page_store_address) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
            $result = mysqli_query( $con, $sql);
            $total_posts = mysqli_num_rows($result);
            $i = 0;

            while ($row = mysqli_fetch_array($result)) {
                echo '
                ';
                echo 'storemarker = new google.maps.Marker({position: {lat: ' . $row["LAT"] . ', lng: ' . $row['LNG'] . '}, map: map, title: \'Location of the store\'});';
                $i++;
            }
        ?>
        map.setCenter(storemarker.getPosition());
      }

    function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 10.7149629, lng: 122.5476471},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        pinstores();
        //codeAddress("<?php echo $page_store_address; ?>");
    }

    window.onresize = function() {
        google.maps.event.trigger(map, "resize");
        map.setCenter(storemarker.getPosition());
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>