<?php 
class dbConnection{
	var $url;
	var $id;
	var $password;
	var $db;
	var $dbNumber=null;
	function __construct($_url="localhost",$_id="root",$_password="",$_db="hltc"){
		$this->url = $_url;
		$this->id = $_id;
		$this->password = $_password;
		$this->db = $_db;
		$dbNumber = mysql_connect($this->url,$this->id,$this->password);
		mysql_select_db($this->db);
		mysql_query("set names utf8");		
	}
	
	public function dbQuery($sql){
		return mysql_query($sql);
	}
	
	public function dbClose(){
		if(!is_null($this->dbNumber)){
			mysql_close($this->dbNumber);		
			$this->dbNumber = null;
		}
	}
		
	function __destruct(){
		if(!is_null($this->dbNumber)){
			mysql_close($this->dbNumber);		
			$this->dbNumber = null;
		}
	}
}
?>