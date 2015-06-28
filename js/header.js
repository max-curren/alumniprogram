$(document).ready(function() 
{  
  var isOpen = false;
  
  var openedRequestsDropdown = false;
  
  var showRequestsLimit = 7;

  var hideDelay = 800;
  var hideSpeed = "fast";
  
  $("#requests-toggle").click(function(event)
  {
    event.preventDefault();
    $(".dropdown").hide();
    $("#requests-dropdown").show();
    isOpen = true;
    
    
    if(openedRequestsDropdown === false)
    {
      openedRequestsDropdown = true;
      
      var ajaxRequest = $.ajax
        ({
          type: "POST",
          url: "getRequests.php",
          dataType: "json",
          data: {isValidRequest: true}
        });

        ajaxRequest.done(function(requests)
        {   
          $("#requests-dropdown #loading-icon").hide();

          if(requests.length === 0)
          {
            $("#requests-dropdown ul").append("<li><span style='text-align: center' id='noRequests'>You currently have no requests.</span></li>");
          }

          for(var counter = 0; counter < requests.length && counter < showRequestsLimit; counter++) 
          {
            $("#requests-dropdown ul").append(
              "<li id='"+ requests[counter].userID +"'><img class='profilePic' src='profilePics/" + requests[counter].profilePic + "' /><a class='name' href='profile.php?id=" + requests[counter].userID + "'>" + requests[counter].firstName + " " + requests[counter].lastName + "</a><span class='gradYear'>Class of " + requests[counter].gradYear + "</span><div class='btnGroup'><a href='#' class='button-grey requestBtn accept'><img class='btn-icon' src='icons/checkmark.png' /><span>Accept</span></a><a href='#' class='button-grey requestBtn reject'><img class='btn-icon' src='icons/cross.png' /><span>Reject</span></a></div></li>"
                                             );
          }
          
          if(requests.length > showRequestsLimit)
          {
            $("#requests-dropdown").append("<a href='requests.php'>See more</a>");
          } 
          



        });

        ajaxRequest.fail(function(jqXHR, error)
        {
          alert("An error has occurred: " + error);
        });
    }
  });
  
  $("#requests-dropdown").on("click", ".requestBtn", function(event)
  {
    event.preventDefault();
    
    var requestedID = this.closest("li").id;
    var desiredStatus;
    
    if($(this).hasClass("accept"))
    {
      desiredStatus = 2;
    }
    else
    {
      desiredStatus = 3;
    }
    
    var ajaxRequest = $.ajax
    ({
      type: "POST",
      url: "processConnection.php",
      data: {isValidRequest: true, requestedID : requestedID, desiredStatus: desiredStatus}
    });

    ajaxRequest.done(function(msg)
    {   
      if(desiredStatus === 2)
      {
        $("li#" + requestedID).html("<h3>Accepted</h3><a id='profileLink' href='profile.php?id=" + requestedID + "'>Click here to view their profile</a>");

        $("li#" + requestedID).css("text-align", "center");
        $("h3").css("margin-top", "10px");

      }
      else if(desiredStatus === 3)
      {
        $("li#" + requestedID).html("<h3>Rejected</h3>");

        $("li#" + requestedID).css("text-align", "center");
        $("h3").css("margin-top", "10px");

        $("li#" + requestedID).delay(hideDelay).hide(hideSpeed);
      }
    });

    ajaxRequest.fail(function(jqXHR, error)
    {
      alert("An error has occurred: " + error);
    });
  });
  
  $("#messages-toggle").click(function(event)
  {
    event.preventDefault();
    $(".dropdown").hide();
    $("#messages-dropdown").show();
    isOpen = true;
  });
  
  $("#more-toggle").click(function(event)
  {
    event.preventDefault();
    $(".dropdown").hide();
    $("#more-dropdown").show();
    isOpen = true;
  });
  
  $("html").click(function(event)
  {
    if(!$(event.target).parents('.dropdown').length && !$(event.target).parent().hasClass('dropdown-toggle') && isOpen === true)
    {
      $(".dropdown").hide();
      isOpen = false;
    }
  });
  
});