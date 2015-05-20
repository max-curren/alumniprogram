<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
    

  </head>
  <body>

  <?php
      
  	include "includes/header_user.php";


	if(isset($_GET["t"]) && trim($_GET["t"]) != "")
	{
		$terms = trim($_GET["t"]);

		include "class/Search.php";
		$searchObj = new Search;
		
		$searchObj->setTerms($terms);
		$results = $searchObj->searchForTerms();

		if($results !== false)
		{
			for($counter = 0; $counter < sizeof($results); $counter++)
			{
				echo "<li>";
					echo "<img src='profilePics/". $results[$counter]["profilePic"] ."' />";
					echo "<div class='info'>";
						echo "<a href='profile.php?id=". $results[$counter]["userID"] ."' class='name'>". $results[$counter]["firstName"] ." ". $results[$counter]["lastName"] . "</a>";
						echo "<p class='gradYear'>Class of ". $results[$counter]["gradYear"] ."</p>";
					echo "</div>";
				echo "</li>";
			}
		}
		else
		{
			echo "An error has occurred, please try again later.";
		}
	}
	else
	{
		echo "You didn't search for anyone!";
	}

?>