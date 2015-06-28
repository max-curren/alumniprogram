

<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/profile.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/profile.js"></script>
  </head>
  <body>
      <?php
        if(session_id() == "") //if session isn't already started
        {
          session_start();
        }

        if(isset($_SESSION["id"]) && isset($_COOKIE["userDetails"])) //if signed in
        {
            if(!isset($_GET["id"]) || $_GET["id"] == "")
            {
                header("Location: profile.php?id=" . $_SESSION["id"]);
            }
        }
        else
        {
            header("Location: index.php");
        }

        if(!isset($_SESSION["id"] && isset($_COOKIE["userDetails"]))
        {
          include_once "class/User.php";
          $userObj = new User();
          $userObj->cookieLogin($_COOKIE["userDetails"]);
        }


        include "class/Profile.php";
        $profileObj = new Profile;

        $doesProfileExist = $profileObj->doesProfileExist($_GET["id"]);
        if($doesProfileExist === true)
        {
          $profileData = $profileObj->getProfileData($_GET["id"]);
        }
        else
        {
          header("Location: profile.php?id=" . $_SESSION["id"]);
        }
        
        

        include "includes/header_user.php";

        if($profileData === false)
        {
          die("An error has occurred, please try again later.");
        }

        
      ?>

      <div id="centerWrapper">
        <main>
            <?php
                echo "<div id='profilePic'>";
                  echo "<img  src='profilePics/". $profileData[0]["profilePic"] . "' />";
                echo "</div>";

                echo "<div class='main-info'>";
                  echo "<p id='fullName'>". $profileData[0]["firstName"] ." ". $profileData[0]["lastName"] ."</p>";
                  echo "<p id='class'>Class of ". $profileData[0]["gradYear"] ."</p>";
                  
                  include "class/Connect.php";
                  $connectObj = new Connect($_SESSION["id"], $_GET["id"]);
                  $connectionStatus = $connectObj->checkConnection();

                    if($connectionStatus == 0)
                    {
                      echo "<a href='#' id='request-btn' class='button-grey connectionButton'><img src='icons/connect.png' /><span>Connect</span></a>";
                    }
                    else if($connectionStatus == 1)
                    {
                      echo "<a href='#' id='requested-btn' class='button-grey connectionButton'><img src='icons/message.png' /><span>Requested</span></a>";
                    }
                    else if($connectionStatus == 2)
                    {
                      echo "<a href='#' id='confirmed-btn' class='button-grey connectionButton'><img src='icons/check59.png' /><span>Connected</span></a>";
                    }
                    else if($connectionStatus == 4)
                    {
                      echo "<p id='requestHeader'>". $profileData[0]["firstName"] . " " . $profileData[0]["lastName"] . " has requested to follow you: </p>";
                      echo "<a href='#' id='acceptRequest-btn' class='button-grey connectionButton'><img src='icons/checkmark.png' /><span>Accept</span></a>";
                      echo "<a href='#' id='rejectRequest-btn' class='button-grey connectionButton'><img src='icons/cross.png' /><span>Reject</span></a>";
                    }
                    
                 

                echo "</div>";
            ?>


        </main>

        <aside>
            <?php
                if($connectionStatus === 0)
                {
                  echo "<span id='notConnected' class='centered-text'>Please connect with ". $profileData[0]["firstName"] ." ". $profileData[0]["lastName"] ." in order to view their profile.</span>";
                }
                else if($connectionStatus == 1)
                {
                  echo "<span id='notConnected' class='centered-text'>You will be able to view ". $profileData[0]["firstName"] ." ". $profileData[0]["lastName"] ."'s profile after they accept your connection request.</span>";
                }
                else if($connectionStatus == 4)
                {
                  echo "<span id='notConnected' class='centered-text'>Please accept ". $profileData[0]["firstName"] ." ". $profileData[0]["lastName"] ."'s connection request in order to view their profile.</span>";
                }
                else
                {
                    include "includes/profileInfo.php";
                }
            ?>
            

        </aside>
      </div>


    

  </body>
</html>