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
$query = "select * from testimonials where toId = '" . $userId . "'";
// execute query
$result = mysql_query($query);  
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
// print out results to standard out
$q2 = "select name from profile ";
	$q2 .= "where id = ".
	$row['fromId'];
	$result2 = mysql_query($q2);
	$nm = mysql_fetch_array($result2, MYSQL_ASSOC);
	
echo $nm['name'] . "\t";
echo $row['testimonial'];
echo "\n";
	
}
?>
