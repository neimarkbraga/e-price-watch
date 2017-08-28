var password_request = false;
      var register_request = false;
      var loginrequest = false;
      var passwordform = document.getElementById("password_iframe");
      var loginform = document.getElementById("login_iframe");
      var registerform = document.getElementById("register_iframe");
      var messagebox = document.getElementById("my_message_box");
      register_btn = "#registerbtn";
      password_btn = "#passwordbtn";

      function register_submit(){

        register_request = true;
        $(register_btn).button('loading');
        return true;
      }

      function password_submit(){

        password_request = true;
        $(password_btn).button('loading');
        return true;
      }

      registerform.onload = function() {
        var registerresult = registerform.contentDocument.body.innerHTML;
        if(register_request)
        {

          switch(registerresult)
          {
            case 'success':
              messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> You have successfully created an account. Get your password in your email. We recommend to change your password immediately. note: If you cannot find the message in email, check the spam section.</div>';
              document.getElementById('the_reg_form').reset();
              break;
            case 'userexists':
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Someone\'s already using that username.</div>';
              break;
            case 'emailexists':
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> Someone\'s already using that email.</div>';
              break;
            case 'error':
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a bug or problem.</div>';
              break;
            default:
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
              break;
          }

          register_request = false;
          $(register_btn).button('reset');
          registerform.src = "";
        }

      };

      passwordform.onload = function() {
        var passwordresult = passwordform.contentDocument.body.innerHTML;
        if(password_request)
        {

          switch(passwordresult)
          {
            case 'success':
              messagebox.innerHTML = '<div class="alert alert-success" role="alert"><b>Success!</b> Your password was delivered in your email. We recommend to change your password immediately. note: If you cannot find the message in email, check the spam section.</div>';
              break;
            case 'noexist':
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> That email is not registered in our system.</div>';
              break;
            case 'error':
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a bug or problem.</div>';
              break;
            default:
              messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
              break;
          }

          password_request = false;
          $(password_btn).button('reset');
          passwordform.src = "";
        }

      };



          $('#myModal').on('shown.bs.modal', function (e) {
            messagebox.innerHTML = "";
          });

          
        loginform.onload = function() {
          var loginresult = loginform.contentDocument.body.innerHTML;

            if(loginrequest){
              if(loginresult == 'admin')
              {
                loginform.src = "";
                window.location = "adminpanel.php";
              }
              else if(loginresult == 'user')
              {
                loginform.src = "";
                window.location = "userpanel.php";
              }
              else if(loginresult == 'false')
              {
                messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> You entered wrong Username or password.</div>';
              }
              else
              {
                messagebox.innerHTML = '<div class="alert alert-danger" role="alert"><b>Oh Snap!</b> There is a problem with the server or connection</div>';
              }

              loginform.src = "";
              loginrequest = false;
             $('#loginbutton').button('reset');
            }
      };