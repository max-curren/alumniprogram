$(document).ready(function() 
{
	var displayLimit = 5;
	var slideSpeed = 100;

	$("#searchbox").keyup(function()
	{
		var terms = $.trim($("#searchbox").val());

		if(terms !== "")
		{
			var ajaxRequest = $.ajax
			({
				type: "POST",
				url: "processSearch.php",
				dataType: "json",
				data: {isValidRequest: true, terms: terms}
			});

			ajaxRequest.done(function(results)
			{
			  	if(results !== "false" && results.length !== 0)
			  	{
			  		$("#suggestions ul").empty();
			  		
			  		for(var counter = 0; counter < results.length && counter < displayLimit; counter++)
			  		{
			  			$("#suggestions ul").append("<li><a href='profile.php?id=" + results[counter].userID + "'><img class='profilePic' src='profilePics/" + results[counter].profilePic + "' /><div class='info'><span class='name'>" + results[counter].firstName + " " + results[counter].lastName + "</span><span class='gradYear'>Class of " + results[counter].gradYear + "</span></div></a></li>");

			  		}

			  		if(results.length > displayLimit)
			  		{
			  			$("#suggestions ul").append("<li id='viewAll'><a href='search.php?t=" + terms + "'>View all " + results.length + " results");
			  		}

			  		$("#suggestions").slideDown(slideSpeed);
			  	}
			  	else
			  	{
					$("#suggestions").slideUp(slideSpeed, function()
					{
						$("#suggestions ul").empty();
					});
					
			  	}
			});

			ajaxRequest.fail(function(jqXHR, error)
			{
				$("#registrationErrors").text("Registration failed: " + error);
			});
		}
		else
		{
			$("#suggestions").slideUp(slideSpeed, function()
			{
				$("#suggestions ul").empty();
			});
		}
	});

	

});