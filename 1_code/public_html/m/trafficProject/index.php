<?php
//@ author: Justin Silang

//ini_set('display_errors', '1'); ini_set('display_startup_errors', '1'); error_reporting(E_ALL);

require_once('include/GoogleMap.php');
require_once('include/GeoCoder.php');
require_once('include/DataAggregator.php');
require_once('include/police_user_connect.php');

$MAP_OBJECT = new GoogleMapAPI('map');  $MAP_OBJECT->_minify_js = isset($_REQUEST["min"])?FALSE:TRUE;
$MAP_OBJECT->setMapType('');
$MAP_OBJECT->setWidth(300);
$MAP_OBJECT->setHeight(400);

$road=$_GET['road'];
$region=$_GET['region'];
if(isset($_GET['time'])) {
	$time=$_GET['time'];
        
}
else {
	$time='0000';
}
if($time>'2400' || $time<'0'){
	$time='0';
}

$day=$_GET['day'];
$weather=$_GET['weather'];
$traffic=$_GET['liveTraff'];


$gc=new GeoCoder($MAP_OBJECT);
if($traffic=="Yes") {
	$gc->enableLiveTraffic();
}
else {
	$gc->disableLiveTraffic();
}
if($region=="n" || $region=="c" || $region=="s") {
    
	dataToMarkers($road,$region,$weather,$time,$day,$gc);
        $gc->displayRegion($region);
}
elseif(isset($road)==TRUE  && $road!="0") {
    dataToMarkers($road,$region,$weather,$time,$day,$gc);
    $gc->displayRoad($road, $region);
}
else {
	$gc->defaultView();
}


//Police/User report Section - Jason
//Takes the relevant police data from database and places it onto Google Maps.
$policesubmit = $_GET['submitpolice'];
if (isset($policesubmit)){
	$policeobject = new police_user_report('police');
	$policeobject->store_police_info();
	$policeobject->close_db();
	$policeobject->verify_police_data(2);
	//$policeobject->print_police_info();
	for ($i = 0; $i < count($policeobject->verified_police_array); ++$i){
		$road_name = $policeobject->verified_police_array[$i][5];
		$MAP_OBJECT->addMarkerByCoords($policeobject->verified_police_array[$i][4], $policeobject->verified_police_array[$i][3],"", $html = "<font color = \"black\">$road_name</font>", $tooltip='', "http://i76.photobucket.com/albums/j39/jason5394/Police%20Icon_zpsct68n053.png?t=14279390859", "","");
	}
}

//Same thing as above, but for user reports instead of police reports.
$usersubmit = $_GET['submituser'];
if (isset($usersubmit)){
	$userobject = new police_user_report('user');
	$userobject->store_user_info();
	//$userobject->print_user_info();
	$userobject->close_db();
	$userobject->verify_user_data(2);
	for ($i = 0; $i < count($userobject->verified_user_array); ++$i){
		$incident_label = $userobject->verified_user_array[$i][2];
		$MAP_OBJECT->addMarkerByCoords($userobject->verified_user_array[$i][4], $userobject->verified_user_array[$i][3],"", $html = "<font color = \"black\">$incident_label</font>", $tooltip='', "http://i76.photobucket.com/albums/j39/jason5394/User%20Icon_zpszi8qfgzy.png?t=1427939083", "","");
		//User Report Icon is temporary until further notice
	}
}

?>



<html>
<head>
<link rel = "stylesheet" type = "text/css" href="trafficstyle.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<title>Traffic Monitor</title>
<?=$MAP_OBJECT->getHeaderJS();?>
<?=$MAP_OBJECT->getMapJS();?>

<script>
$(document).ready(function(){
	 $("#title").delay(300).fadeTo(800, 1);
	  $("#formOpt").delay(300).fadeTo(1000, 1);
	  $(".links").delay(300).fadeTo(2000, 1);
	  $("#mapPosition").delay(600).fadeTo(2000, 1);
       	 
   
});
</script>
</head>

<body>

<p id="title" style="opacity: 0.001;">
Traffic History<br></p>

<form method="get" action="index.php" id="formOpt" style="opacity: 0.001;">



<input type="radio" name="region" id="north" value="n" <?php echo($region == "n"?'checked':null) ?>>
<label for="north"><span></span>North Region</label>
&nbsp;
<br></br>
<input type="radio" name="region" id="central" value="c"  <?php echo($region == "c"?'checked':null) ?>>
<label for="central"><span></span>Central Region</label>
<br></br>
&nbsp;
<input type="radio" name="region" id="south" value="s"  <?php echo($region == "s"?'checked':null) ?>>
<label for="south"><span></span>South Region</label>
<br></br>

