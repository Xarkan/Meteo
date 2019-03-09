<?php


/**
 * 
 */
class FStatement
{
	private $table;
	private $type; //exist, store ecc
	private $conditions; //array associativo $conditions['temp'] = 13.2 -> WHERE temp = 13.2
	public $fetchOpt = PDO::FETCH_BOTH;

	
	function __construct($tab, $type, $c = [])
	{
		$this->table = $tab;
		$this->type = $type;
		$this->conditions = $c;
	}

	public function setTable($t) {
		$this->table = $t;
	}

	public function getTable() {
		return $this->table;
	}

	public function getType() {
		return $this->type;
	}

	public function getConditions() {
		return $this->conditions;
	}

	public function setConditions($conditions) {
		$this->conditions = $conditions;
	}


	public function setFetchOpt($string) {
		switch ($string) {
			case 'assoc':
				$this->fetchOpt = PDO::FETCH_ASSOC;
				break;

			case 'num':
				$this->fetchOpt = PDO::FETCH_NUM;
				break;	
			
			default:
				$this->fetchOpt = '';
				break;
		}
	}

	public function addCondition($element) { //array associativo
		array_push($this->conditions, $element);
	}


	public function getSQLconditions() {
		$c = $this->conditions;
		$firstElem = true;
		for ($i=0; $i < count($c); $i++) { 
			if($firstElem) {
				$condStatement = $c[$i]->var." ".$c[$i]->operator." ?";	
				$firstElem = false;
			}else{
				$condStatement = $condStatement." AND ".$c[$i]->var." ".$c[$i]->operator." ?";
			}
		}
		return $condStatement;
	}

	public function bindConditions($statement) {
		$c = $this->conditions;
		for ($i=0; $i < count($c); $i++) { 
			$statement->bindParam($i+1,$c[$i]->value);
		}
	}
}
//------------
