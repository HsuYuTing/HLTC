<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>balabce.php</title>
</head>
<body>
<div style="width:800px" align=center>
<?php
 include_once("dbConnection.php"); 
 $db = new dbConnection();
 $years=$_GET['year'];
 $months=$_GET['month'];
 $purchase=array();//儲存進貨
 $sales=array();//儲存銷貨
 //宣告變數
    $Btotal=0;
	$total=0;
	$countdata=0;
	$a=0;
	$b=0;
	$d=0;

 echo '<center>';
 echo '<font size=5>'.$years.'年'.$months.'月'.'進銷貨表</font> <hr>';
 echo '<form id="form1" name="form1" method="GET" >';
 echo '<table width="650" style="border:8px #FFD382 groove;" border="1" cellspacing="0" cellpadding="3">';
 echo '<tr style="color:red;font-size:20px;text-align:center"><th> 日期 </th><th> 進貨金額 </th><th> 銷貨金額 </th></tr>'; 
 
  
  //0.產品ID, 1.農場ID, 2.進貨日期, 3.成本價, 4.進貨數量, 5.進貨成本
 
  $SQLSTR="SELECT Q.product_id,Q.farm_id,SUBSTR(S.arrival_date,1,10) AS arrival_date,Q.cost,S.arraival_vol,SUM(ROUND((Q.cost*S.arraival_vol),0)) AS sub,S.unit ";
  $SQLSTR.="FROM qiproduct AS Q LEFT JOIN stock AS S ON Q.product_id=S.product_id AND Q.farm_id = S.farm_id AND Q.resume_id = S.resume_id ";
  $SQLSTR.="WHERE SUBSTR(S.arrival_date , 1 , 4 )=$years AND SUBSTR(S.arrival_date , 6 , 7 )=$months GROUP BY arrival_date order by arrival_date asc";
  $Aresult=$db->dbQuery($SQLSTR);
  
  //找出有報廢、試吃、吧檯用的orderID
  //0.銷售日期, 1.銷售編號
 
  $SQLSTR="SELECT DISTINCT SUBSTR(B.billDate , 1,10) AS 日期 ,D.orderID ";
  $SQLSTR.="FROM qibill AS B LEFT JOIN qibilldetail AS D ON B.orderID=D.orderID ";
  $SQLSTR.="WHERE SUBSTR(B.billDate ,1,4)=$years AND SUBSTR(B.billDate ,6,2)=$months AND (resume_id LIKE '%報廢%' OR resume_id LIKE '%試吃%' OR resume_id LIKE '%吧檯%') ";
  $SQLSTR.="ORDER BY `orderID` ASC";
  $result=$db->dbQuery($SQLSTR);
    while($re=mysql_fetch_row($result)){ 
	$exclude[$i]=$re[1]; //有報廢、試吃、吧檯用的orderID
	$i++;  
	}
	
	
	//0.銷售日期, 1.銷售金額, 2.銷售編號, 3.產品ID, 4.批號
  
  $SQLSTR="SELECT DISTINCT SUBSTR(B.billDate , 1,10) AS 日期 ,B.bill ,D.orderID ,D.product_id,D.resume_id ";
  $SQLSTR.="FROM qibill AS B LEFT JOIN qibilldetail AS D ON B.orderID=D.orderID ";
  $SQLSTR.="WHERE SUBSTR(B.billDate ,1,4)=$years AND SUBSTR(B.billDate ,6,2)=$months AND (D.resume_id NOT LIKE '%報廢%' AND D.resume_id NOT LIKE '%試吃%' AND D.resume_id NOT LIKE '%吧檯%') ";
  $SQLSTR.="GROUP BY B.billDate order by B.billDate asc";
  $Bresult=$db->dbQuery($SQLSTR);
  
  /*      將進貨及銷貨變成兩個陣列
   ---------------          --------------
  |進貨日期 |進貨金額|        |銷貨日期 |銷貨金額|
  |$p[0,0]|$p[0,1]|        |$S[0,0]|$S[0,1]|
  |$p[1,0]|$p[0,1]|        |$S[1,0]|$S[0,1]|
  |$p[2,0]|$p[0,1]|        |$S[2,0]|$S[0,1]|
  |$p[3,0]|$p[0,1]|        |$S[3,0]|$S[0,1]|
   ---------------          ---------------
  */
  
 while($rs=mysql_fetch_row($Aresult)){ //進貨成本
	  echo '<tr>';
	  if($rs[2]!=$date) {
	    $purchase[$a][$b]=$rs[2];//將進貨日期存入二維陣列
		//echo '進貨日期:'.$purchase[$a][$b];
		$b++;
	  }
	  if($rs[6]=="克"){
		$total+=round($rs[5]/100,0);
		$rs[5]=round($rs[5]/100,0);
	  }
	   $date=$rs[2];
	   $total+=$rs[5];     
	   $purchase[$a][$b]=$rs[5];//將進貨金額存入二維陣列
	   //echo '進貨金額:'.$purchase[$a][$b].'</br>';
	   $a++;
	   $b=0;
	}
	 $a=0;$b=0;
    while($rb=mysql_fetch_row($Bresult)){
		for($t=0;$t<$i;$t++){
			if($rb[2]==$exclude[$t])
			   {
				   $c+=1;
				   break;
			   }
		}
	if($c==0){
	    if($rb[0]!=$data )
		  {
		    if($data=="")
			  {
				$sales[$a][$b]=$rb[0];//將銷貨日期存入二維陣列
				//echo '銷貨日期:'.$sales[$a][$b];
		        $b++;
				$sum+=$rb[1];
				$Btotal+=$rb[1];
				$data=$rb[0];
		      }
			else{
			   $sales[$a][$b]=$sum;//將銷貨金額存入二維陣列
			   //echo '銷貨金額:'.$sales[$a][$b].'</br>'; 
			   $a++;
	           $b=0;
			   $sales[$a][$b]=$rb[0];
			   //echo '銷貨日期:'.$sales[$a][$b];
			   $b++;
			   $sum=0;
			   $sum+=$rb[1];
			   $Btotal+=$rb[1];
			   $data=$rb[0];
			  }
		  }
		 else if($rb[0]==$data){
			 $sum+=$rb[1];
			 $Btotal+=$rb[1];
		 } 
		}
	else{$c>0;}
	$c=0;
	} 
	$totals=round($Btotal,0)-round($total,0); //淨損
	$sales[$a][$b]=$sum;
	for($c=0;$c<=$a;$c++){	//跑迴圈將兩個陣列値合併
	 $mode=$purchase[$d][0]; //進貨不是每天有,以$mode存値另外跑
		if($sales[$c][0]==$mode){//假如日期相等
			echo '<tr>';
			echo '<td width="100" align="center">'.$sales[$c][0].'</td>';
			echo '<td width="250" align="center">'.'$'.$purchase[$d][1].'</td>';
			echo '<td width="250" align="center">'.'$'.$sales[$c][1].'</td>';
			echo '<tr>';
			$d++;//進貨跑下個日期
		}
		else if ($sales[$c][0]!=$mode){//若不相等,當天沒進貨金額給0
			echo '<tr>';
			echo '<td width="100" align="center">'.$sales[$c][0].'</td>';
			echo '<td width="250" align="center">'.'$0'.'</td>';
			echo '<td width="250" align="center">'.'$'.$sales[$c][1].'</td>';
			echo '<tr>';
		}
	}
	//'echo '銷貨金額:'.$sales[$a][$b].'</br>'; 	  	
    echo '<tr style="color:blue"><td><b>小計</b><td align="center">$<b>'.round($total,0).'</b><td align="center">$<b>'.round($Btotal,0).'</td></tr>';  
	if($totals<0)	
	echo '<tr style="color:red;font-size:20px;"><td><b>淨損</b></td><td colspan="2" align="center">$<b>'.$totals.'</b></td></tr>'; //虧損
	else
	echo '<tr style="color:blue;font-size:20px;"><td><b>淨利</b></td><td colspan="2" align="center">$<b>'.$totals.'</b></td></tr>';  //盈利	
 	echo '</table>';	
	echo '</form>';	
	echo '</center>';
?> 
</body>
</html>



