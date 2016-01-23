<?php 
include "dbinfo.php"; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
	<head>  
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
		<title>Lab 7 PHP</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>  
	<body>  
	<div id="main">
	
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
	//let the user access the page
}
elseif(!empty($_POST['username']) && !empty($_POST['password'])){
	//access user to login
}
else{
	//show form data
}
	if(isset($_COOKIE['userData1'])){	
		$data = $_COOKIE['userData1'];
	}
	
	if(	empty($_POST["remember"]) ){
	setcookie("userData1", time()-1);		
	}else {		
		//remember the username and student number in a cookie stored for 1 week
		//build a comma delimited string
		setcookie("userData1", time() + 60*60*24*7);				
	}
?>
	
<?php 
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
	?>
	<h1>Members Only </h1>
	<p>Your inside the secret zone. You are <code><?=$_SESSION['Username']?></code> and your username is <code><?=$_SESSION['Password']?></code>.<p>
	<p>Logout <a href="logout.php">Click here to logout</a>.</p>
	<?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = mysqli_real_escape_string($connection,$_POST['username']);
	$password = md5(mysqli_real_escape_string($connection,$_POST['password']));
	
	$checklogin = mysqli_query($connection, "SELECT * FROM users WHERE username = '" .$username. "' And Password = '".$password."'");
	
	if(mysqli_num_rows($checklogin) == 1)
	{
		$row = mysqli_fetch_array( $checklogin);
		$_SESSION['Username'] = $username;
		$_SESSION['Password'] = $password;
		$_SESSION['LoggedIn'] = 1;
		
		echo "<h1>Awesome</h1>";
        echo "<p>YOur a member only</p>";
		
		?>
			//<p>Logout <a href="logout.php">Click here to logout</a>.</p>
			<a href="logout.php">Logout</a><?php
        echo "<meta http-equiv='refresh' content='=2;index.php' />";
    }
    else
    {
		echo "<h1>Oh Dear</h1>";
         echo "<p>Boo urns, your account could not be found. Please <a href=\"index.php\">click here to try it again!</a>.</p>";
	}
}else{?>
	
	
	<h1>Members with jackets only please</h1>
	   <p>Your here! Please  login below, or <a href="register.php">Click here to register</a>.</p>
	   
	   <form method = "post" action = "index.php" name ="loginform" id="loginform">
		<fieldset>
			<label for = "username">Username:</label><input type = "text" name = "username" id ="username" /><br />
		<label for = "password">Password:</label><input type = "password" name="password" id="password" /><br />
		<input type = "submit" name = "login" id ="login" value = "login" / >
		<label for="remember">Remember Me</label>
			<input type="checkbox"
					name="remember" 
					value="remember"
					id="remember" />  
			<br />
	
		</fieldset>
		</form>
		
		<?php
}
?>
 
</div>
</body>
</html>

?>