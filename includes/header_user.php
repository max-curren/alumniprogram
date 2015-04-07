<?php
	if(session_id() == "") //if session isn't already started
	{
		session_start();
	}
			
?>
<script type="text/javascript" src="js/header.js"></script>

<header>
    <a id="logo" href="index.php">BFHS Alumni Network</a>

    <div id="header-user-group">
      <div id='info-group'>
        <?php
          echo "<a href='profile.php'>". $_SESSION["firstName"] ." ". $_SESSION["lastName"] ."</p>";
        ?>
          
        <a class="dropdown-toggle" id='more-toggle' href='#'><img src='icons/dots.png' /></a>
        <a class="dropdown-toggle" id='messages-toggle' href='#'><img src='icons/chat.png' /></a>
        <a class="dropdown-toggle" id='requests-toggle' href='#'><img src='icons/requests.png' /></a>
      </div>
      <?php
	    	echo "<div id='img-container'><img src='profilePics/". $_SESSION["profilePic"] ."' /></div>";
    	?>
    </div>
      
    
 

</header>

<div class="dropdown" id="requests-dropdown">
  <h1>Connection Requests</h1>
  
  <img id="loading-icon" src="icons/ajax-loader.gif" />
  <ul>
    
  </ul>
</div>

<div class="dropdown" id="messages-dropdown">

</div>

<div class="dropdown" id="more-dropdown">
    <a href="settings.php">
      <img src="icons/settings.png" />
      <span>Settings</span>
    </a>

    <a href="logout.php">
      <img src="icons/minus.png" />
      <span>Logout</span>
    </a>
</div>