<?php
include "dbinfo.php"?>
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Registration Management System</title>

<div id = "main">

<?php 
if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = md5(mysqli_real_escape_string($connection, trim($_POST['password'])));
	if (strlen($_POST['password'])<8) { 
	   die("It's a password, not your buddy's nickname!  Good grief!"); 
	} 

		$cpassword = ($_POST['password']);	
		if($password != $cpassword){
		echo "The passwords don't match bro ";
		echo "<p>Please <a href=\"register.php\">click here to try it again!</a>.</p>";	
		die();

}

	$checkusername = mysqli_query($connection,"SELECT * FROM users WHERE username = '".$username."'");	
		if(mysqli_num_rows($checkusername) == 1)	{
			echo "<h1> Someone else has that username, sorry bro. But you can create another one if you want.</h1>";			
		}else{
			$registerquery = mysqli_query($connection,"INSERT INTO users (username, password) VALUES ('".$username."' , '".$password."')");
			if($registerquery){
				echo "<h1> You did it mate. Your account was created.  Please <a href=\"index.php\">click here to login</a>.</h1>";
			}else{
			 echo "<p>Sorry bro, your registration failed. Please go back and try again.</p>";				 
		}			
	}
}

else{
	?>	
	<h1>Cool! Come on and register</h1>
	   <p>Please enter your details below to register.</p>
     
    <form method="post" action="register.php" name="registerform" id="registerform">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<label for="cpassword">Confirm Password:</label><input type="password" name="cpassword" id="cpassword" /><br />
        <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>     
    <?php
}
?>
 
</div>
</body>
</html>

