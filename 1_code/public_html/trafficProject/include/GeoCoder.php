<?php
// @ author Justin Silang
class GeoCoder {

	private $i287n;
	private $i287c;
	private $i80n;
	private $i78n;
	private $NJTPKn;
	private $NJTPKc;
	private $NJTPKs;
	private $NJPKYn;
	private $NJPKYc;
	private $NJPKYs;
	private $i195c;
	private $i295c;
	private $i295s;
	private $ACEs;
	
	private $map;

	function GeoCoder($mapObject) {
		$this->map=$mapObject;
		$this->buildDB();
	}
public function setColor($_road, $_region, $_sector, $_color){
    $_rd = $this->resolveRoad($_road, $_region);
                
		if($_color=="blue") {
		    $_color="http://i860.photobucket.com/albums/ab164/vlad1024/blue.png";
		   // $_color="http://i.imgur.com/loFPFBC.png";
		}
		if($_color=="red") {
		    $_color="http://i860.photobucket.com/albums/ab164/vlad1024/red.png";
		}
		if($_color=="orange") {
		    $_color="http://i860.photobucket.com/albums/ab164/vlad1024/orange.png";
		}
		if($_color=="green") {
		    $_color="http://i860.photobucket.com/albums/ab164/vlad1024/green.png";
		}
		if($_color=="yellow") {
		    $_color="http://i860.photobucket.com/albums/ab164/vlad1024/yellow.png";
		}
		switch($_region) {
			case 'n':
                        case 'north':
				switch ($_road) {
					case 'i287': $this->i287n[$_sector]["color"]=$_color; return;
					case 'i80':  $this->i80n[$_sector]["color"]=$_color; return;
					case 'i78':  $this->i78n[$_sector]["color"]=$_color;  return;
					case 'NJTPK':  $this->NJTPKn[$_sector]["color"]=$_color; return;
					case 'NJPKY':  $this->NJPKYn[$_sector]["color"]=$_color; return;
					default: return 0;
				}
			case 'c':
                        case 'central':
				switch ($_road) {
					case 'i287':  $this->i287c[$_sector]["color"]=$_color; return;
					case 'NJTPK':  $this->NJTPKc[$_sector]["color"]=$_color; return;
					case 'NJPKY':  $this->NJPKYc[$_sector]["color"]=$_color; return;
					case 'i195':  $this->i195c[$_sector]["color"]=$_color;  return;
					case 'i295':  $this->i295c[$_sector]["color"]=$_color; return;
					default: return 0;
				}
			case 's':
                        case 'south':
				switch ($_road) {
					case 'NJTPK':  $this->NJTPKs[$_sector]["color"]=$_color; return;
					case 'NJPKY':  $this->NJPKYs[$_sector]["color"]=$_color; return;
					case 'i295':  $this->i295s[$_sector]["color"]=$_color; return;
					case 'ACE':  $this->ACEs[$_sector]["color"]=$_color; return;
					default: return 0;
				}
		}
                
	}
	
	
	public function setData($_road, $_region, $_sector, $_data) {
		$_rd = resolveRoad($_road, $region);
		$_rd[$_sector]["data"]=$_data;
	}

	public function enableLiveTraffic() {
		$this->map->enableTrafficOverlay();
	}
	
	public function disableLiveTraffic() {
		$this->map->disableTrafficOverlay();
	}
	
