$(document).ready(function() 
{
  
  
  $("#requested-btn").hover
  (
    function()
    {
      $(this).html("<img src='icons/cross.png' /><span>Cancel Request</span>");
    }, 
    function()
    {
      $(this).html("<img src='icons/message.png' /><span>Requested</span>");
    }
  );
  
  $("#confirmed-btn").hover
  (
    function()
    {
      $(this).html("<img src='icons/cross.png' /><span>Unconnect</span>");
    }, 
    function()
    {
      $(this).html("<img src='icons/check59.png' /><span>Connected</span>");
    }
  ); 
  
  var profileID = GetURLParameter('id');
  
  $("#request-btn").click(function(event)
  {
    event.preventDefault();
    
    var ajaxRequest = $.ajax
		({
		    type: "POST",
				url: "processConnection.php",
        data: {isValidRequest: true, desiredStatus: 1, requestedID: profileID}
		});

		ajaxRequest.done(function(msg)
		{
			 if(msg == "success")
			 {
			   $("#request-btn").replaceWith("<a href='#' id='requested-btn' class='button-grey connectionButton'><img src='icons/message.png' /><span>Requested</span></a>");
			 }
       else
       {
         alert(msg);
       }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
			alert("An error has occurred: " + error);
		});
  });
  
  $("#requested-btn").click(function(event)
  {
    event.preventDefault();
    
    var ajaxRequest = $.ajax
		({
		    type: "POST",
				url: "processConnection.php",
        data: {isValidRequest: true, desiredStatus: 3, requestedID: profileID}
		});

		ajaxRequest.done(function(msg)
		{
			 if(msg == "success")
			 {
			   $("#requested-btn").replaceWith("<a href='#' id='request-btn' class='button-grey connectionButton'><img src='icons/connect.png' /><span>Connect</span></a>");
			 }
       else
       {
         alert(msg);
       }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
			alert("An error has occurred: " + error);
		});
  });
  
  $("#confirmed-btn").click(function(event)
  {
    event.preventDefault();
    
    var ajaxRequest = $.ajax
		({
		    type: "POST",
				url: "processConnection.php",
        data: {isValidRequest: true, desiredStatus: 3, requestedID: profileID}
		});

		ajaxRequest.done(function(msg)
		{
			 if(msg == "success")
			 {
			   $("#confirmed-btn").replaceWith("<a href='#' id='request-btn' class='button-grey connectionButton'><img src='icons/connect.png' /><span>Connect</span></a>");
			 }
       else
       {
         alert(msg);
       }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
			alert("An error has occurred: " + error);
		});
  });
  
  $("#acceptRequest-btn").click(function(event)
  {
    event.preventDefault();
    
    var ajaxRequest = $.ajax
		({
		    type: "POST",
				url: "processConnection.php",
        data: {isValidRequest: true, desiredStatus: 2, requestedID: profileID}
		});

		ajaxRequest.done(function(msg)
		{
			 if(msg == "success")
			 {
			   $("#acceptRequest-btn").replaceWith("<a href='#' id='confirmed-btn' class='button-grey connectionButton'><img src='icons/check59.png' /><span>Connected</span></a>");
         $("#rejectRequest-btn").remove();
			 }
       else
       {
         alert(msg);
       }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
			alert("An error has occurred: " + error);
		});
  });
  
  $("#rejectRequest-btn").click(function(event)
  {
    event.preventDefault();
    
    var ajaxRequest = $.ajax
		({
		    type: "POST",
				url: "processConnection.php",
        data: {isValidRequest: true, desiredStatus: 3, requestedID: profileID}
		});

		ajaxRequest.done(function(msg)
		{
			 if(msg == "success")
			 {
			   $("#rejectRequest-btn").replaceWith("<a href='#' id='request-btn' class='button-grey connectionButton'><img src='icons/connect.png' /><span>Connect</span></a>");
			 }
       else
       {
         alert(msg);
       }
		});

		ajaxRequest.fail(function(jqXHR, error)
		{
			alert("An error has occurred: " + error);
		});
  });
  
  function GetURLParameter(sParam)
  {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for(var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
  }

  
  
  
});