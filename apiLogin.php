<?php

	if($_POST["isValidRequest"] == true)
	{
		include "class/User.php";
		$userObj = new User;

		if($_POST["type"] == "FB") //Facebook
		{
			if($userObj->doesEmailExist($_POST["email"]) == true && )
			{

			}
			else
			{

			}
		}
		else if($_POST["type"] == "T") //Twitter
		{

		}
	}

?>