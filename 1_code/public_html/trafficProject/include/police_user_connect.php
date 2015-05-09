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
	public $verifed_police_array; 	//2-D array holding data of verified police reports
	public $verified_police_size;
	public $user_rows;		//number of rows of user reports
	public $user_data_array;	//2-D array holding data of user reports
	public $verifed_user_array; 	//2-D array holding data of verified user reports
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
		for ($i = 0; $i < count($this->verified_police_array); ++$i){
			echo 'Creation Date: '.$this->verified_police_array[$i][0].'<br>';
			echo 'Creation Time: '.$this->verified_police_array[$i][1].'<br>';
			echo 'Incident Report: '.$this->verified_police_array[$i][2].'<br>';
			echo 'Latitude: '.$this->verified_police_array[$i][3].'<br>';
			echo 'Longitude: '.$this->verified_police_array[$i][4].'<br>';
			echo 'Road Name: '.$this->verified_police_array[$i][5].'<br><br>';
		}	
		echo count($this->verified_police_array);
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
	
	function find_distance($lat1, $long1, $lat2, $long2){
		$distance = sqrt(pow($lat1 - $lat2,2) + pow($long1 - $long2, 2));
		return $distance;
	}
	
	//Checks the legitimacy of police reports.  If an n number of data entries in the database are of similar time, location, and the same report type, then the entry is "verified".
	function verify_police_data($n){
		$temp_police_array = $this->police_data_array;
		$evaluated = array();
		for ($i = 0; $i < $this->police_rows; ++$i){
			$count = 1;
			$marked = array();
			$marked[] = $i;
			if (!in_array($i, $evaluated)){
				for ($j = 0; $j < $this->police_rows; ++$j){
					if (($j != $i) && (!in_array($j, $evaluated))){
						$distance = $this->find_distance($temp_police_array[$i][3], $temp_police_array[$i][4], $temp_police_array[$j][3], $temp_police_array[$j][4]);
						if ($distance < 0.0035){
							++$count;
							$marked[] = $j;
						}
					}
				}
				if ($count >= $n){
					//for ($k = 0; $k < 6; ++$k){
					//	$this->verified_police_array[count($this->verified_police_array)%6][$k] = $temp_police_array[$i][$k];
					//}
					$this->verified_police_array[] = $temp_police_array[$i];
					array_push($evaluated, $i);
					for ($k = 0; $k < count($marked); ++$k){
						array_push($evaluated, $marked[$k]);
					}
				}
			}
		}
	}
	
	
	//Checks the legitimacy of user reports.  If an n number of data entries in the database are of similar time, location, and the same report type, then the entry is "verified".
	function verify_user_data($n){
		$temp_user_array = $this->user_data_array;
		$evaluated = array();
		for ($i = 0; $i < $this->user_rows; ++$i){
			$count = 1;
			$marked = array();
			$marked[] = $i;
			if (!in_array($i, $evaluated)){
				for ($j = 0; $j < $this->user_rows; ++$j){
					if (($j != $i) && (!in_array($j, $evaluated))){
						$distance = $this->find_distance($temp_user_array[$i][3], $temp_user_array[$i][4], $temp_user_array[$j][3], $temp_user_array[$j][4]);
						if (($distance < 0.0035) && ($temp_user_array[$i][2] == $temp_user_array[$j][2])){
							++$count;
							$marked[] = $j;
						}
					}
				}
				if ($count >= $n){
					//for ($k = 0; $k < 6; ++$k){
					//	$this->verified_user_array[count($this->verified_user_array)%6][$k] = $temp_user_array[$i][$k];
					//}
					$this->verified_user_array[] = $temp_user_array[$i];
					array_push($evaluated, $i);
					for ($k = 0; $k < count($marked); ++$k){
						array_push($evaluated, $marked[$k]);
					}
				}
			}
		}
	}
	
	//Closes database.
	function close_db(){
		mysql_close($this->db_server);
	}
}

?>