<?php
	session_start();
	session_destroy();

	//if(isset($_COOKIE["userDetails"]))
	//{
		unset($_COOKIE["userDetails"]);

		setcookie("userDetails[email]", "", time() - 3600);
		setcookie("userDetails[id]", "", time() - 3600);
		setcookie("userDetails[firstName]", "", time() - 3600);
		setcookie("userDetails[lastName]", "", time() - 3600);
		setcookie("userDetails[gradYear]", "", time() - 3600);
		setcookie("userDetails[profilePic]", "", time() - 3600);
		setcookie("userDetails[hasSetUpProfile]", "", time() - 3600);
	//}

	header("Location: index.php");
?>