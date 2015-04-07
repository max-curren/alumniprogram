 var alumniObj = 
 {
 	0: 
 	{
    'name': "Molly Curren",
 		'address': "275 High St. North Attleboro MA"
 	},

 	1: 
 	{
    'name': "Jacob Curren",
 		'address': "Metcalf Rd. North Attleboro MA"
 	},

 	2: 
 	{
    'name': "Kerry O'Heir",
 		'address': "286 High St. North Attleboro MA"
 	}

 }

 function initialize() 
 {
 	

 	var mapOptions = 
 	{
		center: { lat: -34.397, lng: 150.644},
        zoom: 1
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    for(var key in alumniObj)
    {
    	var alumni = alumniObj[key];

    	geocodeAddress(alumni.address, function(result){ 
    		if(typeof result != "string")
    		{
	    		var marker = new google.maps.Marker
		   		({
			    	position: result,
			    	map: map,
			    	title: alumni.name
		    	});
	   		}
	   		else
	   		{
	   			alert(result);
	   		}
    	});

	}
 }


 function geocodeAddress(address, callback) 
 {
 	geocoder = new google.maps.Geocoder();

  	geocoder.geocode( { 'address': address}, function(results, status) 
  	{
	    if(status == google.maps.GeocoderStatus.OK) 
	    {
	    	callback(results[0].geometry.location);
	    }
	    else 
	    {
	      callback('Geocode was not successful for the following reason: ' + status);
	    }
	});
}



google.maps.event.addDomListener(window, 'load', initialize);