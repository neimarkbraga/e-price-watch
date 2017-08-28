<!DOCTYPE html>
<?php
  session_start();
  include('library/connection.php');
  include('library/functionlibrary.php');



$product_id = 0;
$page_product_name = '';
$page_product_price = 0;
$page_product_srp = 0;
$page_product_category = '';
$page_product_description = '';
$page_store_name = '';
$page_store_address = '';
$indicator = '';
$product_lat = 0;
$product_lng = 0;

if(isset($_GET['PRODUCT']))
{
    if((int)$_GET['PRODUCT'] > 0)
    {
        $product_id = $_GET['PRODUCT'];
        $sql = 'SELECT * FROM encoded_products WHERE ID =' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $product_id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        $result = mysqli_query( $con, $sql);
        $total_posts = mysqli_num_rows($result);
        if($total_posts > 0)
        {
            $clause = 'AND encoded_products.ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $product_id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
            $sql = 'SELECT encoded_products.ID, encoded_products.LAT, encoded_products.LNG, product_table.NAME, product_table.ID AS PRODUCTORIGINALID, encoded_products.ADDRESS, encoded_products.STORENAME, product_table.DESCRIPTION, product_category.NAME AS CATEGORY, encoded_products.PRICE, product_table.SRP FROM encoded_products, product_table, product_category WHERE product_table.ID = encoded_products.PRODUCT AND product_category.ID = product_table.CATEGORY ' . $clause . ' GROUP BY encoded_products.ID ORDER BY encoded_products.DATECREATED DESC';
            $result = mysqli_query( $con, $sql);
            if ($row = mysqli_fetch_array($result)) {
                $page_product_name = $row['NAME'];
                $page_product_price = $row['PRICE'];
                $page_product_srp = $row['SRP'];
                $page_product_category = $row['CATEGORY'];
                $page_product_description = $row['DESCRIPTION'];
                $page_store_name = $row['STORENAME'];
                $page_store_address = $row['ADDRESS'];
                $product_lat = $row['LAT'];
                $product_lng = $row['LNG'];
                $indicator = getpricestatus($row['PRODUCTORIGINALID'], $row['PRICE']);

                if($indicator == 'over')
                {
                    $indicator = '<span class="label label-danger">Overprice</span>';
                }
                else if($indicator == 'average')
                {
                    $indicator = '<span class="label label-success">Average Price</span>';
                }
                else if($indicator == 'under')
                {
                    $indicator = '<span class="label label-info">Underprice</span>';
                }
            }
        }
        else
        {
            header('Location: products.php');
        }
    }
    else
    {
        header('Location: products.php');
    }
}
else
{
    header('Location: products.php');
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
            <h3>Product Profile</h3>
        </div>
        <div class="panel-body">
            <div class="row" style="padding-top: 20px;">
                <div class="container-fluid">
                    <div>
                        <div class="form-control" style="width: 100%; height:300px;">
                            <div id="map" style="width: 100%; height: 100%;"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1"></div>
                            <div class="col-xs-3 col-sm-3 col-lg-2 col-md-2">
                                <div class="thumbnail" style="margin-top: -50%;">
                                    <img src="img/site%20images/box.jpg" style="max-width: 100%;" />
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <h3><span style="color: gray;">Product Name:</span> <?php echo $page_product_name; ?></h3>
                                <h4><span style="color: gray;">Price:</span> <?php echo $page_product_price; ?> PHP <?php echo $indicator; ?></h4>
                                <h5><span style="color: gray;">Suggested Retail Price (SRP):</span> <?php echo $page_product_srp; ?> PHP</h5>
                                <h5><span style="color: gray;">Product Category:</span> <?php echo $page_product_category; ?></h5>
                                <h5><span style="color: gray;">Seller (Store):</span> </small><a href="<?php echo 'viewstore.php?STORE=' . $page_store_name . '&ADDRESS=' . $page_store_address;?>"><?php echo $page_store_name; ?></a></h5>
                                <h5><span style="color: gray;">Address:</span> <a href="#" onclick="map.setCenter(storemarker.getPosition()); return false;"><?php echo $page_store_address; ?></a></h5>
                                <p><span style="color: gray;">Product Description:</span> <?php echo $page_product_description; ?></p>
                            </div>

                            <div class="container-fluid">
                                  <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Price History</h4>  
                                    </div>
                                  </div><!--/row-->
                                  <hr>
                            </div>

                            <iframe src="library/productlinegraph.php?id=<?php echo $product_id; ?>" style="width:100%; height: 100%;" frameborder="0" onload="resizeIframe(this)"></iframe>
                        </div>
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
<script>
    var map;
    var storemarker;
    function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?php echo $product_lat; ?>, lng: <?php echo $product_lng; ?>},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        storemarker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            title: 'Location of the product'
        });
    }

    window.onresize = function() {
        google.maps.event.trigger(map, "resize");
        map.setCenter(storemarker.getPosition());
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete" async defer></script>
<script language="javascript" type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
</body>
</html>