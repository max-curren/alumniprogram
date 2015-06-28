<?php
	
	if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
	{
		include "class/User.php";
		$userObj = new User(strtolower($_POST["email"]), $_POST["password"]);
		$result = $userObj->loginUser($_POST["rememberMe"]);

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