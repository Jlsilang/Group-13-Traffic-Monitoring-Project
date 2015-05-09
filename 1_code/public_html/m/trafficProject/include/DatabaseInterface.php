<?php
require_once('SeverityCalc.php');
/* DatabaseInterface.php
 * @author Vam Chilukamari
 *
 * The DatabaseInterface class is the class that does
 * all the querying using MYSQL commands in the dbQuery()
 * function, which connects to the MYSQL database on a server
 * and executes MYSQL commands to query the database by passing
 * the command to the startQuery() function  for the required
 * information based on the client's requests */

function dbQuery($road, $region, $weather, $time, $day)
{
	$connect = dbConn(); /*Function call to connect to MYSQL server and select a database*/

    /*Extracts data from database for the road requested by the client*/
    if($road && $region == null && $weather == null && $time == null && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $sql = "select *, datediff(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where ROAD_NAME like '%" . $road . "%'";
        $trafficData = startQuery($sql);
    }

    /*Extracts data from database for the region requested by the client*/
    elseif($road == null && $region && $weather == null && $time == null && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        switch($region)
        {
            case "north":
            case "North":
                $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.633162 and 41.027571415339786";
                $trafficData = startQuery($sql);
                break;
            case "south":
			case "South":
                $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 39.244086 and 40.086863";
                $trafficData = startQuery($sql);
                break;
            case "central":
			case "Central":
                $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.15595 and 40.595185";
                $trafficData = startQuery($sql);
                break;
        }
    }

    /*Extracts data from database for the road and weather condition requested by the client*/
    elseif($road && $region == null && $weather && $time == null && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
        if($weather == "rain")
        {
            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Edison'";
            $weatherData = startQuery($sql);
        }
        elseif($weather == "clear")
        {
            $sql = "select * from WEATHER where (CONDITIONS like '%sunny%' or CONDITIONS like '%clear%') and CITY_NAME = 'Edison'";
            $weatherData = startQuery($sql);
        }
		elseif($weather == "cloudy")
		{
			$sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Edison'";
            $weatherData = startQuery($sql);
		}
		elseif($weather == "fog")
		{
			$sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Edison'";
            $weatherData = startQuery($sql);
		}
        foreach($weatherData as $Data)/*Loop through each record in $weatherData and store the create dates into $createData*/
        {
            $createData[] = $Data["CREATE_DATE"];
        }
        for($i = 0; $i < count($createData); $i++)/*Loop through each date in the array and extract data from database for each of the dates*/
        {
            $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and ROAD_NAME like '%" . $road . "%'";
			$temp = startQuery($sql2);
			$trafficData = array_merge($trafficData, $temp);
		}
    }

    /*Extracts data from database for the region and weather condition requested by the client*/
    elseif($road == null && $region && $weather && $time == null && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
        switch($region)
        {
            case "north":
			case "North":
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Parsippany'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%sunny%' or CONDITIONS like '%clear%') and CITY_NAME = 'Parsippany'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Parsippany'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Parsippany'";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
                for($i = 0; $i < count($createData); $i++)
                {
                    $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and LATITUDE between 40.633162 and 41.027571415339786";
					$temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);
                }
                break;
            case "south":
			case "South":
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Manchester Township'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%sunny%' or CONDITIONS like '%clear%') and CITY_NAME = 'Manchester Township'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Manchester Township'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Manchester Township'";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
                for($i = 0; $i < count($createData); $i++)
                {
					$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and LATITUDE between 39.244086 and 40.086863";
					$temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);
                }
                break;
            case "central":
			case "Central":
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Edison'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where (CONDITIONS like '%sunny%' or CONDITIONS like '%clear%') and CITY_NAME = 'Edison'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Edison'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Edison'";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
                for($i = 0; $i < count($createData); $i++)
                {
                    $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and LATITUDE between 40.15595 and 40.595185";
                    $temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);

                }
                break;
        }
    }

    /*Extracts data from database for the road and time requested by the client*/
    elseif($road && $region == null && $weather == null && $time && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        if(strcmp("23", $time) >= 0 && strcmp("07", $time) < 0)
        {
            $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and ROAD_NAME like '%" . $road . "%'";
            $trafficData = startQuery($sql);
        }
        elseif(strcmp($time, "07") >= 0 && strcmp($time, "10") < 0)
        {
            $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and ROAD_NAME like '%" . $road . "%'";
            $trafficData = startQuery($sql);
        }
        elseif(strcmp($time, "10") >= 0 && strcmp($time, "14") < 0)
        {
            $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and ROAD_NAME like '%" . $road . "%'";
            $trafficData = startQuery($sql);
        }
        elseif(strcmp($time, "14") >= 0 && strcmp($time, "18") < 0)
        {
            $sql =  "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and ROAD_NAME like '%" . $road . "%'";
            $trafficData = startQuery($sql);
        }
        elseif(strcmp($time, "18") >= 0 && strcmp($time, "23") < 0)
        {
            $sql =  "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and ROAD_NAME like '%" . $road . "%'";
            $trafficData = startQuery($sql);
        }
    }

    /*Extracts data from database for the region and time requested by the client*/
    elseif($road == null && $region && $weather == null && $time && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        if(strcmp("23", $time) >= 0 && strcmp("07", $time) < 0)
        {   echo "IN DB with time";
            switch($region)
            {
                case "north":
				case "North":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.633162 and 41.027571415339786";
                    $trafficData = startQuery($sql);
                    break;
                case "south":
				case "South":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 39.244086 and 40.086863";
                    $trafficData = startQuery($sql);
                    break;
                case "central":
				case "Central":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.15595 and 40.595185";
                    $trafficData = startQuery($sql);
                    break;
            }
        }
        elseif(strcmp($time, "07") >= 0 && strcmp($time, "10") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.633162 and 41.027571415339786";
                    $trafficData = startQuery($sql);
                    break;
                case "south":
				case "South":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 39.244086 and 40.086863";
                    $trafficData = startQuery($sql);
                    break;
                case "central":
				case "Central":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.15595 and 40.595185";
                    $trafficData = startQuery($sql);
                    break;
            }
        }
        elseif(strcmp($time, "10") >= 0 && strcmp($time, "14") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.633162 and 41.027571415339786";
                    $trafficData = startQuery($sql);
                    break;
                case "south":
				case "South":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 39.244086 and 40.086863";
                    $trafficData = startQuery($sql);
                    break;
                case "central":
				case "Central":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.15595 and 40.595185";
                    $trafficData = startQuery($sql);
                    break;
            }
        }
        elseif(strcmp($time, "14") >= 0 && strcmp($time, "18") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.633162 and 41.027571415339786";
                    $trafficData = startQuery($sql);
                    break;
                case "south":
				case "South":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 39.244086 and 40.086863";
                    $trafficData = startQuery($sql);
                    break;
                case "central":
				case "Central":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.15595 and 40.595185";
                    $trafficData = startQuery($sql);
                    break;
            }
        }
        elseif(strcmp($time, "18") >= 0 && strcmp($time, "23") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.633162 and 41.027571415339786";
                    $trafficData = startQuery($sql);
                    break;
                case "south":
				case "South":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 39.244086 and 40.086863";
                    $trafficData = startQuery($sql);
                    break;
                case "central":
				case "Central":
                    $sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_TIME like '%" . $time . ":%' and LATITUDE between 40.15595 and 40.595185";
                    $trafficData = startQuery($sql);
                    break;
            }
        }
    }

    /*Extracts data from database for the road and type of day requested by the client*/
    elseif($road && $region == null && $weather == null && $time == null && $day)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
		switch($day)
		{
			case 2: /*Weekday query*/
				$sql =  "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where ROAD_NAME like '%" . $road . "%' and weekday(CREATE_DATE) between 0 and 4";
				$trafficData = startQuery($sql);
				break;
			case 1: /*Weekend query*/
				$sql =  "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where ROAD_NAME like '%" . $road . "%' and weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6";
				$trafficData = startQuery($sql);
				break;
			case 3: /*Anyday query*/
				$sql =  "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where ROAD_NAME like '%" . $road . "%'";
				$trafficData = startQuery($sql);
				break;
		}
    }

    /*Extracts data from database for the region and type of day requested by the client*/
    elseif($road == null && $region && $weather == null && $time == null && $day)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
		switch($day)
		{
			case 2:
				switch($region)
				{
					case "north":
					case "North":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.633162 and 41.027571415339786 and weekday(CREATE_DATE) between 0 and 4";
						$trafficData = startQuery($sql);
						break;
					case "south":
					case "South":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 39.244086 and 40.086863 and weekday(CREATE_DATE) between 0 and 4";
						$trafficData = startQuery($sql);
						break;
					case "central":
					case "Central":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.15595 and 40.595185 and weekday(CREATE_DATE) between 0 and 4";
						$trafficData = startQuery($sql);
						break;
				}
				break;
			case 1:
				switch($region)
				{
					case "north":
					case "North":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.633162 and 41.027571415339786 and
						weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6";
						$trafficData = startQuery($sql);
						break;
					case "south":
					case "South":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 39.244086 and 40.086863 and
						weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6";
						$trafficData = startQuery($sql);
						break;
					case "central":
					case "Central":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.15595 and 40.595185 and
						weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6";
						$trafficData = startQuery($sql);
						break;
				}
				break;
			case 3:
				switch($region)
				{
					case "north":
					case "North":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.633162 and 41.027571415339786";
						$trafficData = startQuery($sql);
						break;
					case "south":
					case "South":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 39.244086 and 40.086863";
						$trafficData = startQuery($sql);
						break;
					case "central":
					case "Central":
						$sql = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where LATITUDE between 40.15595 and 40.595185";
						$trafficData = startQuery($sql);
						break;
				}
				break;
        }
    }

    /*Extracts data from database for the road, weather, and time requested by the client*/
    elseif($road && $region == null && $weather && $time && $day == null)
    {
        $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
        if(strcmp("23", $time) >= 0 && strcmp("07", $time) < 0)
	    {
		    if($weather == "rain")
			{
				$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
				$weatherData = startQuery($sql);
                                
			}
			elseif($weather == "clear")
			{
				$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
				$weatherData = startQuery($sql);
			}
			elseif($weather == "cloudy")
			{
				$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and CONDITIONS like '%cloudy%'";
				$weatherData = startQuery($sql);
			}
			elseif($weather == "fog")
			{
				$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and CONDITIONS like '%fog%'";
				$weatherData = startQuery($sql);
			}
			foreach($weatherData as $Data)
			{
				$createData[] = $Data["CREATE_DATE"];
			}
			for($i = 0; $i < count($createData); $i++)
			{
				$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '23:00:00' or CREATE_TIME < '07:00:00') and ROAD_NAME like '%" . $road . "%'";
				$temp = startQuery($sql2);
				$trafficData = array_merge($trafficData, $temp);
			}
		 }
		 elseif(strcmp($time, "07") >= 0 && strcmp($time, "10") < 0)
		 {
			if($weather == "rain")
			{
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "clear")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "cloudy")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and CONDITIONS like '%cloudy%'";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "fog")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and CONDITIONS like '%fog%'";
				 $weatherData = startQuery($sql);
			 }
			 foreach($weatherData as $Data)
			 {
				 $createData[] = $Data["CREATE_DATE"];
			 }
			 for($i = 0; $i < count($createData); $i++)
			 {
				 $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '07:00:00' and CREATE_TIME <'10:00:00') and ROAD_NAME like '%" . $road . "%'";
				 $temp = startQuery($sql2);
				 $trafficData = array_merge($trafficData, $temp);
			 }
		 }
		 elseif(strcmp($time, "10") >= 0 && strcmp($time, "14") < 0)
		 {
			 if($weather == "rain")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "clear")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "cloudy")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and CONDITIONS like '%cloudy%'";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "fog")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and CONDITIONS like '%fog%'";
				 $weatherData = startQuery($sql);
			 }
			 foreach($weatherData as $Data)
			 {
				 $createData[] = $Data["CREATE_DATE"];
			 }
			 for($i = 0; $i < count($createData); $i++)
			 {
				 $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '10:00:00' and CREATE_TIME < '14:00:00') and ROAD_NAME like '%" . $road . "%'";
				 $temp = startQuery($sql2);
				 $trafficData = array_merge($trafficData, $temp);
			 }
		 }
		 elseif(strcmp($time, "14") >= 0 && strcmp($time, "18") < 0)
		 {
			 if($weather == "rain")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "clear")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "cloudy")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and CONDITIONS like '%cloudy%'";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "fog")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and CONDITIONS like '%fog%'";
				 $weatherData = startQuery($sql);
			 }
			 foreach($weatherData as $Data)
			 {
				 $createData[] = $Data["CREATE_DATE"];
			 }
			 for($i = 0; $i < count($createData); $i++)
			 {
				 $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '14:00:00' and CREATE_TIME <'18:00:00') and ROAD_NAME like '%" . $road . "%'";;
				 $temp = startQuery($sql2);
				 $trafficData = array_merge($trafficData, $temp);
			 }
		 }
		 elseif(strcmp($time, "18") >= 0 && strcmp($time, "23") < 0)
		 {
			 if($weather == "rain")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "clear")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "cloudy")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and CONDITIONS like '%cloudy%'";
				 $weatherData = startQuery($sql);
			 }
			 elseif($weather == "fog")
			 {
				 $sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and CONDITIONS like '%fog%'";
				 $weatherData = startQuery($sql);
			 }
			 foreach($weatherData as $Data)
			 {
				 $createData[] = $Data["CREATE_DATE"];
			 }
			 for($i = 0; $i < count($createData); $i++)
			 {
				 $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '18:00:00' CREATE_TIME <'23:00:00') and ROAD_NAME like '%" . $road . "%'";;
				 $temp = startQuery($sql2);
				 $trafficData = array_merge($trafficData, $temp);
			 }
		 }
	}

	/*Extracts data from database for the region, weather, and time requested by the client*/
	elseif($road == null && $region && $weather && $time && $day == null)
	{
	    $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
		if(strcmp("23", $time) >= 0 && strcmp("07", $time) < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
					if($weather == "rain")
					{       
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%01:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
                                                
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%01:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%01:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%01:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '23:00:00' or CREATE_TIME < '07:00:00') and LATITUDE between 40.633162 and 41.027571415339786";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "south":
				case "South":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%01:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%01:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%01:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%01:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '23:00:00' or CREATE_TIME < '07:00:00') and LATITUDE between 39.244086 and 40.086863";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "central":
				case "Central":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%01:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '23:00:00' or CREATE_TIME < '07:00:00') and LATITUDE between 40.15595 and 40.595185";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
            }
        }
        elseif(strcmp($time, "07") >= 0 && strcmp($time, "10") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%08:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%08:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%08:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%08:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '07:00:00' and CREATE_TIME < '10:00:00') and LATITUDE between 40.633162 and 41.027571415339786";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "south":
				case "South":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%08:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%08:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
						elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%08:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%08:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '07:00:00' and CREATE_TIME < '10:00:00') and LATITUDE between 39.244086 and 40.086863";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "central":
				case "Central":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%08:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >='07:00:00' and CREATE_TIME < '10:00:00') and LATITUDE between 40.15595 and 40.595185";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
            }
        }
        elseif(strcmp($time, "10") >= 0 && strcmp($time, "14") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%12:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%12:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%12:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%12:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '10:00:00' and CREATE_TIME < '14:00:00') and LATITUDE between 40.633162 and 41.027571415339786";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "south":
				case "South":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%12:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%12:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%12:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%12:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '10:00:00' and CREATE_TIME < '14:00:00') and LATITUDE between 39.244086 and 40.086863";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "central":
				case "Central":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%12:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '10:00:00' and CREATE_TIME < '14:00:00') and LATITUDE between 40.15595 and 40.595185";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
            }
        }
        elseif(strcmp($time, "14") >= 0 && strcmp($time, "18") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%16:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%16:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%16:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%16:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '14:00:00' and CREATE_TIME < '18:00:00') and LATITUDE between 40.633162 and 41.027571415339786";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "south":
				case "South":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%16:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%16:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%16:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%16:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '14:00:00' and CREATE_TIME < '18:00:00') and LATITUDE between 39.244086 and 40.086863";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "central":
				case "Central":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%16:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '14:00:00' and CREATE_TIME < '18:00:00') and LATITUDE between 40.15595 and 40.595185";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
            }
        }
        elseif(strcmp($time, "18") >= 0 && strcmp($time, "23") < 0)
        {
            switch($region)
            {
                case "north":
				case "North":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%20:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%20:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%20:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Parsippany' and CREATE_TIME like '%20:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '18:00:00' and CREATE_TIME < '23:00:00') and LATITUDE between 40.633162 and 41.027571415339786";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "south":
				case "South":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%20:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%20:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%20:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Manchester Township' and CREATE_TIME like '%20:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '18:00:00' and CREATE_TIME < '23:00:00') and LATITUDE between 39.244086 and 40.086863";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
                case "central":
				case "Central":
					if($weather == "rain")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "clear")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "cloudy")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and CONDITIONS like '%cloudy%'";
						$weatherData = startQuery($sql);
					}
					elseif($weather == "fog")
					{
						$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CREATE_TIME like '%20:%' and CONDITIONS like '%fog%'";
						$weatherData = startQuery($sql);
					}
					foreach($weatherData as $Data)
					{
						$createData[] = $Data["CREATE_DATE"];
					}
					for($i = 0; $i < count($createData); $i++)
					{
						$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (CREATE_TIME >= '18:00:00' and CREATE_TIME < '23:00:00') and LATITUDE between 40.15595 and 40.595185";
						$temp = startQuery($sql2);
						$trafficData = array_merge($trafficData, $temp);
					}
                    break;
            }
		}
	}

	/*Extracts data from database for the road, weather, and day selected by the client*/
	elseif($road && $region == null && $weather && $time == null && $day)
	{
	    $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
		switch($day)
		{
			case 2:
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (weekday(CREATE_DATE) between 0 and 4))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (weekday(CREATE_DATE) between 0 and 4))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and CONDITIONS like '%cloudy%' and (weekday(CREATE_DATE) between 0 and 4))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and CONDITIONS like '%fog%' and (weekday(CREATE_DATE) between 0 and 4))";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
				for($i = 0; $i < count($createData); $i++)
				{
					$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and ROAD_NAME like '%" . $road . "%'";
					$temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);
				}
				break;
			case 1:
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and CONDITIONS like '%cloudy%' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where (CITY_NAME = 'Edison' and CONDITIONS like '%fog%'  and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
				for($i = 0; $i < count($createData); $i++)
				{
					$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where ROAD_NAME like '%" . $road . "%'";
					$temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);
				}
				break;
			case 3:
				if($weather == "rain")
				{
					$sql = "select * from WEATHER where CITY_NAME = 'Edison' and (CONDITIONS like '%shower%' or CONDITIONS like '%rain%')";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "clear")
				{
					$sql = "select * from WEATHER where CITY_NAME = 'Edison' and (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%')";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "cloudy")
				{
					$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CONDITIONS like '%cloudy%'";
					$weatherData = startQuery($sql);
				}
				elseif($weather == "fog")
				{
					$sql = "select * from WEATHER where CITY_NAME = 'Edison' and CONDITIONS like '%fog%'";
					$weatherData = startQuery($sql);
				}
				foreach($weatherData as $Data)
				{
					$createData[] = $Data["CREATE_DATE"];
				}
				for($i = 0; $i < count($createData); $i++)
				{
					$sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and ROAD_NAME like '%" . $road . "%'";
					$temp = startQuery($sql2);
					$trafficData = array_merge($trafficData, $temp);
				}
				break;
		}
	}

	/*Extracts data from database for the region, weather, and day selected by the client*/
	elseif($road ==  null && $region && $weather && $time == null && $day)
	{
	    $trafficData = array(); /*Associative array that will hold the data requested by client*/
        $weatherData = array(); /*Associative array that will hold the data for the weather*/
        $createData = array(); /*Array that holds all the create dates for each row in database*/
        $temp = array(); /*Temporary array the holds data from database*/
		switch($day)
		{
			case 2:
				switch($region)
				{
					case "north":
					case "North":
					    if($weather == "rain")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "clear")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "cloudy")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "fog")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    foreach($weatherData as $Data)
					    {
					        $createData[] = $Data["CREATE_DATE"];
					    }
					    for($i = 0; $i < count($createData); $i++)
					    {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.633162 and 41.027571415339786)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
					    }
					    break;
					case "south":
					case "South":
					    if($weather == "rain")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "clear")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "cloudy")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "fog")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    foreach($weatherData as $Data)
					    {
					        $createData[] = $Data["CREATE_DATE"];
					    }
					    for($i = 0; $i < count($createData); $i++)
					    {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 39.244086 and 40.086863)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
					    }
					    break;
					case "central":
					case "Central":
					    if($weather == "rain")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "clear")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "cloudy")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    elseif($weather == "fog")
					    {
					        $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) between 0 and 4))";
					        $weatherData = startQuery($sql);
					    }
					    foreach($weatherData as $Data)
					    {
					        $createData[] = $Data["CREATE_DATE"];
					    }
					    for($i = 0; $i < count($createData); $i++)
					    {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.15595 and 40.595185)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
					    }
					    break;
				}
				break;
			case 1:
			    switch($region)
			    {
					case "north":
					case "North":
				        if($weather == "rain")
		    	        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
	    				    $weatherData = startQuery($sql);
		    		    }
			    	    elseif($weather == "clear")
			    	    {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
	    			    }
	    			    elseif($weather == "fog")
	    			    {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Parsippany' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
				            $weatherData = startQuery($sql);
					    }
					    foreach($weatherData as $Data)
					    {
				            $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
				            $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.633162 and 41.027571415339786)";    				            $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
					    }
					    break;
					case "south":
				    case "South":
				        if($weather == "rain")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "clear")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
				            $weatherData = startQuery($sql);
				        }
				        elseif($weather == "fog")
					    {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Manchester Township' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        foreach($weatherData as $Data)
				        {
				            $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
				            $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 39.244086 and 40.086863)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
				        }
				        break;
				    case "central":
				    case "Central":
				        if($weather == "rain")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "clear")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "fog")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and (CITY_NAME = 'Edison' and (weekday(CREATE_DATE) = 5 || weekday(CREATE_DATE) = 6))";
    					    $weatherData = startQuery($sql);
	    			    }
		    		    foreach($weatherData as $Data)
					    {
			    	        $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.15595 and 40.595185)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
				        }
				        break;
			    }
			    break;
		    case 3:
			    switch($region)
			    {
				    case "north":
				    case "North":
				        if($weather == "rain")
					    {
					        $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Parsippany'";
	    				    $weatherData = startQuery($sql);
		    			}
			    	    elseif($weather == "clear")
					    {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and CITY_NAME = 'Parsippany'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Parsippany'";
	    				    $weatherData = startQuery($sql);
		    		    }
			    	    elseif($weather == "fog")
			    	    {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Parsippany'";
				            $weatherData = startQuery($sql);
				        }
				        foreach($weatherData as $Data)
					    {
				            $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
				            $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.633162 and 41.027571415339786)";					            $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
					    }
					    break;
					case "south":
				    case "South":
				        if($weather == "rain")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Manchester Township'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "clear")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and CITY_NAME = 'Manchester Township'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Manchester Township'";
				            $weatherData = startQuery($sql);
				        }
				        elseif($weather == "fog")
					    {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Manchester Township'";
					        $weatherData = startQuery($sql);
					    }
				        foreach($weatherData as $Data)
				        {
				            $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 39.244086 and 40.086863)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
				        }
				        break;
				    case "central":
				    case "Central":
				        if($weather == "rain")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%shower%' or CONDITIONS like '%rain%') and CITY_NAME = 'Edison'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "clear")
				        {
				            $sql = "select * from WEATHER where (CONDITIONS like '%clear%' or CONDITIONS like '%sunny%') and CITY_NAME = 'Edison'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "cloudy")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%cloudy%' and CITY_NAME = 'Edison'";
					        $weatherData = startQuery($sql);
					    }
				        elseif($weather == "fog")
				        {
				            $sql = "select * from WEATHER where CONDITIONS like '%fog%' and CITY_NAME = 'Edison'";
    					    $weatherData = startQuery($sql);
	    			    }
		    		    foreach($weatherData as $Data)
					    {
			    	        $createData[] = $Data["CREATE_DATE"];
				        }
				        for($i = 0; $i < count($createData); $i++)
				        {
					        $sql2 = "select *, DATEDIFF(CURDATE(),UPDATE_DATE) as DURATION_DAYS, case hour(timediff(UPDATE_TIME,CREATE_TIME)) WHEN hour(timediff(UPDATE_TIME,CREATE_TIME)) = NULL THEN 0 ELSE hour(timediff(UPDATE_TIME,CREATE_TIME)) END as LENGTH_HOURS  from TRAFFIC where CREATE_DATE = '" . $createData[$i] . "' and (LATITUDE between 40.15595 and 40.595185)";
					        $temp = startQuery($sql2);
					        $trafficData = array_merge($trafficData, $temp);
				        }
				        break;
			    }
			    break;
		}
	}


    dbCloseConn($connect);/*Closes the connection to the MYSQL server*/
    return $trafficData; /*Returns the traffic data array to the calling function*/
	 
}

