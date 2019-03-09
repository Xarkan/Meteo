<?php

/**
 * 
 */
class ECapture
{
	public $sensor;
	public $value;

	function __construct(ESensor $s, $v, $t = '')
	{
		$this->sensor = $s;
		$this->value = $v;
	}
}