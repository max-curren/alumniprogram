<script type="text/javascript" src="js/apiLogin.js"></script>

<script type="text/javascript">
	console.log('Welcome!  Fetching your information.... ');
  FB.api('/me', function(response) 
  {
    console.log('Successful login for: ' + response.name);
    $('#status').append('Thanks for logging in, ' + response.name + '!');
    $("#status").append("<img width='100' height='100' src='http://graph.facebook.com/" + response.id + "/picture?type=normal' />");
  });
</script>

    <div id="status">
    </div>