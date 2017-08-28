<!DOCTYPE html>
<?php 
session_start();
include('library/useronly.php');
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
  <link href="css/map.css" rel="stylesheet">
</head>
<body role="document">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="panel_title">Add Price for: <b>Sometxt here</b></h4>
      </div>
      <div class="modal-body">
        <div id="my_message_box" tabindex="0">
        </div>
        <div class="tab-content">

          <ul class="nav nav-tabs" style="display: none;">
            <li><a href="#editpanel" data-toggle="tab">Edit</a></li>
            <li><a href="#deletepanel" data-toggle="tab">Delete</a></li>
          </ul>
          <!--Editing section-->
          <div role="tabpanel" class="tab-pane fade" id="editpanel">
            <iframe id="edit_iframe" name="edit_iframe" src="" style="display: none;"></iframe>
            <form target="edit_iframe" action="library/editeditpriceform.php" onsubmit="return edit_form_submit();" method="post">
              <input type="text" id="edit_id_input" name="ID" style="display: none;" />
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-th-list"></span> Category</span>
                <input type="text" disabled="disabled" class="form-control" id="edit_category_input" placeholder="Product Category" aria-describedby="basic-addon1"/>
              </div>
              <br />
              <div class="input-group">
                <span class="input-group-addon" id="basicasd-addon1"><span class="glyphicon glyphicon-tag"></span> SRP</span>
                <input type="text" disabled="disabled" class="form-control" id="edit_srp_input" placeholder="Suggested Retail Price" aria-describedby="basic-addon1"/>
              </div>
              <br />
              <div class="input-group">
                <span class="input-group-addon" id="basicasasdsdsaasdon1"><span class="glyphicon glyphicon-map-marker"></span> Store Address</span>
                <input type="text" class="form-control" id="editressformtxt" name="ADDRESS" placeholder="Store Address" aria-describedby="basic-addon1" required />
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
                <input type="text" class="form-control" id="edit_store_input" name="NAME" placeholder="Store Name" aria-describedby="basic-addon1" required />
              </div>
              <br />
              <div class="input-group">
                <span class="input-group-addon" id="basicasd-asasddon1"><span class="glyphicon glyphicon-tag"></span> Price</span>
                <input type="number" min="0" step="any" class="form-control" name="PRICE" id="edit_price_input" placeholder="Price of the item" aria-describedby="basic-addon1" required />
              </div>
              <br />
              <input type="submit" class="btn btn-info pull-right" id="editbtn" data-loading-text="Updating price..." value="Update Price" />
              <div style="clear:both;"></div>
            </form>
            <input id="pac-input" class="controls" onkeydown="if(event.keyCode == 13) {event.preventDefault(); return false; }" type="text" placeholder="Search Box" />
          </div>
        </div>


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
      <h3>Edit/Delete Price</h3>
      <small>
        <ol class="breadcrumb">
          <li><a href="userpanel.php">User Dashboard</a></li>
          <li><a href="addprice.php">Add Price</a></li>
          <li class="active">Edit/Delete Price</li>
          <li><a href="useraccountsettings.php">Account Settings</a></li>
        </ol>
      </small>
    </div>
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">

          <?php
            $searchkeyword = '';
            if(isset($_GET['search']))
            {
              $searchkeyword = $_GET['search'];
            }
            $argument = 'AND product_table.NAME LIKE "%' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $searchkeyword) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . '%"';
            $sql = 'SELECT encoded_products.ID, encoded_products.LAT, encoded_products.LNG, product_table.NAME, encoded_products.ADDRESS, encoded_products.STORENAME, encoded_products.DISABLED, product_table.DESCRIPTION, product_category.NAME AS CATEGORY, encoded_products.PRICE, product_table.SRP FROM encoded_products, product_table, product_category WHERE product_table.ID = encoded_products.PRODUCT AND product_category.ID = product_table.CATEGORY AND POSTBY = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_SESSION['USER']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")) . ' ' . $argument . ' GROUP BY encoded_products.ID ORDER BY encoded_products.DATECREATED DESC';
            $result = mysqli_query( $con, $sql);
            $total = mysqli_num_rows($result);
          ?>

          <form>
            <div class="input-group">
              <input type="text" name="search" value="<?php echo $searchkeyword; ?>" class="form-control" placeholder="Search by Product Name">
              <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Search" />
              </span>
            </div><!-- /input-group -->
          </form>
          <?php
            if($total < 1)
            {
           ?>
           <br />
            <div class="alert alert-info" role="alert">There are no results. <a href="editprice.php">Click here to display all.</a> or <a href="addprice.php">Click here to add price</a></div>
           <?php } ?>
        </div>
        <table class="table">
          <thead>
            <tr class="table_headers">
              <th>Store Name</th>
              <th>Store Address</th>
              <th>Product Name</th>
              <th>Price</th>
              <th style="text-align: right;">Action</th>
            </tr>
          </thead>

          <tbody>

          <?php              
              while ($row = mysqli_fetch_array($result)) {
                $btn_class = 'success';
                $btn_innerHTML = 'Enabled';
                if($row['DISABLED'] != 0)
                {
                  $btn_class = 'danger';
                  $btn_innerHTML = 'Disabled';
                }
          ?>
            <tr id="item<?php echo $row['ID']; ?>">
              <td><b id="storename<?php echo $row['ID']; ?>"><?php echo $row['STORENAME']; ?></b></td>
              <td id="address<?php echo $row['ID']; ?>"><?php echo $row['ADDRESS']; ?></td>
              <td><b id="productname<?php echo $row['ID']; ?>"><?php echo $row['NAME']; ?></b></td>
              <td id="price<?php echo $row['ID']; ?>"><?php echo $row['PRICE']; ?></td>
              <td style="text-align: right;">
                <div style="display:none;">
                  <div id="category<?php echo $row['ID']; ?>"><?php echo $row['CATEGORY']; ?></div>
                  <div id="srp<?php echo $row['ID']; ?>"><?php echo $row['SRP']; ?></div>
                  <div id="lat<?php echo $row['ID']; ?>"><?php echo $row['LAT']; ?></div>
                  <div id="lng<?php echo $row['ID']; ?>"><?php echo $row['LNG']; ?></div>
                </div>
                <a href="#" onclick="initeditpanel(<?php echo $row['ID']; ?>);" data-toggle="modal" data-target="#myModal" class="btn btn-info">Update</a>
                <a href="#" id="enabledisable<?php echo $row['ID']; ?>" data-loading-text="Please wait..." onclick="enabledisable(<?php echo $row['ID']; ?>); return false;" class="btn btn-<?php echo $btn_class; ?>"><?php echo $btn_innerHTML; ?></a>
              </td>
            </tr>

          <?php } ?>

          </tbody>

        </table>
      </div>

    </div>
  </div>

