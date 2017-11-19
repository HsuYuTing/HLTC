<script language='javascript'>
var mk_name=false;
var mk_tel =false;
var mk_email =false;
var mk_pass =false;
	
	function checkAll(){
		if(mk_name&&mk_tel&&mk_email&&mk_pass){
			alert("註冊成功!");
		}else{
			alert("資料有錯誤喔!請檢查");
			event.returnValue=false; //攔截並且停止現在已經觸發的所有動作
			}
	}
	function check_name(){
		if(document.getElementById("login_name").value==""){
			document.getElementById("error_name").innerHTML="請輸入姓名！";
		}else{
			document.getElementById("error_name").innerHTML="";
			 mk_name=true;
		}
	}
	
	function check_tel(){
		re = /^[09]{2}[0-9]{8}$/; //驗證手機格式，起首為09開頭，後面再八位數字。
		//re = /^[0]{1}[0-9]{1,3}-[0-9]{7,8}$/; //驗證市內電話，第一碼固定為0，區碼最多3碼，後面號碼多為7-8碼
		if(document.getElementById("login_tel").value==""){
			document.getElementById("error_tel").innerHTML="請輸入手機電話！";
		}
		else if (!re.test(frmmain.login_tel.value)){
			document.getElementById("error_tel").innerHTML="電話格式錯囉！";
		}else{
			document.getElementById("error_tel").innerHTML="";	
			mk_tel=true;
		}
	}
		
	function check_Email(remail){
		if(document.getElementById("login_email").value==""){
			document.getElementById("error_email").innerHTML="請輸入email！";
		}
		else if(remail.search(/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/)==-1){
			document.getElementById("error_email").innerHTML="email格式有錯！";
		}else {
			document.getElementById("error_email").innerHTML="";
			mk_email=true;
		}
	}
	function check_pass(){
	     re = /^([a-zA-Z]+\d+|\d+[a-zA-Z]+)[a-zA-Z0-9]*$/; 
	     var password=document.getElementById("login_pwd").value;
	    if(!re.test(password)){
	       document.getElementById("error_pass1").innerHTML="請輸入英數字混合的密碼！";
	       	mk_pass =false;
	    }else if(password.length>10 || password.length<6){
	       document.getElementById("error_pass1").innerHTML="請輸入6-10位的長度密碼！";
	       	mk_pass =false;
	    }else if(password ==""){
			document.getElementById("error_pass1").innerHTML="請輸入密碼！";
		    mk_pass =false;
		}else{
			document.getElementById("error_pass1").innerHTML="";
			mk_pass=true;
		}
	}
	function open_button(){
	var send_str = "dataFlag=add_user";//連接form input的值
	XHreport_request("index_SIM.php",send_str,"");
}
	function kind(kind){

		if (frmmain.people_kind.value==kind) {
			document.all.checked_nurse.style.display='none';
		}else if(frmmain.people_kind.value==kind){
			document.all.checked_nurse.style.display='black';
		}
}

</script>
<?php 
include("./js/script_main.js");
echo "<html><head>";
echo "<meta http-equiv=Content-Type content=\"text/html;charset=utf-8\">";
echo "<link rel='stylesheet' type='text/css' href='/HLTC/socecode/css/master.css' />";   
echo "</head>";
$tableW=400;  $tdW=520;  $tableH=202;
echo "<div class='title'></div>";
echo "<div class='text_1 white shadow' >醫療長照</div>";
echo "<div class='text_4 black shadow' >";
echo "<button type='button' class='btn_clandar'><A Target='_self' Href='index.php'>首頁</a></button></div>";
echo "<div class='text_3 black shadow' >";
echo "<button type='button' class='btn_open'><A Target='_self' Href='add_user.php'>加入會員</a></button></div>";
echo "<div style='position:absolute;left:50%;top:50%;margin-left:-150px;margin-top:-150px;'>";// class='logoin'
echo "<form name='frmmain' id='frmmain' action='user_success.php' method=post '>";
echo "<table width=$tableW  height='".$tableH."px' border='0' cellpadding='0' cellspacing='0' >";
echo "<tr valign='center'><td colspan='2' align='center'  class='blue f16 b' style='letter-spacing:2px;'>加入會員";

echo "<tr ><td width=200px align='right' class='gray f17'>名字：";
echo "<td><input type='text' id='login_name' name='login_name' autocomplete='off' size='17' autofocus='autofocus' onblur='check_name()' >";
echo "<td id='error_name' class=error></td>";

echo "<tr height='40px'><td width=200px align='right' class='gray f17'>性別：";
echo "<td><input type='radio' id='sex' name='sex' value='M' checked='ture'>男&nbsp;&nbsp;&nbsp;";
echo "<input type='radio' id='sex' name='sex' value='F'>女&nbsp;&nbsp;&nbsp;";

echo "<tr ><td width=55px align='right' class='gray f17'>密碼：";
echo "<td><input type='password' id='login_pwd' name='login_pwd' autocomplete='off' size='17' onblur='check_pass()' >";
echo "<td class=error id='error_pass1'></td>";

echo "<tr height='40px' width=75px><td width=55px align='right' class='gray f17'>email：";
echo "<td><input type='email' id='login_email' name='login_email' autocomplete='off' size='17' onblur='check_Email(document.frmmain.login_email.value)' >";
echo "<td class=error id='error_email'></td>";

echo "<tr><td width=70px align='right' class='gray f17'>聯絡電話：";
echo "<td><input type='text' id='login_tel' name='login_tel' autocomplete='off' size='17' onblur='check_tel()' >";
echo "<td id='error_tel' class=error></td>";

echo "<tr><td width=70px align='right' class='gray f17'>身分：";
echo "<td width=300px><input type='radio' id='people_kind' name='people_kind' value='nurse' >護理人員&nbsp;&nbsp;&nbsp;";
echo "<input type='radio' id='people_kind' name='people_kind' value='customer' checked='ture' onclick=kind(customer)'>訪客&nbsp;&nbsp;&nbsp;";
echo "<tr valign='center'><td colspan='2' align='center'><br>";
echo "<input type='submit' class='btn_orange' id='okbtn' value='送出'  onClick='checkAll()'>";
echo "<br><span id='msgStr' class='red f13'></span>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "<html>";
?>