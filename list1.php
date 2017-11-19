<!DOCTYPE html>
<html>
<head>
<title>護理人員清單</title>

</head>
<body>
<?php
 session_start();
 include_once("dbConnection.php"); 
  $db = new dbConnection();
  $id=0;
  echo '<p align="center">護理人員清單</p>';
  echo '<table style="width:40%" border="1" align="center" valign="center">';
  echo '<tr>';
  
//顯示護士清單(姓名、信箱、經歷)
  $SQLSTR="SELECT * FROM `nuser`";
  $list=$db->dbQuery($SQLSTR);

  while($re=mysqli_fetch_row($list)){ 
   $id=$re[0];
   $_SESSION["id"] = $id;
   echo '<tr>';
   echo '<td style="width:25%" align="center">姓名:</td>';
   echo '<td style="width:75%" align="center">'.$re[1].'</td>';
   echo '</tr>';
   echo '<tr>';
   echo '<td style="width:25%" align="center">信箱:</td>';
   echo '<td style="width:75%" align="center">'.$re[4].'</td>';
   echo '</tr>';
   echo '<tr>';
   echo '<td style="width:25%" align="center">經歷:</td>';
   echo '<td style="width:75%" align="center">'.$re[7].'</td>';
   echo '</tr>';
   echo '<td style="width:20%" align="center"><A Target='_self' Href='introduction.php?id=''.$id.'>查詢</a></td>' ;
	}
    echo '</tr>';
    echo '</table>';
?>
</body>
</html>