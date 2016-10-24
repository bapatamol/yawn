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
$query = "select * from profile where id = '" . $userId . "'";
// execute query
$result = mysql_query($query);  
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
// print out results to standard out
echo "<form action=editprofile.php method=post>";
echo "<br/>";
echo "<br/>";
echo "Name = ";
echo "<input type=text name='fname' id='name' value='";
echo $row['name'];
echo "'/>";
echo "<br/>";
echo "Home Country = ";
echo "<input type=text name='fcountry' id='country' value='";
echo $row['country'];
echo "'/>";
echo "<br/>";
echo "Favorite fictional character = ";
echo "<input type=text name='fcharacter' id='character' value='";
echo $row['character'];
echo "'/>";
echo "<br/>";
echo "Current Employer = ";
echo "<input type=text name='femployer' id='employer' value='";
echo $row['employer'];
echo "'/>";
echo "<br/>";	
echo "<input onclick='editProfile()'type='button' value='Save'>";
echo "</form>";
}
?>
