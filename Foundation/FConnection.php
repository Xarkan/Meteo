<?php

/**
 * 
 */
class FConnection 
{
	public $connection;
	
	function __construct($dbname = '')
	{
		include 'config.php';
		switch ($dbname) {
			case '':
				$string = "dbname=".$config['mysql']['database'].";";
				break;
			case 'new':
				$string = '';
				break;
			default:
				$string = 'dbname='.$dbname.';';		
				break;
		}

		$dsn = 'mysql:'.$string.'host='.$config['mysql']['host'];

        $user = $config['mysql']['user'];
        $password = $config['mysql']['password'];
        try {
            $this->connection = new PDO($dsn, $user, $password);
        }
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
	}


	public function close() {
		unset($this->connection);
	}


	public function execute(FStatement $fst) {
		$condStatement = $fst->getSQLconditions();
		switch ($fst->getType()) {
			case 'delete':
				$sql = "DELETE FROM ".$fst->getTable()." WHERE ".$condStatement;
				break;

			case 'save':
				$insert = '';
				$values = '';
				$c = $fst->getConditions();
				for ($i=0; $i < count($c); $i++) { 
					$values = $values.'?,';
					$insert = $insert.$c[$i]->name.",";	
				}
				$fields = rtrim($insert,',');
				$qmarks = rtrim($values,',');
				
		        $sql = "INSERT INTO ".$fst->getTable()."(".$fields.") VALUES (".$qmarks.")";
				break;	

			case 'createDB':
				$response = $this->createDB($statement);
				break;

			case 'createTable':
				$response = $this->createTable($statement);
				break;	

			default:
				$sql = "SELECT * FROM ".$fst->getTable()." WHERE ".$condStatement;
				break;
		}

		if ($fst->getType() != 'createDB' && $fst->getType() != 'createTable') {
			$statement = $this->connection->prepare($sql);
        	$fst->bindConditions($statement);
        	$statement->execute();
		}
		
        switch ($fst->getType()) {
        	case 'exist':
        		$result = $statement->fetchAll($fst->fetchOpt);
        		$response = count($result) > 0;
        		break;

        	case 'delete':
        		$n=$statement->rowCount();
        		$response = $n > 0;
        		break;	

        	case 'save':
        		$response = $statement->execute();
        		break;

        	default:
        		$response = $statement->fetchAll($fst->fetchOpt);
        		break;
        }
		return $response;
	}


	private function createDB(FStatement $fst) {
        $create = "CREATE DATABASE ".$fst->getTable().";";
        $created = $this->connection->exec($create);

        return $created;
	}


	public function createTable(FStatement $fst) {
        $columns = '';
        $kcols = '';
        $keys = '';
        $c = $fst->getConditions();

        for ($i=0; $i < count($c); $i++) { 
        	if ($c[$i]->operator == 'key') {
        		$notnull = ' NOT NULL';
        		$keys = $keys.$c[$i]->name.",";
        	}else{
        		$notnull = '';
        	}
        	$row = $c[$i]->name." ".$c[$i]->value.$notnull.", ";
        	$columns = $columns.$row;
        }

        /*foreach ($c as $key => $value) {
        	$row = $c[$key]." ".$value.", ";
            $columns = $columns.$row;
        }        
        for ($i=0; $i < $c['key'] ; $i++) { 
        	$keys = $keys.$c['key'][$i]['name'].",";
        	$kcols = $kcols.$c['key'][$i]['name']." ".$c['key'][$i]['type']." NOT NULL, ";
        }
        $keys = rtrim($keys,',');
        $table = "CREATE TABLE ".$fst->getTable()." ( "
            .$kcols." ".$columns."PRIMARY KEY (".$keys.") );";*/

        $keys = rtrim($keys,',');
        
        $table = "CREATE TABLE ".$fst->getTable()." ( "
            .$columns."PRIMARY KEY (".$keys.") );";

        
        //$pdo = new PDO("mysql:dbname=".$dbname.";host=localhost", "root", "" );
        $this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        try {
            $created = $this->connection->exec($table);
        }catch(Exception $e) {
        	$created = false;
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $created;
	}

}