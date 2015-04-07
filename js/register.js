$(document).ready(function() {

	//add options to #gradYear ranging from 1961 to 2014
	for(var year = new Date().getFullYear(); year >= 1961; year--)
	{
		$("#reg-gradYear").append("<option value='" + year + "'>" + year + "</option>");
	}

	
	//toggle Registration window
	$("#registerPopup-toggle").click(function(e)
	{
		e.preventDefault();

		$("main").addClass("popup-shadow");		
		$("#registerPopup").show("fast");
	});
	
	//remove shadow and exit popup
	$("main").click(function()
	{
		$("main").removeClass("popup-shadow");
		$("#registerPopup").hide("fast");
	});


	//if enter key is pressed
	$("#registrationForm").children().keypress(function(e)
	{
		if(e.which == 13)
		{
			$("#reg-submit").click();
		}
	});
	

	//handle registration submit
	$("#reg-submit").click(function()
	{

		var email = $.trim($("#reg-email").val());
		var password = $.trim($("#reg-password").val());
		var firstName = $.trim($("#reg-firstName").val());
		var lastName = $.trim($("#reg-lastName").val());
		var gradYear = $("#reg-gradYear").val();

		if(checkInputtedValues(email, password, firstName, lastName, gradYear))
		{
			$("#registrationErrors").text(""); //remove any previous errors before continuing

			var ajaxRequest = $.ajax
			({
				type: "POST",
				url: "processRegistration.php",
				data: {isValidRequest: true, email: email, password: password, firstName: firstName, lastName: lastName, gradYear: gradYear}
			});

			ajaxRequest.done(function(msg)
			{
			  	if(msg == "success")
			  	{
			  		location.reload();
			  	}
			  	else
			  	{
			  		$("#registrationErrors").text(msg);
			  	}
			});

			ajaxRequest.fail(function(jqXHR, error)
			{
				$("#registrationErrors").text("Registration failed: " + error);
			});
		}
		else
		{
			$("#registrationErrors").text("Please complete every field");
		}


	});

	function checkInputtedValues(email, password, firstName, lastName, gradYear)
	{
		var noErrors = true;

		if(email == "")
		{
			var noErrors = false;

			$("#reg-email").addClass("inputError");
		}
		else
		{ 
			$("#reg-email").removeClass("inputError");
		}


		if(password == "")
		{
			var noErrors = false;

			$("#reg-password").addClass("inputError");
		}
		else 
		{
			$("#reg-password").removeClass("inputError");
		}


		if(firstName == "")
		{
			var noErrors = false;

			$("#reg-firstName").addClass("inputError");
		}
		else 
		{
			$("#reg-firstName").removeClass("inputError");
		}


		if(lastName == "")
		{
			var noErrors = false;

			$("#reg-lastName").addClass("inputError");
		}
		else 
		{
			$("#reg-lastName").removeClass("inputError");
		}


		if(gradYear == "default") //if a year isn't selected
		{
			var noErrors = false;
			$("#reg-gradYear").addClass("inputError");
		}
		else
		{
			$("#reg-gradYear").removeClass("inputError");
		}

		return noErrors;
	}

});