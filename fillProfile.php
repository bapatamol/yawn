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
if ($userId != $me)
{	
	// find friendship between me and userid
	// if me and userid are already friends, dont prompt it.
	$qFship = "select * from friends where fromId = $me and toId = $userId";
	$rFship = mysql_query($qFship);
	$ctr = 0; // if there exists a row between me and userid, then we are already friends.
	while ($rowFship = mysql_fetch_array($rFship, MYSQL_ASSOC))
	{
		$ctr++; // so if this is 1, then we dont want to write it. so flag should be 0.
	}
	if ($ctr == 1)
	{
		$flag = 0; // flag is 0 in case when there is a row between me and userid.
	}
	else
	{
		$flag = 1; // if there is no row between me and userid, then flag is 1. this means chk the other table for it.
	}
	// find an earlier friendship request between me and userid
	// if i have already requested userid to be my firend, 
	// dont prompt.

	if ($flag == 1) // couldnt find connection as friend between me and userid, now lets see if i had requested him earlier.
	{
		$qFship = "select * from friendrequest where fromId = $me and toId = $userId";
		$rFship = mysql_query($qFship);
		$ctr = 0;
		while ($rowFship = mysql_fetch_array($rFship, MYSQL_ASSOC))
		{
			$ctr++; // again, ctr will be 0 if i had NOT sent a request to him earlier. if there exists 1 row here, then it means i had requested earlier, so dont show now. keep flag 0.
		}
		if ($ctr == 1) // ctr =0 means there is no coneection between me and him here. so i can add a completely new request.
		{
			// there exists some connection between me and userid. so dont show
			$flag = 0;
		}
	}
	if ($flag > 0) // flag = 0 means there is 1 connetion either as a friend or a friend request between me and userid, flag = 1 means there is none, so i can add him as a friend
	{
		echo "<a onclick=";
		echo "addFriend(". $userId. ")";
		echo ">";
		echo "Add " . $row['name'] . " as a friend";
		echo "</a>";
	}
}	
else
{
	echo "<input type=button onclick=fillEditProfile() value='Edit Profile'/>";
}
// print out results to standard out
echo "<br/>";
echo "<br/>";
echo "Name = ";
echo $row['name'];
echo "<br/>";
echo "Home Country = ";
echo $row['country'];
echo "<br/>";
echo "Favorite fictional character = ";
echo $row['character'];
echo "<br/>";
echo "Current Employer = ";
echo $row['employer'];
echo "<br/>";	
}
?>
