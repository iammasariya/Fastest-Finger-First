<?php
ob_start();
require_once("session.php"); 
?>
<html>
	<head>
	<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>
<body>
<div class="box">
<h1 align="center">Runtime : Xtra Mile Finals!</h1>
</div>
<div class="box">
<h1 align="center">ANSWERS</h1>
</div>
<?php 

if($_SESSION['refid']!='admin')
		{
			header("Location:notallowed.html");
	exit;

		}
?>
	<div class="ansbox">
<?php

 //

/*if (!isset($_SESSION['signed_in'])) {
    
   header("Location: login.php");
			exit;
}*/

require_once("connection.php");
?>
<div class="rowtitle" >
<div class="colstitle">REF ID</div>
<div class="colstitle">ANS1</div>
<div class="colstitle">ANS2</div>
<div class="colstitle">TIME</div>
</div>
<?php

//$_SESSION['qid']=$_SESSION['qid'];

//$qid=$_SESSION['qid'];
$query1="SELECT max(qid) AS qid FROM answers";
$result=mysql_query($query1);
$rows=mysql_fetch_row($result);
$temp=$rows[0];
//$temp=1;



 
$query="SELECT * FROM answers WHERE `qid`='{$temp}' ORDER BY time ASC";

$result_set=mysql_query($query);

if(!$result_set)
{
	die("Database query failed: ".mysql_error());
}
else
{
	
    while(($row = mysql_fetch_array($result_set))) {
    ?>
	
	
<div class="row">
<div class="cols"><?php	echo $row["refid"]; ?></div>
<div class="cols"><?php	echo $row["blank1"]; ?></div>
<div class="cols"><?php	echo $row["blank2"]; ?></div>
<div class="cols"><?php	echo $row["time"]; ?></div>
</div>
		
		<?php
		
}
}
?>
</div>
<div class="box">
<p align="center">CORRECT ANSWER</p>
<div class="rowtitle" >
<div class="colstitle">Question</div>
<div class="colstitle">ANS1</div>
<div class="colstitle">ANS2</div>

</div>
<?php

$query2="SELECT * FROM disp WHERE `qid`='{$temp}'";
$result_set1=mysql_query($query2);

if(!$result_set1)
{
	die("Database query failed: ".mysql_error());
}
else
{
	
    while(($row = mysql_fetch_array($result_set1))) {
    ?>
		<div class="rowans">
<div class="cols"><b><?php	echo $row["qid"]; ?></b></div>
<div class="cols"><b><?php	echo $row["ans1"]; ?></b></div>
<div class="cols"><b><?php	echo $row["ans2"]; ?></b></div>
</div>
		<?php
		
}
}


?>
<div style="align:center;">
<form action="display.php" name="que" method="post">
		<input type="hidden" name="nextq" value="<?php echo ++$temp; ?>"/>
		<!--<input type="hidden" name="nextq" value="3" />-->
		<input type="submit" name="next" value="Next Question">
		
		</form>
		</div>
</div>



 
	