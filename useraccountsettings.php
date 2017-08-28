<!DOCTYPE html>
<?php 
    session_start();
    include('library/useronly.php');
    include('library/connection.php');
    include('library/functionlibrary.php');
    $logged_in_id = $_SESSION['USER'];
    $sql = 'SELECT * FROM user_account WHERE ID = ' . ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $logged_in_id) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
    $result = mysqli_query( $con, $sql);
    $page_username;
    $page_password;
    $page_name;
    $page_email;

    if($row = mysqli_fetch_array($result))
    {
        $page_username = $row['USERNAME'];
        $page_password = $row['PASSWORD'];
        $page_name = $row['NAME'];
        $page_email = $row['EMAIL'];
    }
    $ii = strlen($page_password);
    $pass = '';
    for($i = 0; $i < $ii; $i++)
    {
        $pass .= '•';
    }
    $page_password = $pass;
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
                    <li><a href="#passwordpanel" data-toggle="tab">Add</a></li>
                    <li><a href="#namepanel" data-toggle="tab">Edit</a></li>
                    <li><a href="#emailpanel" data-toggle="tab">Delete</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--Password Change-->
                    <div role="tabpanel" class="tab-pane fade in active" id="passwordpanel">
                        <iframe id="password_iframe" name="password_iframe" src="" style="display:none;" ></iframe>
                        <form method="post" id="the_password_form" action="library/userpasswordform.php" target="password_iframe" onsubmit="return password_submit();">
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addonsad2"><span class="glyphicon glyphicon-lock"></span> </span>
                                <input type="password" class="form-control" id="password_old_input" name="OLDPASSWORD" placeholder="Old Password" aria-describedby="basic-addon2" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-asadddon2"><span class="glyphicon glyphicon-lock"></span> </span>
                                <input type="password" class="form-control" id="password_new_input" name="NEWPASSWORD" placeholder="New Password" aria-describedby="basic-addon2" required />
                            </div>
                            <br />
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span> </span>
                                <input type="password" class="form-control" id="password_re_input" name="REPASSWORD" placeholder="Confirm New Password" aria-describedby="basic-addon2" required />
                            </div>

                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="passwordbtn" data-loading-text="Changing password..." value="Save" />
                            <div style="clear:both;"></div>
                        </form>
                    </div>

                    <!--name change-->
                    <div role="tabpanel" class="tab-pane fade" id="namepanel">
                        <iframe id="name_iframe" name="name_iframe" src="" style="display:none;" ></iframe>
                        <form target="name_iframe" action="library/usernameform.php" method="post" id="the_name_form" onsubmit="return name_submit();">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span> </span>
                                <input type="text" class="form-control" id="name_name_input" name="NAME" placeholder="New Name" aria-describedby="basic-addon1" required="">
                            </div>
                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="namebtn" data-loading-text="Changing Name..." value="Save" />
                            <div style="clear:both;"></div>
                        </form>
                    </div>

                    <!--email change-->
                    <div role="tabpanel" class="tab-pane fade" id="emailpanel">
                        <iframe id="email_iframe" name="email_iframe" src="" style="display:none;" ></iframe>
                        <form method="post" id="the_email_form" action="library/useremailform.php" target="email_iframe" onsubmit="return email_submit();">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-aasdddon1"><span class="glyphicon glyphicon-envelope"></span> </span>
                                <input type="email" class="form-control" id="email_email_input" name="EMAIL" placeholder="New Email" aria-describedby="basic-addon1" required="">
                            </div>
                            <br />
                            <input type="submit" class="btn btn-info pull-right" id="emailbtn" data-loading-text="Changing Email..." value="Save" />
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
            <h3>Account Settings</h3>
            <small>
                <ol class="breadcrumb">
                  <li><a href="userpanel.php">User Dashboard</a></li>
                  <li><a href="addprice.php">Add Price</a></li>
                  <li><a href="editprice.php">Edit/Delete Price</a></li>
                  <li class="active">Account Settings</li>
                </ol>
            </small>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="container">
                    <table class="table">
                        <tr>
                            <td><b>Username: </b></td>
                            <td><?php echo $page_username; ?></td>
                            <td><span class="label label-default">Cannot be changed</span></td>
                        </tr>
                        <tr>
                            <td><b>Password: </b></td>
                            <td id="current_password"><?php echo $page_password; ?></td>
                            <td><a href="#" onclick="initpasswordpanel();" data-toggle="modal" data-target="#myModal" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Change</a></td>
                        </tr>
                        <tr>
                            <td><b>Name: </b></td>
                            <td id="current_name"><?php echo $page_name; ?></td>
                            <td><a href="#" onclick="initnamepanel();" data-toggle="modal" data-target="#myModal" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Change</a></td>
                        </tr>
                        <tr>
                            <td><b>Email: </b></td>
                            <td id="current_email"><?php echo $page_email; ?></td>
                            <td><a href="#" onclick="initemailpanel();" data-toggle="modal" data-target="#myModal" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Change</a></td>
                        </tr>
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
    var password_request = false;
    var name_request = false;
    var email_request = false;
    var messagebox = document.getElementById("my_message_box");
    var passwordform = document.getElementById('password_iframe');
    var nameform = document.getElementById('name_iframe');
    var emailform = document.getElementById('email_iframe');
    var passwordbtn = "#passwordbtn";
    var namebtn = "#namebtn";
    var emailbtn = "#emailbtn";
    var input = {
        oldpassword: document.getElementById('password_old_input'),
        newpassword: document.getElementById('password_new_input'),
        repassword: document.getElementById('password_re_input'),
        name: document.getElementById('name_name_input'),
        email: document.getElementById('email_email_input')
    };

    var current = {
        password: document.getElementById('current_password'),
        name: document.getElementById('current_name'),
        email: document.getElementById('current_email')
    };

    function updatepassword(){
        current.password.innerHTML = "";

        for(var i = 0; i < input.newpassword.value.length; i++)
        {
            current.password.innerHTML += '•';
        }
    }

    function updatename(){
        document.getElementById('nav_current_name').innerHTML = input.name.value;
        current.name.innerHTML = input.name.value;
    }

    function updateemail(){
        current.email.innerHTML = input.email.value;
    }

    function password_submit(){
        if(input.newpassword.value != input.repassword.value)
        {
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Password did not match.</div>';
            return false;
        }

        password_request = true;
        $(passwordbtn).button('loading');
        return true;
    }

    function name_submit(){
        if(input.name.value == current.name.innerHTML)
        {
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That is your old name.</div>';
            return false;
        }

        name_request = true;
        $(namebtn).button('loading');
        return true;
    }

    function email_submit(){
        if(input.email.value == current.email.innerHTML)
        {
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That is your old email.</div>';
            return false;
        }

        email_request = true;
        $(emailbtn).button('loading');
        return true;
    }

    $('#myModal').on('show.bs.modal', function (e) {
            messagebox.innerHTML = "";
    });

    passwordform.onload = function(){
        var password_message = passwordform.contentDocument.body.innerHTML;
        if(password_request){

            switch(password_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed your password</div>';
                    updatepassword();
                    document.getElementById('the_password_form').reset();
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in changing you password.</div>';
                    break;
                case 'notmatch':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That is not your old password.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }
            password_request = false;
            $(passwordbtn).button('reset');
            passwordform.src = "";
        }
    };

    nameform.onload = function(){
        var name_message = nameform.contentDocument.body.innerHTML;
        if(name_request){
            switch(name_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed your name</div>';
                    updatename();
                    document.getElementById('the_name_form').reset();
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in changing you name.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }
            name_request = false;
            $(namebtn).button('reset');
            nameform.src = "";
        }
    };

    emailform.onload = function(){
        var email_message = emailform.contentDocument.body.innerHTML;
        if(email_request){

            switch(email_message)
            {
                case 'success':
                    messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully changed your email</div>';
                    updateemail();
                    document.getElementById('the_email_form').reset();
                    break;
                case 'error':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is an error in changing you email.</div>';
                    break;
                case 'exists':
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Someone\'s already using the email.</div>';
                    break;
                default:
                    messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
                    break;
            }
            email_request = false;
            $(emailbtn).button('reset');
            emailform.src = "";
        }
    };

    function initpasswordpanel(){
        document.getElementById('the_password_form').reset();
        document.getElementById('panel_title').innerHTML = "Change Password";
        $('.nav-tabs a[href="#passwordpanel"]').tab('show');
    }
    function initnamepanel(){
        document.getElementById('the_name_form').reset();
        document.getElementById('panel_title').innerHTML = "Change Name";
        $('.nav-tabs a[href="#namepanel"]').tab('show');

    }
    function initemailpanel(){
        document.getElementById('the_email_form').reset();
        document.getElementById('panel_title').innerHTML = "Email Change";
        $('.nav-tabs a[href="#emailpanel"]').tab('show');
    }
</script>
</body>
</html>