&nbsp;
<input type="radio" name="region" id="road" value="r" <?php echo($region == "r"?'checked':nullx) ?>>
<label for="road"><span></span>A Road: </label>
<br></br>

<span class="custom-dropdown custom-dropdown--white">
<select class="custom-dropdown__select custom-dropdown__select--white" name="road">
<option value="0" >Select a main road</option>
<option value="i78" <?php echo($road == "i78" && $region=="r"?' selected="selected"':null) ?>>i78</option>
<option value="i80" <?php echo($road == "i80" && $region=="r"?' selected="selected"':null) ?>>i80</option>
<option value="i195" <?php echo($road == "i195" && $region=="r"?' selected="selected"':null) ?>>i195</option>
<option value="i287" <?php echo($road == "i287" && $region=="r"?' selected="selected"':null) ?>>i287</option>
<option value="i295" <?php echo($road == "i295" && $region=="r"?' selected="selected"':null) ?>>i295</option>
<option value="ACE" <?php echo($road == "ACE" && $region=="r"?' selected="selected"':null) ?>>Atlantic City Expressway</option>
<option value="NJPKY" <?php echo($road == "NJPKY" && $region=="r"?' selected="selected"':null) ?>>Garden State Parkway</option>
<option value="NJTPK" <?php echo($road == "NJTPK" && $region=="r"?' selected="selected"':null) ?>>NJ Turnpike</option>
</select>
</span> 

<br>
<br>
&nbsp;
<span class="hovtrans">
Day Selection:</span>
<span class="custom-dropdown custom-dropdown--white">
<select class="custom-dropdown__select custom-dropdown__select--white" name="day">
<option value="all" >All Days</option>
<option value="week" <?php echo($day == "week"?' selected="selected"':null) ?>>Weekday</option>
<option value="end" <?php echo($day == "end"?' selected="selected"':null) ?>>Weekend</option>
</select>
</span> 
<br></br>
&nbsp;
<span class="hovtrans">
Weather:
</span>
<span class="custom-dropdown custom-dropdown--white">
<select class="custom-dropdown__select custom-dropdown__select--white" name="weather">
<option value="all" <?php echo($weather == "all"?' selected="selected"':null) ?>>All</option>
<option value="clear" <?php echo($weather == "clear"?' selected="selected"':null) ?>>Clear</option>
<option value="rain" <?php echo($weather == "rain"?' selected="selected"':null) ?>>Rain</option>
<option value="snow" <?php echo($weather == "cloudy"?' selected="selected"':null) ?>>Cloudy</option>
<option value="fog" <?php echo($weather == "fog"?' selected="selected"':null) ?>>Fog</option>
</select>
</span>



&nbsp;
<input id="live" type="checkbox" name="liveTraff" value="Yes" <?php echo($traffic == "Yes"?'checked="checked"':null) ?>>
<label for="live"><span></span><span class="hovtrans">Display Live Traffic</span></label><br><br>

<input type="submit" class="styled-button-5" value="View Statistics" name="submit">
<br></br>
&nbsp;
<input type="submit" class="styled-button-5" value="User Report" name="submituser">
<br></br>
&nbsp;
<input type="submit" class="styled-button-5" value="Police Report" name="submitpolice">
<br></br>
&nbsp;
<input type="button" value="Submit Incident" class="styled-button-5" onClick="location.href='include/police_user_report_page.php'">
<br></br>
</form>


<a href="index.php" class="links" style="opacity: 0.001;">Start Over</a>

<div id="mapPosition" style="opacity: 0.001;">
<?=$MAP_OBJECT->printOnLoad();?>

<?=$MAP_OBJECT->printMap();?>

<?=$MAP_OBJECT->printSidebar();?>

</div>

<br>

<img src = "http://i860.photobucket.com/albums/ab164/vlad1024/green.png" /> Low  &nbsp;<img src = "http://i860.photobucket.com/albums/ab164/vlad1024/blue.png" /> Moderate Low &nbsp;<img src = "http://i860.photobucket.com/albums/ab164/vlad1024/yellow.png" /> Moderate &nbsp;<img src = "http://i860.photobucket.com/albums/ab164/vlad1024/orange.png" /> Moderate High &nbsp;<img src = "http://i860.photobucket.com/albums/ab164/vlad1024/red.png"/> Severe <br />

<br><a href="help.html" class="links" style="opacity: 0.001;">Help</a> 
&nbsp;
<a href="about.html" class="links" style="opacity: 0.001;">About</a>
<br><br>
<a href="about.html" class="links" style="opacity: 0.001;">About</a>
<br><br>
<a href="Fast.php" class="links">Fastest Route</a>
<br><br>

</body>
</html>