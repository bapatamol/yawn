<?php

	session_start(); // start a new session or append the earlier one.
	$me = $_SESSION['userid'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> 
		<title> YAWN </title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	</head>
	<script type="text/javascript" src="jquery.js"></script>          
	<script type="text/javascript">
	function addFriend($var1)
	{
		// jQuery implementation of AJAX call 
		$.post(
			"addFriend.php", // post to abapat-p9.php
			{ userId:$var1 },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>Notices</u> <br/>" + data;
				$("#notice").html(data); // modify text area with ajax output
			}
		);
	}		
	function fillProfile()
	{
		document.getElementById("notice").innerHTML = "";
		var value = $("#userId").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"fillProfile.php", // post to abapat-p9.php
			{ userId: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				$("#profile").html(data); // modify text area with ajax output
			}
		);
	}		
	function fillFriends()
	{
		var value = $("#userId").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"fillFriends.php", // post to abapat-p9.php
			{ userId: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>My Friends</u><br/>" + data;
				$("#friends").html(data); // modify text area with ajax output
			}
		);
	}		
	function fillRequests()
	{
		var value = $("#userId").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"fillRequest.php", // post to abapat-p9.php
			{ userId: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>Friend Requests for me</u> <br/>" + data;
				$("#requests").html(data); // modify text area with ajax output
			}
		);
	}		
	function fillTestimonial()
	{
		var value = $("#userId").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"fillTestimonials.php", // post to abapat-p9.php
			{ userId: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>My Testimonials</u> <br/>" + data;
				$("#testimonials").html(data); // modify text area with ajax output
			}
		);
	}		
	
	function fillPage($var)
	{
		$("#userId").val($var);
		fillProfile();
		fillFriends();
		fillTestimonial();
		fillRequests();
	}
	
	function getSuggestions()
	{
		var value = $("#search").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"getSuggestions.php", // post to abapat-p9.php
			{ search: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>Search Results</u> <br/>" + data;
				$("#suggestions").html(data); // modify text area with ajax output
			}
		);
	}		
	
	function changeProfile($var)
	{
		$("#userId").val($var);
	}
	
	
	function accept($var)
	{
		// jQuery implementation of AJAX call 
		$.post(
			"acceptFriendReq.php", // post to abapat-p9.php
			{ userId: $var },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>Notices</u> <br/>" + data;
				$("#notice").html(data); // modify text area with ajax output
			}
		);
		fillPage($var);
	}		
	
	function decline($var)
	{
		// jQuery implementation of AJAX call 
		$.post(
			"declineFriendReq.php", // post to abapat-p9.php
			{ userId: $var },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				data = "<u>Notices</u> <br/>" + data;
				$("#notice").html(data); // modify text area with ajax output
			}
		);
		fillPage($var);
	}	
	
	function fillEditProfile()
	{
		document.getElementById("notice").innerHTML = "";
		var value = $("#userId").val(); // grab text input and store in value
		// jQuery implementation of AJAX call 
		$.post(
			"fillEditProfile.php", // post to abapat-p9.php
			{ userId: value },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				$("#profile").html(data); // modify text area with ajax output
			}
		);
	}
	
	function editProfile()
	{
		document.getElementById("notice").innerHTML = "";
		var value = $("#userId").val(); // grab text input and store in value
		var name = $("#name").val();
		var address = $("#address").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		// jQuery implementation of AJAX call 
		
		$.post(
			"editprofile.php", // post to abapat-p9.php
			{ userId: value, fname:name, faddress:address, fphone:phone, femail:email  },  // parameter userInput
			// callback function with data written to standard out from abapat-p9.php program
			function(data) 
			{
				$("#profile").html(data); // modify text area with ajax output
			}
		);
		fillProfile();
	}
	
	</script>
	<body onLoad="fillPage()">
		<form method="post">
		<input type="hidden" id="userId" onchange="fillPage()" value="<?php echo $me ?>"/>
		</form>
		<a href="http://yawn.webege.com/profile.php"> Home </a>
		<a href="http://yawn.webege.com/login.php"> Logout </a>
		<p id="notice"> </p>
		<p id="profile"> </p>
		<p id="friends"> </p>
		<p id="requests"> </p>
		<p id="testimonials"> </p>
		<p id="searchResults"> 
		<form method="post">
		Search other users:
		<input type="text" id="search" onkeyup="getSuggestions()"/>
		</form>
		<p id="suggestions"> </p>
		
		</p>
	</body>
</html>
