<?php

/**
 * 
 */
class EEMeasure
{
	$station;
	$sensors = [];
	
	function __construct(argument)
	{
		# code...
	}
}


/**
 * 
 */
class ESensor
{
	$type;
	$unit;
	//$measures = []; //array(ECapture-> {time: datetime, value: float})
	function __construct(argument)
	{
		# code...
	}
}


/**
 * 
 */
class ECapture
{
	public $sensor;
	public $value;
	function __construct(argument)
	{
		# code...
	}

//-----------------------

/**
 * 
 */
class EEMeasure
{
	$station;
	$time;
	$sensors = [];
	
	function __construct(argument)
	{
		# code...
	}
}

/**
 * 
 */
class ECapture
{
	public $time;
	public $value;
	public $unit;
	function __construct(argument)
	{
		# code...
	}
}



}

