<?php
session_start();
echo $id = $_SESSION['id'];
include("./js/script_main.js");
echo "<html><head>";
echo "<meta http-equiv=Content-Type content=\"text/html;charset=utf-8\">";
echo "<link rel='stylesheet' type='text/css' href='/HLTC/socecode/css/master.css' />";   
echo "</head>";
$tableW=420;  $tdW=520;  $tableH=202;
echo "<div class='title'></div>";
echo "<div class='text_1 white shadow' >醫療長照</div>";
echo "<div class='text_4 black shadow' >";
echo "<button type='button' class='btn_clandar'><A Target='_self' Href='index.php'>首頁</a></button></div>";
echo "<div class='text_3 black shadow' >";
echo "<button type='button' class='btn_open'><A Target='_self' Href='add_user.php'>加入會員</a></button></div>";
echo "<div style='position:absolute;left:50%;top:50%;margin-left:-190px;margin-top:-150px;'>";// class='logoin'
echo "<form name='frmmain' id='frmmain' action='user_success.php?nurse_value=yes' method=post>";
echo "<table width=$tableW  height='".$tableH."px' border='0' cellpadding='10' cellspacing='0' >";
echo "<tr valign='center'><td colspan='2' align='center'  class='blue f16 b' style='letter-spacing:2px;'>醫護人員";

echo "<tr height='40px'><td width=200px align='right' class='gray f17'>科別：";
echo "<td><input type='radio' id='sort' name='sort' value='內科' checked='ture'>內科&nbsp;&nbsp;&nbsp;";
echo "<input type='radio' id='sort' name='sort' value='外科'>外科&nbsp;&nbsp;&nbsp;";
echo "<tr><td width=200px align='right' class='gray f17'>擅長科別：";
echo "<td><textarea style='width:280px;height:150px;' id='skill' name='skill'></textarea>";
echo "<tr><td width=70px align='right' class='gray f17'>自我介紹：";
echo "<td><textarea style='width:280px;height:150px;' id='introduction' name='introduction'></textarea>";
echo "<tr valign='center'><td colspan='2' align='center'><br>";
echo "<input type='submit' class='btn_orange' id='okbtn' value='送出' >";
echo "<br><span id='msgStr' class='red f13'></span>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "<html>";
?>