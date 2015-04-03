<?php						//Written by Jason Yang

class police_user_report{
	private $db_hostname = 'localhost';
	private $db_database = 'jlsilang_DB';
	private $db_username = 'jlsilang_jc';
	private $db_password = 'Runescape1';
	public $db_server;
	public $result;
	public $police_rows;		//number of rows of police reports
	public $police_data_array;	//2-D array holding data of police reports
	public $user_rows;		//number of rows of user reports
	public $user_data_array;	//2-D array holding data of user reports
	
	//Note: The police_user_markers class only can hold either police data or user data, not both.  I was too lazy to implement
	//virtual functions, inheritance and whatnot :S
	
	function police_user_report($police_or_user){
		$this->db_server = mysql_connect($this->db_hostname, $this->db_username, $this->db_password);
		if(!$this->db_server) die("Unable to connect to MYSQL: " . mysql_error());
		mysql_select_db($this->db_database) or 
			die("Unable to connect to database: ". mysql_error());
		if ($police_or_user == 'police'){
			$query = "SELECT * FROM POLICE_USER_REPORTS WHERE INCIDENT_REPORT = 'Police Sighting'";	
			$this->result = mysql_query($query);
			if (!$this->result) die("Database access failed: ". mysql_error());
			$this->police_rows = mysql_num_rows($this->result);	
		}
		else if ($police_or_user =='user'){
			$query = "SELECT * FROM POLICE_USER_REPORTS WHERE INCIDENT_REPORT NOT LIKE 'Police Sighting'";	
			$this->result = mysql_query($query);
			if (!$this->result) die("Database access failed: ". mysql_error());
			$this->user_rows = mysql_num_rows($this->result);	
		}
		else if ($police_or_user == ""){
			$this->db_server = mysql_connect($this->db_hostname, $this->db_username, $this->db_password);
			if(!$this->db_server) die("Unable to connect to MYSQL: " . mysql_error());
			mysql_select_db($this->db_database) or 
			die("Unable to connect to database: ". mysql_error());
		}
	}
	
	/*function police_user_report(){
		$this->db_server = mysql_connect($this->db_hostname, $this->db_username, $this->db_password);
		if(!$this->db_server) die("Unable to connect to MYSQL: " . mysql_error());
		mysql_select_db($this->db_database) or 
		die("Unable to connect to database: ". mysql_error());
	}*/
	
	//Prints contents of the data arrays.  No real use for this project, but still helpful for debugging purposes.
	function print_police_info(){
		for ($i = 0; $i < $this->police_rows; ++$i){
			echo 'Creation Date: '.$this->police_data_array[$i][0].'<br>';
			echo 'Creation Time: '.$this->police_data_array[$i][1].'<br>';
			echo 'Incident Report: '.$this->police_data_array[$i][2].'<br>';
			echo 'Latitude: '.$this->police_data_array[$i][3].'<br>';
			echo 'Longitude: '.$this->police_data_array[$i][4].'<br>';
			echo 'Road Name: '.$this->police_data_array[$i][5].'<br><br>';
		}
	}
	
	function print_user_info(){
		for ($i = 0; $i < $this->user_rows; ++$i){
			echo 'Creation Date: '.$this->user_data_array[$i][0].'<br>';
			echo 'Creation Time: '.$this->user_data_array[$i][1].'<br>';
			echo 'Incident Report: '.$this->user_data_array[$i][2].'<br>';
			echo 'Latitude: '.$this->user_data_array[$i][3].'<br>';
			echo 'Longitude: '.$this->user_data_array[$i][4].'<br>';
			echo 'Road Name: '.$this->user_data_array[$i][5].'<br><br>';
		}
	}
	
	//These functions store the relevant data from databases into corresponding data structures.
	function store_police_info(){
		for ($i = 0; $i < $this->police_rows; ++$i){
			$row = mysql_fetch_row($this->result);
			for ($j = 0; $j < 6; ++$j){
				$this->police_data_array[$i][$j] = $row[$j];
			}
		}
	}
	
	function store_user_info(){
		for ($i = 0; $i < $this->user_rows; ++$i){
			$row = mysql_fetch_row($this->result);
			for ($j = 0; $j < 6; ++$j){
				$this->user_data_array[$i][$j] = $row[$j];
			}
		}
	}
	
	//Inputs a row into the database based on the input values
	function input_row($incident_report, $longitude, $latitude, $road_name){
		$query = "INSERT INTO POLICE_USER_REPORTS(CREATE_DATE, CREATE_TIME, INCIDENT_REPORT, LATITUDE, LONGITUDE, ROAD_NAME) VALUES"."(CURDATE(), CURTIME(), '$incident_report', '$latitude', '$longitude', '$road_name')";
		$this->result = mysql_query($query);
		if (!$this->result) die("Database access failed: ". mysql_error());
	}
	
	//Closes database.
	function close_db(){
		mysql_close($this->db_server);
	}
}

?>