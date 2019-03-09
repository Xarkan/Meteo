<?php

/**
 * 
 */
class CMeasure 
{

	public function post_measure() {
		$session = USingleton::getInstance('USession');
		if($session->is_set('station')) {
			$station = $session->get_value('station');
			
			foreach ($_POST['measures'] as $key => $value) {
				$sensor = new ESensor($key,'');
				$captures[] = new ECapture($sensor, $value);
			}
			$time = new DateTime($_POST['time']);
			$m = new EMeasure($station, $time, $captures);

			$dbm->save($m);
		}else{
			$view = USingleton::getInstance('View');
			$view->error('access');
		}

		

	}

	public function get_measure() {
		
	}
}