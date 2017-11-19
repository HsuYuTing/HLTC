<?php
//include("dbConnection.php");
include("menu.php");
class classMaster{//extends dbConnection
	public function __construct(){}//建構者
  
  /*function insertTomysql($_POST){
  }*/
    public function adduser($divName=''){
 echo $divName;
echo "<form name='frmmain' id='frmmain' action='index.php' method=post onSubmit='return false;'>";
//echo "<table width=".$tableW."px border=1  cellpadding='0' cellspacing='1'>";
//echo "<tr><td align=center valign=bottom width=".$tdW."px style='background-repeat:no-repeat;letter-spacing:1px;padding-bottom:20px;'>"; 
//echo "<td width=".$tdW."px height='".$tdH."px' valign=top id='td123'  style='background-repeat:no-repeat;'>";//中間的格線
echo "<table width=$tableW  height='".$tableH."px' border='0' cellpadding='0' cellspacing='0' background='/old/image/king_login.png' >";
echo "<tr height=50px valign='center'><td colspan='2' align='center'  class='blue f16 b' style='letter-spacing:2px;'>會員登入";
echo "<tr height='40px'><td width=55px align='right' class='gray f17'>帳號：";
echo "<td><input type='text' id='login_account' name='login_account' autocomplete='off' size='17' autofocus='autofocus' >";
echo "<tr height='40px'><td width=55px align='right' class='gray f17'>密碼：";
echo "<td><input type='password' id='login_pwd' name='login_pwd' autocomplete='off' size='17' >";

echo "<tr valign='center'><td colspan='3' align='center'>";
echo "<input type='submit' class='btn_orange' id='okbtn' value='送出'  onClick='okBtnClick()'>";
echo "<br><span  id='msgStr' class='red f13'></span>";
echo "</table>";
echo "</form>";
//echo "<div class='king_img'></div>";
echo "</table>";

}
}
?>