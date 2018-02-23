<?php
class User {
	private $dbHost     = "localhost";
    private $dbUsername = "klout";
    private $dbPassword = "d7asCvrbi{";
    private $dbName     = "klout";
    private $userTbl    = 'user';
	
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
}
?>
