<?php

/**
 * 
 */
class CDebug 
{
	
	function get_debug() {
		$dbm = USingleton::getInstance('FDBmanager');

		$user = new EUser('test@gmail.com');
		$user->setName('pippo');
		$temp = new EStation($user,'Monte Calvo');
		$station = $dbm->load($temp);
		$s[0] = new ESensor('temp','');
		$station->sensors = $s;
		$date = new DateTime('2019-03-01');
		$r = 'hour';
		$result = $station->computeData($date, $date, $r);

		//*
		echo "<pre>";
		var_dump($result);
		echo "</pre>";//*/

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