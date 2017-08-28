<!DOCTYPE html>
<?php 
session_start();
include('library/useronly.php');
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
      <h3>User Dashboard</h3>
    </div>
    <div class="panel-body">
      <div class="row my_thumb_container">

        <div class="col-sm-4 col-md-4">
          <a href="addprice.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Add Price - Encode/Delete Price of product of a store">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/addprice.jpg');"></div>
            <div class="caption">
              <h4>Add Price</h4>
              <p>Encode/Delete Price of product of a store</p>
            </div>
          </a>
        </div>

        <div class="col-sm-4 col-md-4">
          <a href="editprice.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Update/Disable-Enable Prices - Update/Disable-Enable Price of product of a store">
            <div class="my_thumb_img" style="background-image: url('img/site%20images/editprice.jpg');"></div>
            <div class="caption">
              <h4>Update/Disable-Enable Prices</h4>
              <p>Update/Disable-Enable Price of product of a store</p>
            </div>
          </a>
        </div>

        <div class="col-sm-4 col-md-4">
          <a href="useraccountsettings.php" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Account Settings - Change username and password of this account">
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