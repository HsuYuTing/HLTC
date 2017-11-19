<!DOCTYPE html>
<html>
<head>
<title>護理人員介紹</title>
</head>
<body>
<?php
 session_start();
 include_once("dbConnection.php"); 
  $db = new dbConnection();
  $id=$_SESSION["id"];
echo '<p align="center">護理人員介紹</p>';
echo '<table style="width:50%" border="0" align="center" valign="center">';
  $SQLSTR="SELECT * FROM `nuser` where id=$id";
  $list=$db->dbQuery($SQLSTR);
   while($re=mysql_fetch_row($list)){ 
   echo '<tr>';
    echo '<td align="center">姓名:</td>';
    echo '<td align="center">'.$re[1].'</td>';
  echo '</tr>';
  echo '<tr>';
   echo '<td align="center">性別:</td>';
    echo '<td align="center">'.$re[2].'</td>';
  echo '</tr>';
  echo '<tr>';
    echo '<td align="center">連絡電話:</td>';
    echo '<td align="center">'.$re[3].'</td>';
  echo '</tr>';
    echo '<tr>';
    echo '<td align="center">擅長科別:</td>';
    echo '<td align="center">'.$re[6].'</td>';
  echo '</tr>';
  echo '<tr>';
    echo '<td align="center">經歷:</td>';
    echo '<td align="center">'.$re[7].'<td>';
  echo '</tr>';
  echo '<tr>';
    echo '<td align="center">介紹:</td>';
    echo '<td align="center">'.$re[8].'</td>';
  echo '</tr>';
   }
  
  echo '<tr>';
     echo '<td style="width:50%" align="right"><A Target='_self' Href='list1.php'>回上頁</a></td>';
     echo '<td style="width:50%" align="left"><button type="button">預約</button></td>'; 
  echo '</tr>';
echo '</table>';
?>
</body>
</html>