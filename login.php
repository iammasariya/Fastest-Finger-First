<?php

 require_once("session.php"); 

if (logged_in()) {
    
   header("Location: main.php");
			exit;
}

require_once("connection.php");


if (isset($_POST['login']))
    { // Form has been submitted.
	
	$username = $_POST['username'];
    $password = $_POST['password'];


 $query = "SELECT * ";
        $query .= "FROM users ";
        $query .= "WHERE refid = '{$username}' ";
        $query .= "AND pass = '{$password}' ";
        $query .= "LIMIT 1";
		//echo $query;
    $result_set = mysql_query($query);
		
		if(!$result_set)
					{
						die("Database query failed: ".mysql_error());
					}
				
	if (mysql_num_rows($result_set) == 1) 
	{
            // username/password authenticated
            // and only 1 match
			
			$found_user = mysql_fetch_array($result_set);
            $_SESSION['signed_in'] = true;
			
			$_SESSION['refid']=$found_user['refid'];
			
	header("Location: main.php");
			exit;
				}
	else
	{
			   // username/password combo was not found in the database
            $message = "Username/password combination incorrect.<br />
					Please try again.";	
					echo $message;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
         <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
	<div class="box">
	<h1 align="center"><u>Footprints X2</u></h1>
<h1 align="center">Welcome to Runtime : Xtra Mile Finals!</h1>
  
</div>
        <div class=simplebox>
    
           <!-- <div class="login">-->
			<h3 align="center">Login Details</h3>
                <form action="login.php" method="post" name="login">
                   <b>FP ID:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="q" type="text" name="username" height="20px"  autofocus maxlength="30" value="<?php echo htmlentities($username);?>"  required/>
                    <script>
    if (!("autofocus" in document.createElement("input"))) {
      document.getElementById("q").focus();
    }
  </script><br/>
                    <b>Password:</b>&nbsp;&nbsp;<input type="password" name="password"  maxlength="30" value="<?php echo htmlentities($password);?>"  required/><br />

                    
                         <input type="submit" name="login" value="Login" /><br />
                         
                    
                </form>
                
              <!--  </div> -->
                    
            </div>
			
			</body>
			</html>