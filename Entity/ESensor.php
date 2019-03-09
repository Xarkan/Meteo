<?php

/**
 * 
 */
class ESensor
{
	public $variable;
	public $unit;

	function __construct($variable, $unit)
	{
		$this->variable = $variable;
		$this->unit = $unit;
	}

	public function getVariable() {
		return $this->variable;
	}
}