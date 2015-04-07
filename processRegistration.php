<?php
	if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
	{
		include "class/User.php";
		$userObj = new User;

		$result = $userObj->registerUser(strtolower($_POST["email"]), $_POST["password"], $_POST["firstName"], $_POST["lastName"], $_POST["gradYear"]);

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