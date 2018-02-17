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
/* initiate in a view by... 

// attempt to make a call to the tab in order to get that information. 
include ROOT . "_classes/standards.class.php"; 
include ROOT . "_classes/testdb.class.php"; 

$test = new Testdb();
$return = $test->testmydb();

print_r($return);

*/