<?php
  if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
  {
    
    if(session_id() == "") //if session isn't already started
    {
      session_start();
    }
    
    $userID = $_SESSION["id"];
    $requestedID = $_POST["requestedID"];
    
    include "class/Connect.php";
    $connectObj = new Connect($userID, $requestedID);

    
    
    $result;
    
    if($_POST["desiredStatus"] == 1)
    {
      $result = $connectObj->requestConnection($userID, $requestedID);
    }
    else if($_POST["desiredStatus"] == 2)
    {
      $result = $connectObj->confirmConnection($userID, $requestedID);
    }
    else if($_POST["desiredStatus"] == 3)
    {
      $result = $connectObj->deleteConnection($userID, $requestedID);
    }
    
    if($result === true)
    {
      echo "success";
    }
    else
    {
      echo $result;
    }
    
  }
  
?>