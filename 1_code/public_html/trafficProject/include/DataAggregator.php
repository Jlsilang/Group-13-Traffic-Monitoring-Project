<?php
//@ author: Justin Silang, Jason Yang
	/* road 
	region
weather
time
day
dbQuery name of array
*/

require('DatabaseInterface.php');
require_once('GeoCoder.php');
	
	//Get's Data from DBInterface
	
	
	//echo $size_of_data_array;
	
	//Initialize arrays and counters for roads
	
	
	
	
function dataToMarkers($road,$region,$weather,$time,$day,$gc)
{

    $colors= array( 1 => "green", 2 => "blue", 3 => "yellow", 4 => "orange", 5 => "red");
        $i78_array = array();
	$i78counter = 0;
	$i80_array = array();
	$i80counter = 0;
	$i195_array = array();
	$i195counter = 0;
	$i287_array = array();
	$i287counter = 0;
	$i295_array = array();
	$i295counter = 0;
	$ACE_array = array();
	$ACEcounter = 0;
	$NJTP_array = array();
	$NJTPcounter = 0;
	$GSP_array = array();
	$GSPcounter = 0;
	$i78_array_sector_1 = array();
	$i78sector1counter = 0;
	$i78_array_sector_2 = array();
	$i78sector2counter = 0;
	$i78_array_sector_3 = array();
	$i78sector3counter = 0;
	$i78_array_sector_4 = array();
	$i78sector4counter = 0;
	$i78_array_sector_5 = array();
	$i78sector5counter = 0;
	
	
	$i80_array_sector_1 = array();
	$i80sector1counter = 0;
	$i80_array_sector_2 = array();
	$i80sector2counter = 0;
	$i80_array_sector_3 = array();
	$i80sector3counter = 0;
	$i80_array_sector_4 = array();
	$i80sector4counter = 0;
	
	
	$i195_array_sector_1 = array();
	$i195sector1counter = 0;
	$i195_array_sector_2 = array();
	$i195sector2counter = 0;
	$i195_array_sector_3 = array();
	$i195sector3counter = 0;
	$i195_array_sector_4 = array();
	$i195sector4counter = 0;
	
	
	$i287_array_sector_1 = array();
	$i287sector1counter = 0;
	$i287_array_sector_2 = array();
	$i287sector2counter = 0;
	$i287_array_sector_3 = array();
	$i287sector3counter = 0;
	$i287_array_sector_4 = array();
	$i287sector4counter = 0;
	$i287_array_sector_5 = array();
	$i287sector5counter = 0;
	$i287_array_sector_6 = array();
	$i287sector6counter = 0;
	
	
	
	$i295_array_sector_1 = array();
	$i295sector1counter = 0;
	$i295_array_sector_2 = array();
	$i295sector2counter = 0;
	$i295_array_sector_3 = array();
	$i295sector3counter = 0;
	$i295_array_sector_4 = array();
	$i295sector4counter = 0;
	
	
	$ACE_array_sector_1 = array();
	$ACEsector1counter = 0;
	$ACE_array_sector_2 = array();
	$ACEsector2counter = 0;
	$ACE_array_sector_3 = array();
	$ACEsector3counter = 0;
	$ACE_array_sector_4 = array();
	$ACEsector4counter = 0;
	
	$NJTP_array_sector_1 = array();
	$NJTPsector1counter = 0;
	$NJTP_array_sector_2 = array();
	$NJTPsector2counter = 0;
	$NJTP_array_sector_3 = array();
	$NJTPsector3counter = 0;
	$NJTP_array_sector_4 = array();
	$NJTPsector4counter = 0;
	$NJTP_array_sector_5 = array();
	$NJTPsector5counter = 0;
	$NJTP_array_sector_6 = array();
	$NJTPsector6counter = 0;
	$NJTP_array_sector_7 = array();
	$NJTPsector7counter = 0;
	$NJTP_array_sector_8 = array();
	$NJTPsector8counter = 0;
	$NJTP_array_sector_9 = array();
	$NJTPsector9counter = 0;
	$NJTP_array_sector_10 = array();
	$NJTPsector10counter = 0;
	
	$GSP_array_sector_1 = array();
	$GSPsector1counter = 0;
	$GSP_array_sector_2 = array();
	$GSPsector2counter = 0;
	$GSP_array_sector_3 = array();
	$GSPsector3counter = 0;
	$GSP_array_sector_4 = array();
	$GSPsector4counter = 0;
	$GSP_array_sector_5 = array();
	$GSPsector5counter = 0;
	$GSP_array_sector_6 = array();
	$GSPsector6counter = 0;
	$GSP_array_sector_7 = array();
	$GSPsector7counter = 0;
	$GSP_array_sector_8 = array();
	$GSPsector8counter = 0;
	$GSP_array_sector_9 = array();
	$GSPsector9counter = 0;
	$GSP_array_sector_10 = array();
	$GSPsector10counter = 0;
	$GSP_array_sector_11 = array();
	$GSPsector11counter = 0;
	$GSP_array_sector_12 = array();
	$GSPsector12counter = 0;

             
		if($road == '0'){
			$road = null;
		}
		if($road == 'NJTPK'){
			$road = 'New Jersey Turnpike';		
		}
		if($road == 'ACE'){
			$road = 'Atlantic City Expressway';		
		}
		if($road == 'NJPKY'){
			$road = 'Garden State Parkway';		
		}
		if($road == 'i295'){
			$road = 'I-295';		
		}
		if($road == 'i287'){
			$road = 'I-287';		
		}
		if($road == 'i195'){
			$road = 'I-195';		
		}
		if($road == 'i80'){
			$road = 'I-80';		
		}
		if($road == 'i78'){
			$road = 'I-78';		
		}
		if($region == 'r'){
			$region = null;		
		}
		if($region == "n"){
			$region = 'north';
			$road = null;	
		}
		if($region == "s"){
			$region = 'south';
			$road = null;	
		}
		if($region == "c"){
			$region = 'central';
			$road = null;		
		}
		if($weather == 'all'){
			$weather = null;		
		}
		if($time == '0' || $time == '0000'){
			$time = null;		
		}
                if($time){$day = null;}
		else{
                        if($day == 'all'){
                                $day = 3;
                        }
                        if($day == 'week'){
                                $day = 2;
                        }
                        if($day == 'end'){
                                $day = 1;
                        }
                }
                //echo $road . $region . $weather . $time . $day . "</br>";
	$analyzer_array = dbQuery($road,$region,$weather,$time,$day);
        //print_r($analyzer_array);
	$size_of_data_array = sizeof($analyzer_array);
	
	for($i = 0;$i <= $size_of_data_array; $i++)
	{
			
			if( $analyzer_array[$i]["ROAD_NAME"] == "I-78")
			{       if($i78counter == 0){
                                $i78_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i78_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i78_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i78_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i78_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i78_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i78_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i78_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i78_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i78_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i78counter++;

                                }
                                else{
				$i78_array[$i78counter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i78_array[$i78counter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i78_array[$i78counter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i78_array[$i78counter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i78_array[$i78counter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i78_array[$i78counter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i78_array[$i78counter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i78_array[$i78counter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i78_array[$i78counter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i78_array[$i78counter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i78counter++;}
				continue;
			}

			if( $analyzer_array[$i]["ROAD_NAME"] == "I-80")
			{       if($i80counter == 0){
                                    $i80_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $i80_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $i80_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $i80_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $i80_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $i80_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $i80_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $i80_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $i80_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $i80_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $i80counter++;
                                }else{
				$i80_array[$i80counter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i80_array[$i80counter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i80_array[$i80counter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i80_array[$i80counter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i80_array[$i80counter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i80_array[$i80counter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i80_array[$i80counter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i80_array[$i80counter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i80_array[$i80counter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i80_array[$i80counter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i80counter++;}
				continue;
			}
			if( $analyzer_array[$i]["ROAD_NAME"] == "I-195")
			{       if($i195counter == 0 ){
                                    $i195_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $i195_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $i195_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $i195_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $i195_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $i195_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $i195_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $i195_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $i195_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $i195_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $i195counter++;

                                }else{
				$i195_array[$i195counter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i195_array[$i195counter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i195_array[$i195counter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i195_array[$i195counter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i195_array[$i195counter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i195_array[$i195counter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i195_array[$i195counter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i195_array[$i195counter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i195_array[$i195counter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i195_array[$i195counter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i195counter++;}
				continue;
			}
			if( $analyzer_array[$i]["ROAD_NAME"] == "I-287")
			{       if($i287counter == 0){
                                    $i287_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $i287_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $i287_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $i287_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $i287_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $i287_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $i287_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $i287_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $i287_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $i287_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $i287counter++;
                                }else{
				$i287_array[$i287counter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i287_array[$i287counter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i287_array[$i287counter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i287_array[$i287counter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i287_array[$i287counter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i287_array[$i287counter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i287_array[$i287counter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i287_array[$i287counter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i287_array[$i287counter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i287_array[$i287counter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i287counter++;}
				continue;
			}
			if( $analyzer_array[$i]["ROAD_NAME"] == "I-295")
			{       if($i295counter == 0){
                                    $i295_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $i295_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $i295_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $i295_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $i295_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $i295_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $i295_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $i295_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $i295_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $i295_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $i295counter++;
                                }else{
				$i295_array[$i295counter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$i295_array[$i295counter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$i295_array[$i295counter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$i295_array[$i295counter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$i295_array[$i295counter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$i295_array[$i295counter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$i295_array[$i295counter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$i295_array[$i295counter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$i295_array[$i295counter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$i295_array[$i295counter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$i295counter++;}
				continue;
			}
			if( $analyzer_array[$i]["ROAD_NAME"] == "Atlantic City Expressway")
			{       if($ACEcounter == 0){
                                    $ACE_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $ACE_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $ACE_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $ACE_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $ACE_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $ACE_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $ACE_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $ACE_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $ACE_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $ACE_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $ACEcounter++;

                                }else{
				$ACE_array[$ACEcounter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$ACE_array[$ACEcounter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$ACE_array[$ACEcounter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$ACE_array[$ACEcounter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$ACE_array[$ACEcounter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$ACE_array[$ACEcounter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$ACE_array[$ACEcounter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$ACE_array[$ACEcounter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$ACE_array[$ACEcounter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$ACE_array[$ACEcounter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$ACEcounter++;}
				continue;
			}
                        $pos = strpos($analyzer_array[$i]["ROAD_NAME"],"Turnpike");
			if( $pos !== FALSE)
			{       if($NJTPcounter == 0){
                                    $NJTP_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $NJTP_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $NJTP_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $NJTP_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $NJTP_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $NJTP_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $NJTP_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $NJTP_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $NJTP_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $NJTP_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $NJTPcounter++;

                                }else{
				$NJTP_array[$NJTPcounter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$NJTP_array[$NJTPcounter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$NJTP_array[$NJTPcounter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$NJTP_array[$NJTPcounter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$NJTP_array[$NJTPcounter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$NJTP_array[$NJTPcounter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$NJTP_array[$NJTPcounter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$NJTP_array[$NJTPcounter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$NJTP_array[$NJTPcounter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$NJTP_array[$NJTPcounter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$NJTPcounter++;}
				continue;
			}
			if( $analyzer_array[$i]["ROAD_NAME"] == "Garden State Parkway")
			{       if($GSPcounter == 0){
                                    $GSP_array[0]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
                                    $GSP_array[0]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
                                    $GSP_array[0]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
                                    $GSP_array[0]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
                                    $GSP_array[0]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
                                    $GSP_array[0]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
                                    $GSP_array[0]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
                                    $GSP_array[0]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
                                    $GSP_array[0]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
                                    $GSP_array[0]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
                                    $GSPcounter++;
                                }else{
				$GSP_array[$GSPcounter]["CREATE_DATE"] = $analyzer_array[$i]["CREATE_DATE"];
				$GSP_array[$GSPcounter]["CREATE_TIME"] = $analyzer_array[$i]["CREATE_TIME"];
				$GSP_array[$GSPcounter]["UPDATE_TIME"] = $analyzer_array[$i]["UPDATE_TIME"];
				$GSP_array[$GSPcounter]["UPDATE_DATE"] = $analyzer_array[$i]["UPDATE_DATE"];
				$GSP_array[$GSPcounter]["LATITUDE"] = $analyzer_array[$i]["LATITUDE"];
				$GSP_array[$GSPcounter]["LONGITUDE"] = $analyzer_array[$i]["LONGITUDE"];
				$GSP_array[$GSPcounter]["INCIDENT_TYPE"] = $analyzer_array[$i]["INCIDENT_TYPE"];
				$GSP_array[$GSPcounter]["ROAD_NAME"] = $analyzer_array[$i]["ROAD_NAME"];
				$GSP_array[$GSPcounter]["LENGTH_HOURS"] = $analyzer_array[$i]["LENGTH_HOURS"];
				$GSP_array[$GSPcounter]["DURATION_DAYS"] = $analyzer_array[$i]["DURATION_DAYS"];
				$GSPcounter++;}
				continue;
			}	
	}
        
	//print_r($GSP_array);
	//Break road arrays into sectors
	//Initialize size, arrays and counters for sectors.
		
	$size_of_i78_array = sizeof($i78_array);
        //echo "START i78 </br>";
	for($i = 0;$i < $size_of_i78_array; $i++)
	{               //echo $i . " ";
			//echo $i78_array[$i]["LATITUDE"] . $i78_array[$i]["LONGITUDE"] . $i78_array[$i]["INCIDENT_TYPE"] . "</br>";
			if( $i78_array[$i]["LATITUDE"] > 40.6 && $i78_array[$i]["LATITUDE"] < 40.75 && $i78_array[$i]["LONGITUDE"] < -74.75425958633423 && $i78_array[$i]["LONGITUDE"] > -75.17650365829468)
			{	
                                if($i78sector1counter == 0){
                                        
					$i78_array_sector_1[0]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
					$i78_array_sector_1[0]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
					$i78_array_sector_1[0]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
					$i78_array_sector_1[0]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
					$i78_array_sector_1[0]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
					$i78_array_sector_1[0]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
					$i78_array_sector_1[0]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
					$i78_array_sector_1[0]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
					$i78_array_sector_1[0]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
					$i78_array_sector_1[0]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
					$INCIDENT_TYPE[0] = $i78_array_sector_1[0]["INCIDENT_TYPE"];
					$Delays[0] = $i78_array_sector_1[0]["LENGTH_HOURS"];
					$Days[0] = $i78_array_sector_1[0]["DURATION_DAYS"];
					$i78sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                        //echo $i78sector1_value . "</br>";
                                        //echo  $colors[$i78sector1_value];
					$gc->setColor('i78', 'north', 0,$colors[$i78sector1_value]);
					$i78sector1counter++;

                                        }
                                else{
						$i78_array_sector_1[$i78sector1counter]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
						$i78_array_sector_1[$i78sector1counter]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
						$i78_array_sector_1[$i78sector1counter]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
						$i78_array_sector_1[$i78sector1counter]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
						$i78_array_sector_1[$i78sector1counter]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
						$i78_array_sector_1[$i78sector1counter]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
						$i78_array_sector_1[$i78sector1counter]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
						$i78_array_sector_1[$i78sector1counter]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
						$i78_array_sector_1[$i78sector1counter]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
						$i78_array_sector_1[$i78sector1counter]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
						$INCIDENT_TYPE[$i78sector1counter] = $i78_array_sector_1[$i78sector1counter]["INCIDENT_TYPE"];
						$Delays[$i78sector1counter] = $i78_array_sector_1[$i78sector1counter]["LENGTH_HOURS"];
						$Days[$i78sector1counter] = $i78_array_sector_1[$i78sector1counter]["DURATION_DAYS"];
						$i78sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                                //echo $i78sector1_value . "</br>";
						$gc->setColor("i78", 'north', 0, $colors[$i78sector1_value]);
						$i78sector1counter++;
				}
				continue;

			}
			if( $i78_array[$i]["LATITUDE"] > 40.6 && $i78_array[$i]["LATITUDE"] < 40.75 && $i78_array[$i]["LONGITUDE"] < -74.5228385925293 && $i78_array[$i]["LONGITUDE"] > -74.75425958633423)
			{
								if($i78sector2counter == 0){
					$i78_array_sector_2[0]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
					$i78_array_sector_2[0]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
					$i78_array_sector_2[0]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
					$i78_array_sector_2[0]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
					$i78_array_sector_2[0]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
					$i78_array_sector_2[0]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
					$i78_array_sector_2[0]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
					$i78_array_sector_2[0]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
					$i78_array_sector_2[0]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
					$i78_array_sector_2[0]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
					$INCIDENT_TYPE[0] = $i78_array_sector_2[0]["INCIDENT_TYPE"];
					$Delays[0] = $i78_array_sector_2[0]["LENGTH_HOURS"];
					$Days[0] = $i78_array_sector_2[0]["DURATION_DAYS"];
					$i78sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                        //echo $i78sector2_value . "</br>";
					$gc->setColor("i78", 'north', 1, $colors[$i78sector1_value]);
					$i78sector2counter++;

                                        }
                                else{
						$i78_array_sector_2[$i78sector2counter]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
						$i78_array_sector_2[$i78sector2counter]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
						$i78_array_sector_2[$i78sector2counter]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
						$i78_array_sector_2[$i78sector2counter]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
						$i78_array_sector_2[$i78sector2counter]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
						$i78_array_sector_2[$i78sector2counter]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
						$i78_array_sector_2[$i78sector2counter]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
						$i78_array_sector_2[$i78sector2counter]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
						$i78_array_sector_2[$i78sector2counter]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
						$i78_array_sector_2[$i78sector2counter]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
						$INCIDENT_TYPE[$i78sector2counter] = $i78_array_sector_2[$i78sector2counter]["INCIDENT_TYPE"];
						$Delays[$i78sector2counter] = $i78_array_sector_2[$i78sector2counter]["LENGTH_HOURS"];
						$Days[$i78sector2counter] = $i78_array_sector_2[$i78sector2counter]["DURATION_DAYS"];
						$i78sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                                //echo $i78sector2_value . "</br>";
						$gc->setColor("i78", 'north', 1, $colors[$i78sector1_value]);
						$i78sector2counter++;
				}
				continue;
			}
			if( $i78_array[$i]["LATITUDE"] > 40.6 && $i78_array[$i]["LATITUDE"] < 40.75 && $i78_array[$i]["LONGITUDE"] < -74.32390451431274 && $i78_array[$i]["LONGITUDE"] > -74.5228385925293)
			{
				if($i78sector3counter == 0){
					$i78_array_sector_3[0]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
					$i78_array_sector_3[0]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
					$i78_array_sector_3[0]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
					$i78_array_sector_3[0]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
					$i78_array_sector_3[0]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
					$i78_array_sector_3[0]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
					$i78_array_sector_3[0]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
					$i78_array_sector_3[0]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
					$i78_array_sector_3[0]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
					$i78_array_sector_3[0]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
					$INCIDENT_TYPE[0] = $i78_array_sector_3[0]["INCIDENT_TYPE"];
					$Delays[0] = $i78_array_sector_3[0]["LENGTH_HOURS"];
					$Days[0] = $i78_array_sector_3[0]["DURATION_DAYS"];
					$i78sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                        //echo $i78sector3_value . "</br>";
					$gc->setColor("i78", 'north', 2, $colors[$i78sector1_value]);
					$i78sector3counter++;

                                        }
                                else{
						$i78_array_sector_3[$i78sector3counter]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
						$i78_array_sector_3[$i78sector3counter]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
						$i78_array_sector_3[$i78sector3counter]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
						$i78_array_sector_3[$i78sector3counter]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
						$i78_array_sector_3[$i78sector3counter]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
						$i78_array_sector_3[$i78sector3counter]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
						$i78_array_sector_3[$i78sector3counter]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
						$i78_array_sector_3[$i78sector3counter]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
						$i78_array_sector_3[$i78sector3counter]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
						$i78_array_sector_3[$i78sector3counter]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
						$INCIDENT_TYPE[$i78sector3counter] = $i78_array_sector_3[$i78sector3counter]["INCIDENT_TYPE"];
						$Delays[$i78sector3counter] = $i78_array_sector_3[$i78sector3counter]["LENGTH_HOURS"];
						$Days[$i78sector3counter] = $i78_array_sector_3[$i78sector3counter]["DURATION_DAYS"];
						$i78sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                                //echo $i78sector3_value . "</br>";
						$gc->setColor("i78", 'north', 2, $colors[$i78sector1_value]);
						$i78sector3counter++;
				}
				continue;
			}
			if( $i78_array[$i]["LATITUDE"] > 40.6 && $i78_array[$i]["LATITUDE"] < 40.75 && $i78_array[$i]["LONGITUDE"] < -74.18565273284912 && $i78_array[$i]["LONGITUDE"] > -74.32390451431274)
			{
				if($i78sector4counter == 0){
					$i78_array_sector_4[0]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
					$i78_array_sector_4[0]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
					$i78_array_sector_4[0]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
					$i78_array_sector_4[0]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
					$i78_array_sector_4[0]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
					$i78_array_sector_4[0]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
					$i78_array_sector_4[0]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
					$i78_array_sector_4[0]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
					$i78_array_sector_4[0]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
					$i78_array_sector_4[0]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
					$INCIDENT_TYPE[0] = $i78_array_sector_4[0]["INCIDENT_TYPE"];
					$Delays[0] = $i78_array_sector_4[0]["LENGTH_HOURS"];
					$Days[0] = $i78_array_sector_4[0]["DURATION_DAYS"];
					$i78sector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                        //echo $i78sector4_value . "</br>";
					$gc->setColor("i78", 'north', 3, $colors[$i78sector1_value]);
					$i78sector4counter++;

                                        }
                                else{
						$i78_array_sector_4[$i78sector4counter]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
						$i78_array_sector_4[$i78sector4counter]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
						$i78_array_sector_4[$i78sector4counter]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
						$i78_array_sector_4[$i78sector4counter]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
						$i78_array_sector_4[$i78sector4counter]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
						$i78_array_sector_4[$i78sector4counter]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
						$i78_array_sector_4[$i78sector4counter]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
						$i78_array_sector_4[$i78sector4counter]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
						$i78_array_sector_4[$i78sector4counter]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
						$i78_array_sector_4[$i78sector4counter]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
						$INCIDENT_TYPE[$i78sector4counter] = $i78_array_sector_4[$i78sector4counter]["INCIDENT_TYPE"];
						$Delays[$i78sector4counter] = $i78_array_sector_4[$i78sector4counter]["LENGTH_HOURS"];
						$Days[$i78sector4counter] = $i78_array_sector_4[$i78sector4counter]["DURATION_DAYS"];
						$i78sector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                                //echo $i78sector4_value . "</br>";
						$gc->setColor("i78", 'north', 3, $colors[$i78sector1_value]);
						$i78sector4counter++;
				}
				continue;
			}
			if( $i78_array[$i]["LATITUDE"] > 40.6 && $i78_array[$i]["LATITUDE"] < 40.75 && $i78_array[$i]["LONGITUDE"] < -74.05203580856323 && $i78_array[$i]["LONGITUDE"] > -74.18565273284912)
			{
					if($i78sector5counter == 0){
					$i78_array_sector_5[0]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
					$i78_array_sector_5[0]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
					$i78_array_sector_5[0]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
					$i78_array_sector_5[0]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
					$i78_array_sector_5[0]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
					$i78_array_sector_5[0]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
					$i78_array_sector_5[0]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
					$i78_array_sector_5[0]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
					$i78_array_sector_5[0]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
					$i78_array_sector_5[0]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
					$INCIDENT_TYPE[0] = $i78_array_sector_5[0]["INCIDENT_TYPE"];
					$Delays[0] = $i78_array_sector_5[0]["LENGTH_HOURS"];
					$Days[0] = $i78_array_sector_5[0]["DURATION_DAYS"];
					$i78sector5_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                        //echo $i78sector5_value . "</br>";
					$gc->setColor("i78", 'north', 4, $colors[$i78sector1_value]);
					$i78sector5counter++;

                                        }
                                else{
						$i78_array_sector_5[$i78sector5counter]["CREATE_DATE"] = $i78_array[$i]["CREATE_DATE"];
						$i78_array_sector_5[$i78sector5counter]["CREATE_TIME"] = $i78_array[$i]["CREATE_TIME"];
						$i78_array_sector_5[$i78sector5counter]["UPDATE_TIME"] = $i78_array[$i]["UPDATE_TIME"];
						$i78_array_sector_5[$i78sector5counter]["UPDATE_DATE"] = $i78_array[$i]["UPDATE_DATE"];
						$i78_array_sector_5[$i78sector5counter]["LATITUDE"] = $i78_array[$i]["LATITUDE"];
						$i78_array_sector_5[$i78sector5counter]["LONGITUDE"] = $i78_array[$i]["LONGITUDE"];
						$i78_array_sector_5[$i78sector5counter]["INCIDENT_TYPE"] = $i78_array[$i]["INCIDENT_TYPE"];
						$i78_array_sector_5[$i78sector5counter]["ROAD_NAME"] = $i78_array[$i]["ROAD_NAME"];
						$i78_array_sector_5[$i78sector5counter]["LENGTH_HOURS"] = $i78_array[$i]["LENGTH_HOURS"];
						$i78_array_sector_5[$i78sector5counter]["DURATION_DAYS"] = $i78_array[$i]["DURATION_DAYS"];
						$INCIDENT_TYPE[$i78sector5counter] = $i78_array_sector_5[$i78sector5counter]["INCIDENT_TYPE"];
						$Delays[$i78sector5counter] = $i78_array_sector_5[$i78sector5counter]["LENGTH_HOURS"];
						$Days[$i78sector5counter] = $i78_array_sector_5[$i78sector5counter]["DURATION_DAYS"];
						$i78sector5_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                                //echo $i78sector5_value . "</br>";
						$gc->setColor("i78", 'north', 4, $colors[$i78sector1_value]);
						$i78sector5counter++;
				}
				continue;
			}
                        
	}
	//echo "START i80 </br>";
	$size_of_i80_array = sizeof($i80_array);
	for($i = 0;$i < $size_of_i80_array; $i++)
	{
			//echo $i . " ";
			//echo $i80_array[$i]["LATITUDE"] . $i80_array[$i]["LONGITUDE"] . $i80_array[$i]["INCIDENT_TYPE"] . "</br>";
			if( $i80_array[$i]["LATITUDE"] > 40.8 && $i80_array[$i]["LATITUDE"] < 41.1 && $i80_array[$i]["LONGITUDE"] < -74.69733238220215 && $i80_array[$i]["LONGITUDE"] > -75.14)
			{       
				$i80_array_sector_1[$i80sector1counter]["CREATE_DATE"] = $i80_array[$i]["CREATE_DATE"];
				$i80_array_sector_1[$i80sector1counter]["CREATE_TIME"] = $i80_array[$i]["CREATE_TIME"];
				$i80_array_sector_1[$i80sector1counter]["UPDATE_TIME"] = $i80_array[$i]["UPDATE_TIME"];
				$i80_array_sector_1[$i80sector1counter]["UPDATE_DATE"] = $i80_array[$i]["UPDATE_DATE"];
				$i80_array_sector_1[$i80sector1counter]["LATITUDE"] = $i80_array[$i]["LATITUDE"];
				$i80_array_sector_1[$i80sector1counter]["LONGITUDE"] = $i80_array[$i]["LONGITUDE"];
				$i80_array_sector_1[$i80sector1counter]["INCIDENT_TYPE"] = $i80_array[$i]["INCIDENT_TYPE"];
				$i80_array_sector_1[$i80sector1counter]["ROAD_NAME"] = $i80_array[$i]["ROAD_NAME"];
				$i80_array_sector_1[$i80sector1counter]["LENGTH_HOURS"] = $i80_array[$i]["LENGTH_HOURS"];
				$i80_array_sector_1[$i80sector1counter]["DURATION_DAYS"] = $i80_array[$i]["DURATION_DAYS"];
				
				$INCIDENT_TYPE[$i80sector1counter] = $i80_array_sector_1[$i80sector1counter]["INCIDENT_TYPE"];
                                $Delays[$i80sector1counter] = $i80_array_sector_1[$i80sector1counter]["LENGTH_HOURS"];
                                $Days[$i80sector1counter] = $i80_array_sector_1[$i80sector1counter]["DURATION_DAYS"];
                                $i80sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i80sector1_value . "</br>";
				$gc->setColor("i80", 'north', 0, $colors[$i80sector1_value]);
                                $i80sector1counter++;
				continue;
			}
			if( $i80_array[$i]["LATITUDE"] > 40.8 && $i80_array[$i]["LATITUDE"] < 41.1 && $i80_array[$i]["LONGITUDE"] < -74.43811297416687 && $i80_array[$i]["LONGITUDE"] > -74.69733238220215)
			{       
				$i80_array_sector_2[$i80sector2counter]["CREATE_DATE"] = $i80_array[$i]["CREATE_DATE"];
				$i80_array_sector_2[$i80sector2counter]["CREATE_TIME"] = $i80_array[$i]["CREATE_TIME"];
				$i80_array_sector_2[$i80sector2counter]["UPDATE_TIME"] = $i80_array[$i]["UPDATE_TIME"];
				$i80_array_sector_2[$i80sector2counter]["UPDATE_DATE"] = $i80_array[$i]["UPDATE_DATE"];
				$i80_array_sector_2[$i80sector2counter]["LATITUDE"] = $i80_array[$i]["LATITUDE"];
				$i80_array_sector_2[$i80sector2counter]["LONGITUDE"] = $i80_array[$i]["LONGITUDE"];
				$i80_array_sector_2[$i80sector2counter]["INCIDENT_TYPE"] = $i80_array[$i]["INCIDENT_TYPE"];
				$i80_array_sector_2[$i80sector2counter]["ROAD_NAME"] = $i80_array[$i]["ROAD_NAME"];
				$i80_array_sector_2[$i80sector2counter]["LENGTH_HOURS"] = $i80_array[$i]["LENGTH_HOURS"];
				$i80_array_sector_2[$i80sector2counter]["DURATION_DAYS"] = $i80_array[$i]["DURATION_DAYS"];
				$INCIDENT_TYPE[$i80sector2counter] = $i80_array_sector_2[$i80sector2counter]["INCIDENT_TYPE"];
                                $Delays[$i80sector2counter] = $i80_array_sector_2[$i80sector2counter]["LENGTH_HOURS"];
                                $Days[$i80sector2counter] = $i80_array_sector_2[$i80sector2counter]["DURATION_DAYS"];
                                $i80sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i80sector2_value . "</br>";
				$gc->setColor("i80", 'north', 1, $colors[$i80sector2_value]);
                                $i80sector2counter++;
				continue;
			}
			if( $i80_array[$i]["LATITUDE"] > 40.8 && $i80_array[$i]["LATITUDE"] < 41.1 && $i80_array[$i]["LONGITUDE"] < -73 && $i80_array[$i]["LONGITUDE"] > -74.43811297416687)
			{       //echo "HERE3";
				$i80_array_sector_3[$i80sector3counter]["CREATE_DATE"] = $i80_array[$i]["CREATE_DATE"];
				$i80_array_sector_3[$i80sector3counter]["CREATE_TIME"] = $i80_array[$i]["CREATE_TIME"];
				$i80_array_sector_3[$i80sector3counter]["UPDATE_TIME"] = $i80_array[$i]["UPDATE_TIME"];
				$i80_array_sector_3[$i80sector3counter]["UPDATE_DATE"] = $i80_array[$i]["UPDATE_DATE"];
				$i80_array_sector_3[$i80sector3counter]["LATITUDE"] = $i80_array[$i]["LATITUDE"];
				$i80_array_sector_3[$i80sector3counter]["LONGITUDE"] = $i80_array[$i]["LONGITUDE"];
				$i80_array_sector_3[$i80sector3counter]["INCIDENT_TYPE"] = $i80_array[$i]["INCIDENT_TYPE"];
				$i80_array_sector_3[$i80sector3counter]["ROAD_NAME"] = $i80_array[$i]["ROAD_NAME"];
				$i80_array_sector_3[$i80sector3counter]["LENGTH_HOURS"] = $i80_array[$i]["LENGTH_HOURS"];
				$i80_array_sector_3[$i80sector3counter]["DURATION_DAYS"] = $i80_array[$i]["DURATION_DAYS"];
				$INCIDENT_TYPE[$i80sector3counter] = $i80_array_sector_3[$i80sector3counter]["INCIDENT_TYPE"];
                                $Delays[$i80sector3counter] = $i80_array_sector_3[$i80sector3counter]["LENGTH_HOURS"];
                                $Days[$i80sector3counter] = $i80_array_sector_3[$i80sector3counter]["DURATION_DAYS"];
                                $i80sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i80sector3_value . "</br>";
				$gc->setColor("i80", 'north', 2, $colors[$i80sector3_value]);
                                $i80sector3counter++;
				continue;
			}
			if( $i80_array[$i]["LATITUDE"] > 40.8 && $i80_array[$i]["LATITUDE"] < 41.1 && $i80_array[$i]["LONGITUDE"] < -74.05744314193726 && $i80_array[$i]["LONGITUDE"] > -74.17425870895386)
			{       //echo "HERE4";
				$i80_array_sector_4[$i80sector4counter]["CREATE_DATE"] = $i80_array[$i]["CREATE_DATE"];
				$i80_array_sector_4[$i80sector4counter]["CREATE_TIME"] = $i80_array[$i]["CREATE_TIME"];
				$i80_array_sector_4[$i80sector4counter]["UPDATE_TIME"] = $i80_array[$i]["UPDATE_TIME"];
				$i80_array_sector_4[$i80sector4counter]["UPDATE_DATE"] = $i80_array[$i]["UPDATE_DATE"];
				$i80_array_sector_4[$i80sector4counter]["LATITUDE"] = $i80_array[$i]["LATITUDE"];
				$i80_array_sector_4[$i80sector4counter]["LONGITUDE"] = $i80_array[$i]["LONGITUDE"];
				$i80_array_sector_4[$i80sector4counter]["INCIDENT_TYPE"] = $i80_array[$i]["INCIDENT_TYPE"];
				$i80_array_sector_4[$i80sector4counter]["ROAD_NAME"] = $i80_array[$i]["ROAD_NAME"];
				$i80_array_sector_4[$i80sector4counter]["LENGTH_HOURS"] = $i80_array[$i]["LENGTH_HOURS"];
				$i80_array_sector_4[$i80sector4counter]["DURATION_DAYS"] = $i80_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i80sector4counter] = $i80_array_sector_4[$i80sector4counter]["INCIDENT_TYPE"];
                                $Delays[$i80sector4counter] = $i80_array_sector_4[$i80sector4counter]["LENGTH_HOURS"];
                                $Days[$i80sector4counter] = $i80_array_sector_4[$i80sector4counter]["DURATION_DAYS"];
                                $i80sector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i80sector4_value . "</br>";
				$gc->setColor("i80",'north', 3, $colors[$i80sector4_value]);
                                $i80sector4counter++;
				continue;
			}
	}
	
	//echo "START i185 </br>";
	$size_of_i195_array = sizeof($i195_array);
	for($i = 0;$i < $size_of_i195_array; $i++)
	{               //echo $i . " ";
			//echo $i195_array[$i]["LATITUDE"] . $i195_array[$i]["LONGITUDE"] . $i195_array[$i]["INCIDENT_TYPE"] . "</br>";
			
			if( $i195_array[$i]["LATITUDE"] > 40.1 && $i195_array[$i]["LATITUDE"] < 40.3 && $i195_array[$i]["LONGITUDE"] < -74.60188865661621 && $i195_array[$i]["LONGITUDE"] > -74.73)
			{       //echo "HERE1";
				$i195_array_sector_1[$i195sector1counter]["CREATE_DATE"] = $i195_array[$i]["CREATE_DATE"];
				$i195_array_sector_1[$i195sector1counter]["CREATE_TIME"] = $i195_array[$i]["CREATE_TIME"];
				$i195_array_sector_1[$i195sector1counter]["UPDATE_TIME"] = $i195_array[$i]["UPDATE_TIME"];
				$i195_array_sector_1[$i195sector1counter]["UPDATE_DATE"] = $i195_array[$i]["UPDATE_DATE"];
				$i195_array_sector_1[$i195sector1counter]["LATITUDE"] = $i195_array[$i]["LATITUDE"];
				$i195_array_sector_1[$i195sector1counter]["LONGITUDE"] = $i195_array[$i]["LONGITUDE"];
				$i195_array_sector_1[$i195sector1counter]["INCIDENT_TYPE"] = $i195_array[$i]["INCIDENT_TYPE"];
				$i195_array_sector_1[$i195sector1counter]["ROAD_NAME"] = $i195_array[$i]["ROAD_NAME"];
				$i195_array_sector_1[$i195sector1counter]["LENGTH_HOURS"] = $i195_array[$i]["LENGTH_HOURS"];
				$i195_array_sector_1[$i195sector1counter]["DURATION_DAYS"] = $i195_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i195sector1counter] = $i195_array_sector_1[$i195sector1counter]["INCIDENT_TYPE"];
                                $Delays[$i195sector1counter] = $i195_array_sector_1[$i195sector1counter]["LENGTH_HOURS"];
                                $Days[$i195sector1counter] = $i195_array_sector_1[$i195sector1counter]["DURATION_DAYS"];
                                $i195sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i195sector1_value . "</br>";
				$gc->setColor("i195",'central', 2, $colors[$i195sector1_value]);
                                $i195sector1counter++;
				continue;
			}
			if( $i195_array[$i]["LATITUDE"] > 40.1 && $i195_array[$i]["LATITUDE"] < 40.3 && $i195_array[$i]["LONGITUDE"] < -74.42606449127197 && $i195_array[$i]["LONGITUDE"] > -74.60188865661621)
			{       //echo "HERE2";
				$i195_array_sector_2[$i195sector2counter]["CREATE_DATE"] = $i195_array[$i]["CREATE_DATE"];
				$i195_array_sector_2[$i195sector2counter]["CREATE_TIME"] = $i195_array[$i]["CREATE_TIME"];
				$i195_array_sector_2[$i195sector2counter]["UPDATE_TIME"] = $i195_array[$i]["UPDATE_TIME"];
				$i195_array_sector_2[$i195sector2counter]["UPDATE_DATE"] = $i195_array[$i]["UPDATE_DATE"];
				$i195_array_sector_2[$i195sector2counter]["LATITUDE"] = $i195_array[$i]["LATITUDE"];
				$i195_array_sector_2[$i195sector2counter]["LONGITUDE"] = $i195_array[$i]["LONGITUDE"];
				$i195_array_sector_2[$i195sector2counter]["INCIDENT_TYPE"] = $i195_array[$i]["INCIDENT_TYPE"];
				$i195_array_sector_2[$i195sector2counter]["ROAD_NAME"] = $i195_array[$i]["ROAD_NAME"];
				$i195_array_sector_2[$i195sector2counter]["LENGTH_HOURS"] = $i195_array[$i]["LENGTH_HOURS"];
				$i195_array_sector_2[$i195sector2counter]["DURATION_DAYS"] = $i195_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i195sector2counter] = $i195_array_sector_2[$i195sector2counter]["INCIDENT_TYPE"];
                                $Delays[$i195sector2counter] = $i195_array_sector_2[$i195sector2counter]["LENGTH_HOURS"];
                                $Days[$i195sector2counter] = $i195_array_sector_2[$i195sector2counter]["DURATION_DAYS"];
                                $i195sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i195sector2_value . "</br>";
				$gc->setColor("i195",'central', 1, $colors[$i195sector2_value]);
                                $i195sector2counter++;
				continue;
			}
			if( $i195_array[$i]["LATITUDE"] > 40.1 && $i195_array[$i]["LATITUDE"] < 40.3 && $i195_array[$i]["LONGITUDE"] < -74.10930633544922 && $i195_array[$i]["LONGITUDE"] > -74.42606449127197)
			{       //echo "HERE3";
				$i195_array_sector_3[$i195sector3counter]["CREATE_DATE"] = $i195_array[$i]["CREATE_DATE"];
				$i195_array_sector_3[$i195sector3counter]["CREATE_TIME"] = $i195_array[$i]["CREATE_TIME"];
				$i195_array_sector_3[$i195sector3counter]["UPDATE_TIME"] = $i195_array[$i]["UPDATE_TIME"];
				$i195_array_sector_3[$i195sector3counter]["UPDATE_DATE"] = $i195_array[$i]["UPDATE_DATE"];
				$i195_array_sector_3[$i195sector3counter]["LATITUDE"] = $i195_array[$i]["LATITUDE"];
				$i195_array_sector_3[$i195sector3counter]["LONGITUDE"] = $i195_array[$i]["LONGITUDE"];
				$i195_array_sector_3[$i195sector3counter]["INCIDENT_TYPE"] = $i195_array[$i]["INCIDENT_TYPE"];
				$i195_array_sector_3[$i195sector3counter]["ROAD_NAME"] = $i195_array[$i]["ROAD_NAME"];
				$i195_array_sector_3[$i195sector3counter]["LENGTH_HOURS"] = $i195_array[$i]["LENGTH_HOURS"];
				$i195_array_sector_3[$i195sector3counter]["DURATION_DAYS"] = $i195_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i195sector3counter] = $i195_array_sector_3[$i195sector3counter]["INCIDENT_TYPE"];
                                $Delays[$i195sector3counter] = $i195_array_sector_3[$i195sector3counter]["LENGTH_HOURS"];
                                $Days[$i195sector3counter] = $i195_array_sector_3[$i195sector3counter]["DURATION_DAYS"];
                                $i195sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i195sector3_value . "</br>";
				$gc->setColor("i195",'central', 0, $colors[$i195sector3_value]);
                                $i195sector3counter++;
				continue;
			}
	}
	
		//echo "START i287 </br>";
	$size_of_i287_array = sizeof($i287_array);
	for($i = 0;$i < $size_of_i287_array; $i++)
	{//echo $i . " ";
			//echo $i287_array[$i]["LATITUDE"] . $i287_array[$i]["LONGITUDE"] . $i287_array[$i]["INCIDENT_TYPE"] . "</br>";
			
			if( $i287_array[$i]["LATITUDE"] > 40.992167319322334 && $i287_array[$i]["LATITUDE"] < 41.11214114440146 && $i287_array[$i]["LONGITUDE"] < -74.1 && $i287_array[$i]["LONGITUDE"] > -74.7)
			{       //echo "HERE1";
				$i287_array_sector_1[$i287sector1counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_1[$i287sector1counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_1[$i287sector1counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_1[$i287sector1counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_1[$i287sector1counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_1[$i287sector1counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_1[$i287sector1counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_1[$i287sector1counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_1[$i287sector1counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_1[$i287sector1counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];
				
                                $INCIDENT_TYPE[$i287sector1counter] = $i287_array_sector_1[$i287sector1counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector1counter] = $i287_array_sector_1[$i287sector1counter]["LENGTH_HOURS"];
                                $Days[$i287sector1counter] = $i287_array_sector_1[$i287sector1counter]["DURATION_DAYS"];
                                $i287sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector1_value . "</br>";
				$gc->setColor("i287",'north', 3, $colors[$i287sector1_value]);
                                $i287sector1counter++;
				continue;
			}
			if( $i287_array[$i]["LATITUDE"] > 40.858932335171026 && $i287_array[$i]["LATITUDE"] < 40.992167319322334 && $i287_array[$i]["LONGITUDE"] < -74.1 && $i287_array[$i]["LONGITUDE"] > -74.7)
			{       //echo "HERE2";
				$i287_array_sector_2[$i287sector2counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_2[$i287sector2counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_2[$i287sector2counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_2[$i287sector2counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_2[$i287sector2counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_2[$i287sector2counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_2[$i287sector2counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_2[$i287sector2counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_2[$i287sector2counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_2[$i287sector2counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i287sector2counter] = $i287_array_sector_2[$i287sector2counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector2counter] = $i287_array_sector_2[$i287sector2counter]["LENGTH_HOURS"];
                                $Days[$i287sector2counter] = $i287_array_sector_2[$i287sector2counter]["DURATION_DAYS"];
                                $i287sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector2_value . "</br>";
				$gc->setColor("i287",'north', 2, $colors[$i287sector2_value]);
                                $i287sector2counter++;
				continue;
			}
			if( $i287_array[$i]["LATITUDE"] > 40.79028091966677 && $i287_array[$i]["LATITUDE"] < 40.858932335171026 && $i287_array[$i]["LONGITUDE"] < -74.1 && $i287_array[$i]["LONGITUDE"] > -74.7)
			{//echo "HERE3";
				$i287_array_sector_3[$i287sector3counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_3[$i287sector3counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_3[$i287sector3counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_3[$i287sector3counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_3[$i287sector3counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_3[$i287sector3counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_3[$i287sector3counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_3[$i287sector3counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_3[$i287sector3counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_3[$i287sector3counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i287sector3counter] = $i287_array_sector_3[$i287sector3counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector3counter] = $i287_array_sector_3[$i287sector3counter]["LENGTH_HOURS"];
                                $Days[$i287sector3counter] = $i287_array_sector_3[$i287sector3counter]["DURATION_DAYS"];
                                $i287sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector3_value . "</br>";
				$gc->setColor("i287",'north', 1, $colors[$i287sector3_value]);
                                $i287sector3counter++;
				continue;
			}
			if( $i287_array[$i]["LATITUDE"] > 40.63573460818558 && $i287_array[$i]["LATITUDE"] < 40.79028091966677 && $i287_array[$i]["LONGITUDE"] < -74.1 && $i287_array[$i]["LONGITUDE"] > -74.7)
			{       //echo "HERE4";
				$i287_array_sector_4[$i287sector4counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_4[$i287sector4counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_4[$i287sector4counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_4[$i287sector4counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_4[$i287sector4counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_4[$i287sector4counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_4[$i287sector4counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_4[$i287sector4counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_4[$i287sector4counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_4[$i287sector4counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i287sector4counter] = $i287_array_sector_4[$i287sector4counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector4counter] = $i287_array_sector_4[$i287sector4counter]["LENGTH_HOURS"];
                                $Days[$i287sector4counter] = $i287_array_sector_4[$i287sector4counter]["DURATION_DAYS"];
                                $i287sector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector4_value . "</br>";
				$gc->setColor("i287",'north', 0, $colors[$i287sector4_value]);
                                $i287sector4counter++;
				continue;
			}
			if( $i287_array[$i]["LATITUDE"] > 40.5 && $i287_array[$i]["LATITUDE"] < 40.65 && $i287_array[$i]["LONGITUDE"] < -74.51135873794556 && $i287_array[$i]["LONGITUDE"] > -74.64443922042847)
			{       //echo "HERE5";
				$i287_array_sector_5[$i287sector5counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_5[$i287sector5counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_5[$i287sector5counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_5[$i287sector5counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_5[$i287sector5counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_5[$i287sector5counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_5[$i287sector5counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_5[$i287sector5counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_5[$i287sector5counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_5[$i287sector5counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i287sector5counter] = $i287_array_sector_5[$i287sector5counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector5counter] = $i287_array_sector_5[$i287sector5counter]["LENGTH_HOURS"];
                                $Days[$i287sector5counter] = $i287_array_sector_5[$i287sector5counter]["DURATION_DAYS"];
                                $i287sector5_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector5_value . "</br>";
				$gc->setColor("i287",'central', 1, $colors[$i287sector5_value]);
                                $i287sector5counter++;
				continue;
			}
			if( $i287_array[$i]["LATITUDE"] > 40.5 && $i287_array[$i]["LATITUDE"] < 40.65 && $i287_array[$i]["LONGITUDE"] < -74.336 && $i287_array[$i]["LONGITUDE"] > -74.51135873794556)
			{       //echo "HERE6";
				$i287_array_sector_6[$i287sector6counter]["CREATE_DATE"] = $i287_array[$i]["CREATE_DATE"];
				$i287_array_sector_6[$i287sector6counter]["CREATE_TIME"] = $i287_array[$i]["CREATE_TIME"];
				$i287_array_sector_6[$i287sector6counter]["UPDATE_TIME"] = $i287_array[$i]["UPDATE_TIME"];
				$i287_array_sector_6[$i287sector6counter]["UPDATE_DATE"] = $i287_array[$i]["UPDATE_DATE"];
				$i287_array_sector_6[$i287sector6counter]["LATITUDE"] = $i287_array[$i]["LATITUDE"];
				$i287_array_sector_6[$i287sector6counter]["LONGITUDE"] = $i287_array[$i]["LONGITUDE"];
				$i287_array_sector_6[$i287sector6counter]["INCIDENT_TYPE"] = $i287_array[$i]["INCIDENT_TYPE"];
				$i287_array_sector_6[$i287sector6counter]["ROAD_NAME"] = $i287_array[$i]["ROAD_NAME"];
				$i287_array_sector_6[$i287sector6counter]["LENGTH_HOURS"] = $i287_array[$i]["LENGTH_HOURS"];
				$i287_array_sector_6[$i287sector6counter]["DURATION_DAYS"] = $i287_array[$i]["DURATION_DAYS"];
                                
                                $INCIDENT_TYPE[$i287sector6counter] = $i287_array_sector_6[$i287sector6counter]["INCIDENT_TYPE"];
                                $Delays[$i287sector6counter] = $i287_array_sector_6[$i287sector6counter]["LENGTH_HOURS"];
                                $Days[$i287sector6counter] = $i287_array_sector_6[$i287sector6counter]["DURATION_DAYS"];
                                $i287sector6_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i287sector6_value . "</br>";
				$gc->setColor("i287",'central', 0, $colors[$i287sector6_value]);
                                $i287sector6counter++;
				continue;
			}
	}
	//echo "START i295 </br>";
	$size_of_i295_array = sizeof($i295_array);
	for($i = 0;$i < $size_of_i295_array; $i++)
	{//echo $i . " ";
			//echo $i295_array[$i]["LATITUDE"] . $i295_array[$i]["LONGITUDE"] . $i295_array[$i]["INCIDENT_TYPE"] . "</br>";
			
			if( $i295_array[$i]["LATITUDE"] > 40.16771546996926 && $i295_array[$i]["LATITUDE"] < 40.3 && $i295_array[$i]["LONGITUDE"] < -74.58 && $i295_array[$i]["LONGITUDE"] > -75.6)
			{       //echo "HERE1";
				$i295_array_sector_1[$i295sector1counter]["CREATE_DATE"] = $i295_array[$i]["CREATE_DATE"];
				$i295_array_sector_1[$i295sector1counter]["CREATE_TIME"] = $i295_array[$i]["CREATE_TIME"];
				$i295_array_sector_1[$i295sector1counter]["UPDATE_TIME"] = $i295_array[$i]["UPDATE_TIME"];
				$i295_array_sector_1[$i295sector1counter]["UPDATE_DATE"] = $i295_array[$i]["UPDATE_DATE"];
				$i295_array_sector_1[$i295sector1counter]["LATITUDE"] = $i295_array[$i]["LATITUDE"];
				$i295_array_sector_1[$i295sector1counter]["LONGITUDE"] = $i295_array[$i]["LONGITUDE"];
				$i295_array_sector_1[$i295sector1counter]["INCIDENT_TYPE"] = $i295_array[$i]["INCIDENT_TYPE"];
				$i295_array_sector_1[$i295sector1counter]["ROAD_NAME"] = $i295_array[$i]["ROAD_NAME"];
				$i295_array_sector_1[$i295sector1counter]["LENGTH_HOURS"] = $i295_array[$i]["LENGTH_HOURS"];
				$i295_array_sector_1[$i295sector1counter]["DURATION_DAYS"] = $i295_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i295sector1counter] = $i295_array_sector_1[$i295sector1counter]["INCIDENT_TYPE"];
                                $Delays[$i295sector1counter] = $i295_array_sector_1[$i295sector1counter]["LENGTH_HOURS"];
                                $Days[$i295sector1counter] = $i295_array_sector_1[$i295sector1counter]["DURATION_DAYS"];
                                $i295sector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i295sector1_value . "</br>";
				$gc->setColor("i295",'central', 0, $colors[$i295sector1_value]);
                                $i295sector1counter++;
				continue;
			}
			if( $i295_array[$i]["LATITUDE"] > 39.99628122298595 && $i295_array[$i]["LATITUDE"] < 40.3 && $i295_array[$i]["LONGITUDE"] < -74.58 && $i295_array[$i]["LONGITUDE"] > -75.6)
			{       //echo "HERE2";
				$i295_array_sector_2[$i295sector2counter]["CREATE_DATE"] = $i295_array[$i]["CREATE_DATE"];
				$i295_array_sector_2[$i295sector2counter]["CREATE_TIME"] = $i295_array[$i]["CREATE_TIME"];
				$i295_array_sector_2[$i295sector2counter]["UPDATE_TIME"] = $i295_array[$i]["UPDATE_TIME"];
				$i295_array_sector_2[$i295sector2counter]["UPDATE_DATE"] = $i295_array[$i]["UPDATE_DATE"];
				$i295_array_sector_2[$i295sector2counter]["LATITUDE"] = $i295_array[$i]["LATITUDE"];
				$i295_array_sector_2[$i295sector2counter]["LONGITUDE"] = $i295_array[$i]["LONGITUDE"];
				$i295_array_sector_2[$i295sector2counter]["INCIDENT_TYPE"] = $i295_array[$i]["INCIDENT_TYPE"];
				$i295_array_sector_2[$i295sector2counter]["ROAD_NAME"] = $i295_array[$i]["ROAD_NAME"];
				$i295_array_sector_2[$i295sector2counter]["LENGTH_HOURS"] = $i295_array[$i]["LENGTH_HOURS"];
				$i295_array_sector_2[$i295sector2counter]["DURATION_DAYS"] = $i295_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i295sector2counter] = $i295_array_sector_2[$i295secto2counter]["INCIDENT_TYPE"];
                                $Delays[$i295sector2counter] = $i295_array_sector_2[$i295sector2counter]["LENGTH_HOURS"];
                                $Days[$i295sector2counter] = $i295_array_sector_2[$i295sector2counter]["DURATION_DAYS"];
                                $i295sector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i295sector2_value . "</br>";
				$gc->setColor("i295",'south', 2, $colors[$i295sector2_value]);
                                $i295sector2counter++;
				continue;
			}
			if( $i295_array[$i]["LATITUDE"] > 39.832786726786274 && $i295_array[$i]["LATITUDE"] < 40.3 && $i295_array[$i]["LONGITUDE"] < -74.58 && $i295_array[$i]["LONGITUDE"] > -75.6)
			{       //echo "HERE3";
				$i295_array_sector_3[$i295sector3counter]["CREATE_DATE"] = $i295_array[$i]["CREATE_DATE"];
				$i295_array_sector_3[$i295sector3counter]["CREATE_TIME"] = $i295_array[$i]["CREATE_TIME"];
				$i295_array_sector_3[$i295sector3counter]["UPDATE_TIME"] = $i295_array[$i]["UPDATE_TIME"];
				$i295_array_sector_3[$i295sector3counter]["UPDATE_DATE"] = $i295_array[$i]["UPDATE_DATE"];
				$i295_array_sector_3[$i295sector3counter]["LATITUDE"] = $i295_array[$i]["LATITUDE"];
				$i295_array_sector_3[$i295sector3counter]["LONGITUDE"] = $i295_array[$i]["LONGITUDE"];
				$i295_array_sector_3[$i295sector3counter]["INCIDENT_TYPE"] = $i295_array[$i]["INCIDENT_TYPE"];
				$i295_array_sector_3[$i295sector3counter]["ROAD_NAME"] = $i295_array[$i]["ROAD_NAME"];
				$i295_array_sector_3[$i295sector3counter]["LENGTH_HOURS"] = $i295_array[$i]["LENGTH_HOURS"];
				$i295_array_sector_3[$i295sector3counter]["DURATION_DAYS"] = $i295_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i295sector3counter] = $i295_array_sector_3[$i295sector3counter]["INCIDENT_TYPE"];
                                $Delays[$i295sector3counter] = $i295_array_sector_3[$i295sector3counter]["LENGTH_HOURS"];
                                $Days[$i295sector3counter] = $i295_array_sector_3[$i295sector3counter]["DURATION_DAYS"];
                                $i295sector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i295sector3_value . "</br>";
				$gc->setColor("i295",'south', 1, $colors[$i295sector3_value]);
                                $i295sector3counter++;
				continue;
			}
			if( $i295_array[$i]["LATITIDE"] > 39.679047221165845 && $i295_array[$i]["LATITUDE"] < 40.3 && $i295_array[$i]["LONGITUDE"] < -74.58 && $i295_array[$i]["LONGITUDE"] > -75.6)
			{       //echo "HERE4";
				$i295_array_sector_4[$i295sector4counter]["CREATE_DATE"] = $i295_array[$i]["CREATE_DATE"];
				$i295_array_sector_4[$i295sector4counter]["CREATE_TIME"] = $i295_array[$i]["CREATE_TIME"];
				$i295_array_sector_4[$i295sector4counter]["UPDATE_TIME"] = $i295_array[$i]["UPDATE_TIME"];
				$i295_array_sector_4[$i295sector4counter]["UPDATE_DATE"] = $i295_array[$i]["UPDATE_DATE"];
				$i295_array_sector_4[$i295sector4counter]["LATITUDE"] = $i295_array[$i]["LATITUDE"];
				$i295_array_sector_4[$i295sector4counter]["LONGITUDE"] = $i295_array[$i]["LONGITUDE"];
				$i295_array_sector_4[$i295sector4counter]["INCIDENT_TYPE"] = $i295_array[$i]["INCIDENT_TYPE"];
				$i295_array_sector_4[$i295sector4counter]["ROAD_NAME"] = $i295_array[$i]["ROAD_NAME"];
				$i295_array_sector_4[$i295sector4counter]["LENGTH_HOURS"] = $i295_array[$i]["LENGTH_HOURS"];
				$i295_array_sector_4[$i295sector4counter]["DURATION_DAYS"] = $i295_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$i295sector4counter] = $i295_array_sector_4[$i295sector4counter]["INCIDENT_TYPE"];
                                $Delays[$i295sector4counter] = $i295_array_sector_4[$i295sector4counter]["LENGTH_HOURS"];
                                $Days[$i295sector4counter] = $i295_array_sector_4[$i295sector4counter]["DURATION_DAYS"];
                                $i295sector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $i295sector4_value . "</br>";
				$gc->setColor("i295",'south', 0, $colors[$i295sector4_value]);
                                $i295sector4counter++;
				continue;
			}
	}
		
	//echo "START ACE </br>";
	$size_of_ACE_array = sizeof($ACE_array);
	for($i = 0;$i < $size_of_ACE_array; $i++)
	{//echo $i . " ";
			//echo $ACE_array[$i]["LATITUDE"] . $ACE_array[$i]["LONGITUDE"] . $ACE_array[$i]["INCIDENT_TYPE"] . "</br>";
			
			if( $ACE_array[$i]["LATITUDE"] > 39.34 && $ACE_array[$i]["LATITUDE"] < 39.9 && $ACE_array[$i]["LONGITUDE"] < -74.82856750488281 && $ACE_array[$i]["LONGITUDE"] > -75.06515979766846)
			{       //echo "HERE1";
				$ACE_array_sector_1[$ACEsector1counter]["CREATE_DATE"] = $ACE_array[$i]["CREATE_DATE"];
				$ACE_array_sector_1[$ACEsector1counter]["CREATE_TIME"] = $ACE_array[$i]["CREATE_TIME"];
				$ACE_array_sector_1[$ACEsector1counter]["UPDATE_TIME"] = $ACE_array[$i]["UPDATE_TIME"];
				$ACE_array_sector_1[$ACEsector1counter]["UPDATE_DATE"] = $ACE_array[$i]["UPDATE_DATE"];
				$ACE_array_sector_1[$ACEsector1counter]["LATITUDE"] = $ACE_array[$i]["LATITUDE"];
				$ACE_array_sector_1[$ACEsector1counter]["LONGITUDE"] = $ACE_array[$i]["LONGITUDE"];
				$ACE_array_sector_1[$ACEsector1counter]["INCIDENT_TYPE"] = $ACE_array[$i]["INCIDENT_TYPE"];
				$ACE_array_sector_1[$ACEsector1counter]["ROAD_NAME"] = $ACE_array[$i]["ROAD_NAME"];
				$ACE_array_sector_1[$ACEsector1counter]["LENGTH_HOURS"] = $ACE_array[$i]["LENGTH_HOURS"];
				$ACE_array_sector_1[$ACEsector1counter]["DURATION_DAYS"] = $ACE_array[$i]["DURATION_DAYS"];
				
                                $INCIDENT_TYPE[$ACEsector1counter] = $ACE_array_sector_1[$ACEsector1counter]["INCIDENT_TYPE"];
                                $Delays[$ACEsector1counter] = $ACE_array_sector_1[$ACEsector1counter]["LENGTH_HOURS"];
                                $Days[$ACEsector1counter] = $ACE_array_sector_1[$ACEsector1counter]["DURATION_DAYS"];
                                $ACEsector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $ACEsector1_value . "</br>";
				$gc->setColor("ACE",'south', 1, $colors[$ACEsector1_value]);
                                $ACEsector1counter++;
				continue;
			}
			if( $ACE_array[$i]["LATITUDE"] > 39.34 && $ACE_array[$i]["LATITUDE"] < 39.9 && $ACE_array[$i]["LONGITUDE"] < -74.44097757339478 && $ACE_array[$i]["LONGITUDE"] > -74.82856750488281)
			{       //echo "HERE2";
				$ACE_array_sector_2[$ACEsector2counter]["CREATE_DATE"] = $ACE_array[$i]["CREATE_DATE"];
				$ACE_array_sector_2[$ACEsector2counter]["CREATE_TIME"] = $ACE_array[$i]["CREATE_TIME"];
				$ACE_array_sector_2[$ACEsector2counter]["UPDATE_TIME"] = $ACE_array[$i]["UPDATE_TIME"];
				$ACE_array_sector_2[$ACEsector2counter]["UPDATE_DATE"] = $ACE_array[$i]["UPDATE_DATE"];
				$ACE_array_sector_2[$ACEsector2counter]["LATITUDE"] = $ACE_array[$i]["LATITUDE"];
				$ACE_array_sector_2[$ACEsector2counter]["LONGITUDE"] = $ACE_array[$i]["LONGITUDE"];
				$ACE_array_sector_2[$ACEsector2counter]["INCIDENT_TYPE"] = $ACE_array[$i]["INCIDENT_TYPE"];
				$ACE_array_sector_2[$ACEsector2counter]["ROAD_NAME"] = $ACE_array[$i]["ROAD_NAME"];
				$ACE_array_sector_2[$ACEsector2counter]["LENGTH_HOURS"] = $ACE_array[$i]["LENGTH_HOURS"];
				$ACE_array_sector_2[$ACEsector2counter]["DURATION_DAYS"] = $ACE_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$ACEsector2counter] = $ACE_array_sector_2[$ACEsector2counter]["INCIDENT_TYPE"];
                                $Delays[$ACEsector2counter] = $ACE_array_sector_2[$ACEsector2counter]["LENGTH_HOURS"];
                                $Days[$ACEsector2counter] = $ACE_array_sector_2[$ACEsector2counter]["DURATION_DAYS"];
                                $ACEsector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $ACEsector2_value . "</br>";
				$gc->setColor("ACE",'south', 0, $colors[$ACEsector2_value]);
                                $ACEsector2counter++;
				continue;
			}
	}
	//echo "START NJTP </br>";
	$size_of_NJTP_array = sizeof($NJTP_array);
	for($i = 0;$i < $size_of_NJTP_array; $i++)
	{//echo $i . " ";
			//echo $NJTP_array[$i]["LATITUDE"] . $NJTP_array[$i]["LONGITUDE"] . $NJTP_array[$i]["INCIDENT_TYPE"] . "</br>";

			
			if( $NJTP_array[$i]["LATITUDE"] > 40.83322073519492 && $NJTP_array[$i]["LATITUDE"] < 40.879 && $NJTP_array[$i]["LONGITUDE"] < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_1[$NJTPsector1counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_1[$NJTPsector1counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_1[$NJTPsector1counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_1[$NJTPsector1counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_1[$NJTPsector1counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_1[$NJTPsector1counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_1[$NJTPsector1counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_1[$NJTPsector1counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_1[$NJTPsector1counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_1[$NJTPsector1counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector1counter] = $NJTP_array_sector_1[$NJTPsector1counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector1counter] = $NJTP_array_sector_1[$NJTPsector1counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector1counter] = $NJTP_array_sector_1[$NJTPsector1counter]["DURATION_DAYS"];
                                $NJTPsector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector1_value . "</br>";
				$gc->setColor("NJTPK",'north', 2, $colors[$NJTPsector1_value]);
                                $NJTPsector1counter++;
				continue;
			}
			if( $NJTP_array[$i]["LATITUDE"] > 40.74344422077066 && $NJTP_array[$i]["LATITUDE"] < 40.83322073519492 && $NJTP_array[$i]["LONGITUDE"] < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_2[$NJTPsector2counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_2[$NJTPsector2counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_2[$NJTPsector2counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_2[$NJTPsector2counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_2[$NJTPsector2counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_2[$NJTPsector2counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_2[$NJTPsector2counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_2[$NJTPsector2counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_2[$NJTPsector2counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_2[$NJTPsector2counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector2counter] = $NJTP_array_sector_2[$NJTPsector2counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector2counter] = $NJTP_array_sector_2[$NJTPsector2counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector2counter] = $NJTP_array_sector_2[$NJTPsector2counter]["DURATION_DAYS"];
                                $NJTPsector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector2_value . "</br>";
				$gc->setColor("NJTPK",'north', 1, $colors[$NJTPsector2_value]);
                                $NJTPsector2counter++;
				continue;
			}
			if( $NJTP_array[$i]["LATITUDE"] > 40.61 && $NJTP_array[$i]["LATITUDE"] < 40.74344422077066 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_3[$NJTPsector3counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_3[$NJTPsector3counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_3[$NJTPsector3counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_3[$NJTPsector3counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_3[$NJTPsector3counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_3[$NJTPsector3counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_3[$NJTPsector3counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_3[$NJTPsector3counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_3[$NJTPsector3counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_3[$NJTPsector3counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector3counter] = $NJTP_array_sector_3[$NJTPsector3counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector3counter] = $NJTP_array_sector_3[$NJTPsector3counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector3counter] = $NJTP_array_sector_3[$NJTPsector3counter]["DURATION_DAYS"];
                                $NJTPsector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector3_value . "</br>";
				$gc->setColor("NJTPK",'north', 0, $colors[$NJTPsector3_value]);
                                $NJTPsector3counter++;
				continue;
			}
			
			if( $NJTP_array[$i]["LATITUDE"] > 40.54124427614988 && $NJTP_array[$i]["LATITUDE"] < 40.628463094719486 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_4[$NJTPsector4counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_4[$NJTPsector4counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_4[$NJTPsector4counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_4[$NJTPsector4counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_4[$NJTPsector4counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_4[$NJTPsector4counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_4[$NJTPsector4counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_4[$NJTPsector4counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_4[$NJTPsector4counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_4[$NJTPsector4counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector4counter] = $NJTP_array_sector_4[$NJTPsector4counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector4counter] = $NJTP_array_sector_4[$NJTPsector4counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector4counter] = $NJTP_array_sector_4[$NJTPsector4counter]["DURATION_DAYS"];
                                $NJTPsector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector4_value . "</br>";
				$gc->setColor("NJTPK",'central', 3, $colors[$NJTPsector4_value]);
                                $NJTPsector4counter++;
				continue;
			}
			if( $NJTP_array[$i]["LATITUDE"] > 40.43837246909798 && $NJTP_array[$i]["LATITUDE"] < 40.54124427614988 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_5[$NJTPsector5counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_5[$NJTPsector5counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_5[$NJTPsector5counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_5[$NJTPsector5counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_5[$NJTPsector5counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_5[$NJTPsector5counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_5[$NJTPsector5counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_5[$NJTPsector5counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_5[$NJTPsector5counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_5[$NJTPsector5counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector5counter] = $NJTP_array_sector_5[$NJTPsector5counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector5counter] = $NJTP_array_sector_5[$NJTPsector5counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector5counter] = $NJTP_array_sector_5[$NJTPsector5counter]["DURATION_DAYS"];
                                $NJTPsector5_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector5_value . "</br>";
				$gc->setColor("NJTPK",'central', 2, $colors[$NJTPsector5_value]);
                                $NJTPsector5counter++;
				continue;
			}
			
			if( $NJTP_array[$i]["LATITUDE"] > 40.35784256556003 && $NJTP_array[$i]["LATITUDE"] < 40.43837246909798 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_6[$NJTPsector6counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_6[$NJTPsector6counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_6[$NJTPsector6counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_6[$NJTPsector6counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_6[$NJTPsector6counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_6[$NJTPsector6counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_6[$NJTPsector6counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_6[$NJTPsector6counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_6[$NJTPsector6counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_6[$NJTPsector6counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector6counter] = $NJTP_array_sector_6[$NJTPsector6counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector6counter] = $NJTP_array_sector_6[$NJTPsector6counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector6counter] = $NJTP_array_sector_6[$NJTPsector6counter]["DURATION_DAYS"];
                                $NJTPsector6_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector6_value . "</br>";
				$gc->setColor("NJTPK",'central', 1, $colors[$NJTPsector6_value]);
                                $NJTPsector6counter++;
				continue;
			}
			
			if( $NJTP_array[$i]["LATITUDE"] > 40.16 && $NJTP_array[$i]["LATITUDE"] < 40.35784256556003 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_7[$NJTPsector7counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_7[$NJTPsector7counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_7[$NJTPsector7counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_7[$NJTPsector7counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_7[$NJTPsector7counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_7[$NJTPsector7counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_7[$NJTPsector7counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_7[$NJTPsector7counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_7[$NJTPsector7counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_7[$NJTPsector7counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector7counter] = $NJTP_array_sector_7[$NJTPsector7counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector7counter] = $NJTP_array_sector_7[$NJTPsector7counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector7counter] = $NJTP_array_sector_7[$NJTPsector7counter]["DURATION_DAYS"];
                                $NJTPsector7_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector7_value . "</br>";
				$gc->setColor("NJTPK",'central', 0, $colors[$NJTPsector7_value]);
                                $NJTPsector7counter++;
				continue;
				
			}
			if( $NJTP_array[$i]["LATITUDE"] > 39.995985330682885 && $NJTP_array[$i]["LATITUDE"] < 40.158073296528414 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_8[$NJTPsector8counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_8[$NJTPsector8counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_8[$NJTPsector8counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_8[$NJTPsector8counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_8[$NJTPsector8counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_8[$NJTPsector8counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_8[$NJTPsector8counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_8[$NJTPsector8counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_8[$NJTPsector8counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_8[$NJTPsector8counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector8counter] = $NJTP_array_sector_8[$NJTPsector8counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector8counter] = $NJTP_array_sector_8[$NJTPsector8counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector8counter] = $NJTP_array_sector_8[$NJTPsector8counter]["DURATION_DAYS"];
                                $NJTPsector8_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector8_value . "</br>";
				$gc->setColor("NJTPK",'south', 2, $colors[$NJTPsector8_value]);
                                $NJTPsector8counter++;
				continue;
				
			}
			if( $NJTP_array[$i]["LATITUDE"] > 39.810801940085916 && $NJTP_array[$i]["LATITUDE"] < 39.995985330682885 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_9[$NJTPsector9counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_9[$NJTPsector9counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_9[$NJTPsector9counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_9[$NJTPsector9counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_9[$NJTPsector9counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_9[$NJTPsector9counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_9[$NJTPsector9counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_9[$NJTPsector9counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_9[$NJTPsector9counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_9[$NJTPsector9counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector9counter] = $NJTP_array_sector_9[$NJTPsector9counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector9counter] = $NJTP_array_sector_9[$NJTPsector9counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector9counter] = $NJTP_array_sector_9[$NJTPsector9counter]["DURATION_DAYS"];
                                $NJTPsector9_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector9_value . "</br>";
				$gc->setColor("NJTPK",'south', 1, $colors[$NJTPsector9_value]);
                                $NJTPsector9counter++;
				continue;
			}
			if( $NJTP_array[$i]["LATITUDE"] > 39.679047221165845 && $NJTP_array[$i]["LATITUDE"] < 39.810801940085916 && $NJTP_array[$i]["LONGITUDE"]  < -73.9 && $NJTP_array[$i]["LONGITUDE"] > -75.6)
			{
				$NJTP_array_sector_10[$NJTPsector10counter]["CREATE_DATE"] = $NJTP_array[$i]["CREATE_DATE"];
				$NJTP_array_sector_10[$NJTPsector10counter]["CREATE_TIME"] = $NJTP_array[$i]["CREATE_TIME"];
				$NJTP_array_sector_10[$NJTPsector10counter]["UPDATE_TIME"] = $NJTP_array[$i]["UPDATE_TIME"];
				$NJTP_array_sector_10[$NJTPsector10counter]["UPDATE_DATE"] = $NJTP_array[$i]["UPDATE_DATE"];
				$NJTP_array_sector_10[$NJTPsector10counter]["LATITUDE"] = $NJTP_array[$i]["LATITUDE"];
				$NJTP_array_sector_10[$NJTPsector10counter]["LONGITUDE"] = $NJTP_array[$i]["LONGITUDE"];
				$NJTP_array_sector_10[$NJTPsector10counter]["INCIDENT_TYPE"] = $NJTP_array[$i]["INCIDENT_TYPE"];
				$NJTP_array_sector_10[$NJTPsector10counter]["ROAD_NAME"] = $NJTP_array[$i]["ROAD_NAME"];
				$NJTP_array_sector_10[$NJTPsector10counter]["LENGTH_HOURS"] = $NJTP_array[$i]["LENGTH_HOURS"];
				$NJTP_array_sector_10[$NJTPsector10counter]["DURATION_DAYS"] = $NJTP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$NJTPsector10counter] = $NJTP_array_sector_10[$NJTPsector10counter]["INCIDENT_TYPE"];
                                $Delays[$NJTPsector10counter] = $NJTP_array_sector_10[$NJTPsector10counter]["LENGTH_HOURS"];
                                $Days[$NJTPsector10counter] = $NJTP_array_sector_10[$NJTPsector10counter]["DURATION_DAYS"];
                                $NJTPsector10_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $NJTPsector10_value . "</br>";
				$gc->setColor("NJTPK",'south', 0, $colors[$NJTPsector10_value]);
                                $NJTPsector10counter++;
				continue;
			}
	}
	
        //echo "START GSP </br>";
	$size_of_GSP_array = sizeof($GSP_array);
	for($i = 0;$i < $size_of_GSP_array; $i++)
	{//echo $i . " ";
			//echo $GSP_array[$i]["LATITUDE"] . $GSP_array[$i]["LONGITUDE"] . $GSP_array[$i]["INCIDENT_TYPE"] . "</br>";
			
			if( $GSP_array[$i]["LATITUDE"] > 40.92320011227387 && $GSP_array[$i]["LATITUDE"] < 41.06548680699606 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{       //echo "HERE1";
				$GSP_array_sector_1[$GSPsector1counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_1[$GSPsector1counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_1[$GSPsector1counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_1[$GSPsector1counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_1[$GSPsector1counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_1[$GSPsector1counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_1[$GSPsector1counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_1[$GSPsector1counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_1[$GSPsector1counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_1[$GSPsector1counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];
				
                                $INCIDENT_TYPE[$GSPsector1counter] = $GSP_array_sector_1[$GSPsector1counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector1counter] = $GSP_array_sector_1[$GSPsector1counter]["LENGTH_HOURS"];
                                $Days[$GSPsector1counter] = $GSP_array_sector_1[$GSPsector1counter]["DURATION_DAYS"];
                                $GSPsector1_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector1_value . "</br>";
				$gc->setColor("NJPKY",'north', 4, $colors[$GSPsector1_value]);
                                $GSPsector1counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.86039292202456 && $GSP_array[$i]["LATITUDE"] < 40.92320011227387 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{       //echo "HERE2";
				$GSP_array_sector_2[$GSPsector2counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_2[$GSPsector2counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_2[$GSPsector2counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_2[$GSPsector2counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_2[$GSPsector2counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_2[$GSPsector2counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_2[$GSPsector2counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_2[$GSPsector2counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_2[$GSPsector2counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_2[$GSPsector2counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector2counter] = $GSP_array_sector_2[$GSPsector2counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector2counter] = $GSP_array_sector_2[$GSPsector2counter]["LENGTH_HOURS"];
                                $Days[$GSPsector2counter] = $GSP_array_sector_2[$GSPsector2counter]["DURATION_DAYS"];
                                $GSPsector2_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector2_value . "</br>";
				$gc->setColor("NJPKY",'north', 3, $colors[$GSPsector2_value]);
                                $GSPsector2counter++;
				continue;
			}
			
			if( $GSP_array[$i]["LATITUDE"] > 40.76041455479931 && $GSP_array[$i]["LATITUDE"] < 40.86039292202456 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11 )
			{//echo "HERE3";
				$GSP_array_sector_3[$GSPsector3counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_3[$GSPsector3counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_3[$GSPsector3counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_3[$GSPsector3counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_3[$GSPsector3counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_3[$GSPsector3counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_3[$GSPsector3counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_3[$GSPsector3counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_3[$GSPsector3counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_3[$GSPsector3counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector3counter] = $GSP_array_sector_3[$GSPsector3counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector3counter] = $GSP_array_sector_3[$GSPsector3counter]["LENGTH_HOURS"];
                                $Days[$GSPsector3counter] = $GSP_array_sector_3[$GSPsector3counter]["DURATION_DAYS"];
                                $GSPsector3_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector3_value . "</br>";
				$gc->setColor("NJPKY",'north', 2, $colors[$GSPsector3_value]);
                                $GSPsector3counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.70635558564159 && $GSP_array[$i]["LATITUDE"] < 40.76041455479931 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{//echo "HERE4";
				$GSP_array_sector_4[$GSPsector4counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_4[$GSPsector4counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_4[$GSPsector4counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_4[$GSPsector4counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_4[$GSPsector4counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_4[$GSPsector4counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_4[$GSPsector4counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_4[$GSPsector4counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_4[$GSPsector4counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_4[$GSPsector4counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector4counter] = $GSP_array_sector_4[$GSPsector4counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector4counter] = $GSP_array_sector_4[$GSPsector4counter]["LENGTH_HOURS"];
                                $Days[$GSPsector4counter] = $GSP_array_sector_4[$GSPsector4counter]["DURATION_DAYS"];
                                $GSPsector4_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector4_value . "</br>";
				$gc->setColor("NJPKY",'north', 1, $colors[$GSPsector4_value]);
                                $GSPsector4counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.635 && $GSP_array[$i]["LATITUDE"] < 40.70635558564159 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{//echo "HERE5";
				$GSP_array_sector_5[$GSPsector5counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_5[$GSPsector5counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_5[$GSPsector5counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_5[$GSPsector5counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_5[$GSPsector5counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_5[$GSPsector5counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_5[$GSPsector5counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_5[$GSPsector5counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_5[$GSPsector5counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_5[$GSPsector5counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector5counter] = $GSP_array_sector_5[$GSPsector5counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector5counter] = $GSP_array_sector_5[$GSPsector5counter]["LENGTH_HOURS"];
                                $Days[$GSPsector5counter] = $GSP_array_sector_5[$GSPsector5counter]["DURATION_DAYS"];
                                $GSPsector5_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector5_value . "</br>";
				$gc->setColor("NJPKY",'north', 0, $colors[$GSPsector5_value]);
                                $GSPsector5counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.541810653134085 && $GSP_array[$i]["LATITUDE"] < 40.63126409996257 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{//echo "HERE6";
				$GSP_array_sector_6[$GSPsector6counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_6[$GSPsector6counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_6[$GSPsector6counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_6[$GSPsector6counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_6[$GSPsector6counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_6[$GSPsector6counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_6[$GSPsector6counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_6[$GSPsector6counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_6[$GSPsector6counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_6[$GSPsector6counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector6counter] = $GSP_array_sector_6[$GSPsector6counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector6counter] = $GSP_array_sector_6[$GSPsector6counter]["LENGTH_HOURS"];
                                $Days[$GSPsector6counter] = $GSP_array_sector_6[$GSPsector6counter]["DURATION_DAYS"];
                                $GSPsector6_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector6_value . "</br>";
				$gc->setColor("NJPKY",'central', 3, $colors[$GSPsector6_value]);
                                $GSPsector6counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.408838594166866 && $GSP_array[$i]["LATITUDE"] < 40.541810653134085 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{//echo "HERE7";
				$GSP_array_sector_7[$GSPsector7counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_7[$GSPsector7counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_7[$GSPsector7counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_7[$GSPsector7counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_7[$GSPsector7counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_7[$GSPsector7counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_7[$GSPsector7counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_7[$GSPsector7counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_7[$GSPsector7counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_7[$GSPsector7counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector7counter] = $GSP_array_sector_7[$GSPsector7counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector7counter] = $GSP_array_sector_7[$GSPsector7counter]["LENGTH_HOURS"];
                                $Days[$GSPsector7counter] = $GSP_array_sector_7[$GSPsector7counter]["DURATION_DAYS"];
                                $GSPsector7_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector7_value . "</br>";
				$gc->setColor("NJPKY",'central', 2, $colors[$GSPsector7_value]);
                                $GSPsector7counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.27918080591108 && $GSP_array[$i]["LATITUDE"] < 40.408838594166866 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11 )
			{//echo "HERE8";
				$GSP_array_sector_8[$GSPsector8counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_8[$GSPsector8counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_8[$GSPsector8counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_8[$GSPsector8counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_8[$GSPsector8counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_8[$GSPsector8counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_8[$GSPsector8counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_8[$GSPsector8counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_8[$GSPsector8counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_8[$GSPsector8counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector8counter] = $GSP_array_sector_8[$GSPsector8counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector8counter] = $GSP_array_sector_8[$GSPsector8counter]["LENGTH_HOURS"];
                                $Days[$GSPsector8counter] = $GSP_array_sector_8[$GSPsector8counter]["DURATION_DAYS"];
                                $GSPsector8_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector8_value . "</br>";
				$gc->setColor("NJPKY",'central', 1, $colors[$GSPsector8_value]);
                                $GSPsector8counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 40.15950768369703 && $GSP_array[$i]["LATITUDE"] < 40.27918080591108 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11 )
			{//echo "HERE9";
				$GSP_array_sector_9[$GSPsector9counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_9[$GSPsector9counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_9[$GSPsector9counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_9[$GSPsector9counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_9[$GSPsector9counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_9[$GSPsector9counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_9[$GSPsector9counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_9[$GSPsector9counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_9[$GSPsector9counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_9[$GSPsector9counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector9counter] = $GSP_array_sector_9[$GSPsector9counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector9counter] = $GSP_array_sector_9[$GSPsector9counter]["LENGTH_HOURS"];
                                $Days[$GSPsector9counter] = $GSP_array_sector_9[$GSPsector9counter]["DURATION_DAYS"];
                                $GSPsector9_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector9_value . "</br>";
				$gc->setColor("NJPKY",'central', 0, $colors[$GSPsector9_value]);
                                $GSPsector9counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 39.759784665700685 && $GSP_array[$i]["LATITUDE"] < 40.15950768369703 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11 )
			{//echo "HERE10";
				$GSP_array_sector_10[$GSPsector10counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_10[$GSPsector10counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_10[$GSPsector10counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_10[$GSPsector10counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_10[$GSPsector10counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_10[$GSPsector10counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_10[$GSPsector10counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_10[$GSPsector10counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_10[$GSPsector10counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_10[$GSPsector10counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];
				
                                $INCIDENT_TYPE[$GSPsector10counter] = $GSP_array_sector_10[$GSPsector10counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector10counter] = $GSP_array_sector_10[$GSPsector10counter]["LENGTH_HOURS"];
                                $Days[$GSPsector10counter] = $GSP_array_sector_10[$GSPsector10counter]["DURATION_DAYS"];
                                $GSPsector10_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector10_value . "</br>";
				$gc->setColor("NJPKY",'south', 2, $colors[$GSPsector10_value]);
                                $GSPsector10counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 39.42014017348336 && $GSP_array[$i]["LATITUDE"] < 39.759784665700685 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11 )
			{//echo "HERE11";
				$GSP_array_sector_11[$GSPsector11counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_11[$GSPsector11counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_11[$GSPsector11counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_11[$GSPsector11counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_11[$GSPsector11counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_11[$GSPsector11counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_11[$GSPsector11counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_11[$GSPsector11counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_11[$GSPsector11counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_11[$GSPsector11counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector11counter] = $GSP_array_sector_11[$GSPsector11counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector11counter] = $GSP_array_sector_11[$GSPsector11counter]["LENGTH_HOURS"];
                                $Days[$GSPsector11counter] = $GSP_array_sector_11[$GSPsector11counter]["DURATION_DAYS"];
                                $GSPsector11_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector11_value . "</br>";
				$gc->setColor("NJPKY",'south', 1, $colors[$GSPsector11_value]);
                                $GSPsector11counter++;
				continue;
			}
			if( $GSP_array[$i]["LATITUDE"] > 39.13157381575349 && $GSP_array[$i]["LATITUDE"] < 39.42014017348336 && $GSP_array[$i]["LONGITUDE"] < -73.7 && $GSP_array[$i]["LONGITUDE"] > -75.11)
			{//echo "HERE12";
				$GSP_array_sector_12[$GSPsector12counter]["CREATE_DATE"] = $GSP_array[$i]["CREATE_DATE"];
				$GSP_array_sector_12[$GSPsector12counter]["CREATE_TIME"] = $GSP_array[$i]["CREATE_TIME"];
				$GSP_array_sector_12[$GSPsector12counter]["UPDATE_TIME"] = $GSP_array[$i]["UPDATE_TIME"];
				$GSP_array_sector_12[$GSPsector12counter]["UPDATE_DATE"] = $GSP_array[$i]["UPDATE_DATE"];
				$GSP_array_sector_12[$GSPsector12counter]["LATITUDE"] = $GSP_array[$i]["LATITUDE"];
				$GSP_array_sector_12[$GSPsector12counter]["LONGITUDE"] = $GSP_array[$i]["LONGITUDE"];
				$GSP_array_sector_12[$GSPsector12counter]["INCIDENT_TYPE"] = $GSP_array[$i]["INCIDENT_TYPE"];
				$GSP_array_sector_12[$GSPsector12counter]["ROAD_NAME"] = $GSP_array[$i]["ROAD_NAME"];
				$GSP_array_sector_12[$GSPsector12counter]["LENGTH_HOURS"] = $GSP_array[$i]["LENGTH_HOURS"];
				$GSP_array_sector_12[$GSPsector12counter]["DURATION_DAYS"] = $GSP_array[$i]["DURATION_DAYS"];

                                $INCIDENT_TYPE[$GSPsector12counter] = $GSP_array_sector_12[$GSPsector12counter]["INCIDENT_TYPE"];
                                $Delays[$GSPsector12counter] = $GSP_array_sector_12[$GSPsector12counter]["LENGTH_HOURS"];
                                $Days[$GSPsector12counter] = $GSP_array_sector_12[$GSPsector12counter]["DURATION_DAYS"];
                                $GSPsector12_value = calculator($INCIDENT_TYPE, $Delays, $Days);
                                //echo $GSPsector12_value . "</br>";
				$gc->setColor("NJPKY",'south', 0, $colors[$GSPsector12_value]);
                                $GSPsector12counter++;
				continue;
			}
	}
	//$INCIDENT_TYPE = $row["INCIDENT_TYPE"];
	//$Delays = $row["LENGTH_HOURS"];
	//$Days = $row["DURATION_DAYS"];
	//calculator($INCIDENT_TYPE, $Delays, $Days);
}

//analyzer("i78","all","all","0","all");
?>
