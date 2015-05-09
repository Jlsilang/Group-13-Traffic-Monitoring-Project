<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href="trafficstyle.css">
    <style type="text/css">
    #map_canvas {height:260px;width:1250px;margin-left:auto;margin-right:auto}
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">
        var map;
        var markersArray = [];

        function initMap()
        {
            var latlng = new google.maps.LatLng(40.5,-74.4);
            var myOptions = {
                zoom: 10,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            // add a click event handler to the map object
            google.maps.event.addListener(map, "click", function(event)
            {
                // place a marker
                placeMarker(event.latLng);

                // display the lat/lng in your form's lat/lng fields
                document.getElementById("latFld").value = event.latLng.lat();
                document.getElementById("lngFld").value = event.latLng.lng();
            });
        }
        function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });

            // add marker in markers array
            markersArray.push(marker);
			//sayHelloWorld();
            //map.setCenter(location);
        }

        // Deletes all markers in the array by removing references to them
        function deleteOverlays() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
            markersArray.length = 0;
            }
        }
		function sayHelloWorld() {
			var hello = "hello";
			var world = "world";
			window.location.href = "googlemapmarker.html?w1=" + hello + "&w2=" + world;
		}
    </script>
</head>

<body onload="initMap()">
    <div id="map_canvas"></div>
    <input type="text" id="latFld">
    <input type="text" id="lngFld">
	<form method = "get" action = "police_user_report_page.php">
		<br><br>
		Latitude: <input type = "text" name = "LatCoords">
		&nbsp;
		Longitude: <input type = "text" name = "LongCoords"><br><br> 
Report type:
<span class="custom-dropdown custom-dropdown--white">
<select class="custom-dropdown__select custom-dropdown__select--white" name="reporttype">
<option value="0" >Choose</option>
<option value="Pothole" <?php echo($incident_report == "Pothole"?' selected="selected"':null)?>>Pothole</option>
<option value="Accident" <?php echo($incident_report == "Accident"?' selected="selected"':null)?>>Accident</option>
<option value="Natural Blockage" <?php echo($incident_report == "Natural Blockage"?' selected="selected"':null)?>>Natural Blockage</option>
<option value="Construction" <?php echo($incident_report == "Construction"?' selected="selected"':null)?>>Construction</option>
<option value="Event" <?php echo($incident_report == "Event"?' selected="selected"':null)?>>Event</option>
<option value="Traffic" <?php echo($incident_report == "Traffic"?' selected="selected"':null)?>>Traffic</option>
<option value="Police Sighting" <?php echo($incident_report == "Police Sighting"?' selected="selected"':null)?>>Police Report</option>
<option value="Other" <?php echo($incident_report == "Other"?' selected="selected"':null)?>>Other</option>
</select>
</span>
&nbsp; 
Other: <input type = "text" name = "other">
&nbsp; 
Police Amount
<span class="custom-dropdown custom-dropdown--white">
<select class="custom-dropdown__select custom-dropdown__select--white" name="policeamount">
<option value="none" >None</option>
<option value="one" >One</option>
<option value="two" >Two</option>
<option value="three" >Three</option>
<option value="more" >More</option>
</select>
</span> 
&nbsp; <br><br> 

		
		Road Name (Optional): <input type = "text" name = "roadname"><br><br> 
		<input type = "submit" value = "Submit" class="styled-button-5"><br><br> 
<a href="http://justincoding.com/trafficProject/" style="text-decoration:none">Return to Map Application</a>
	</form>
</body>
</html>


<?php
	require_once('police_user_connect.php');
	$longitude;
	$latitude;
	$incident_report;
	$num_police = $_GET['policeamount'];
	if (!empty($_GET['roadname'])) {$road_name = $_GET['roadname'];}
	else {$road_name = "";}
	if (!empty($_GET['LatCoords']) && !empty($_GET['LongCoords']) && !empty($_GET['reporttype'])){
		$longitude = $_GET['LongCoords'];
		$latitude = $_GET['LatCoords'];
		$incident_report = $_GET['reporttype'];
		if ($incident_report != "0"){
			//echo $longitude .' '. $latitude.' '. $incident_report.' '. $road_name. ' ';
			$report = new police_user_report("");
			$report->input_row($incident_report, $longitude, $latitude, $road_name);
			$report->close_db();
			//print_r($report->result);
			if (!$report->result){
				echo "<br>Unsuccessful attempt at storing in database.";
			}
			else {
				echo "<br>Successfully stored in database!";
			}
		}
	}
?>