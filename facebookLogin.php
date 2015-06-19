<html>
  <head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/apiLogin.js"></script>
      

    </script>
  </head>
  
  <body>
    <fb:login-button scope="public_profile,email" id="fbLogin" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status">
    </div>
  </body>
</html>