</div>
<iframe id="delete_iframe" name="delete_iframe" src="" style="" ></iframe><!--style="display:none;"-->
<!--contents end here-->


<?php include('library/footer.php'); ?>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/1.11.3_jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
  var map;
  var storemarker;
  var edit_request = false;
  var delete_request = false;
  var deleteform = document.getElementById("delete_iframe");
  var editform = document.getElementById("edit_iframe");
  var messagebox = document.getElementById("my_message_box");
  var edit_btn = "#editbtn";
  var id_to_delete;

  var currentdetails = {
    address: '',
    lat: 0,
    lng: 0,
    store: '',
    price: 0
  }

  var editdetails = {
    name: '',
    id: document.getElementById('edit_id_input'),
    category: document.getElementById('edit_category_input'),
    srp: document.getElementById('edit_srp_input'),
    address: document.getElementById('editressformtxt'),
    lat: document.getElementById('formlat'),
    lng: document.getElementById('formlng'),
    store: document.getElementById('edit_store_input'),
    price: document.getElementById('edit_price_input')
  }

  $('#myModal').on('show.bs.modal', function (e) {
    messagebox.innerHTML = "";
  });

  function disableaddress()
  {
    editdetails.address.disabled = "disabled";
    editdetails.lat.disabled = "disabled";
    editdetails.lng.disabled = "disabled";
  }

  function enableaddress()
  {
    editdetails.address.disabled = "";
    editdetails.lat.disabled = "";
    editdetails.lng.disabled = "";
  }

  function resetform()
  {
    editdetails.store.value = '';
    editdetails.price.value = '';
  }

  function edit_item()
  {
    //edit an item in the list
    document.getElementById('productname' + editdetails.id.value).innerHTML = editdetails.name;
    document.getElementById('category' + editdetails.id.value).innerHTML = editdetails.category.value;
    document.getElementById('srp' + editdetails.id.value).innerHTML = editdetails.srp.value;
    document.getElementById('address' + editdetails.id.value).innerHTML = editdetails.address.value;
    document.getElementById('lat' + editdetails.id.value).innerHTML = editdetails.lat.value;
    document.getElementById('lng' + editdetails.id.value).innerHTML = editdetails.lng.value;
    document.getElementById('storename' + editdetails.id.value).innerHTML = editdetails.store.value;
    document.getElementById('price' + editdetails.id.value).innerHTML = editdetails.price.value;

    //document.getElementById('item' + editdetails.id.value).innerHTML = '<td><b>' + editdetails.store.value + '</b></td> <td>' + editdetails.address.value + '</td> <td><b>' + editdetails.name + '</b></td> <td>' + editdetails.price.value + '</td> <td style="text-align: right;"> <a href="#" onclick="initeditpanel(' + editdetails.id.value + ', \'' + editdetails.name + '\', \'' + editdetails.category.value + '\', ' + editdetails.srp.value + ', \'' + editdetails.address.value + '\', ' + editdetails.lat.value + ', ' + editdetails.lng.value + ', \'' + editdetails.store.value + '\', ' + editdetails.price.value + ');" data-toggle="modal" data-target="#myModal" class="btn btn-info">Update</a> <a href="#" onclick="initdeletepanel(' + editdetails.id.value + ', \'' + editdetails.name + '\', \'' + editdetails.store.value + '\', ' + editdetails.price.value + ');" data-toggle="modal" data-target="#myModal" class="btn btn-danger">Delete</a> </td> '; 
    currentdetails.address = editdetails.address.value;
    currentdetails.lat = editdetails.lat.value;
    currentdetails.lng = editdetails.lng.value;
    currentdetails.store = editdetails.store.value;
    currentdetails.price =  editdetails.price.value;
  }

