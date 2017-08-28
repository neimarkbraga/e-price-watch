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
<body role="document">
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>Change Password</h4>
            </div>
            <div class="modal-body">
                <div id="my_message_box">
                    <!--<div class="alert alert-success" role="alert"><b>Well done!</b> You successfully read this important alert message.</div>-->
                </div>
                <iframe id="password_iframe" name="password_iframe" src="" style="display:none;" ></iframe>
                <form id="the_password_form" action="library/adminpasswordform.php" target="password_iframe" method="post" onsubmit="return password_submit();">
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addonsad2"><span class="glyphicon glyphicon-lock"></span> </span>
                        <input type="password" class="form-control" name="OLDPASSWORD" placeholder="Old Password" aria-describedby="basic-addon2" required />
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
                    <input type="submit" class="btn btn-info pull-right" id="passwordbtn" data-loading-text="Changing password..." value="Change" />
                    <div style="clear:both;"></div>
                </form>

            </div>
        </div>
    </div>
</div>     <!-- Fixed navbar -->

<?php include('library/navbar.php'); ?>


<div class="container">
    <div style="width: 100%; height: 80px;"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Account Settings</h3>
            <small>
                <ol class="breadcrumb">
                  <li><a href="adminpanel.php">Admin Dashboard</a></li>
                  <li><a href="managecategory.php">Manage Category</a></li>
                  <li><a href="manageproduct.php">Manage Product</a></li>
                  <li><a href="sitesettings.php">Site Settings</a></li>
                  <li class="active">Account Settings</li>
                </ol>
            </small>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="container">
                    <?php
                        $pass = '';
                        $sql = 'SELECT * FROM admin_account WHERE ID = 1';
                        $result = mysqli_query( $con, $sql);
                        if($row = mysqli_fetch_array($result))
                        {
                            $pass = $row['PASSWORD'];
                        }

                        $ii = strlen($pass);
                        $pass = '';
                        for($i = 0; $i < $ii; $i++)
                        {
                            $pass .= '•';
                        }
                    ?>
                    <table class="table">
                        <tr>
                            <td><b>Username: </b></td>
                            <td>Admin</td>
                            <td><span class="label label-default">Cannot be changed</span></td>
                        </tr>
                        <tr>
                            <td><b>Password: </b></td>
                            <td id="current_password"><?php echo $pass; ?></td>
                            <td><a href="#" class="btn btn-primary" data-toggle="modal" onclick="document.getElementById('the_password_form').reset();" data-target="#myModal">Change</a></td>
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
<script type="text/javascript">
    var password_request = false;
    var passwordbtn = "#passwordbtn";
    var passwordform = document.getElementById('password_iframe');
    var messagebox = document.getElementById("my_message_box");
    var newpassword = document.getElementById('password_new_input');
    var repassword = document.getElementById('password_re_input');
    var currentpassword = document.getElementById('current_password');

    function password_submit()
    {
        if(repassword.value != newpassword.value)
        {
            messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Password did not match.</div>';
            return false;
        }

        password_request = true;
        $(passwordbtn).button('loading');
        return true;
    }

    function changepassword()
    {
        currentpassword.innerHTML = "";

        for(var i = 0; i < newpassword.value.length; i++)
        {
            currentpassword.innerHTML += '•';
        }
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
                    changepassword();
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

</script>
</body>
</html>