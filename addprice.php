<!DOCTYPE html>
<?php 
session_start();
include('library/useronly.php');
include('library/connection.php');
include('library/functionlibrary.php');

  $categoryset = false;
  $searchset = false;
  $searchkeyword = '';
  $categoryid = -99;

  if(isset($_GET['category']))
  {
    $sql = 'SELECT * FROM product_category WHERE ID = "' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['category']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '"';
    $result = mysqli_query( $con, $sql);
    $total_category = mysqli_num_rows($result);
    if($total_category > 0)
    {
      $categoryid = $_GET['category'];
      $categoryset = true;
    }
  }
  if(isset($_GET['search']))
  {
    $searchkeyword = $_GET['search'];
    $searchset = true;
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
  <link href="css/map.css" rel="stylesheet">
</head>
<body role="document">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>Add Price for: <b id="add_name_input"></b></h4>
      </div>
      <div class="modal-body">
        <div id="my_message_box" tabindex="0">
        </div>
        <iframe id="add_iframe" name="add_iframe" src="" style="display:none;" ></iframe><!--style="display:none;"-->
        <form method="post" id="addform" action="library/addpriceform.php" onsubmit="return add_form_submit();" target="add_iframe"><!--need to edit-->
          <input type="text" id="add_product_input" name="PRODUCT" style="display: none;" />
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-th-list"></span> Category</span>
            <input type="text" disabled="disabled" class="form-control" id="add_category_input" placeholder="Product Category" aria-describedby="basic-addon1"/>
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon" id="basicasd-addon1"><span class="glyphicon glyphicon-tag"></span> SRP</span>
            <input type="text" disabled="disabled" class="form-control" id="add_srp_input" placeholder="Suggested Retail Price" aria-describedby="basic-addon1"/>
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon" id="basicasasdsdsaasdon1"><span class="glyphicon glyphicon-map-marker"></span> Store Address</span>
            <input type="text" class="form-control" id="addressformtxt" name="ADDRESS" placeholder="Store Address" aria-describedby="basic-addon1" required />
          </div>
          <br />
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span> Latitude</span>
                <input type="text" class="form-control" id="formlat" name="LATITUDE" placeholder="Latitude" aria-describedby="basic-addon1" required />
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span> Longitude</span>
                <input type="text" class="form-control" id="formlng" name="LONGITUDE" placeholder="Longitude" aria-describedby="basic-addon1" required />
              </div>
            </div>
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon" id="basicasdsaasdon1"><span class="glyphicon glyphicon-pushpin"></span> </span>
            <div class="form-control" style="width: 100%; height:300px;">
              <div id="map"></div>
            </div>
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon" id="basicasd-aasasddon1"><span class="glyphicon glyphicon-header"></span> Store Name</span>
            <input type="text" class="form-control" id="add_store_input" name="NAME" placeholder="Store Name" aria-describedby="basic-addon1" required />
          </div>
          <br />
          <div class="input-group">
            <span class="input-group-addon" id="basicasd-asasddon1"><span class="glyphicon glyphicon-tag"></span> Price</span>
            <input type="number" min="0" step="any" class="form-control" name="PRICE" id="add_price_input" placeholder="Price of the item" aria-describedby="basic-addon1" required />
          </div>
          <br />
          <input type="submit" class="btn btn-info pull-right" id="addbtn" data-loading-text="Adding price..." value="Add Price" />
          <div style="clear:both;"></div>
        </form>
        <input id="pac-input" class="controls" onkeydown="if(event.keyCode == 13) {event.preventDefault(); return false; }" type="text" placeholder="Search Box" />
      </div>
    </div>
  </div>
</div>

<!-- Fixed navbar -->
<?php include('library/navbar.php'); ?>

<!--contents start here-->
<div class="container">
  <div style="width:100%; height: 80px"></div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Add Price</h3>
      <small>
        <ol class="breadcrumb">
          <li><a href="userpanel.php">User Dashboard</a></li>
          <li class="active">Add Price</li>
          <li><a href="editprice.php">Edit/Delete Price</a></li>
          <li><a href="useraccountsettings.php">Account Settings</a></li>
        </ol>
      </small>
    </div>
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">

          <form>
            <div class="input-group">
              <span class="input-group-btn">
                <select onchange="changecategory(this.options[this.selectedIndex].text);" id="searchcategory" name="category" class="btn btn-default dropdown-toggle" style="height: 2.4em;">
                  <option value="-99">All</option>
                  <?php
                      $sql = 'SELECT * FROM product_category';
                      $result = mysqli_query( $con, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                  ?>
                  <option value="<?php echo $row['ID'] ?>" id="category<?php echo $row['ID'] ?>"><?php echo $row['NAME'] ?></option>
                  <?php } ?>
                </select>
                <?php echo "<script> document.getElementById('searchcategory').value = '" . $categoryid . "' </script>" ?>
              </span>
              <input type="text" name="search" value="<?php echo $searchkeyword; ?>" id="searchinput" class="form-control" placeholder="Search">
              <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Search" />
              </span>
            </div><!-- /input-group -->
          </form>
          <?php
            $argument = '';
            if($categoryset)
            {
              $argument .= ' AND product_category.ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $categoryid) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
            }
            if($searchset)
            {
              $argument .= ' AND product_table.NAME LIKE "%' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $searchkeyword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '%"';
            }
            $sql = 'SELECT product_table.ID, product_table.NAME, product_table.DESCRIPTION, product_table.SRP, product_category.ID AS CATEGORYID, product_category.NAME AS CATEGORY FROM product_table, product_category WHERE product_category.ID = product_table.CATEGORY' . $argument . ' ORDER BY product_table.DATECREATED DESC';
            $result = mysqli_query( $con, $sql);
            $total_result = mysqli_num_rows($result);
            if($total_result < 1)
            {
           ?>
           <br />
            <div class="alert alert-info" role="alert">There are no results. <a href="addprice.php">Click here to go to all categories</a></div>
           <?php } ?>
        </div>
        <table class="table">
          <thead>
            <tr class="table_headers">
              <th>Category</th>
              <th>Name</th>
              <th>Description</th>
              <th style="text-align: right;">Action</th>
            </tr>
          </thead>

          <tbody>
          <?php                                                  
            while ($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?php echo $row['CATEGORY']; ?></td>
            <td><b><?php echo $row['NAME']; ?></b></td>
            <td><?php echo $row['DESCRIPTION']; ?></td>
            <td style="text-align: right;">
              <a href="#" onclick="initaddpanel(<?php echo $row['ID']; ?>, '<?php echo $row['NAME']; ?>', '<?php echo $row['CATEGORY']; ?>', <?php echo $row['SRP']; ?>);" data-toggle="modal" data-target="#myModal" class="btn btn-info">Add Price</a>
            </td>
          </tr>
          <?php } ?>
         
          </tbody>

        </table>
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
<script>
  var details = {
    product: document.getElementById('add_product_input'),
    name: document.getElementById('add_name_input'),
    category: document.getElementById('add_category_input'),
    srp: document.getElementById('add_srp_input'),
    address: document.getElementById('addressformtxt'),
    lat: document.getElementById('formlat'),
    lng: document.getElementById('formlng'),
    store: document.getElementById('add_store_input'),
    price: document.getElementById('add_price_input')
  }
  var add_btn = "#addbtn";
  var add_request = false;
  var messagebox = document.getElementById("my_message_box");
  var addform = document.getElementById("add_iframe");

    function disableaddress()
    {
      details.address.disabled = "disabled";
      details.lat.disabled = "disabled";
      details.lng.disabled = "disabled";
    }

    function enableaddress()
    {
      details.address.disabled = "";
      details.lat.disabled = "";
      details.lng.disabled = "";
    }

    function resetform()
    {
      details.store.value = '';
      details.price.value = '';
    }

   addform.onload = function() {
      var add_message = addform.contentDocument.body.innerHTML;
      if(add_request)
      {
        if(add_message == 'success')
        {
          messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully added a price.</div>';
          resetform();
        }
        else if(add_message == 'error')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with adding the price.</div>';
        }
        else if(add_message == 'exists')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Someone already encoded that price for that store.</div>';
        }
        else if(add_message == 'errorloc')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That is not a valid address. Please mark the map where the store can be found.</div>';
        }
        else
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
        }

        messagebox.focus();
        disableaddress();
        add_request = false;
        $(add_btn).button('reset');
        addform.src = "";
      }
  };

  function add_form_submit(){


    enableaddress();
    add_request = true;
    $(add_btn).button('loading');
    return true;
  }

  function initaddpanel(a_id, a_name, a_category, a_srp){
    details.product.value = a_id;
    details.name.innerHTML = a_name;
    details.category.value = a_category;
    details.srp.value = a_srp;
    disableaddress();
  }

   function changecategory(text){
    document.getElementById('searchinput').placeholder = "Search in " + text + " Category";
  }

  $('#myModal').on('show.bs.modal', function (e) {
    messagebox.innerHTML = "";
  });

  var map;
  var storemarker;
  function initAutocomplete() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 10.7149629, lng: 122.5476471},
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    storemarker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      title: 'Drag this to the location of the store.',
      draggable: true,
      animation: google.maps.Animation.BOUNCE
    });

    var geocoder = new google.maps.Geocoder;
    var infoWindow = new google.maps.InfoWindow({map: map});
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent('You are here.');
        map.setCenter(pos);
        storemarker.setPosition(map.getCenter());
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }

    map.addListener('click', function(event) {
      infoWindow.close();
      storemarker.setPosition(event.latLng);
      storemarker.setAnimation(google.maps.Animation.BOUNCE);
    });

    storemarker.addListener('position_changed', function(event) {
     infoWindow.close();
      document.getElementById('addressformtxt').value = 'Getting location...';
      document.getElementById('formlat').value = 'Getting location...';
      document.getElementById('formlng').value = 'Getting location...';
     geocodeLatLng(geocoder, map, storemarker.getPosition());
     });

    storemarker.addListener('dragend', function(event) {
     infoWindow.close();
     geocodeLatLng(geocoder, map, storemarker.getPosition());
     });



    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {

        storemarker.setPosition(place.geometry.location);

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }

  function geocodeLatLng(geocoder, map, latlngg) {
    var latlng = latlngg;
    geocoder.geocode({'location': latlng}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        if (results[1]) {
          //results[1].formatted_address
          document.getElementById('addressformtxt').value = results[1].formatted_address;
          document.getElementById('formlat').value = storemarker.getPosition().lat();
          document.getElementById('formlng').value = storemarker.getPosition().lng();
          //alert(results[1].formatted_address);

        } else {
          alert("There is no address for this area.");
        }
      } else {
        if(status == "ZERO_RESULTS")
        {
          alert("There is no address for this area.");
        }
      }
    });
  }

  $('#myModal').on('shown.bs.modal', function (e) {
    google.maps.event.trigger(map, "resize");
  });
  
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
</html>