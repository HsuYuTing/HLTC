<script language='javascript'>
function okBtnClick(){
	var send_str = "dataFlag=login";//連接form input的值
	XHreport_request("index_SIM.php",send_str,"");
}
</script>
<?php 
session_start();
include("./js/script_main.js");
echo "<html><head>";
echo "<meta http-equiv=Content-Type content=\"text/html;charset=utf-8\">";
echo "<link rel='stylesheet' type='text/css' href='/HLTC/socecode/css/master.css' />";   
echo "</head>";
echo "<div class='title'></div>";
echo "<div class='text_1 white shadow' >醫療長照</div>";
echo "<div class='text_4 black shadow' >";
echo "<button type='button' class='btn_clandar'><A Target='_self' Href='index.php'>首頁</a></button></div>";
echo "<div class='text_3 black shadow' >";
echo "<button type='button' class='btn_open'><A Target='_self' Href='add_user.php'>加入會員</a></button></div>";
echo "<html>";
include_once("dbConnection.php");
$db = new dbConnection();
$SQLSTR= " SELECT * FROM `task` WHERE `nurse`='".$_SESSION["id"]."' and `status`='0'";
  $result=$db->dbQuery($SQLSTR);
	while($row=mysql_fetch_array($result)){
		echo "編號:".$row[0];
	}
?>