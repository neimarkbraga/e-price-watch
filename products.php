<!DOCTYPE html>
<?php
  session_start();
  include('library/connection.php');
  include('library/functionlibrary.php');

$hascategory = false;
$hassearch = false;
$category_id;
$search_keyword = '';

if(isset($_GET['search']))
{
    $hassearch = true;
    $search_keyword = $_GET['search'];
}

  if(isset($_GET['category']))
  {
    try
    {
        if(categoryidexists($_GET['category']) || $_GET['category'] == "-99")
        {
            if($_GET['category'] != "-99")
            {
                $hascategory = true;
                $category_id = $_GET['category'];
            }
        }
        else
        {
            header('Location: products.php');
        } 
    } catch (Exception $e) {
      header('Location: products.php');
    }
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
            <h3>Products</h3>
        </div>
        <div class="panel-body">
            <form method="get">
                <div class="input-group">
              <span class="input-group-btn">
                <select onchange="changecategory(this.options[this.selectedIndex].text);" id="searchcategory" name="category" class="btn btn-default dropdown-toggle" style="height: 2.4em;">
                    <option value="-99">All</option>
                    <?php
                      $sql = 'SELECT * FROM product_category';
                      $result = mysqli_query( $con, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                      <option value="<?php echo $row['ID'] ?>" <?php if($hascategory){ if($row['ID'] == $category_id){echo 'selected="selected"';}} ?> ><?php echo $row['NAME'] ?></option>
                      <?php } ?>
                </select>
                </span>
                    <input type="text" name="search" value="<?php echo $search_keyword; ?>" id="searchinput" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Search" />
              </span>
                </div><!-- /input-group -->
            </form>
            <?php
                $argument = 'AND product_table.NAME LIKE "%' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $search_keyword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '%"';
                if($hascategory)
                {
                    $argument .= ' AND product_category.ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $category_id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
                }
                $sql = 'SELECT encoded_products.ID, product_table.NAME, product_table.ID AS PRODUCTORIGINALID, encoded_products.ADDRESS, encoded_products.STORENAME, product_table.DESCRIPTION, product_category.NAME AS CATEGORY, encoded_products.PRICE, product_table.SRP FROM encoded_products, product_table, product_category WHERE product_table.ID = encoded_products.PRODUCT AND product_category.ID = product_table.CATEGORY AND encoded_products.DISABLED = 0 ' . $argument . ' GROUP BY encoded_products.ID ORDER BY encoded_products.DATECREATED DESC';
                $result = mysqli_query($con,$sql);
                $total = mysqli_num_rows($result);
                if($total < 1)
                {
                ?>
                    <br />
                    <div class="alert alert-info" role="alert">There are no results. <a href="products.php">Click here to go to all categories and all products</a></div>
                <?php } ?>

            <div class="row" style="padding-top: 20px;">
                <div class="container-fluid">
                    <div class="row my_thumb_container container-fluid">
                        <?php
                            while ($row = mysqli_fetch_array($result)) {

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

                        ?>
                        <div class="media thumbnail">
                            <a href="<?php echo 'viewproduct.php?PRODUCT=' . $row['ID']; ?>" class="">
                                <div class="media-left">
                                    <div class="thumbnail" style="margin-top: 20%; margin-right: 10px; margin-left: 10px;">
                                        <div class="media-object my_thumb_img" style="background-image: url('<?php echo getproductpic($row['PRODUCTORIGINALID']); ?>'); position: relative; height: 100px; padding-right: 100px;"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading"><span style="color: gray;">Product Name:</span> <?php echo $row['NAME']; ?></h3>
                                    <h4><span style="color: gray;">Price:</span> <?php echo $row['PRICE'] . ' PHP';?> <small><?php echo $indicator; ?></small></h4>
                                    <p><span style="color: gray;">Seller (Store):</span> <?php echo $row['STORENAME']; ?></p>
                                    <p><span style="color: gray;">Address:</span> <?php echo $row['ADDRESS']; ?></p>
                                    <p><span style="color: gray;">Category:</span> <?php echo $row['CATEGORY']; ?></p>

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