<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
    

  </head>
  <body>

  <?php
    if(session_id() == "") //if session isn't already started
    {
      session_start();
    }

    if(isset($_SESSION["id"])) //if signed in
    {
      include "includes/header_user.php";
      include "includes/dashboard.php";
    }
    else
    {
      include "includes/homePage.php";
    }
    

  ?>


  

  <footer>

  </footer>

  <!--
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD54bT-gD6S7Tm3spK8eCSUtpbHA1J97Uc"></script>
    <script type="text/javascript" src="js/maptest.js"></script>

    <div id="map-canvas"></div>
  -->

  </body>
</html>