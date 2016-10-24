<?php

session_start(); // start a new session or append the earlier one.
$me = $_SESSION['userid'];

$userId = "initialValue";
if (get_magic_quotes_gpc())
{
     // magic_quotes_gpc is ON
     // so we don't need to do anything
     $userId = htmlentities(strip_tags($_POST['userId']));
}
else
{
	// if magic quotes is off, we need to add slashes in order to prevent injection attacks.
        $userId  = htmlentities(strip_tags(addslashes($_POST['userId'])));
}
// if no input, return no suggestions back to the user
if ($userId == "")
	return;
// connect to database
require "dbconnect.php"; 
// suggest table name has "suggest" column with possible suggestion values;
// query to query suggest table
$query = "delete from friendrequest where fromId = '$userId' and toId = '$me'";
// execute query
if (!mysql_query($query))
{
	die('Error: ' . mysql_error());
}

$query = "delete from friendrequest where toId = $userId  and fromId = '$me'";
// execute query


if (!mysql_query($query))
{
	die('Error: ' . mysql_error());
}
echo "Friend request declined.";

?>
