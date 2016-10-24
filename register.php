<?php
$fuser = $fpass = $query = $result = $numrows = $row = $result = "initialValue";
if (isset($_POST['fuser']) && isset($_POST['fpass'])) {
	if (get_magic_quotes_gpc()) 
	{
		// magic_quotes_gpc is ON
		// so we don't need to do anything
		$fuser = htmlentities(strip_tags($_POST['fuser']));
		$fpass = htmlentities(strip_tags($_POST['fpass']));
		$fname = htmlentities(strip_tags($_POST['fname']));
		$fcountry = htmlentities(strip_tags($_POST['fcountry']));
		$fcharacter = htmlentities(strip_tags($_POST['fcharacter']));
		$femployer = htmlentities(strip_tags($_POST['femployer']));
	}
	else 
	{
		// if magic quotes is off, we need to add slashes in order to prevent injection attacks.
		$fuser = htmlentities(strip_tags(addslashes($_POST['fuser'])));
		$fpass = htmlentities(strip_tags(addslashes($_POST['fpass'])));
		$fname = htmlentities(strip_tags(addslashes($_POST['fname'])));
		$fcountry = htmlentities(strip_tags(addslashes($_POST['fcountry'])));
		$fcharacter = htmlentities(strip_tags(addslashes($_POST['fcharacter'])));
		$femployer = htmlentities(strip_tags(addslashes($_POST['femployer'])));
	}
	$id = time();
	$fpass = sha1($fpass);
	require "dbconnect.php"; // connect to db
	$query = "insert into profile values ('$id', '$fname', '$fcountry', '$fcharacter', '$femployer')";
	if (!mysql_query($query))
	{
		die('Error: ' . mysql_error());
	}
	$query = "insert into users values ('$id', '$fuser', '$fpass')";	
	if (!mysql_query($query))
	{
		die('Error: ' . mysql_error());
	}
	
	header( 'Location: login.php' ) ;

}
?>
