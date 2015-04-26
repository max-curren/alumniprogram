<html>
   <head>
     <title>Requests</title>
     <link href="css/main.css" rel="stylesheet" />
     <link href="css/requests.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.js"></script>
  </head>
  <body>
    <?php
      include "includes/header_user.php";
      include "class/Connect.php";
      $connectObj = new Connect($_SESSION["id"]);

      $requestList = $connectObj->getRequests();
      if(is_array($requestList) != true)
      {
        echo $results;
      }

    ?>
    
    <main id="userList">
  		<h2>Connection Requests</h2>
      
  		<ul class="list">
  			<?php
				for($counter1 = 0; $counter1 < count($requestList); $counter1++)
				{
					echo "<li>";
						echo "<img src='profilePics/". $requestList[$counter1]["profilePic"] ."' />";
						echo "<div class='info'>";
							echo "<a href='profile.php?id=". $requestList[$counter1]["userID"] ."' class='name'>". $requestList[$counter1]["firstName"] ." ". $requestList[$counter1]["lastName"] . "</a>";
							echo "<p class='gradYear'>Class of ". $requestList[$counter1]["gradYear"] ."</p>";
						echo "</div>";
					echo "</li>";
				}

			?>
  		</ul>

    </main>
  </body>
</html>