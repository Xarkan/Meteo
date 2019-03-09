<?php

/**
 * 
 */
class CJson
{

	public function get_json($params) {
		$session = USingleton::getInstance('USession');
		$view = USingleton::getInstance('View');
		if(isset($params[0]) && $session->isLogged()) {
			switch ($params[0]) {
				case 'station':
					$results = [];
					if (isset($params[1])) {
						$user = $session->get_value('user');
						$dbm = USingleton::getInstance('FDBmanager');
						$temp = new EStation($user,'');
						$temp->setId($params[1]);
						$station = $dbm->load($temp);
						if($station->getUser()->getMail() == $user->getMail() ) {
							$result = $user->loadStations();						
						}else{
							$view->error('access');
						}
					}
					$view->print_json($result);	
					break;
				
				default:
					$view->error('operation');
					break;
			}
		}else{
			$view->error('access');
		}
		
	}

	public function post_json($params) {
		$session = USingleton::getInstance('USession');
		$view = USingleton::getInstance('View');
		if(isset($params[1]) && $params[0] == 'station' && $session->is_set('user')) {
			$dbm = USingleton::getInstance('FDBmanager');
			$user = $session->get_value('user');
			$temp = new EStation($user,'');
			$temp->setId($params[1]);
			$station = $dbm->load($temp);
			if($station->getUser()->getMail() == $user->getMail() ) {
				$sensors[0] = new ESensor($_POST['variable'],'');
				$from = new DateTime($_POST['from-date']);
				$to = new DateTime($_POST['to-date']);
				$resolution = $_POST['resolution'];
				$station->sensors = $sensors;
				$result = $station->computeData($from, $to, $resolution);
					
				$view->print_json($result);
			}
		}else{
			$view->error('operation');
		}
	}


	private function clearArray($result) {
		/*foreach ($result[0] as $key => $value) {
			if(is_string($key)) {
				$columns[] = $key;
			}*/
		}


}