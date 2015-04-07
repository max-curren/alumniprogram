$(document).ready(function() 
{

	var currentDivIndex = 0;

	//shows popup after setUpProfile.php is included
	$("main").addClass("popup-shadow");
	$("#setUpProfilePopup").show("slow");


	$("#skipButton").click(function(e)
	{
		e.preventDefault();

		if(confirm("Are you sure you want to skip?\nYou can set up your profile later by going to Settings.") == true)
		{
			$("main").removeClass("popup-shadow");
			$("#setUpProfilePopup").hide("slow");

			var ajaxRequest = $.ajax
			({
				type: "POST",
				url: "setUpProfile.php",
				data: {isValidRequest: true, skip: true}
			});

			ajaxRequest.done(function(msg)
			{
			  	if(msg != "success")
			  	{
			  		alert(msg);
			  	}
			});

			ajaxRequest.fail(function(jqXHR, error)
			{
				alert(("An error has occurred: " + error));
			});
		}
	});

	$("#startButton").click(function(e)
	{
		e.preventDefault();

		currentDivIndex++;

		$("#welcome-area").hide("fast");
		$("#location-area").show("fast");
		$("#buttonGroup").show("fast");


	});

	$("#nextButton").click(function(e)
	{
		e.preventDefault();

		if(checkInputFields(currentDivIndex) == true)
		{
			$("#errors").text("");

			var currentDiv = getDivName(currentDivIndex);
			currentDivIndex++;
			var nextDiv = getDivName(currentDivIndex);

			$(currentDiv).hide("fast");
			$(nextDiv).show("fast");

			if(currentDivIndex == 4)
			{
				$("#nextButton").hide("fast");
				$("#doneButton").show("fast");
			}
		}
		else
		{
			$("#errors").text("Please fill in the required fields");
		}
	});

	
	$("#backButton").click(function(e)
	{
		e.preventDefault();

		$("#errors").text("");

		currentDivIndex--;
		if(currentDivIndex > 0)
		{
			var currentDiv = getDivName(currentDivIndex + 1);

			var nextDiv = getDivName(currentDivIndex);

			$(currentDiv).hide("fast");
			$(nextDiv).show("fast");

			if(currentDivIndex == 3)
			{
				$("#doneButton").hide("fast");
				$("#nextButton").show("fast");
			}
		}
		else
		{
			$("#welcome-area").show("fast");
			$("#location-area").hide("fast");
			$("#buttonGroup").hide("fast");
		}
	});

	$("#doneButton").click(function(e)
	{
		e.preventDefault();

		var city = $("#city").val();
		var state = $("#state").val();
		var job = $("#job").val();

		var employer;
		if($("#employer").val() == "")
		{
			employer = null;
		}
		else
		{
			employer = $("#employer").val();
		}

		var showEmail = $("#showEmail").val();

		var facebookLink;
		if($("#facebookLink").val() == "")
		{
			facebookLink = null;
		}
		else
		{
			facebookLink = $("#facebookLink").val();
		}
		
		var twitterLink;
		if($("#twitterLink").val() == "")
		{
			twitterLink = null;
		}
		else
		{
			twitterLink = $("#twitterLink").val();
		}

		var ajaxRequest = $.ajax
		({
			type: "POST",
			url: "setUpProfile.php",
			data: {isValidRequest: true, city: city, state: state, job: job, employer: employer, showEmail: showEmail, facebookLink: facebookLink, twitterLink: twitterLink}
		});

		ajaxRequest.done(function(msg)
		{
			
			if(msg != "success")
			{
				$("#errors").text(msg);
			}
      else
      {
        $(getDivName(4)).hide("fast");
        $("#buttonGroup").hide("fast");
        $("#finished-area").show("fast");    
        
        //hide the popup after two seconds
        $("main").delay(2000).removeClass("popup-shadow");
        $("#setUpProfilePopup").delay(2000).hide("fast");
      }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
      $("#errors").text("An error has occurred: " + error);
		});



	});
  
  

});

function getDivName(index)
{
	switch(index)
	{
		case 0:
			return "#welcome-area";
		break;

		case 1:
			return "#location-area";
		break;

		case 2:
			return "#job-area";
		break;

		case 3:
			return "#contact-area";
		break;

		case 4:
			return "#picture-area";
		break;
      
    case 5:
      return "#finished-area";
    break;
	}
}

//function isValidZip(zipCode)
//{
	//return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zipCode);
//}

function checkInputFields(index)
{
	var noErrors = true;

	if(index == 1)
	{
		if($("#city").val() == "")
		{
			noErrors = false;

			$("#city").addClass("inputError");
		}
		else
		{
			$("#city").removeClass("inputError");
		}

		if($("#state").val() == "default")
		{
			noErrors = false;

			$("#state").addClass("inputError");	
		}
		else
		{
			$("#state").removeClass("inputError");
		}

		return noErrors;
	}

	if(index == 2)
	{
		if($("#job").val() == "")
		{
			noErrors = false;

			$("#job").addClass("inputError");
		}
		else
		{
			$("#job").removeClass("inputError");
		}
	}

	return noErrors;
}