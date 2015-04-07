<h3 class="centered-text">About Me</h3>

<ul>
	<span class="title">Location</span>
    <li>
    <?php
    	echo $profileData[0]["city"] . ", " . $profileData[0]["state"];
    ?>
    </li>
</ul>

            
<ul>
    <span class="title">Current Job</span>

    <li>
        <?php
            echo $profileData[0]["job"];

            if($profileData[0]["employer"] != "" && $profileData[0]["employer"] != null)
        	{
            	echo " at " . $profileData[0]["employer"]; 
        	}
        ?>
    </li>

    <?php
        if($profileData[0]["employer"] != "" && $profileData[0]["employer"] != null)
        {
            echo "<li><span>Current Employer:</span>" . $profileData[0]["employer"] . "</li>";
        }
    ?>

</ul>

<ul> 
    <span class="title">Contact Information</span>

        <?php
            if($profileData[0]["showEmail"] == true)
            {
                echo "<li><span>Email:</span> <a href='mailto:" . $profileData[0]["email"] . "'>" . $profileData[0]["email"] . "</a></li>";
            }

            if($profileData[0]["facebookLink"] != "" && $profileData[0]["facebookLink"] != null)
            {
            	echo "<li><span>Facebook:</span> <a href='" . $profileData[0]["facebookLink"] . "'>" . $profileData[0]["facebookLink"] . "</a></li>";
            }

            if($profileData[0]["twitterLink"] != "" && $profileData[0]["twitterLink"] != null)
            {
            	echo "<li><span>Twitter:</span> <a href='" . $profileData[0]["twitterLink"] . "'>" . $profileData[0]["twitterLink"] . "</a></li>";
            }
        ?>
</ul>