	public function displayRoad($_road, $_region) {

		if($_region=="r") {
			$_rdn = $this->resolveRoad($_road, 'n');
			$_rdc = $this->resolveRoad($_road, 'c');
			$_rds = $this->resolveRoad($_road, 's');
		}
		else {
			
			$_rdn = $this->resolveRoad($_road, $_region);
			$_rdc=0;
			$_rds=0;
		}
		if($_rdn !=0) {
			foreach($_rdn as $rd) {
                            if($rd["color"] == ""){$rd["color"] ="http://i860.photobucket.com/albums/ab164/vlad1024/green.png"; }
				$this->map->addMarkerByCoords($rd["long"], $rd["lat"], "", $rd["data"], $tooltip="", $filename=$rd["color"]);
			}
		}
		if($_rdc !=0) {
                        foreach($_rdc as $rd) {
                            if($rd["color"] == ""){$rd["color"] ="http://i860.photobucket.com/albums/ab164/vlad1024/green.png"; }
				$this->map->addMarkerByCoords($rd["long"], $rd["lat"], "", $rd["data"], $tooltip="", $filename=$rd["color"]);
			}
		}
		if($_rds !=0) {
			foreach($_rds as $rd) {
                            if($rd["color"] == ""){$rd["color"] ="http://i860.photobucket.com/albums/ab164/vlad1024/green.png"; }
				$this->map->addMarkerByCoords($rd["long"], $rd["lat"], "", $rd["data"], $tooltip="", $filename=$rd["color"]);
			}
		}
	}
	
	public function displayRegion($region) {
		switch ($region) {
			case 'n':
                        case 'north':
				$this->displayRoad('i287', $region);
				$this->displayRoad('i80', $region);
				$this->displayRoad('NJTPK', $region);
				$this->displayRoad('NJPKY', $region);
				$this->displayRoad('i78', $region);
				return;
			case 'c':
                        case 'central':
				$this->displayRoad('i287', $region);
				$this->displayRoad('NJTPK', $region);
				$this->displayRoad('NJPKY', $region);
				$this->displayRoad('i195', $region);
				$this->displayRoad('i295', $region);
				break;
			case 's':
                        case 'south':
				$this->displayRoad('NJTPK', $region);
				$this->displayRoad('NJPKY', $region);
				$this->displayRoad('i295', $region);
				$this->displayRoad('ACE', $region);
				break;
		}
	}
	
	public function defaultView() {
		$this->map->adjustCenterCoords(-74.553223, 40.25437660372649);
		$this->map->setZoomLevel(7);
	}
	
	private function resolveRoad($_road, $_region) {
		switch($_region) {
			case 'n':
                        case 'north':
				switch ($_road) {
					case 'i287': return $this->i287n;
					case 'i80': return $this->i80n;
					case 'i78': return $this->i78n;
					case 'NJTPK': return $this->NJTPKn;
					case 'NJPKY': return $this->NJPKYn;
					default: return 0;
				}
			case 'c':
                        case 'central':
				switch ($_road) {
					case 'i287': return $this->i287c;
					case 'NJTPK': return $this->NJTPKc;
					case 'NJPKY': return $this->NJPKYc;
					case 'i195': return $this->i195c;
					case 'i295': return $this->i295c;
					default: return 0;
				}
			case 's':
                        case 'south':
				switch ($_road) {
					case 'NJTPK': return $this->NJTPKs;
					case 'NJPKY': return $this->NJPKYs;
					case 'i295': return $this->i295s;
					case 'ACE': return $this->ACEs;
					default: return 0;
				}
		}
	}
	
