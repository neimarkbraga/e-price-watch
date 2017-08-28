<!-- Bootstrap -->
<?php
  session_start();
  include('connection.php');
  include('functionlibrary.php');
?>
<html>
<head>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/bootstrap-theme.min.css" rel="stylesheet">
<style type="text/css">
.morris-hover{position:absolute;z-index:1000}.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255,255,255,0.8);border:solid 2px rgba(230,230,230,0.8);font-family:sans-serif;font-size:12px;text-align:center}.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0}
.morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0}
</style>
</head>
<body>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div id="line-example" style="height: auto;"></div>
        </div>
      </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/1.11.3_jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>


<?php
$values = '';
$sql = 'SELECT * FROM price_history WHERE ENCODED_ID = ' . $_GET['id'];
$result = mysqli_query( $con, $sql);
while($row = mysqli_fetch_array($result))
{
  $values .= "{date: '" . $row['DATECREATED'] . "', price: " . $row['PRICE'] . "},\n";
}

$sql = 'SELECT * FROM encoded_products WHERE ID = ' . $_GET['id'];
$result = mysqli_query( $con, $sql);
while($row = mysqli_fetch_array($result))
{
  $values .= "{date: '" . $row['DATECREATED'] . "', price: " . $row['PRICE'] . "}";
}


?>

<script type='text/javascript'>
    $(document).ready(function() {
        //Morris charts snippet - js
        $.getScript('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',function(){
            $.getScript('http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js',function(){
              Morris.Line({
                    element: 'line-example',
                    data: [
                      <?php echo $values; ?>
                    ],
                    xkey: 'date',
                    ykeys: ['price'],
                    labels: ['Price']
                  });
              
            });
        });
    });
</script>
        
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-40413119-1', 'bootply.com');
    ga('send', 'pageview');
</script>
</body>
</html>