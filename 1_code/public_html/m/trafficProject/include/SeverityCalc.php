<?php
// @ author: Justin Silang
	function calculator($INCIDENT_TYPE, $DELAYS, $DAYS)
	{
		$result = array();
		for($i =0; $i < count($INCIDENT_TYPE); $i++)
		{
                    if($Delays[$i] == null){
                        $Delays[$i] = 0;
                    }
                    if($Days[$i] == null){
                        $Days[$i] = 0;
                    }
                    
                    $value = Severitycalculator($INCIDENT_TYPE[$i], $Delays[$i], $Days[$i]);
                    $result[] = $value;
		}
		$x = 0;
		for($i = 0; $i< count($result); $i++)
		{
                    $x += $result[$i];
		}
		$weight = $x/count($result);
		if($weight<=2.2)
		{
			$weight = 1;
		}
		else if($weight > 2.2 && $weight<=3.15)
		{
			$weight = 2;
		}
		else if($weight > 3.15 && $weight<=3.45)
		{
			$weight = 3;
		}
		else if($weight > 3.45 && $weight<= 3.75)
		{
			$weight = 4;
		}
		else if($weight > 3.75)
		{
			$weight  = 5;
		}

		return $weight;

	}
	/*Each incident level has points for that incident
	Depending on time delay these points can be increased
	if the incident happend between 7 and 14 days of today then we multiply the incident points by 0.8.*/


	function Severitycalculator($INCIDENT_TYPE, $Delays, $Days){

		$incident5 = array("Accident", "Pedestrian Accident", "Accident with Injuries", "Vehicle fire", "Truck fire", "Overturned vehicle", "Overturned tractor trailer");
		$incident4 = array("Disabled Vehicle", "Disabled truck", "Disabled tractor trailer", "Heavy traffic");
		$incident3 = array("Accident investigation", "Unanticipated Consturction Delay", "Earlier Incident", "Pockets of Volume","Delays");
		$incident2 = array("Traffic Congestion", "Police department activity", "Pothole repairs");
		$incident1 = array("Debris spill", "Roving repairs");

		if($Days == "NULL" && $Delays == "NULL" )
		{
			$Days = 0;
			$Delays = 0;
		}
		else if( $Days != "NULL" && $Delays == "NULL")
		{
			$Delays = 0;
		}
		else if( $Days == "NULL" && $Delays != "NULL")
		{
			$Days = 0;
		}

		if(in_array($INCIDENT_TYPE,$incident5) && $Delays>=0 && $Days <= 7)
		{
			
			$value = 5*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident5) && $Delays>=0 && 7<$Days && $Days<=14)
		{
			
			$value = 5*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident5) && $Delays>=0 && 14<$Days && $Days<=21)
		{
			
			$value = 5*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident5) && $Delays>=0 && 21<$Days && $Days<=31)
		{
			
			$value = 5*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident5) && $Delays>=0 && $Days>31)
		{
			
			$value = 5*0.2;
			
		}
		//incident 4
		else if(in_array($INCIDENT_TYPE,$incident4) && 0<=$Delays && $Delays<=3 && $Days<=7)
		{
			
			$value = 4*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && $Delays>3 && $Days<=7)
		{
			
			$value = 5;
                }
			
		else if(in_array($INCIDENT_TYPE,$incident4) && 0<=$Delays && $Delays<=3 && 7<$Days && $Days<=14)
		{
			
			$value = 4*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && $Delays>3 && 7<$Days && $Days<=14)
		{
			
			$value = 5*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && 0<$Delays && $Delays<=3 && 14<$Days && $Day<=21)
		{
			
			$value = 4*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && $Delays>3 && 14<$Days && $Days<=21)
		{
			
			$value = 5*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && 0<=$Delays && $Delays<=3 && 21<$Days && $Days<=31)
		{
			
			$value = 4*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && $Delays>3 && 21<$Days && $Days<=31)
		{
			
			$value = 5*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && 0<=$Delays && $Delays<=3 && 21<$Days && $Days<=31)
		{
			
			$value = 4*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident4) && $delays>3 && 21<$Days && $Days<=31)
		{
			
			$value = 5*0.2;
			
		}
		//done till here
		//incident 3
	    else if(in_array($INCIDENT_TYPE,$incident3) && 0<=$Delays && $Delays<=2 && $Days<=7)
		{
			
			$value = 3*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 2<$Delays && $Delays<=4 && $Days<=7)
		{
			
			$value = 4*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && $Delays>4 && $Days<=7)
		{
			
			$value = 5*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 0<=$Delays && $Delays<=2 && 7<$Days && $Days<=14)
		{
			
			$value = 3*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 0<=$Delays && $Delays<=2 && 14<$Days && $Days<=21)
		{
			
			$value = 3*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 0<=$Delays && $Delays<=2 && 21<$Days && $Days<=31)
		{
			
			$value = 3*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 0<=$Delays && $Delays<=2 && $Days>31)
		{
			
			$value = 3*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 2<$Delays && $Delays<=4 && 7<$Days && $Days<=14)
		{
			
			$value = 4*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 2<$Delays && $Delays<=4 && 14<$Days && $Days<=21)
		{
		
			$value = 4*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 2<$Delays && $Delays<=4 && 21<$Days && $Days<=31)
		{
			
			$value = 4*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && 2<$Delays && $Delays<=4 && $Days>31)
		{
			
			$value = 4*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && $Delays>4 && 7<$Days && $Days<=14)
		{
			
			$value = 5*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && $Delays>4 && 14<$Days && $Days<=21)
		{
			
			$value = 5*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && $Delays>4 && 21<$Days && $Days<=31)
		{
			
			$value = 5*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident3) && $Delays>4 && $Days>31)
		{
			
			$value = 5*0.2;
			
		}
		//incident 2
		else if(in_array($INCIDENT_TYPE,$incident2) && 0<=$Delays && $Delays<=2 && $Days<=7 )
		{
			
			$value = 2*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 2<$Delays && $Delays<=4 && $Days<=7 )
		{
			
			$value = 3*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 4<$Delays && $Delays<=6 && $Days<=7 )
		{
			
			$value = 4*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && $Delays>6 && $Days<=7 )
		{
			
			$value = 5*1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 0<=$Delays && $Delays<=2 && 7<$Days && $Days<=14 )
		{
			
			$value = 2*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 0<=$Delays && $Delays<=2 && 14<$Days && $Days<=21 )
		{
			
			$value = 2*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 0<=$Delays && $Delays<=2 && 21<$Days && $Days<=31 )
		{
			
			$value = 2*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 0<=$Delays && $Delays<=2 && $Days>31)
		{
			
			$value = 2*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 2<$Delays && $Delays<=4 && 7<$Days && $Days<=14 )
		{
			
			$value = 3*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 2<$Delays && $Delays<=4 && 14<$Days && $Days<=21 )
		{
			
			$value = 3*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 2<$Delays && $Delays<=4 && 21<$Days && $Days<=31 )
		{
			
			$value = 3*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 2<$Delays && $Delays<=4 && $Days>31 )
		{
			
			$value = 3*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 4<$Delays && $Delays<=6 && 7<$Days && $Days<=14 )
		{
			
			$value = 4*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 4<$Delays && $Delays<=6 && 14<$Days && $Days<=21 )
		{
			
			$value = 4*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 4<$Delays && $Delays<=6 && 14<$Days && $Days<=21 )
		{
			
			$value = 4*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && 4<$Delays && $Delays<=6 && 21<$Days && $Days<=31 )
		{
			
			$value = 4*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && $Delays>6 && 7<$Days && $Days<=14 )
		{
			
			$value = 5*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && $Delays>6 && 14<$Days && $Days<=21 )
		{
			
			$value = 5*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && $Delays>6 && 21<$Days && $Days<=31 )
		{
			
			$value = 5*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident2) && $Delays>6 && $Days>31)
		{
			
			$value = 5*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 0<=$Delays && $Delays<=2 && $Days<=7)
		{
			
			$value = 1;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 2<$Delays && $Delays<=4 && $Days<=7)
		{
			
			$value = 2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 4<$Delays && $Delays<=6 && $Days<=7)
		{
			
			$value = 3;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 6<$Delays && $Delays<=8 && $Days<=7)
		{
			
			$value = 4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && $Delays>8 && $Days<=7)
		{
			
			$value = 5;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 0<=$Delays && $Delays<=2 && 7<$Days && $Days<=14)
		{
			
			$value = 1*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 0<=$Delays && $Delays<=2 && 14<$Days && $Days<=21)
		{
			
			$value = 1*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 0<=$Delays && $Delays<=2 && 21<$Days && $Days<=31)
		{
			
			$value = 1*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 0<=$Delays && $Delays<=2 && $Days>31)
		{
			
			$value = 1*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 2<$Delays && $Delays<=4 && 7<$Days && $Days<=14)
		{
			
			$value = 2*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 2<$Delays && $Delays<=4 && 14<$Days && $Days<=21)
		{
			
			$value = 2*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 2<$Delays && $Delays<=4 && 21<$Days && $Days<=31)
		{
			
			$value = 2*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 2<$Delays && $Delays<=4 && $Days>31)
		{
			
			$value = 2*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 4<$Delays && $Delays<=6 && 7<$Days && $Days<=14)
		{
			
			$value = 3*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 4<$Delays && $Delays<=6 && 14<$Days && $Days<=21)
		{
			
			$value = 3*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 4<$Delays && $Delays<=6 && 21<$Days && $Days<=31)
		{
			
			$value = 3*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 4<$Delays && $Delays<=6 && $Days>31)
		{
			
			$value = 3*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 6<$Delays && $Delays<=8 && 7<$Days && $Days<=14)
		{
			
			$value = 4*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 6<$Delays && $Delays<=8 && 14<$Days && $Days<=21)
		{
			
			$value = 4*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 6<$Delays && $Delays<=8 && 21<$Days && $Days<=31)
		{
			
			$value = 4*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && 6<$Delays && $Delays<=8 && $Days>31)
		{
			
			$value = 4*0.2;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && $Delays>8 && 7<$Days && $Days<=14)
		{
			
			$value = 5*0.8;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && $Delays>8 && 14<$Days && $Days<=21)
		{
			
			$value = 5*0.6;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && $Delays>8 && 21<$Days && $Days<=31)
		{
			
			$value = 5*0.4;
			
		}
		else if(in_array($INCIDENT_TYPE,$incident1) && $Delays>8 && $Days>31)
		{
			
			$value = 5*0.2;
			
		}
		else if(!(in_array($INCIDENT_TYPE,$incident1) && in_array($INCIDENT_TYPE,$incident2) && in_array($INCIDENT_TYPE,$incident3) && in_array($INCIDENT_TYPE,$incident4) && in_array($INCIDENT_TYPE,$incident1)))
		{
			
			$value =3;
		}
                return $value;
	}
?>