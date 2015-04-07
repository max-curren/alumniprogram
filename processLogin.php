<?php
	
	if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
	{
		include "class/User.php";
		$userObj = new User;

		$result = $userObj->loginUser(strtolower($_POST["email"]), $_POST["password"]);

		if($result === true)
		{
			echo "success";
		}
		else
		{
			echo $result;
		}
	}
	else
	{
		header("Location: index.php");
	}

?>