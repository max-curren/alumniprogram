<?php
	class Connect
	{
    private $userID;
    private $requestedID;
    
    function __construct($userID = 0, $requestedID = 0)
    {
      $this->userID = $userID;
      $this->requestedID = $requestedID;
    }
    
    function requestConnection()
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $requestConn = $dbConnection->prepare("INSERT INTO connections (connecter_one, connecter_two, status) VALUES ($this->userID, $this->requestedID, 1)");
      
      if($requestConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function confirmConnection()
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $confirmConn = $dbConnection->prepare("UPDATE connections SET status = 2 WHERE connecter_one = '$this->requestedID' AND connecter_two = '$this->userID'");
      
      if($confirmConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function deleteConnection()
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $deleteConn = $dbConnection->prepare("DELETE FROM connections WHERE (connecter_one = '$this->userID' OR connecter_two = '$this->userID') AND (connecter_one = '$this->requestedID' OR connecter_two = '$this->requestedID')");
      
      if($deleteConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function checkConnection() 
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      if($this->userID == $this->requestedID) //if this is you
      {
        return 5;
      }
      
      $checkConn = $dbConnection->prepare("SELECT connecter_one, connecter_two, status FROM connections WHERE (connecter_one = '$this->userID' OR connecter_two = '$this->userID') AND (connecter_one = '$this->requestedID' OR connecter_two = '$this->requestedID')");
      
      if($checkConn->execute())
      {
        if($checkConn->rowCount() > 0)
        {
          $results = $checkConn->fetch(PDO::FETCH_ASSOC);
          
          if($results["status"] == 1) //checks to see who requested first
          {
            if($results["connecter_one"] == $this->userID)
              return 1;
            else if($results["connecter_one"] == $this->requestedID)
              return 4; //the other person requested first, so the user must accept or decline them
          }
          else
          {
            return $results["status"];
          }
        }
        else
        {
          return 0;
        }
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function getRequests()
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $getRequests = $dbConnection->prepare("SELECT connecter_one, connecter_two FROM connections WHERE connecter_two = '$this->userID' AND status = 1");
      if($getRequests->execute())
      {
        $results = $getRequests->fetchAll(PDO::FETCH_ASSOC);
        $info = array();
        
        for($counter = 0; $counter < count($results); $counter++)
        {
          $connecterID = $results[$counter]["connecter_one"];
          $getInfo = $dbConnection->prepare("SELECT userID, firstName, lastName, gradYear, profilePic FROM users WHERE userID = '$connecterID'");
          $getInfo->execute();
          $info[$counter] = $getInfo->fetch(PDO::FETCH_ASSOC);
        }
    
        return $info;
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    
    
	}
?>