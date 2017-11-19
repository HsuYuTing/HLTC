<script language='javascript'>
function okBtnClick(){
//	var myFlag = script_checkTrimText("frmmain");
//	if(myFlag==false){return ;}
XH_form_reset(document.frmmain);//清空訊息
document.frmmain.okbtn.disabled=true;
document.getElementById("msgStr").innerHTML="登入檢查中...";
var send_str = "dataFlag=login_insert&"+XH_get_value(document.frmmain);//連接form input的值
XHreport_request("Login_SIM.php",send_str,"okButtonClickReturn");
}

function okButtonClickReturn(){
	document.frmmain.okbtn.disabled=false;
		alert("HI");
}
function open_button(){
	var send_str = "dataFlag=add_user&"+XH_get_value(document.frmmain);//連接form input的值
	XHreport_request("add_user.php",send_str,"");
}
</script>
<?php 
include("./js/script_main.js");
echo "<html><head>";
echo "<meta http-equiv=Content-Type content=\"text/html;charset=utf-8\">";
echo "<link rel='stylesheet' type='text/css' href='/old/css/master.css' />";   
echo "</head>";
//echo "<body><center>";//onLoad='document.getElementById('login_account').focus();' background='./images/background.png' class='bag'
$tableW=222;  $tdW=320;  $tableH=202;
echo "<div class='title'></div>";
echo "<div class='text_1 white shadow' >醫療長照</div>";
echo "<div class='text_3 black shadow' >";
echo "<button type='button' class='btn_clandar' onclick=\"javascript:open_button()\"'>加入會員</button></div>";

echo "<div style='position:absolute;left:50%;top:50%;margin-left:-150px;margin-top:-150px;'>";// class='logoin'
echo "<form name='frmmain' id='frmmain' action='Login.php' method=post onSubmit='return false;'>";
//echo "<table width=".$tableW."px border=1  cellpadding='0' cellspacing='1'>";
//echo "<tr><td align=center valign=bottom width=".$tdW."px style='background-repeat:no-repeat;letter-spacing:1px;padding-bottom:20px;'>"; 
//echo "<td width=".$tdW."px height='".$tdH."px' valign=top id='td123'  style='background-repeat:no-repeat;'>";//中間的格線
echo "<table width=$tableW  height='".$tableH."px' border='0' cellpadding='0' cellspacing='0' background='/KingMa/image/king_login.png' >";
echo "<tr height=50px valign='center'><td colspan='2' align='center'  class='blue f16 b' style='letter-spacing:2px;'>加入會員";
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
echo "</div>";
//echo "</body>";
echo "<html>";
?>