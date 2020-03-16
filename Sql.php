<?php 

class Sql extends PDO{

	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root","");
	}
	
	public function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
		 	$statment->bindParam($key, $value);
		} 
	}
	public function setParam($statement, $key, $value){
		$statement->bindParam($statement,$key, $value);	
	}

	public function query($rowQuery,$params=array()){
		$stmt = $this->conn -> prepare($rowQuery);
		$this->setParams($stmt,$params);
		$stmt->execute();
		return $stmt;
	}
	public function select($rowQuery, $params = array()):array{
		$stmt = $this->query($rowQuery, $params);
		return $stmt->fetchall(PDO::FETCH_ASSOC);
	}


}




?>