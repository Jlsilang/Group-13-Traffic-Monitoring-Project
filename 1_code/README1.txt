Jason Yang, Charu Jain, Justin Silang, Maxine Deines, Mehul Salhotra, Akshay Sardana

Website for our application: http://justincoding.com/trafficProject/index.php

1_Code Folder:
	Cgi-bin folder:
		a) TrafficParser.py - connects to the traffic website and parses the necessary data, and stores it into database.
		b) WeatherParser.py - connects to the weather website and parses the necessary data, and stores it into database.
		c) CollectScript.py - calls both a) and b) and runs both python scripts, thereby running both 
	trafficProject folder:
		a) about.html - webpage that lists info about project
		b) help.html - webpage that describes how to use the Traffic Monitoring application
		c) index.php - displays the content on the main webpage, including displaying the map, menus, input forms, etc.
		d) trafficstyle.css - the css layout for the website
		include folder:
			a) DataAggregator.php - maps the data from database to markers
			b) DatabaseInterface.php - queries the database for traffic and weather for relevant information.
			c) Geocoder.php - configures map settings like traffic overlays, zoom, etc.
			d) GoogleMap.php - Google Maps API for PHP, allowing for Google Map functions.
			e) JSMin.php - filters out whitespace and comments, sourced from Douglas Crockford
			f) SeverityCalc.php - calculates the severity based on an algorithm and assigns a severity level.
			g) police_user_report.php - interface for accessing the police_user_report database, as well as storing and fetching info
			h) police_user_report_page.php - webpage that displays the submission of incident reports.

	Android folder:
		a) assets - fonts
		b) bin - class files for running app
		c) gen/com - more settings compiled for android
		d) libs - android-support-v4.jar (required jar for android)
		e) res - images/structures for android pages
			a) drawable-xhdpi - icons/images
			b) layout - xml for different pages for app
				a) activity_main.xml - main page
				b) end_direction.xml - getting end direction for getDirections
				c) map_activty - view result of getDirections
				d) report.xml - view report
				e) submit.xml - submit report
		f) src/com/androidapp/traffic - java code
			a) EndDirection.java - get EndDirection for getDirection from current location to EndDirection
			b) MainActivity.java - main page
			c) NewDirection.java - display directions from current direction to result from EndDirection.java
			d) Report.java - view reports
			e) Submit.java - submit reports

How to compile:
	1) To access the google map/current location capabilities, you need a Google Maps API debug key (follow the instructions here: https://developers.google.com/maps/documentation/android/start, and replace the key currently in the AndroidManifest.xml file with the key you get)
	2) Run the project in an Eclipse or AndroidStudio environment on a phone in developer mode that supports Android 18+ (a phone is required to test the voice command capabilities)
	3) The app will open automatically. You will be able to click on the different functions and type in/select/speak different inputs.