<?php
ob_start();
/*
developer: pratik agrawal
this script will display 15 incompleted codes one by one.
$_POST['nextq']) variable is important
*/
 require_once("session.php"); 
?>
<?php 

if($_SESSION['refid']!='admin')
		{
			header("Location:notallowed.html");
	exit;

		}
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
<?php
/*if (!isset($_SESSION['signed_in'])) {
    
   header("Location: login.php");
			exit;
}*/

require_once("connection.php");

if(!isset($_POST['nextq']))
{
$_SESSION['qid']=1;
$qid=$_SESSION['qid'];
 }
 else
 {
 	if($_POST['nextq']==16)
	{
	header("Location:gameover.html");
	exit;
	}


 $qid = $_POST['nextq'];
 }
$query="SELECT * FROM questions WHERE `qid`='{$qid}'";

$result_set=mysql_query($query);

if(!$result_set)
{
	die("Database query failed: ".mysql_error());
}
else
{
	
    while(($row = mysql_fetch_array($result_set))) {
    ?>
	
	<div class="rowque">
<div class="cols" style="width:600px"><h1>Question :<?php	echo $row["qid"]; ?></h1> </div>
</div>

<div class="rowque">
<div class="cols" style="width:600px"><h3><pre><?php	echo htmlentities($row["code"]); ?></pre></h3></div>


		</div>
		
		<?php
		
		if($_SESSION['refid']=='admin')
		{
		?>
		<form action="display.php" name="que" method="post">
		<input type="hidden" name="nextq" value="<?php echo ++$qid; ?>" />
		<input type="submit" name="next" value="Next Question">
		
		</form>
		<form action="disp1.php" name="ans" method="post">
		
		<input type="submit" name="display" value="Display Answers">
		</form>
		
		<?php
		}
		
}
}
?>

</body>
</html>

 
	