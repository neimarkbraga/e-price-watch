<!DOCTYPE html>
<?php
  session_start();
  include('library/adminonly.php');
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
<body role="document" onload="init();">

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="panel_title"></h4>
            </div>
            <div class="modal-body">
                <div id="my_message_box">

                </div>
                <ul class="nav nav-tabs" style="display: none;">
                    <li><a href="#slidemodpanel" data-toggle="tab">Add</a></li>
                    <li><a href="#aboutmodpanel" data-toggle="tab">Edit</a></li>
                    <li><a href="#contactmodpanel" data-toggle="tab">Delete</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- slidesection-->
                    <div role="tabpanel" class="tab-pane fade in active" id="slidemodpanel">
                        <iframe id="slide_iframe" name="slide_iframe" src="" style="display:none;" ></iframe>
                        <form enctype="multipart/form-data" id="the_slide_form" method="post" action="library/slidesettingform.php" target="slide_iframe" onsubmit="return slide_submit();">
                            <input type="text" name="FOLDER" id="slider_folder_input" style="display:none;" required />
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-picture"></span> </span>
                                <input type="file" id="slider_file_input" class="form-control" name="file" aria-describedby="basic-addon1" accept=".jpg, .JPG, .png, .PNG" required />
                            </div>
                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="slidebtn" data-loading-text="Changing Image..." value="Save" />
                            <div style="clear:both;"></div>
                        </form>
                    </div>

                    <!--about section-->
                    <div role="tabpanel" class="tab-pane fade" id="aboutmodpanel" >
                        <iframe id="about_iframe" name="about_iframe" src="" style="display:none;" ></iframe>
                        <form target="about_iframe" action="library/aboutsettingform.php" method="post" onsubmit="return about_submit();">
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-info-sign"></span> </span>
                                <textarea type="text" id="about_about_input" class="form-control" rows="5" name="ABOUTUS" id="textauto" placeholder="What to see in about page?" aria-describedby="basic-addon2" required></textarea>
                            </div>

                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="aboutbtn" data-loading-text="Saving changes.." value="Save" />
                            <div style="clear:both;"></div>
                        </form>
                    </div>

                    <!--contact section-->
                    <div role="tabpanel" class="tab-pane fade" id="contactmodpanel">
                        <iframe id="contact_iframe" name="contact_iframe" src="" style="display:none;" ></iframe>
                        <form target="contact_iframe" action="library/contactsettingform.php" method="post" onsubmit="return contact_submit();">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span> </span>
                                <input type="email" class="form-control" id="contact_email_input" name="EMAIL" placeholder="Email" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span> </span>
                                <input type="text" class="form-control" id="contact_address_input" name="ADDRESS" placeholder="Address" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span> </span>
                                <input type="text" class="form-control" id="contact_contact_input" name="CONTACT" placeholder="Contact" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span> http://www.facebook.com/</span>
                                <input type="text" class="form-control" id="contact_facebook_input" name="FACEBOOK" placeholder="Facebook" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span> http://www.instagram.com/</span>
                                <input type="text" class="form-control" id="contact_instagram_input" name="INSTAGRAM" placeholder="Instagram" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span> http://www.twitter.com/</span>
                                <input type="text" class="form-control" id="contact_twitter_input" name="TWITTER" placeholder="Twitter" aria-describedby="basic-addon1" required />
                            </div>
                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="contactbtn" data-loading-text="Saving changes.." value="Save" />
                            <div style="clear:both;"></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('library/navbar.php'); ?>

