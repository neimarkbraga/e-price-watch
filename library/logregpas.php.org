<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified" role="tablist">
              <li role="presentation" class="active"><a href="#loginpanel" aria-controls="loginpanel" role="tab" data-toggle="tab">Login</a></li>
              <li role="presentation"><a href="#registerpanel" aria-controls="registerpanel" role="tab" data-toggle="tab">Register</a></li>
              <li role="presentation"><a href="#forgotpasswordpanel" aria-controls="forgotpasswordpanel" role="tab" data-toggle="tab">Forgot Password</a></li>
            </ul>
          </div>
          <div class="modal-body">
            <div id="my_message_box">
              <!--<div class="alert alert-success" role="alert"><b>Well done!</b> You successfully read this important alert message.</div>-->
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
              <!--LOGIN-->
              <div role="tabpanel" class="tab-pane fade in active" id="loginpanel">
                <iframe id="login_iframe" name="login_iframe" src="" style="display:none;"></iframe>
                <form action="library/loginform.php" method="post" target="login_iframe" onsubmit="$('#loginbutton').button('loading'); loginrequest=true;">

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="
glyphicon glyphicon-user"></span> </span>
                    <input type="text" class="form-control" name="USERNAME" placeholder="Username" aria-describedby="basic-addon1" required />
                  </div>
                  <br />
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span> </span>
                    <input type="password" class="form-control" name="PASSWORD" placeholder="Password" aria-describedby="basic-addon2" required />
                  </div>

                  <br />
                  <input type="submit" class="btn btn-info pull-right" id="loginbutton" data-loading-text="Logging in..." value="Login" />
                  <div style="clear:both;"></div>
                </form>

              </div>

              <!--REGISTER-->
              <div role="tabpanel" class="tab-pane fade" id="registerpanel">
                <iframe id="register_iframe" name="register_iframe" src="" style="display:none;"></iframe>
                <form action="library/registerform.php" id="the_reg_form" method="post" target="register_iframe" onsubmit="return register_submit();">

                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-user"></span> </span>
                    <input type="text" class="form-control" name="USERNAME" placeholder="Username" aria-describedby="basic-addon3" required />
                  </div>
                  <br />
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4"><span class="glyphicon glyphicon-italic"></span> </span>
                    <input type="text" class="form-control" name="NAME" placeholder="Name" aria-describedby="basic-addon4" required />
                  </div>
                  <br />
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5"><span class="glyphicon glyphicon-envelope"></span> </span>
                    <input type="email" class="form-control" name="EMAIL" placeholder="Email" aria-describedby="basic-addon5" required />
                  </div>

                  <br />
                  <input type="submit" class="btn btn-info pull-right" id="registerbtn" data-loading-text="Registering..." value="Register" />
                  <div style="clear:both;"></div>
                </form>
              </div>

              <!--Password-->
              <div role="tabpanel" class="tab-pane fade" id="forgotpasswordpanel">
                <iframe id="password_iframe" name="password_iframe" src="" style="display:none;"></iframe>
                <form action="library/passwordform.php" method="post" target="password_iframe" onsubmit="return password_submit();">
                  <p>We will send your password to the email that you registered here.</p>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon6"><span class="glyphicon glyphicon-envelope"></span> </span>
                    <input type="email" class="form-control" name="EMAIL" placeholder="Email" aria-describedby="basic-addon6" required />
                  </div>

                  <br />
                  <input type="submit" class="btn btn-info pull-right" id="passwordbtn" data-loading-text="Sending password to your email..." value="Get my password" />
                  <div style="clear:both;"></div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>