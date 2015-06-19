<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/list.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
  </head>
  <body>

  	<?php
  		if(session_id() == "") //if session isn't already started
      {
        session_start();
      }

      if(empty($_SESSION["id"])) //if signed in
      {
          header("Location: index.php");
      }

      $userID = 0;

      if(empty($_GET["t"]) || $_GET["t"] == "" || $_GET["t"] == 0)
      {
        $listType = 0;
      }
      else if($_GET["t"] == 1)
      {
        $listType = 1;
      }
      else if($_GET["t"] == 2)
      {
        if(empty($_GET["id"]) || $_GET["id"] == "")
        {
          $listType = 0;
        }
        else
        {
          $listType = 2;
          $userID = $_GET["id"];
        }
        
      }

  		include "class/User.php";
  		$userObj = new User;

  		if(is_array($userList = $userObj->getUserList($listType, $userID)) != true)
      {
        die($userList);
      }

  		include "includes/header_user.php";
  	?>

  	<main id="userList">
      <?php
        if($listType == 0)
        {
          echo "<h2>List of Registered Alumni</h2>";
          echo '<input type="text" class="search" placeholder="Search" />';
        }
        else if($listType == 1)
        {
          echo "<h2>Connection Requests</h2>";
        }
      ?>

  		<ul class="list">
  			<?php
				for($counter1 = 0; $counter1 < count($userList); $counter1++)
				{
					echo "<li>";
						echo "<img src='profilePics/". $userList[$counter1]["profilePic"] ."' />";
						echo "<div class='info'>";
							echo "<a href='profile.php?id=". $userList[$counter1]["userID"] ."' class='name'>". $userList[$counter1]["firstName"] ." ". $userList[$counter1]["lastName"] . "</a>";
							echo "<p class='gradYear'>Class of ". $userList[$counter1]["gradYear"] ."</p>";
						echo "</div>";
					echo "</li>";
				}

			?>
  		</ul>

      <ul class="pagination"></ul>
    </main>

    <script type="text/javascript" src="js/list.js"></script>
    <script type="text/javascript" src="js/list.pagination.js"></script>

    <script type="text/javascript">
        $(".pagination li a").click(function()
        {
          $(this).css("color", "red");
        });

        var options = 
        {
          valueNames: ['name', 'gradYear'],
          page: 7,
          plugins: [ListPagination({})]
        };

        var userList = new List('userList', options);
    </script>

  </body>
</html>





