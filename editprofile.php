<?php
session_start(); // start a new session or append the earlier one.
$me = $_SESSION['userid'];

$fuser = $fpass = $query = $result = $numrows = $row = $result = "initialValue";

	if (get_magic_quotes_gpc()) 
	{
		// magic_quotes_gpc is ON
		// so we don't need to do anything
		$fname = htmlentities(strip_tags($_POST['fname']));
		$fcountry = htmlentities(strip_tags($_POST['fcountry']));
		$fcharacter = htmlentities(strip_tags($_POST['fcharacter']));
		$femployer = htmlentities(strip_tags($_POST['femployer']));
	}
	else 
	{
		// if magic quotes is off, we need to add slashes in order to prevent injection attacks.
		$fname = htmlentities(strip_tags(addslashes($_POST['fname'])));
		$fcountry = htmlentities(strip_tags(addslashes($_POST['fcountry'])));
		$fcharacter = htmlentities(strip_tags(addslashes($_POST['fcharacter'])));
		$femployer = htmlentities(strip_tags(addslashes($_POST['femployer'])));
	}

	$fpass = sha1($fpass);
	require "dbconnect.php"; // connect to db
	$query = "update profile set name = '$fname', country = '$fcountry', character = '$fcharacter', employer = '$femployer' where id = '$me'";
	if (!mysql_query($query))
	{
		die('Error: ' . mysql_error());
	}
	

?>
