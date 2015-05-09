<!DOCTYPE html>
<html>
	<head>
							
							<!-- WRITTEN BY JUSTIN SILANG -->
							
	<title>Traffic Monitor</title>
							
   	<link rel = "stylesheet" type = "text/css" href="trafficstyle.css">
    
    	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    
     	<style>
     		 #directions-panel {
        		height: 100%;
       			 float: right;
      			  width: 270px;
      			  background-color: white;
      		
      		}
      	</style>
      	
    	<script type="text/javascript">
        	var map;
        	var directionsDisplay;
		var directionsService = new google.maps.DirectionsService();
 
  		function initialize() {
    			directionsDisplay = new google.maps.DirectionsRenderer();
    			var latlng = new google.maps.LatLng(40.5,-74.4);
    			var mapOptions = {
     				zoom: 16,
     				center: latlng
    			}
    		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    		directionsDisplay.setMap(map);
  		directionsDisplay.setPanel(document.getElementById('directions-panel'));
    		
 	 	}
 	 
  		function calcRoute() {
  			var start = document.getElementById('startingAddress').value;
  			var end = document.getElementById('destinationAddress').value;
  			var request = {
    				origin: start,
    				destination: end,
    				travelMode: google.maps.TravelMode.DRIVING,
    				provideRouteAlternatives: true,
    				avoidHighways: true
  			};
  			directionsService.route(request, function(response, status) {
    				if (status == google.maps.DirectionsStatus.OK) {
      					directionsDisplay.setDirections(response);
    				}
    				else{
      						alert('Direction Error: ' + status);
    				}
 			 });
		}
  		

  		
	</script>
	
	
							<!-- BODY -->
							
<body onload="initialize()">

    	<a href="index.php" style="margin: 0 auto; ">Home</a>
  <div class="hovtrans" style="margin: 0 auto; padding-top:20px; padding-bottom:35px;">
  Start 
    <input id="startingAddress" type="textbox" value="31 Robinson St, New Brunswick" style="width: 200px; height: 30px; "><br></br>
  End
    <input id="destinationAddress" type="textbox" value="15 Bartlett St, New Brunswick" style="width: 200px; height: 30px;"><br></br>
    	<input type="button" value="Shortest Travel Time" onclick="calcRoute()" style="width: 215px; height: 40px" class="styled-button-5">
  </div>

  <div id="map-canvas" style="width: 270px; height: 600px; margin: 0 auto;"></div>
<br></br>
  <div id="directions-panel"></div>
</body>

</html>


