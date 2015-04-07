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

		include "class/User.php";
		$userObj = new User;

		$userList = $userObj->getUserList();

		include "includes/header_user.php";
	?>

  	<main id="userList">
  		<h2>List of Registered Alumni</h2>
      <input type="text" class="search" placeholder="Search (name or year)" />

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





