<?php

/**
 * 
 */
class CStation 
{
	private $station; //EStation 

	public function __construct(EUser $user = NULL) {
		if ($user != NULL) {
			$name = $_POST['name'];  //$name = 'prova'; //
			$altitude = $_POST['altitude']; //$altitude = '1.1'; // 
			$latitude = $_POST['latitude']; //$latitude = '2.2'; //
			$longitude = $_POST['longitude']; //$longitude = '3.3'; //		
			$s = $_POST['sensors']; //array dei sensori temp = degC, press = pascal ecc...

			foreach ($s as $key => $value) {
				$sensors[] = new ESensor($key,$value);
			}		
			$this->station = new EStation($user, $name, $altitude, $latitude, $longitude, $sensors);
		}
	}
	//bisogna aggiungere i dati della stazione: nome, posizione ecc

	public function get_station($id) {
		if (isset($id[1]) && $id[1] == 'download') {
			$this->download($id[0]);
		}else{
			$this->display($id[0]);
		}
	}
	
	private function display($id) {	
		include 'config.php';
		$session = USingleton::getInstance('USession');
		$view = USingleton::getInstance('View');
		if($session->is_set('user')) {
			$user = $session->get_value('user');
			$dbm = USingleton::getInstance('FDBmanager');
			$temp = new EStation($user,'');
			$temp->setId($id);
			$station = $dbm->load($temp);
			if($station->getUser()->getMail() == $user->getMail() ) {
				$dbc = USingleton::getInstance('FDBcustom');
				$sensors = $dbc->load_station_sensors($station);			
				array_shift($sensors);
	        	$user = $session->get_value('user');
	        	$result = $dbm->list($station);
	        	for ($i=0; $i < count($result); $i++) { 
	        		$stations[$i]['name'] = $result[$i]->getName();
	        		$stations[$i]['id'] = $result[$i]->getId();
	        	}
	        	$lastMeasure = $dbc->limit($station, 1);
	        	$firstMeasure = $dbc->limit($station, 1, false);
	        	$d = new DateTime($lastMeasure[0]['time']);
	        	$dd = new DateTime($firstMeasure[0]['time']);
	        	$lastMeasure[0]['time'] = $d->format('Y-m-d H:i');
	        	$firstMeasure[0]['time'] = $dd->format('Y-m-d');
	        	
	        	$view->setDataIntoTemplate('firstMeasure', $firstMeasure[0]['time']);
	        	$view->setDataIntoTemplate('lastMeasure', $lastMeasure[0]);
	        	$view->setDataIntoTemplate('name', $station->getName());
	        	$view->setDataIntoTemplate('altitude', $station->getAltitude());
	        	$view->setDataIntoTemplate('latitude', $station->getLatitude());
	        	$view->setDataIntoTemplate('longitude', $station->getLongitude());
	        	$view->setDataIntoTemplate('chartlimit', $config['template']['chartlimit']);
	        	$view->setDataIntoTemplate('id', $id);
	        	$view->setDataIntoTemplate('stations', $stations);
				$view->setDataIntoTemplate('sensors', $sensors);
				//$view->setDataIntoTemplate('results', $results);
				$view->setTemplate('station.tpl');
			}else{
				$view->error('access');
			}
		}else{
			$view->error('access');
		}
	}

	private function download($id) {
		echo "prova";
	}

	public function save() {
		include 'config.php';
		$session = USingleton::getInstance('USession');
		$dbm = USingleton::getInstance('FDBmanager');
		try{
			$dbm->save($this->station);
			$station = $dbm->load($this->station);
			$dbm->create($station);
			$session->set_value('station', $station);
			//setcookie('station', $this->station->getName(), time() + $config['control']['cookie_timer']);	
			echo "station saved";
		}catch(Exeption $e) {
			echo $e->getMessage();
			var_dump($this->station);
		}				
	}


	public function post_station() {  //per fare upload successivo del db 

	}

}