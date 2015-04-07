<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/register.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
    
  </head>
  <body>

  	<header>
		<h1>BFHS Alumni Network</h1>
	</header>

	<main>
		
	<div class="centeredPopup" id="registerPopup">
      <form id="registrationForm">
        <h2>Register</h2>
        <input type="email" id="reg-email" placeholder="Email" />
        <input type="password" id="reg-password" placeholder="Password" />
        <input type="text" id="reg-firstName" placeholder="First Name" />
        <input type="text" id="reg-lastName" placeholder="Last Name" />
        <select id="reg-gradYear">
          <option value="default">Graduation Year</option>
          <!-- Options are added through register.js -->
        </select>
        <input type="button" id="reg-submit" value="Register" />

        <span id="registrationErrors" class="error-form"></span>
      </form>
  	</div>

		<p id="registrationErrors"></p>
	</main>

  </body>
</html>