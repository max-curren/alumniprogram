<script type="text/javascript" src="js/dashboard.js"></script>



<main>
	<br /><br /><a href="list.php">Full list of alumni</a><br /><br />
  (Will add more content later)
</main>

<?php
	if(isset($_SESSION["needsToSetUpProfile"]) && $_SESSION["needsToSetUpProfile"] == true)
	{
		include "setUpProfilePopup.php";
	}
?>