/* dbConnect() is called to open a connection to
 * MYSQL server and select the database */
function dbConn()
{
	$username = "jlsilang_jc"; /*MYSQL Username (change if needed)*/
    $password = "Runescape1"; /*MYSQL Password (change if needed)*/
    $database = "jlsilang_DB"; /*Database that will be used (change if needed)*/
    $server = "localhost"; /*The server to which MYSQL will make a connection to (change if needed)*/
    $conn = mysql_connect($server, $username, $password); /*Try to connect to MYSQL or die*/
	if(!$conn)
	{
		die(mysql_error());
	}
    $dbSelect = mysql_selectdb($database, $conn); /*Try to select the database or die*/
	if(!$dbSelect)
	{
		die(mysql_error());
	}
	return $conn;
}

/* dbCloseConn() closes the connection to the MYSQL server */
function dbCloseConn($conn)
{
	mysql_close($conn);
}

/* startQuery() is called to query the database in
 * MYSQL taking the MYSQL command statement as the arguement
 * and stores the extracted data into an associative array. */
function startQuery($sql)
{
    $collectData = array();
    $result = mysql_query($sql); /*Try to perform query command or die*/
	if(!$result)
	{
		die(mysql_error());
	}
    while($row = mysql_fetch_assoc($result))
    {
        $collectData[] = $row;
    }
    return $collectData;
	mysql_free_result($result);
}

$road = "I-78";
$region = "north";
$weather = "rain";
$time = "11";
$day = 2;
//$data = dbQuery($road, null, null, null, null);
//dbQuery(null, $region, null, null, null);
//dbQuery($road, null, $weather, null, null);
//dbQuery(null, $region, $weather, null, null);
//dbQuery($road, null, null, $time, null);
//dbQuery(null, $region, null, $time, null);
//dbQuery($road, null, null, null, $day);
//dbQuery(null, $region, null, null, $day);
//dbQuery($road, null, $weather, $time, null);
//dbQuery(null, $region, $weather, $time, null);
//dbQuery($road, null, $weather, null, $day);
//dbQuery(null, $region, $weather, null, $day);
?>