	private function buildDB() {
		$this->i287n = array(
			array("lat" => 40.72878729696505, "long" => -74.53983306884766, "data" => "n0", "color" => ""),
			array("lat" => 40.84413856225261, "long" => -74.43014144897461,"data" => "n1", "color" => ""),
			array("lat" => 40.91578271304594, "long" => -74.37066078186035,"data" => "n2", "color" =>  ""),
			array("lat" => 41.027571415339786, "long" => -74.20286178588867,"data" => "n3", "color" => ""));
		$this->i287c = array(
			array("lat" => 40.55776507737398, "long" => -74.42859649658203,"data" => "c0", "color" => ""),
			array("lat" => 40.5859298421919, "long" => -74.61347579956055,"data" => "c1", "color" => ""));
		$this->i80n = array(
			array("lat" => 40.924409, "long" => -74.951477, "data" => "n0", "color" => ""),
			array("lat" => 40.910805, "long" => -74.538782, "data" => "n1", "color" => ""),
			array("lat" => 40.862138, "long" => -74.360425, "data" => "n2", "color" => ""),
			array("lat" => 40.902518, "long" => -74.121881, "data" => "n3", "color" => ""));
		$this->i78n = array(
			array("lat" => 40.633162, "long" => -74.937766, "data" => "n0", "color" => ""),
			array("lat" => 40.643754, "long" => -74.662185, "data" => "n1", "color" => ""),
			array("lat" => 40.65616, "long" => -74.443359, "data" => "n2", "color" => ""),
			array("lat" => 40.707222, "long" => -74.255347, "data" => "n3", "color" => ""),
			array("lat" => 40.708165, "long" => -74.156513, "data" => "n4", "color" => ""));
		$this->NJTPKn = array(
			array("lat" => 40.686398, "long" => -74.164968, "data" => "n0", "color" => ""),
			array("lat" => 40.797957, "long" => -74.078064, "data" => "n1", "color" => ""),
			array("lat" => 40.78210123234386, "long" => -74.05506134033203, "data" => "n2", "color" => ""),    //
			array("lat" => 40.87302619480758, "long" => -73.99703979492188, "data" => "n1", "color" => ""));
		$this->NJTPKc = array(
			array("lat" => 40.238654, "long" => -74.532623, "data" => "c0", "color" => ""),
			array("lat" => 40.394673, "long" => -74.455376, "data" => "c1", "color" => ""),
			array("lat" => 40.483042, "long" => -74.401281, "data" => "c2", "color" => ""),
			array("lat" => 40.587445, "long" => -74.238632, "data" => "c3", "color" => ""));
		$this->NJTPKs = array(
			array("lat" => 39.73762, "long" => -75.302525, "data" => "s0", "color" => ""),
			array("lat" => 39.888138, "long" => -74.998856, "data" => "s1", "color" => ""),
			array("lat" => 40.064541, "long" => -74.768872, "data" => "s2", "color" => ""));
		$this->NJPKYn = array(
			array("lat" => 40.672762, "long" => -74.281096, "data" => "n0", "color" => ""),
			array("lat" => 40.737933, "long" => -74.217625, "data" => "n1", "color" => ""),
			array("lat" => 40.806273, "long" => -74.183464, "data" => "n2", "color" => ""),
			array("lat" => 40.843611, "long" => -74.180181, "data" => "n3", "color" => ""),
			array("lat" => 40.997452, "long" => -74.071412, "data" => "n4", "color" => ""));
		$this->NJPKYc = array(
			array("lat" => 40.223255, "long" => -74.096947, "data" => "c0", "color" => ""),
			array("lat" => 40.354655, "long" => -74.123297, "data" => "c1", "color" => ""),
			array("lat" => 40.460009, "long" => -74.278564, "data" => "c2", "color" => ""),
			array("lat" => 40.595185, "long" => -74.321823, "data" => "c3", "color" => ""));
		$this->NJPKYs = array(
			array("lat" => 39.244086, "long" => -74.659417, "data" => "s0", "color" => ""),
			array("lat" => 39.61402, "long" => -74.422846, "data" => "s1", "color" => ""),
			array("lat" => 39.949688, "long" => -74.20754, "data" => "s2", "color" => ""));
		$this->i195c = array(
			array("lat" => 40.15595, "long" => -74.256506, "data" => "c0", "color" => ""),
			array("lat" => 40.176545, "long" => -74.507657, "data" => "c1", "color" => ""),
			array("lat" => 40.200183, "long" => -74.658923, "data" => "c2", "color" => ""));
		$this->i295c = array(
			array("lat" => 40.189476, "long" => -74.719788, "data" => "c0", "color" => ""),
			array("lat" => 40.287227, "long" => -74.74396, "data" => "c1", "color" => ""));
		$this->i295s = array(
			array("lat" => 39.764907, "long" => -75.35634, "data" => "s0", "color" => ""),
			array("lat" => 39.872108, "long" => -75.063513, "data" => "s1", "color" => ""),
			array("lat" => 40.086863, "long" => -74.757457, "data" => "s2", "color" => ""));	
		$this->ACEs = array(
			array("lat" => 39.484899, "long" => -74.645598, "data" => "s0", "color" => ""),
			array("lat" => 39.704809, "long" => -74.965038, "data" => "s1", "color" => ""));	
		
	}
}
?>
			