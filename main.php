<?php

 require_once("session.php"); 

/*if (!isset($_SESSION['signed_in'])) {
    
   header("Location: login.php");
			exit;
}*/

require_once("connection.php");
 
	


if (isset($_POST['next']))
    { // Form has been submitted.
	$qid=$_POST['qid'];
	$refid=$_SESSION['refid'];
	$blank1 = $_POST['blank1'];
    $blank2 = $_POST['blank2'];
	

                     
              $query = "INSERT INTO answers
			(qid,refid,blank1,blank2,time)
			VALUES
			('{$qid}','{$refid}','{$blank1}','{$blank2}',CURTIME())";
                    $result_set = mysql_query($query);

                 if(!$result_set)
					{
						die("Database query failed: ".mysql_error());
					}                  
                
	
	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div>
<script type="text/javascript">
var start = new Date().getTime();

</script>


           <div class="box"><b>Enter question number Carefully. (the question number displayed currently on projector.)</b></div>
          
            <div class="simplebox">
			
	  <h2>Runtime : Xtramile Finals</h2>
	 

                <form action="main.php" method="post" name="ans">
				<table>
				<tr>
				<td>Question No:</td>
				<td><input id="q" type="text" name="qid"  height="20px" autofocus maxlength="30" required/></td>
				</tr>
				<tr>
				<td>Blank1:</td>
				<td><input id="q" type="text" name="blank1"  autofocus maxlength="30" /></td>
				</tr>
                    <script>
    if (!("autofocus" in document.createElement("input"))) {
      document.getElementById("q").focus();
    }
  </script>
                   <tr>
				<td> Blank2:</td><td><input type="text" name="blank2"  maxlength="30"  /></td>
					</tr>
					<tr>
					<td>
                    <div>
                         <input type="submit" name="next" value="next" />
                         </td></tr>
                    </div>
					</table>
                </form>
                
                </div>
                    
            </div>
			
			
			</body>
			</html>