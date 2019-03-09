<?php
	
/**
 * 
 */
class FDBmanager
{
	
	public function exist($obj) {
		$assembler = new FAssembler('exist');
		$statement = $assembler->getStatement($obj); //FStatement
		$connection = $assembler->getConnection($obj);
		$bool = $connection->execute($statement);		
		$connection->close();
		return $bool;
	}

	public function load($obj) {
		$assembler = new FAssembler('load');
		$statement = $assembler->getStatement($obj); //FStatement
		$connection = $assembler->getConnection($obj);
		$sql_result = $connection->execute($statement);		
		$entity_obj = $assembler->assemble($sql_result, $obj);
		$connection->close();
		return $entity_obj;
	}

	public function save($obj) {
		$assembler = new FAssembler('save');
		$statement = $assembler->getStatement($obj); //FStatement
		$connection = $assembler->getConnection($obj);
		$bool = $connection->execute($statement);		
		$connection->close();
		return $bool;
	}

	public function delete($obj) {
		$assembler = new FAssembler('delete');
		$statement = $assembler->getStatement($obj); //FStatement
		$connection = $assembler->getConnection($obj);
		$bool = $connection->execute($statement);		
		$connection->close();
		return $bool;
	}

	public function list($obj, $array = []) {
		$assembler = new FAssembler('list');
		$statement = $assembler->getStatement($obj, $array); //FStatement
		$connection = $assembler->getConnection($obj);
		$sql_result = $connection->execute($statement);		
		$list = $assembler->assemble($sql_result, $obj);
		$connection->close();
		return $list;
	}

	public function create($obj) {
		$assembler = new FAssembler('createDB');
		$connection1 = new FConnection('new');
		$statement1 = $assembler->getStatement($obj); //FStatement		
		$sql_result1 = $connection1->execute($statement1);		
		//-----create table----
		$assembler->setQueryType('createTable');
		$connection2 = new FConnection($statement1->getTable());
		$statement2 = $assembler->getStatement($obj); //FStatement		
		$sql_result2 = $connection2->execute($statement2);	

		$entity_obj = $assembler->assemble($sql_result);

		return $entity_obj;
	}

	//---------------------- custom section --------------------------

	
}