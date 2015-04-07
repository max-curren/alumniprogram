<?php
	class User
	{
		

		function registerUser($email, $password, $firstName, $lastName, $gradYear)
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$password = password_hash($password, PASSWORD_DEFAULT);

			if($this->doesEmailExist($email) == true)
			{
				return "That email already exists.";
			}
			else
			{
				$registerQuery = $dbConnection->prepare("INSERT INTO users (email, password, firstName, lastName, gradYear) VALUES (?, ?, ?, ?, ?)");
				$dataToInsert = array($email, $password, $firstName, $lastName, $gradYear); //used to insert the data into the prepared statement

				if($registerQuery->execute($dataToInsert))
				{
					$this->createUserSession($email, $dbConnection->lastInsertId(), $firstName, $lastName, $gradYear, "default.png", false);

					return true;
				}
				else
				{
					return "An error has occurred, please try again later.";
				}
			}
		}

		function doesEmailExist($email)
		{
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$checkEmailQuery = $dbConnection->prepare("SELECT email FROM users WHERE email = :email");
			$checkEmailQuery->bindParam(":email", $email);
			$checkEmailQuery->execute();

			if($checkEmailQuery->rowCount() > 0)
			{
				return true;
			} 
			else
			{
				return false;
			}
		}

		function loginUser($email, $password)
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$loginQuery = $dbConnection->prepare("SELECT userID, password, firstName, lastName, gradYear, profilePic, hasSetUpProfile FROM users WHERE email = :email");
			$loginQuery->bindParam(":email", $email);
			//$loginQuery->bindParam(":password", $password);
			$loginQuery->execute();

			if($loginQuery->rowCount() > 0)
			{
				$results = $loginQuery->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $results["password"]))
				{
					$this->createUserSession($email, $results["userID"], $results["firstName"], $results["lastName"], $results["gradYear"], $results["profilePic"], $results["hasSetUpProfile"]);
					return true;
				}
				else
				{
					return "That username/password combo does not exist.";
				}
			}
			else
			{
				return "That username/password combo does not exist.";
			}
		}

		function createUserSession($email, $id, $firstName, $lastName, $gradYear, $profilePic, $hasSetUpProfile)
		{
			if(session_id() == "") //if session isn't already started
			{
				session_start();
			}
			
			$_SESSION["email"] = $email;
			$_SESSION["id"] = $id;
			$_SESSION["firstName"] = $firstName;
			$_SESSION["lastName"] = $lastName;
			$_SESSION["gradYear"] = $gradYear;
			$_SESSION["profilePic"] = $profilePic;

			if($hasSetUpProfile == false)
			{
				$_SESSION["needsToSetUpProfile"] = true;
			}
		}

		function getUserList()
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			//if($limitByYear !== false)
			//{
			//	$limitByYear = implode(", ", $limitByYear);
			//	$query = $query . " WHERE gradYear IN ($limitByYear)";
			//}

			$getListQuery = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear, profilePic FROM users ORDER BY gradYear DESC, lastName, firstName");

			if($getListQuery->execute())
			{
				$userList = $getListQuery->fetchAll(PDO::FETCH_ASSOC);
				return $userList;
			}
			else
			{
				return false;
			}
		}

	}
?>