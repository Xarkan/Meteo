<?php

/**
 * 
 */
class CDebug 
{
	
	function get_debug() {
		$dbm = USingleton::getInstance('FDBmanager');
		$view = USingleton::getInstance('View');

		$user = new EUser('test@gmail.com');
		$user->setName('pippo');
		$temp = new EStation($user,'Monte Calvo');
		$station = $dbm->load($temp);
		//$s[0] = new ESensor('temp','');
		$s[0] = new ESensor('pressure','');
		$station->sensors = $s;
		$date1 = new DateTime('2019-01-01');
		$date2 = new DateTime('2019-02-02');
		$r = 'max';
		$result = $station->computeData($date1, $date2, $r);

		/*
		echo "<pre>";
		var_dump($result);
		echo "</pre>";//*/

		$view->print_json($result); //cambiare serialize_precision in php.ini da 100 a -1

		/*$now = new DateTime();
		$now->add(new DateInterval('PT2H'));
		$step = new DateInterval('PT5M');

		$date = "2013-04-20 16:25:34"; 
		echo date("Y-m-d H:00:00",strtotime($date));*/

		/*
		for ($i=0; $i < 10; $i++) { 
			$values['temp'] = rand(-10,30);
			$values['pressure'] = rand(0,25);
			$time = $now->add($step);
			$m = new EMeasure($station, $time, $values);
			$result = $dbm->save($m);

			echo $result;
		}//*/

			

		/*echo "<pre>";
		var_dump($m);
		echo "</pre>";*/
		
		/*
		$name = 'prova';
		$altitude = '1.1';
		$latitude = '2.2'; 
		$longitude = '3.3'; 		
		$sensors = [];
		$sensors[0] = 'temp_degC';
		$sensors[1] = 'pressure_pascal';
		$station = new EStation($user, $name, $altitude, $latitude, $longitude, $sensors);//*/
	}
}