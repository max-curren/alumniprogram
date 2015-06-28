$(document).ready(function() {

	//toggle Login window
	$("#loginPopup-toggle").click(function(e)
	{
		e.preventDefault();

		$("main").addClass("popup-shadow");		
		$("#loginPopup").show("fast");
	});
	
	//remove shadow and exit popup
	$("main").click(function()
	{
		$("main").removeClass("popup-shadow");
		$("#loginPopup").hide("fast");
	});


	//if enter key is pressed
	$("#loginForm").children().keypress(function(e)
	{
		if(e.which == 13)
		{
			$("#login-submit").click();
		}
	});



	$("#login-submit").click(function()
	{
		var email = $.trim($("#login-email").val());
		var password = $.trim($("#login-password").val());
		var rememberMe = $("#rememberMe").is(':checked');

		if(checkInputtedValues(email, password) == true)
		{
			$("#loginErrors").text(""); //remove any previous errors before continuing

			var ajaxRequest = $.ajax
			({
				type: "POST",
				url: "processLogin.php",
				data: {isValidRequest: true, email: email, password: password, rememberMe: rememberMe}
			});

			ajaxRequest.done(function(msg)
			{
			  	if(msg == "success")
			  	{
			  		location.reload();
			  	}
			  	else
			  	{
			  		$("#loginErrors").text(msg);
			  	}
			});

			ajaxRequest.fail(function(jqXHR, error)
			{
				$("#loginErrors").text("Login failed: " + error);
			});
		}
		else
		{
			$("#loginErrors").text("Please complete every field");
		}


	});

	function checkInputtedValues(email, password)
	{
		var noErrors = true;

		if(email == "")
		{
			var noErrors = false;

			$("#login-email").addClass("inputError");
		}
		else
		{ 
			$("#login-email").removeClass("inputError");
		}


		if(password == "")
		{
			var noErrors = false;

			$("#login-password").addClass("inputError");
		}
		else 
		{
			$("#login-password").removeClass("inputError");
		}

		return noErrors;
	}
});