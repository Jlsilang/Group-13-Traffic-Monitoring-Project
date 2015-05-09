Jason Yang, Charu Jain, Justin Silang, Maxine Deines, Mehul Salhotra, Akshay Sardana

Website for our application: http://justincoding.com/trafficProject/index.php


Run instructions: 

- The runnable file is ran by our webhost. To run locally, you must have a local web server installed such as
  WAMP, XAMPP, and EasyPHP.
- The runnable file responsible is index.php, in directory: "public_html/trafficProject".
- To run the main runnable file successfully, the database credentials are host name, database table name,
  database username, and database password.
  -Credentials is required in files: 
	- dir path "public_html/trafficProject/include/police_user_connect.php"
   	- dir path "public_html/cgi-bin/TrafficParser.py"
	- dir path "public_html/cgi-bin/WeatherParser.py

	i.e. Example

	private $db_hostname = 'localhost';
	private $db_database = 'jlsilang_DB';
	private $db_username = 'jlsilang_jc';
	private $db_password = 'Runescape1';

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
		e) Fast.php - webpage that determines directions between two locations and give estimated time
		include folder:
			a) DataAggregator.php - maps the data from database to markers
			b) DatabaseInterface.php - queries the database for traffic and weather for relevant information.
			c) Geocoder.php - configures map settings like traffic overlays, zoom, etc.
			d) GoogleMap.php - Google Maps API for PHP, allowing for Google Map functions.
			e) JSMin.php - filters out whitespace and comments, sourced from Douglas Crockford
			f) SeverityCalc.php - calculates the severity based on an algorithm and assigns a severity level.
			g) police_user_report.php - interface for accessing the police_user_report database, as well as storing and fetching info
			h) police_user_report_page.php - webpage that displays the submission of incident reports.
	

