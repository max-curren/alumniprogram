<?php
	class User
	{
		public $email;
    private $password;
    private $firstName;
    private $lastName;
    private $gradYear;
    
    function __construct($email = "", $password = "", $firstName = "", $lastName = "", $gradYear = "")
    {
      $this->email = $email;
      $this->password = $password;
      $this->firstname = $firstName;
      $this->lastname = $lastName;
      $this->gradYear = $gradYear;
    }

		function registerUser()
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$password = password_hash($this->password, PASSWORD_DEFAULT);

			if($this->doesEmailExist($this->email) == true)
			{
				return "That email already exists.";
			}
			else
			{
				$registerQuery = $dbConnection->prepare("INSERT INTO users (email, password, firstName, lastName, fullName, gradYear) VALUES (?, ?, ?, ?, ?, ?)");
				$fullName = $this->firstName . " " . $this->lastName;
				$dataToInsert = array($this->email, $this->password, $this->firstName, $this->lastName, $fullName, $this->gradYear); //used to insert the data into the prepared statement

				if($registerQuery->execute($dataToInsert))
				{
					$this->createUserSession($this->email, $dbConnection->lastInsertId(), $this->firstName, $this->lastName, $this->gradYear, "default.png", false);

					return true;
				}
				else
				{
					return "An error has occurred, please try again later.";
				}
			}
		}

		private function doesEmailExist($email)
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

		function loginUser($rememberMe)
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			$loginQuery = $dbConnection->prepare("SELECT userID, password, firstName, lastName, gradYear, profilePic, hasSetUpProfile FROM users WHERE email = :email");
			$loginQuery->bindParam(":email", $this->email);
			//$loginQuery->bindParam(":password", $password);
			$loginQuery->execute();

			if($loginQuery->rowCount() > 0)
			{
				$results = $loginQuery->fetch(PDO::FETCH_ASSOC);
				if(password_verify($this->password, $results["password"]))
				{
					$this->createUserSession($this->email, $results["userID"], $results["firstName"], $results["lastName"], $results["gradYear"], $results["profilePic"], $results["hasSetUpProfile"]);
					

					if($rememberMe == "true")
					{
						$this->setCookies($results);
					}

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

		private function setCookies($results)
		{
			setcookie("userDetails[email]", $this->email, time() + 2592000);
			setcookie("userDetails[id]", $results["userID"], time() + 2592000);
			setcookie("userDetails[firstName]", $results["firstName"], time() + 2592000);
			setcookie("userDetails[lastName]", $results["lastName"], time() + 2592000);
			setcookie("userDetails[gradYear]", $results["gradYear"], time() + 2592000);
			setcookie("userDetails[profilePic]", $results["profilePic"], time() + 2592000);
			setcookie("userDetails[hasSetUpProfile]", $results["hasSetUpProfile"], time() + 2592000);
		}

		function cookieLogin($userDetails)
		{
			$this->createUserSession($userDetails["email"], $userDetails["id"], $userDetails["firstName"], $userDetails["lastName"], $userDetails["gradYear"], $userDetails["profilePic"], $userDetails["hasSetUpProfile"]);
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

		function getUserList($type, $userID = 0) //types- 0 = all, 1 = requests, 2 = friends
		{
			include "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();

			//if($limitByYear !== false)
			//{
			//	$limitByYear = implode(", ", $limitByYear);
			//	$query = $query . " WHERE gradYear IN ($limitByYear)";
			//}

			if($type == 0)
			{
				$getListQuery = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear, profilePic FROM users ORDER BY gradYear DESC, lastName, firstName");
			}
			else if($type == 1)
			{
				if(session_id() == "") //if session isn't already started
				{
					session_start();
				}

				include "Connect.php";
				$connectObj = new Connect($_SESSION["id"]);

				return $connectObj->getRequests();
			}
			else if($type == 2)
			{
				include "Connect.php";
				$connectObj = new Connect($userID);

				return $connectObj->getConnections();
			}
			else
			{
				return "ERROR: Invalid list type.";
			}

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