<?php

/**
 * 
 */
class FCondition 
{
	public $var;
	public $value;
	public $operator;
	
	function __construct($var, $value, $op = '=')
	{
		$this->var = $var;
		$this->value = $value;
		$this->operator = $op;
	}
}