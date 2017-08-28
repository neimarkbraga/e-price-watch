<?php
if(!isset($_SESSION["USER"]))
{
?>

	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">E-Price Watch</a>
        </div>
        <div id="navbar"  class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="products.php"><span class="glyphicon glyphicon-tag"></span> Products</a></li>
            <li><a href="stores.php"><span class="glyphicon glyphicon-barcode"></span> Stores</a></li>
            <li><button style="margin-left: 15px;" class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</button></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<?php
}
else if($_SESSION['USER'] < 0)
{
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">E-Price Watch</a>
    </div>
    <div id="navbar"  class="navbar-collapse collapse navbar-right">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="products.php"><span class="glyphicon glyphicon-tag"></span> Products</a></li>
        <li><a href="stores.php"><span class="glyphicon glyphicon-barcode"></span> Stores</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="adminpanel.php">Dashboard</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="accountsettings.php">Account Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<?php
}
else
{
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">E-Price Watch</a>
    </div>
    <div id="navbar"  class="navbar-collapse collapse navbar-right">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="products.php"><span class="glyphicon glyphicon-tag"></span> Products</a></li>
        <li><a href="stores.php"><span class="glyphicon glyphicon-barcode"></span> Stores</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span id="nav_current_name"><?php echo $_SESSION["NAME"]; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="userpanel.php">Dashboard</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="useraccountsettings.php">Account Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<?php
}
?>