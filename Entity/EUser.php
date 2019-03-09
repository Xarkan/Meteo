<?php

/**
 * 
 */
class EUser
{	public $name;
	public $mail;
	public $password;
	
	function __construct($mail, $password = '')
	{
		$this->mail = $mail;
		$this->password = $password;
	}

	public function loadStations() {
		$dbm = USingleton::getInstance('FDBmanager');
		$result = $dbm->list($this);
		for ($i=0; $i < count($result); $i++) { 
			foreach ($result[$i] as $key => $value) {
				if(is_string($key)) {
					$values[] = $value; 
				}		
			}
			$results[$i] = $values;
			unset($values);
		}
		return $results;
	}


	public function getName() {
		return $this->name;
	}
	
	public function getMail() {
		return $this->mail;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setMail($mail) {

	}

	public function setPassword($password) {
		# code...
	}

}