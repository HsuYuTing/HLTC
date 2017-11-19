<?php 
session_start();
  include_once("dbConnection.php");
  $db = new dbConnection();
$account = $_POST["login_account"];
$pwd = $_POST["login_pwd"];

	$SQLSTR= "SELECT * FROM `nuser` where mail='".$account."' and password='".$pwd."'";
	$result=$db->dbQuery($SQLSTR);
	$num=mysql_num_rows($result);
	$id=mysql_fetch_array($result);
	if($num>0){
		$_SESSION["key"]="N";
		$_SESSION["id"]=$id[0];
		header("Location:home.php?key=".$_SESSION["key"]."&id=".$_SESSION["id"]);
	}
	$SQLSTR= "SELECT * FROM `guest` where mail='".$account."' and password='".$pwd."'";    
	$result=$db->dbQuery($SQLSTR);
	$num=mysql_num_rows($result);
	if($num>0){
		$_SESSION["key"]="G";
		$_SESSION["id"]=$id[0];
		header("Location:home.php?key=".$_SESSION["key"]."&id=".$_SESSION["id"]);
	}

?>