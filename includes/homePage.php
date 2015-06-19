<link href="css/homepage.css" rel="stylesheet" />
<script type="text/javascript" src="js/register.js"></script>
<script type="text/javascript" src="js/login.js"></script>



<div id='header-group'>
  <img src="images/logo.png" />
  <h2>Alumni Network</h2>
  
  <a href="#" id="loginPopup-toggle" class="button-gold">Login</a>
  <a href="#" id="registerPopup-toggle" class="button-gold">Register</a>
</div>



<div class="centered-popup" id="registerPopup">
  <form id="registrationForm">
    <h2 class="centered-text">Register</h2>

    <input type="email" name="email" id="reg-email" placeholder="Email" />
    <input type="password" id="reg-password" placeholder="Password" />
    <input type="text" name="firstName" id="reg-firstName" placeholder="First Name" />
    <input type="text" name="lastName" id="reg-lastName" placeholder="Last Name" />
    <select id="reg-gradYear">
      <option value="default">Graduation Year</option>
      <!-- Options are added through register.js -->
    </select>
    <input type="button" id="reg-submit" value="Register" />

    <span id="registrationErrors" class="error-span centered-text"></span>
  </form>
</div>

<div class="centered-popup" id="loginPopup">
  <form id="loginForm">
    <h2 class="centered-text">Login</h2>

    <input type="email" name="email" id="login-email" placeholder="Email" />
    <input type="password" id="login-password" placeholder="Password" />
    <input type="button" id="login-submit" value="Login" />

    <span id="loginErrors" class="error-span centered-text"></span>
  </form>
</div>

<main>
    
</main>