<div class="container">
    <div style="width: 100%; height: 80px;"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Site Settings</h3>
            <small>
                <ol class="breadcrumb">
                  <li><a href="adminpanel.php">Admin Dashboard</a></li>
                  <li><a href="managecategory.php">Manage Category</a></li>
                  <li><a href="manageproduct.php">Manage Product</a></li>
                  <li class="active">Site Settings</li>
                  <li><a href="accountsettings.php">Account Settings</a></li>
                </ol>
              </small>
        </div>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#slidepanel" aria-controls="home" role="tab" data-toggle="tab">Slider Images</a></li>
                <li role="presentation"><a href="#aboutuspanel" aria-controls="profile" role="tab" data-toggle="tab">About us</a></li>
                <li role="presentation"><a href="#contactpanel" aria-controls="messages" role="tab" data-toggle="tab">Contact</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="slidepanel">
                    <table class="table">
                        <tr>
                            <td><img style="max-width: 100%; max-height: 300px;" id="sliderimgg1" src="<?php echo getsliderimagelink(1) ?>"/></td>
                            <td style="vertical-align: middle;"><a href="#" onclick="initslidepanel(1);" data-toggle="modal" data-target="#myModal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Change</a></td>
                        </tr>
                        <tr>
                            <td><img style="max-width: 100%; max-height: 300px;" id="sliderimgg2" src="<?php echo getsliderimagelink(2) ?>"/></td>
                            <td style="vertical-align: middle;"><a href="#" onclick="initslidepanel(2);" data-toggle="modal" data-target="#myModal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Change</a></td>
                        </tr>
                        <tr>
                            <td><img style="max-width: 100%; max-height: 300px;" id="sliderimgg3" src="<?php echo getsliderimagelink(3) ?>"/></td>
                            <td style="vertical-align: middle;"><a href="#" onclick="initslidepanel(3);" data-toggle="modal" data-target="#myModal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Change</a></td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="aboutuspanel">
                    <br />
                    <a href="#" onclick="initaboutpanel();" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    <div style="clear: both;"></div>
                    <p id="aboutus_content" style="white-space: pre-line; width: 95%; margin: auto;"> <?php $sql = 'SELECT * FROM about_us WHERE ID=1'; $result = mysqli_query( $con, $sql); if($row = mysqli_fetch_array($result)) {echo $row['DESCRIPTION']; } ?> </p>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="contactpanel">
                    <br />
                    <a href="#" onclick="initcontactpanel();" data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    <div style="clear: both;"></div>
                    <br />
                    <table class="table">
                        <?php
                        $sql = 'SELECT * FROM contact_us WHERE ID=1';
                        $result = mysqli_query( $con, $sql);
                        if($row = mysqli_fetch_array($result))
                        {
                            ?>
                            <tr>
                                <td><b>Email </b></td>
                                <td id="contact_email_current"><?php echo $row['EMAIL']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Address </b></td>
                                <td id="contact_address_current"><?php echo $row['ADDRESS']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Contact Number </b></td>
                                <td id="contact_contact_current"><?php echo $row['CONTACT']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Facebook </b></td>
                                <td><a id="contact_facebook_current" href="http://www.facebook.com/<?php echo $row['FACEBOOK']; ?>"><?php echo $row['FACEBOOK']; ?></a></td>
                            </tr>
                            <tr>
                                <td><b>Instagram </b></td>
                                <td><a id="contact_instagram_current" href="http://www.instagram.com/<?php echo $row['INSTAGRAM']; ?>"><?php echo $row['INSTAGRAM']; ?></a></td>
                            </tr>
                            <tr>
                                <td><b>Twitter </b></td>
                                <td><a id="contact_twitter_current" href="http://www.twitter.com/<?php echo $row['TWITTER']; ?>"><?php echo $row['TWITTER']; ?></a></td>
                            </tr>
                            <?php
                                }
                            ?>
                    </table>
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
<script>
    var slide_request = false;
    var about_request = false;
    var contact_request = false;
    var slidebtn = "#slidebtn";
    var aboutbtn = "#aboutbtn";
    var contactbtn = "#contactbtn";
    var messagebox = document.getElementById("my_message_box");
    var slideform = document.getElementById("slide_iframe");
    var aboutform = document.getElementById("about_iframe");
    var contactform = document.getElementById("contact_iframe");
    var currentaboutus = document.getElementById('aboutus_content');
    var aboutus_input = document.getElementById('about_about_input');
    var currentcontactinput = {
        email: document.getElementById('contact_email_input'),
        address: document.getElementById('contact_address_input'),
        contact: document.getElementById('contact_contact_input'),
        facebook: document.getElementById('contact_facebook_input'),
        instagram: document.getElementById('contact_instagram_input'),
        twitter: document.getElementById('contact_twitter_input')
    };

    var currentcontact = {
        email: document.getElementById('contact_email_current'),
        address: document.getElementById('contact_address_current'),
        contact: document.getElementById('contact_contact_current'),
        facebook: document.getElementById('contact_facebook_current'),
        instagram: document.getElementById('contact_instagram_current'),
        twitter: document.getElementById('contact_twitter_current')
    };

    $('#myModal').on('show.bs.modal', function (e) {
        messagebox.innerHTML = "";
    });

    function updateimage()
    {
        var item_image = document.getElementById('slider_file_input').value;
        item_image = item_image.split('\\')[item_image.split('\\').length - 1];
        var folder = document.getElementById('slider_folder_input').value;
        var newlink = "img/slider images/" + folder + "/" + item_image;
        document.getElementById('sliderimgg' + folder).src = newlink;
        document.getElementById('slider_file_input').value = "";
    }

    function updateaboutus()
    {
        currentaboutus.innerHTML = aboutus_input.value;
    }

    function updatecontact()
    {
        currentcontact.email.innerHTML = currentcontactinput.email.value;
        currentcontact.address.innerHTML = currentcontactinput.address.value;
        currentcontact.contact.innerHTML = currentcontactinput.contact.value;
        currentcontact.facebook.innerHTML = currentcontactinput.facebook.value;
        currentcontact.instagram.innerHTML = currentcontactinput.instagram.value;
        currentcontact.twitter.innerHTML = currentcontactinput.twitter.value;
        currentcontact.facebook.href = 'http://facebook.com/' + currentcontactinput.facebook.value;
        currentcontact.instagram.href = 'http://instagram.com/' + currentcontactinput.instagram.value;
        currentcontact.twitter.href = 'http://twitter.com/' + currentcontactinput.twitter.value;
    }

    slideform.onload = function(){
        var slide_message = slideform.contentDocument.body.innerHTML;
        if(slide_request)
        {

            //messagebox.innerHTML = slide_message;
            switch(slide_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed the image.</div>';
                    updateimage();            
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in uploading.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }


            slide_request = false;
            $(slidebtn).button('reset');
            slideform.src = "";
        }
    };

    aboutform.onload = function(){
        var about_message = aboutform.contentDocument.body.innerHTML;
        if(about_request)
        {
            switch(about_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed the about us page.</div>';
                    updateaboutus();          
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in updating.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }
            about_request = false;
            $(aboutbtn).button('reset');
            aboutform.src = "";
        }
    };

    contactform.onload = function(){
        var contact_message = contactform.contentDocument.body.innerHTML;
        if(contact_request)
        {
            switch(contact_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed the contact details.</div>';
                    updatecontact();         
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in updating.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }

            contact_request = false;
            $(contactbtn).button('reset');
            contactform.src = "";
        }
    };

    function slide_submit(){
        slide_request = true;
        $(slidebtn).button('loading');
        return true;
    }

    function about_submit(){

        if(aboutus_input.value == currentaboutus.innerHTML){
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Hey!</b> There\'s nothing to be updated. Nothing changed.</div>';
            return false;
        }

        about_request = true;
        $(aboutbtn).button('loading');
        return true;
    }

    function contact_submit(){

        if(currentcontactinput.email.value == currentcontact.email.innerHTML && currentcontactinput.address.value == currentcontact.address.innerHTML && currentcontactinput.contact.value == currentcontact.contact.innerHTML && currentcontactinput.facebook.value == currentcontact.facebook.innerHTML && currentcontactinput.instagram.value == currentcontact.instagram.innerHTML && currentcontactinput.twitter.value == currentcontact.twitter.innerHTML)
        {
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Hey!</b> There\'s nothing to be updated. Nothing changed.</div>';
            return false;
        }
        contact_request = true;
        $(contactbtn).button('loading');
        return true;
    }

    function initslidepanel(folder){
        document.getElementById('slider_folder_input').value = folder;
        document.getElementById('panel_title').innerHTML = "Change number " + folder + " Slider Image";
        $('.nav-tabs a[href="#slidemodpanel"]').tab('show');
    }

    function initaboutpanel(){
        aboutus_input.value = currentaboutus.innerHTML;
        document.getElementById('panel_title').innerHTML = "Edit About us page";
        $('.nav-tabs a[href="#aboutmodpanel"]').tab('show');
    }

    function initcontactpanel(){
        currentcontactinput.email.value = currentcontact.email.innerHTML;
        currentcontactinput.address.value = currentcontact.address.innerHTML;
        currentcontactinput.contact.value = currentcontact.contact.innerHTML;
        currentcontactinput.facebook.value = currentcontact.facebook.innerHTML;
        currentcontactinput.instagram.value = currentcontact.instagram.innerHTML;
        currentcontactinput.twitter.value = currentcontact.twitter.innerHTML;

        document.getElementById('panel_title').innerHTML = "Edit Contact page";
        $('.nav-tabs a[href="#contactmodpanel"]').tab('show');
    }

</script>

<script type="text/javascript">
    var observe;
    if (window.attachEvent) {
        observe = function (element, event, handler) {
            element.attachEvent('on'+event, handler);
        };
    }
    else {
        observe = function (element, event, handler) {
            element.addEventListener(event, handler, false);
        };
    }
    function init () {
        var text = document.getElementById('textauto');
        function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
        }
        /* 0-timeout to get the already changed text */
        function delayedResize () {
            window.setTimeout(resize, 0);
        }
        observe(text, 'change',  resize);
        observe(text, 'cut',     delayedResize);
        observe(text, 'paste',   delayedResize);
        observe(text, 'drop',    delayedResize);
        observe(text, 'keydown', delayedResize);
    }
</script>
</body>
</html>