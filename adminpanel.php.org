<!DOCTYPE html>
<?php
session_start();
include('library/adminonly.php');
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

<!-- Fixed navbar -->
<?php include('library/navbar.php'); ?>

<!--contents start here-->
<div class="container">
  <div style="width:100%; height: 80px"></div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Admin Dashboard</h3>
    </div>
    <div class="panel-body">
      <div class="row my_thumb_container">

        <div class="col-sm-6 col-md-3">
          <a href="managecategory.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Manage Category - Add/Delete a product category">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/category.jpg');"></div>
            <div class="caption">
              <h4>Manage Category</h4>
              <p>Add/Delete a product category.</p>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-md-3">
          <a href="manageproduct.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Manage Product - Encode/Delete Suggested Retail Price">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/srp.jpg');"></div>
            <div class="caption">
              <h4>Manage Product</h4>
              <p>Encode/Delete Suggested Retail Price.</p>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-md-3">
          <a href="sitesettings.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Site Settings - Set home slide images and contact details">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/setting.jpg');"></div>
            <div class="caption">
              <h4>Site Settings</h4>
              <p>Set home slide images and contact details.</p>
            </div>
          </a>
        </div>

        <div class="col-sm-6 col-md-3">
          <a href="accountsettings.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Account Settings - Change username and password of this account">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/setting2.jpg');"></div>
            <div class="caption">
              <h4>Account Settings</h4>
              <p>Change username and password of this account.</p>
            </div>
          </a>
        </div>




      </div>

    </div>
  </div>

</div>

<!--contents end here-->


<?php include('library/footer.php'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/1.11.3_jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>
</body>
</html>