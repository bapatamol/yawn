<?php
$search = "initialValue";
$userid = 999;
if (get_magic_quotes_gpc())
{
     // magic_quotes_gpc is ON
     // so we don't need to do anything
     $search = htmlentities(strip_tags($_POST['search']));
}
else
{
	// if magic quotes is off, we need to add slashes in order to prevent injection attacks.
        $search  = htmlentities(strip_tags(addslashes($_POST['search'])));
}
// if no input, return no suggestions back to the user
if ($search == "")
	return;
// connect to database
require "dbconnect.php"; 
// suggest table name has "suggest" column with possible suggestion values;
// query to query suggest table
$query = "select id, name from profile where name like '" . $search . "%'";
// execute query
$result = mysql_query($query);  
// loop through results
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	// print out results to standard out
	$to = $row['id'];
	echo "<a ";
	echo "onclick = ";
	echo "fillPage($to) ";
	echo "name = $to";
	echo ">";
	echo $row['name'];
	echo "</a>\n";
	
}

?>