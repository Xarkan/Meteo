<?php

/**
 * 
 */
class CHtml
{
	
	public function get_html($params) {

	}

	public function post_html($params) {
		$session = USingleton::getInstance('USession');
		$view = USingleton::getInstance('View');
		if(isset($params[1]) && $params[0] == 'station' && $session->is_set('user')) {
			$dbm = USingleton::getInstance('FDBmanager');
			$user = $session->get_value('user');
			$temp = new EStation($user,'');
			$temp->setId($params[1]);
			$station = $dbm->load($temp);
			if($station->getUser()->getMail() == $user->getMail() ) {
				$from = new DateTime($_POST['from-date']);
				$to = new DateTime($_POST['to-date']);
				$dbc = USingleton::getInstance('FDBcustom');
				$s = $dbc->load_station_sensors($station);
				array_shift($s);
				for ($i=0; $i < count($s); $i++) { 
					$sensors[$i] = new ESensor($s[$i]['COLUMN_NAME'],'');
				}
				$station->sensors = $sensors;
				$result = $station->computeData($from, $to);

				
				$table = [];
				for ($i=0; $i < count($result) - 1; $i++) { 
					for ($j=0; $j < count($result[$i]); $j++) { 
						if ($result[0][$j]->unit == 'degC') {
							$unit = '(°C)';
						}else{
							$unit = "(".$result[0][$j]->unit.")";
						}

						$var = $result[0][$j]->variable." ".$unit;
						$table[$i][$var] = $result[$i+1][$j];
					}
				}

				$view->setDataIntoTemplate('table', $table);
				$html = $view->getHTML('table.tpl');
				echo $html;
			}	
		}else{
			$view->error('operation');
		}	

		
	}

}	