/*
  function delete_item()
  {
    //delete item from the list
    $('#myModal').modal('hide');
    $("#item" + id_to_delete).remove();
  }
*/

  function edit_form_submit()
  {

    if(currentdetails.address == editdetails.address.value && currentdetails.lat == editdetails.lat.value && currentdetails.lng == editdetails.lng.value && currentdetails.store == editdetails.store.value && currentdetails.price == editdetails.price.value)
    {
      messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Hey!</b> There\'s nothing to be updated. Nothing changed.</div>';
      messagebox.focus();
      return false;
    }

    enableaddress();
    edit_request = true;
    $(edit_btn).button('loading');
    return true;
  }
/*
  function delete_form_submit()
  {
    delete_request = true;
    $(delete_btn).button('loading');
    return true;
  }
*/
  editform.onload = function() {
    var edit_message = editform.contentDocument.body.innerHTML;
    if(edit_request)
    {
      //edit_item();
      //messagebox.innerHTML = edit_message;
      if(edit_message == 'success')
        {
          messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully updated the item.</div>';
          edit_item();
        }
        else if(edit_message == 'error')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with updating the item.</div>';
        }
        else if(edit_message == 'exists')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Someone already encoded that price for that store.</div>';
        }
        else if(edit_message == 'errorloc')
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That is not a valid address. Please mark the map where the store can be found.</div>';
        }
        else
        {
          messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
        }

      messagebox.focus();
      disableaddress();
      edit_request = false;
      $(edit_btn).button('reset');
      editform.src = "";
    }
  };


  deleteform.onload = function() {
    delete_message = deleteform.contentDocument.body.innerHTML;
    if(delete_request)
    {
      var modibtn = document.getElementById('enabledisable' + id_to_delete);
      if(delete_message == 'enabled')
      {
        //document.getElementById("MyElement").className = "MyClass";
        modibtn.className = "btn btn-success";
        modibtn.innerHTML = 'Enabled';
      }
      else if(delete_message == 'disabled')
      {
        modibtn.className = "btn btn-danger";
        modibtn.innerHTML = 'Disabled';
      }
      else if(delete_message == 'error')
      {
        alert('There is a problem with deleting the price');
      }
      else
      {
        alert('There is a problem with the server or connection');
      }
      delete_request = false;
      //$('#enabledisable' + id_to_delete).button('reset');
      deleteform.src = "";
    }
  };


  
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


    map.addListener('click', function(event) {
      storemarker.setPosition(event.latLng);
      storemarker.setAnimation(google.maps.Animation.BOUNCE);
    });

    storemarker.addListener('position_changed', function(event) {
      document.getElementById('editressformtxt').value = 'Getting location...';
      document.getElementById('formlat').value = 'Getting location...';
      document.getElementById('formlng').value = 'Getting location...';
     geocodeLatLng(geocoder, map, storemarker.getPosition());
     });

    storemarker.addListener('dragend', function(event) {
     geocodeLatLng(geocoder, map, storemarker.getPosition());
     });

    storemarker.setPosition(map.getCenter());


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
          document.getElementById('editressformtxt').value = results[1].formatted_address;
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

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    google.maps.event.trigger(map, "resize");
  });

  function setmapto(s_lat, s_lng){
    newLatLng = new google.maps.LatLng(s_lat, s_lng);
    storemarker.setPosition(newLatLng);
    map.setCenter(newLatLng);
    map.setZoom(16);

  }

  //e_name, e_category, e_srp, e_address, e_lat, e_lng, e_store, e_price
  function initeditpanel(e_id){
    var e_name = document.getElementById('productname' + e_id).innerHTML;
    var e_category = document.getElementById('category' + e_id).innerHTML;
    var e_srp = document.getElementById('srp' + e_id).innerHTML;
    var e_address = document.getElementById('address' + e_id).innerHTML;
    var e_lat = document.getElementById('lat' + e_id).innerHTML;
    var e_lng = document.getElementById('lng' + e_id).innerHTML;
    var e_store = document.getElementById('storename' + e_id).innerHTML;
    var e_price = document.getElementById('price' + e_id).innerHTML;

    document.getElementById('panel_title').innerHTML = "Edit Price of <b>" + e_name + "</b>";
    editdetails.name = e_name;
    editdetails.id.value = e_id;
    editdetails.category.value = e_category;
    editdetails.srp.value = e_srp;
    editdetails.address.value = e_address;
    editdetails.lat.value = e_lat;
    editdetails.lng.value = e_lng;
    editdetails.store.value = e_store;
    editdetails.price.value = e_price;

    currentdetails.address = e_address;
    currentdetails.lat = e_lat;
    currentdetails.lng = e_lng;
    currentdetails.store = e_store;
    currentdetails.price = e_price;
    setmapto(e_lat, e_lng);


    disableaddress();
    $('.nav-tabs a[href="#editpanel"]').tab('show');
    google.maps.event.trigger(map, "resize");
  }
  function enabledisable(d_id){
    if(delete_request)
    {
      alert('Please Wait...');
    }
    else
    {
      id_to_delete = d_id;
      delete_request = true;
      //$('#enabledisable' + id_to_delete).button('loading');
      deleteform.src = "library/deleteeditpriceform.php?DELETEID=" + d_id;
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
</html>