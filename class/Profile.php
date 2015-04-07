<?php
	class Profile
	{

		function setupComplete()
		{
			if(session_id() == "") //if session isn't already started
			{
				session_start();
      }
      
			$userID = $_SESSION["id"];

			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$setupCompleteQuery = $dbConnection->prepare("UPDATE users SET hasSetUpProfile = 1 WHERE userID = $userID");

			if($setupCompleteQuery->execute())
			{
				return true;
			}
			else
			{
				return "An error has occurred, please try again later.";
			}
		}

		function addInfoToDB($city, $state, $job, $employer, $showEmail, $facebookLink, $twitterLink)
		{
			if(session_id() == "") //if session isn't already started
			{
				session_start();
			}

			$userID = $_SESSION["id"];

			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$setupProfileQuery = $dbConnection->prepare("UPDATE users SET city = ?, state = ?, job = ?, employer = ?, showEmail = ?, facebookLink = ?, twitterLink = ?, hasSetUpProfile = 1 WHERE userID = $userID");

			if($setupProfileQuery->execute(array($city, $state, $job, $employer, $showEmail, $facebookLink, $twitterLink)))
			{
				return true;
			}
			else
			{
				return "An error has occurred, please try again later.";
			}
		}

		function getProfileData($userID)
		{
			include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$getDataQuery = $dbConnection->prepare("SELECT firstName, lastName, gradYear, facebookLink, twitterLink, email, profilePic, city, state, job, employer, showEmail, dateRegistered, hasSetUpProfile FROM users WHERE userID = '$userID'");

			if($getDataQuery->execute())
			{
				$profileData = $getDataQuery->fetchAll(PDO::FETCH_ASSOC);
				return $profileData;
			}
			else
			{
				return false;
			}
		}
    
    function doesProfileExist($id)
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $doesProfileExistQuery = $dbConnection->prepare("SELECT userID FROM users WHERE userID = '$id'");
      
      if($doesProfileExistQuery->execute())
      {
        if($doesProfileExistQuery->rowCount() == 1)
        {
          return true;
        }
        else
        {
          return false;
        }
      }
      else
      {
        return "An error has occurred, please try again later.";
      }

    }

	}
?>