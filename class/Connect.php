<?php
	class Connect
	{
    
    function requestConnection($userID, $requestedID)
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $requestConn = $dbConnection->prepare("INSERT INTO connections (connecter_one, connecter_two, status) VALUES ($userID, $requestedID, 1)");
      
      if($requestConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function confirmConnection($userID, $requestedID)
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $confirmConn = $dbConnection->prepare("UPDATE connections SET status = 2 WHERE connecter_one = '$requestedID' AND connecter_two = '$userID'");
      
      if($confirmConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function deleteConnection($userID, $requestedID)
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $deleteConn = $dbConnection->prepare("DELETE FROM connections WHERE (connecter_one = '$userID' OR connecter_two = '$userID') AND (connecter_one = '$requestedID' OR connecter_two = '$requestedID')");
      
      if($deleteConn->execute())
      {
        return true;  
      }
      else
      {
        return "An error has occurred, please try again later.";
      }
    }
    
    function checkConnection($userID, $requestedID) 
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      if($userID == $requestedID) //if this is you
      {
        return 5;
      }
      
      $checkConn = $dbConnection->prepare("SELECT connecter_one, connecter_two, status FROM connections WHERE (connecter_one = '$userID' OR connecter_two = '$userID') AND (connecter_one = '$requestedID' OR connecter_two = '$requestedID')");
      
      if($checkConn->execute())
      {
        if($checkConn->rowCount() > 0)
        {
          $results = $checkConn->fetch(PDO::FETCH_ASSOC);
          
          if($results["status"] == 1) //checks to see who requested first
          {
            if($results["connecter_one"] == $userID)
              return 1;
            else if($results["connecter_one"] == $requestedID)
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
    
    function getRequests($userID)
    {
      include_once "Database.php";
			$dbObj = new Database;
			$dbConnection = $dbObj->connectToDB();
      
      $getRequests = $dbConnection->prepare("SELECT connecter_one, connecter_two FROM connections WHERE connecter_two = '$userID' AND status = 1");
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