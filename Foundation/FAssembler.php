<?php

/**
 * 
 */
class FAssembler 
{
	private $query_type;

	function __construct($string)
	{
		$this->query_type = $string;
	}

	public function setQueryType($string) {
		$this->query_type = $string;
	}

	public function getConnection($obj) {
		if ($obj instanceof EUser) {						
			$connection = new FConnection();
		}
		if ($obj instanceof EStation) {
			$connection = new FConnection();
		}
		if ($obj instanceof ESensor) {
			$connection = new FConnection();
		}
		if ($obj instanceof EMeasure) {
			$connection = new FConnection("station".strval($obj->getStation()->getId()));
		}
		return $connection;
	}

	public function getStatement($obj, $range = []) {
		$classname = get_class($obj);
		$trimmed = ltrim($classname,'E');
		$table = strtolower($trimmed);
		$statement = new FStatement($table,$this->query_type);
		$conditions = [];

		switch ($this->query_type) {

			case 'list':
				$statement->setFetchOpt('assoc');
				if ($obj instanceof EUser) {
					
				}
				if ($obj instanceof EStation) {
					$conditions[] = new FCondition('mail', $obj->getUser()->getMail());
				}
				if ($obj instanceof EMeasure) {
					$conditions[] = new FCondition('time', $range['from']->format(DateTime::ATOM), '>');
					$conditions[] = new FCondition('time', $range['to']->format(DateTime::ATOM), '<');
				}
				break;

			case 'save':
				if ($obj instanceof EUser) {
					$conditions[] = new FCondition('mail', $obj->getMail());
					$conditions[] = new FCondition('name', $obj->getName());
					$conditions[] = new FCondition('password', $obj->getPassword());

				}
				if ($obj instanceof EStation) {
					$conditions[] = new FCondition('mail', $obj->getUser()->getMail());
					$conditions[] = new FCondition('name', $obj->getName());
					$conditions[] = new FCondition('altitude', $obj->altitude);
					$conditions[] = new FCondition('latitude', $obj->latitude);
					$conditions[] = new FCondition('longitude', $obj->longitude);

				}
				if ($obj instanceof EMeasure) {
					$measures = $obj->getValues();
					foreach ($measures as $key => $value) {
						$conditions[] = new FCondition($key, $value);
					}
					$conditions[] = new FCondition('time', $obj->getTime()->format(DateTime::ATOM)); 
				}
				break;

			case 'createDB':
				$statement = new FStatement("station".strval($obj->getId()));	
				break;
			
			case 'createTable':
				$sensors = $obj->getSensors();
				foreach ($sensors as $key => $value) {
					$conditions[] = new FCondition($value, 'float');
				}
				$conditions[] = new FCondition('time', 'datetime', 'key');
				break;			

			default:
				$statement->setFetchOpt('assoc');
				if ($obj instanceof ESensor) {
					$conditions[] = new FCondition('variable', $obj->getVariable());
				}
				if ($obj instanceof EUser) {						
					$conditions[] = new FCondition('mail', $obj->getMail());
				}
				if ($obj instanceof EStation) {
					$conditions[] = new FCondition('mail', $obj->getUser()->getMail());
					if (isset($obj->id)) {
						$conditions[] = new FCondition('id', $obj->getId());
					}else{
						$conditions[] = new FCondition('name', $obj->getName());
					}					
				}
				if ($obj instanceof EMeasure) {
					$conditions[] = new FCondition('time', $obj->getTime()->format(DateTime::ATOM));
				}
				break;
			}

		$statement->setConditions($conditions);
		unset($conditions);
		return $statement;		
	}

	public function assemble($response,$obj) {
		$class = get_class($obj);
		$class_vars = get_class_vars($class);
		/*
		echo "<pre>";
		print_r($response);
		echo "</pre>";
		echo "<pre>";
		print_r($class_vars);
		echo "</pre>";//*/
		$return = [];
		for ($i=0; $i < count($response); $i++) { 
			$newObj = clone $obj;
			if ($obj instanceof EUser || $obj instanceof ESensor) {						
				foreach ($response[$i] as $name => $v1) {
					foreach ($class_vars as $attr => $v2) {
						if ($name == $attr) {
							$newObj->$name = $v1;
						}
					}
				}
			}
			if ($obj instanceof EStation) {
				foreach ($response[$i] as $name => $v1) {
					foreach ($class_vars as $attr => $v2) {
						if ($name != 'mail') {
							if ($name == $attr) {			
								$newObj->$name = $v1;		
							}
						}else{
							$newObj->user = $obj->getUser();
						}					
					}
				}
			}
			if ($obj instanceof EMeasure) {
				$newObj->station = '';//$obj->getStation();
				$newObj->time = new DateTime($response[$i]['time']);
				$k = 0;
				foreach ($response[$i] as $name => $v1) {
					if ($name != 'time' && $name == $obj->values[0]->sensor->variable) {
						$sens = new ESensor($name,'');
						$c = new ECapture($sens,$v1);
						$newObj->values[$k] = $c;
						$k++;
					}				
				}
			}
			$return[] = $newObj;
			unset($newObj);
		}	
		/*	
		echo "<pre>";
		var_dump($return);
		echo "</pre>";		
		//*/
		if (count($return) > 1 || count($return) == 0) {
			return $return;
		}else{
			return $return[0];
		}
		
	}



}


/*$class_vars = get_class_vars($obj);
						foreach ($class_vars as $key => $value) {
							if(!is_object($value)) {
								$conditions[$key] = $value;
							}else{
								$varobj = $obj->$key;
								foreach ($varobj as $key2 => $value2) {
									$conditions[$key2] = $value2;
								}
							}
						}*/