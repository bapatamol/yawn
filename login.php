<?php
$fuser = $fpass = $query = $result = $numrows = $row = $result = "initialValue";
if (isset($_POST['fuser']) && isset($_POST['fpass'])) {
	if (get_magic_quotes_gpc()) 
	{
		// magic_quotes_gpc is ON
		// so we don't need to do anything
		$fuser = htmlentities(strip_tags($_POST['fuser']));
	}
	else 
	{
		// if magic quotes is off, we need to add slashes in order to prevent injection attacks.
		$fuser = htmlentities(strip_tags(addslashes($_POST['fuser'])));
	}
	$fpass = sha1($_POST['fpass']); // immediately get sha1 for the password
	require "dbconnect.php"; // connect to db
	$query = 'select id from users ' . "where username = '$fuser' " // query db for htat user
	. "and password = '" . $fpass . "'"; 
	$result = mysql_query($query); // execute query
	$num_rows = mysql_num_rows($result); // get number of rows in result. if 0, user not present
	if ($num_rows > 0)  
	{
		session_start(); // start a new session or append the earlier one.
		$row = mysql_fetch_row($result); // get result
		$_SESSION['valid_user'] = $fuser; // append session state variables here.
		$_SESSION['userid'] = $row[0]; 
	}
	mysql_close($db); // close db connection
}
?>
<?php
	if (isset($_SESSION['valid_user'])) 
	{
		// on successful login,  redirect to home page with appropriate message
		header( 'Location: profile.php' ) ;
	} 
	else 
	{ 
		// user is not logged in
		if ($fuser != "initialValue")  // assumption is that username is not "initialValue"
		{ 
			// tried to login, but failed
			echo "Login Failed. Please Retry.<br>";
		} 
		else 
		{ 
			// not logged in
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head> <title> YAWN - Login </title>
<link rel="stylesheet" type="text/css" href="abapat-p6-styles.css" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="header">

</div>
<div class="head">
YAWN - Yet another web network!
</div>
<div class="homeBody">
	<h2> Login </h2>
	<form method="post" action="login.php">
	Username:&nbsp;<input type="text" name="fuser"><p>
	Password:&nbsp;<input type="password" name="fpass"><p>
	<input type="submit" value="Login">
	</form>
	Not a user? <a href="http://yawn.webege.com/register.html"> Register Here </a>
<?php
}
?>

</div>
</body>
</html>
