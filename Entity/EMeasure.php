<?php

/**
 * 
 */
class EMeasure 
{
	public $station;
	public $time;
	public $values = []; //array<ECapture>();
	
	function __construct(EStation $station, $time, $m)
	{
		$this->station = $station;
		$this->time = $time;
		$this->values = $m;
	}

	function getStation() {
		return $this->station;
	}

	function getTime() {
		return $this->time;
	}

	function getValues() {
		return $this->values;
	}

	function add($name, $value) {
		$this->values[$name] = $value;
	}
}