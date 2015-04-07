<?php
  if(isset($_POST["isValidRequest"]) && $_POST["isValidRequest"] == true)
  {
    if(session_id() == "") //if session isn't already started
		{
			session_start();
		}
    
    include "class/Connect.php";
    $connectObj = new Connect;
    $results = $connectObj->getRequests($_SESSION["id"]);
      
    if(is_array($results) == true)
    {
      echo json_encode($results);
    }
    else
    {
      echo $results;
    }
  }
?>