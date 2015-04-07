<?php
	
	if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
	{
		if(isset($_POST["skip"]) && $_POST["skip"] == true)
		{
			include "class/Profile.php";
			$profileObj = new Profile;

			$result = $profileObj->setupComplete();

			if($result === true)
			{
				$_SESSION["needsToSetUpProfile"] = false;

				echo "success";
			}
			else
			{
				echo $result;
			}
		}
		else
		{
			$city = $_POST["city"];
			$state = $_POST["state"];
			$job = $_POST["job"];
			$employer = $_POST["employer"];
			$facebookLink = $_POST["facebookLink"];
			$twitterLink = $_POST["twitterLink"];
			$showEmail;
			
			if($_POST["showEmail"] == "on")
			{
				$showEmail = true;
			}
			else
			{
				$showEmail = false;
			}

			include "class/Profile.php";
			$profileObj = new Profile;

			$result = $profileObj->addInfoToDB($city, $state, $job, $employer, $showEmail, $facebookLink, $twitterLink);

			if($result === true)
			{
				$_SESSION["needsToSetUpProfile"] = false;

				echo "success";
			}
			else
			{
				echo $result;
			}
		}

	}
	
	else
	{
		header("Location: index.php");
	}
	

?>