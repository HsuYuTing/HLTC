<?php
session_start();
include_once("dbConnection.php");
$db = new dbConnection();
	if(!isset($_POST["login_name"])){
		$name="";
	}else{
	$name = $_POST['login_name'];
	}
	if(!isset($_POST["sex"])){
		$sex="";
	}else{
	$sex = $_POST['sex'];
	}
	if(!isset($_POST["login_tel"])){
		$tel="";
	}else{
	$tel = $_POST['login_tel'];
	}
	if(!isset($_POST["login_email"])){
		$email="";
	}else{
	$email = $_POST['login_email'];
	}
	if(!isset($_POST["login_pwd"])){
		$pwd="";
	}else{
	$pwd = $_POST['login_pwd'];
	}
	if(!isset($_POST["people_kind"])){
		$people_kind="";
	}else{
	$people_kind = $_POST['people_kind'];
	}
	if(!isset($_POST["nurse_value"])){
		$nurse_value="";
	}else{
		$nurse_value=$_POST["nurse_value"];
	}
	if(!isset($_POST["skill"])){
		$skill_value="";
	}else{
		$skill_value=$_POST["skill"];
	}
	if(!isset($_POST["introduction"])){
		$introduction_value="";
	}else{
		$introduction_value=$_POST["introduction"];
	}
	if(!isset($_POST["sort"])){
		$sort_value="";
	}else{
		$sort_value=$_POST["sort"];
	}

 if($people_kind=="nurse"){
	 $indate=date("YmdHis");
	$id = "n"+$indate;
	$_SESSION['id'] = $id;
	$SQLSTR= "INSERT INTO `nuser`(`id`, `name`, `sex`, `phone`, `mail`, `password`, `type`, `skill`, `introduction`)"; 
	$SQLSTR.= " Values('".$id."','".$name."','".$sex."','".$tel."','".$email."','".$pwd."','','','')";
	$result=$db->dbQuery($SQLSTR);
	header("Location:nurse.php?id=".$_SESSION['id']);
}else if($people_kind=="customer"){
	$indate=date("YmdHis");
	$id = "g"+$indate;
	$_SESSION['id'] = $id;
	$SQLSTR= "INSERT INTO `guest`(`id`, `name`, `sex`, `phone`, `mail`, `password`)";
	$SQLSTR.=" Values('".$id."','".$name."','".$sex."','".$tel."','".$email."','".$pwd."')";
	$result=$db->dbQuery($SQLSTR);
	header("Location:index.php?id=".$id);
}else if($nurse_value='yes'){
	$SQLSTR= "UPDATE `nuser` SET `skill`='".$skill_value."',`introduction`='".$introduction_value."',`type`='".$sort_value."' where id='".$_SESSION['id']."' ";
	$result=$db->dbQuery($SQLSTR);
	header("Location:index.php?id=".$_SESSION['id']);
	
	}


?>