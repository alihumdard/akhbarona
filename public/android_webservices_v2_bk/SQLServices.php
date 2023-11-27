<?php
/*define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","facebook_like_db");*/

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","123");
define("DATABASE","akhbarona");

/*define("HOSTNAME","localhost");
define("USERNAME","u737368432_123");
define("PASSWORD","123456");
define("DATABASE","u737368432_game");*/

class SQLServices {

	public $result;
	public $connection;
	function __construct(){
		$this->get_connection();
	}

	function get_connection(){
		$this->connection=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
	}
	function executequery($query){
		$this->result = mysqli_query($this->connection,$query);
		return $this->result;
	}
	function getObject($result){
		return mysqli_fetch_object($result);
	}
	function getRowCount($result){
		return mysqli_num_rows($result);
	}
	function getRow($result){
		return mysqli_fetch_row($result);
	}
	function getArray($result){
		return mysqli_fetch_array($result);
	}
	function getAssoc($result){
		return mysqli_fetch_assoc($result);
	}
	function getInsertId(){
		return mysqli_insert_id();
	}
	function closeConnection(){
		mysqli_close($this->connection);
	}
	function getRows($result){
		return mysqli_num_rows($result);
	}
	function getAffectedRows(){
		return mysqli_affected_rows();
	}
}
?>
