<?php 


class Testdb extends Standards {
	
	function testmydb(){
		$sql = "SELECT * FROM test ";
		$query = $this->query($sql, 'fetch');

		$array = array(
			'query'=> $query,
			'sql'=>$sql,
		);

		return $array;
	}
}