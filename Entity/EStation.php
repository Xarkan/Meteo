<?php

/**
 * 
 */
class EStation 
{
	public $user; //EUser
	public $name;
	public $altitude;
	public $latitude;
	public $longitude;
	public $sensors = []; //Array<ESensor>();
	public $id;

	
	function __construct($u, $n, $alt = 0, $lat = 0, $long = 0, $sensors = [])
	{	
		$this->user = $u;
		$this->name = $n;
		$this->altitude = $alt;
		$this->latitude = $lat;
		$this->longitude = $long;
		$this->sensors = $sensors;
	}

	public function computeData($from, $to, $resolution) {
		$dbm = USingleton::getInstance('FDBmanager');
        $sensors = $this->sensors;
        $caps[0] = new ECapture($sensors[0], '');
        $m = new EMeasure($this, '', $caps);
        
        if ($from->format('Y-m-d') == $to->format('Y-m-d')) {
            $from = new DateTime($from->format('Y-m-d').' 00:00:00');
            $to = new DateTime($to->format('Y-m-d').'23:59:59');
        }
        
        $result = $dbm->list($m, array('from' => $from, 'to' => $to));


        $sens[0][] = new ESensor('time','');
		$response = [];
        for ($s=0; $s < count($sensors); $s++) { 
            $sens[0][] = $dbm->load($sensors[$s]);
            if ($resolution == 'max') {
                for ($i=0; $i < count($result); $i++) {                         
                        $values[0] = $result[$i]->time->format('Y-m-d H:i');//('M j H:i');
                        $values[$s+1] = $result[$i]->values[$s]->value;
                        $response[$i] = $values;
                        unset($values);
                    }
                    $s = count($sensors);
            }else{
                $curr_step = clone $result[0]->time;
                if ($resolution == 'hour') {
                    $step = new DateInterval('PT1H');
                }else{
                    $step = new DateInterval('PT24H');
                }
                $curr_step->add($step);
                    
                $firstElem = true;
                $x = 0;
                $sum = 0;
                for ($i=0; $i < count($result); $i++) { 
                    $date = $result[$i]->time;
                    if ($result[$i]->values[$s]->value != null) {
                        $val = $result[$i]->values[$s]->value;
                        if($firstElem) {                        
                            $sum = $val;
                            $k = 1;
                            $firstElem = false;
                        }
                        if($date < $curr_step) {
                            $sum = $sum + $val;
                            $k++;
                            if ($i == count($result) - 1) {
                                $d = $curr_step->format('Y-m-d H:00:00');
                                $t = new DateTime($d);
                                $t->sub($step);
                                $response[$x][0] = $t->format('Y-m-d H:30');
                                $response[$x][$s+1] = round($sum / $k, 1, PHP_ROUND_HALF_DOWN);
                            }
                        }else{
                            if ($k > 1) {
                                $d = $curr_step->format('Y-m-d H:00:00');
                                $t = new DateTime($d);
                                $t->sub($step);
                                $response[$x][0] = $t->format('Y-m-d H:30');
                                $response[$x][$s+1] = round($sum / $k, 1, PHP_ROUND_HALF_DOWN);
                                $x++;
                            }                           
                            $curr_step->add($step);
                            $i--;
                            $firstElem = true;
                            $sum = 0;
                        }
                    }else{
                        if($date > $curr_step) {
                            $d = $curr_step->format('Y-m-d H:00:00');
                            $t = new DateTime($d);
                            $t->sub($step);
                            $response[$x][0] = $t->format('Y-m-d H:30');
                            if ($firstElem) {                          
                              $response[$x][$s+1] = null;                                
                            }else{
                                $response[$x][$s+1] = round($sum / $k, 1, PHP_ROUND_HALF_DOWN);
                                $firstElem = true;
                                $sum = 0;
                            }
                            $x++;
                            $curr_step->add($step);
                            $i--;
                            
                        }
                    }    
                }
            }
        }    

    	for ($i=0; $i < count($response); $i++) { 
    		array_push($sens, $response[$i]);
    	}
        return $sens;
	}


	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}

	public function getName() {
		return $this->name;
	}

	public function getAltitude() {
		return $this->altitude;
	}

	public function getLatitude() {
		return $this->latitude;
	}

	public function getLongitude() {
		return $this->longitude;
	}

	public function getSensors() {
		return $this->sensors;
	}

}